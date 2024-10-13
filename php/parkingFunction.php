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
function parkingAdd($floor, $zone, $slot_number, $plateNumber, $vehicleType, $userType, $current_page) {
    global $connections;

    // Get the Slot ID based on the floor, zone, and slot number
    $slotidSql = "SELECT slot_id FROM parking_tbl WHERE floor = ? AND zone = ? AND slot_number = ?";
    if ($stmt = $connections->prepare($slotidSql)) {
        $stmt->bind_param("ssi", $floor, $zone, $slot_number);
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

    // Close the database connection
    $connections->close();
    exit();
}