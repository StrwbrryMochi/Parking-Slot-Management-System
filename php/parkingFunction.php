<?php 
include 'connections.php';

//* To Fetch Parking Data
function fetchParking() {
    global $connections;

    if ($connections->ping()) {
        $sql = "SELECT * FROM parking_tbl";
        $result = mysqli_query($connections, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($connections);
            return[];
        }

        $parkingFetch = [];
        while($row = mysqli_fetch_assoc($result)) {
            $parkingFetch[] = $row;
        }

        return $parkingFetch;
    } else {
        echo "Error: Database connection is closed.";
        return [];
    }
}

//* To Assign a Slot
function slotAdd($floor, $zone, $slot_number, $plateNumber, $vehicleType, $userType, $current_page) {
    global $connections;

    // Get the Slot ID based on the floor, zone, and slot number
    $slotidSql = "SELECT slot_id FROM parking_tbl WHERE floor = ? AND zone = ? AND slot_number = ?";
    if ($stmt = $connections->prepare($slotidSql)) {
        $stmt->bind_param("isi", $floor, $zone, $slot_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Error: Slot not Found";
            $stmt->close();
            $connections->close();
            exit();
        }

        $row = $result->fetch_assoc();
        $slot_id = $row['slot_id'];
        $stmt->close(); 
    } else {
        echo "Error: " . $connections->error;
        $connections->close();
        exit();
    }

    // Check if the slot_id exists and is available
    $checkSql = "SELECT status FROM parking_tbl WHERE slot_id = ?";
    if ($stmt = $connections->prepare($checkSql)) {
        $stmt->bind_param("i", $slot_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Error: Slot not Found";
            $stmt->close();
            $connections->close();
            exit();
        }

        $row = $result->fetch_assoc();
        if ($row['status'] != 'Available') {
            echo "Error: Slot is not available";
            $stmt->close();
            $connections->close();
            exit();
        }

        $stmt->close(); 
    } else {
        echo "Error: " . $connections->error;
        $connections->close();
        exit();
    }

    // Set timezone and get the current time
    date_default_timezone_set('Asia/Manila');
    $current_time = date('Y-m-d H:i:s');

    // Update the status of the existing slot with formatted time_in and hardcoded payment_status to "Pending"
    $updateSql = "UPDATE parking_tbl SET plate_number = ?, user_type = ?, vehicle_type = ?, status = 'Occupied', time_in = ?, payment_status = 'Pending', zone = ?, floor = ?, slot_number = ? WHERE slot_id = ?";
    if ($stmt = $connections->prepare($updateSql)) {
        $stmt->bind_param("sssssiii", $plateNumber, $userType, $vehicleType, $current_time, $zone, $floor, $slot_number, $slot_id);
        if ($stmt->execute()) {
            // Adjust redirection based on the current page
            if ($current_page === 'StaffSlotManagement') {
                echo "<script>window.location.href='../Staff/StaffSlotManagement.php?add_slot=true'</script>";
            } else {
                echo "<script>window.location.href='../Staff/StaffSlotOverview.php?add_slot=true'</script>"; 
            }
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $connections->error;
    }

    $connections->close();
    exit();
}

// To Edit A Slot
function slotEdit($floor, $zone, $slot_number, $plateNumber, $vehicleType, $userType, $current_page) {
    global $connections;

    // Get The Slot_Id From the floor, zone, and slot_number
    $slotidSql = "SELECT slot_id FROM parking_tbl WHERE floor = ? AND zone = ? AND slot_number = ?";
    if ($stmt = $connections->prepare($slotidSql)) {
        $stmt->bind_param("isi", $floor, $zone, $slot_number); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Error: Slot not Found";
            $stmt->close();
            $connections->close();
            exit();
        }

        $row = $result->fetch_assoc();
        $slot_id = $row['slot_id'];
        $stmt->close();
    } else {
        echo "Error: " . $connections->error;
        $connections->close();
        exit();
    }

    // Check if the slot is occupied
    $checkSql = "SELECT status FROM parking_tbl WHERE slot_id = ?";
    if ($stmt = $connections->prepare($checkSql)) {
        $stmt->bind_param("i", $slot_id); // Use slot_id, not slot_number
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Error: Slot not Found";
            $stmt->close();
            $connections->close();
            exit();
        }

        $row = $result->fetch_assoc();
        if ($row['status'] != 'Occupied') {
            echo "Error: Slot is still Available!";
            $stmt->close();
            $connections->close();
            exit();
        }

        $stmt->close(); 
    } else {
        echo "Error: " . $connections->error;
        $connections->close();
        exit();
    }

    // Update the slot with vehicle and user details
    $updateSql = "UPDATE parking_tbl SET vehicle_type = ?, user_type = ?, plate_number = ? WHERE slot_id = ?";
    if ($stmt = $connections->prepare($updateSql)) {
        $stmt->bind_param("sssi", $vehicleType, $userType, $plateNumber, $slot_id); 
        if ($stmt->execute()) {
            // Adjust redirection based on the current page
            if ($current_page === 'StaffSlotManagement') {
                echo "<script>window.location.href='../Staff/StaffSlotManagement.php?edit_slot=true'</script>";
            } else {
                echo "<script>window.location.href='../Staff/StaffSlotOverview.php?edit_slot=true'</script>"; 
            }
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $connections->error;
    }

    $connections->close();
    exit();

}

// To Checkout A Slot
function slotCheckout($floor, $zone, $slot_number, $plateNumber, $vehicleType, $userType, $status, $time_in, $time_out, $duration, $fee, $current_page) {
    global $connections;

    // Get The Slot_Id From the floor, zone, and slot_number
    $slotidSql = "SELECT slot_id FROM parking_tbl WHERE floor = ? AND zone = ? AND slot_number = ?";
    if ($stmt = $connections->prepare($slotidSql)) {
        $stmt->bind_param("isi", $floor, $zone, $slot_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Error: Slot not Found";
            $stmt->close();
            $connections->close();
            exit();
        }

        $row = $result->fetch_assoc();
        $slot_id = $row['slot_id'];
        $stmt->close();
    } else {
        echo "Error: " . $connections->error;
        $connections->close();
        exit();
    }

    // Check if the slot is occupied
    $checkSql = "SELECT status FROM parking_tbl WHERE slot_id = ?";
    if ($stmt = $connections->prepare($checkSql)) {
        $stmt->bind_param("i", $slot_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Error: Slot not Found";
            $stmt->close();
            $connections->close();
            exit();
        }

        $row = $result->fetch_assoc();
        if ($row['status'] != 'Occupied') {
            echo "Error: Slot is still Available!";
            $stmt->close();
            $connections->close();
            exit();
        }

        $stmt->close(); 
    } else {
        echo "Error: " . $connections->error;
        $connections->close();
        exit();
    }

    // Update the parking table
    $checkoutSql = "UPDATE parking_tbl SET fee = ?, duration = ?, time_out = ?, time_in = ?, status = ?, user_type = ?, vehicle_type = ?, plate_number = ?, zone = ?, slot_number = ?, floor = ? WHERE slot_id = ?";
    if ($stmt = $connections->prepare($checkoutSql)) {
        $stmt->bind_param("issssssssiii", $fee, $duration, $time_out, $time_in, $status, $userType, $vehicleType, $plateNumber, $zone, $slot_number, $floor, $slot_id);
        
        if ($stmt->execute()) {
            $stmt->close();

            // Archive the slot information
            $archiveSql = "INSERT INTO archive_tbl (slot_id, floor, zone, slot_number, plate_number, vehicle_type, user_type, status, time_in, time_out, duration, fee, payment_status)
                           SELECT slot_id, floor, zone, slot_number, plate_number, vehicle_type, user_type, status, time_in, time_out, duration, fee, 'Paid'
                           FROM parking_tbl
                           WHERE slot_id = ?";        
            if ($stmt = $connections->prepare($archiveSql)) {
                $stmt->bind_param("i", $slot_id);
                
                if ($stmt->execute()) {
                    $stmt->close();

                    // Reset the slot
                    $resetSql = "UPDATE parking_tbl SET fee = NULL, duration = NULL, time_out = NULL, time_in = NULL, status = 'Available', user_type = NULL, vehicle_type = NULL, plate_number = NULL, zone = ?, slot_number = ?, floor = ? WHERE slot_id = ?";
                    if ($stmt = $connections->prepare($resetSql)) {
                        $stmt->bind_param("ssii", $zone, $slot_number, $floor, $slot_id);
                        
                        if ($stmt->execute()) {
                            $stmt->close();
                            // Adjust redirection based on the current page
                            if ($current_page === 'StaffSlotManagement') {
                                echo "<script>window.location.href='../Staff/StaffSlotManagement.php?checkout_slot=true'</script>";
                            } else {
                                echo "<script>window.location.href='../Staff/StaffSlotOverview.php?checkout_slot=true'</script>"; 
                            }
                        } else {
                            echo "Error Executing Reset query: " . $stmt->error . "<br>";
                        }
                    } else {
                        echo "Error Preparing Reset query: " . $connections->error . "<br>";
                    }
                } else {
                    echo "Error Executing Archive Query: " . $stmt->error . "<br>";
                }
            } else {
                echo "Error Preparing Archive Query: " . $connections->error . "<br>";
            }        
        } else {
            echo "Error Executing Update Query: " . $stmt->error . "<br>";
        }
    } else {
        echo "Error Preparing Update Query: " . $connections->error . "<br>";
    }

    $connections->close();
}