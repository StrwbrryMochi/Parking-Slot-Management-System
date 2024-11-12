<?php
include '../connections.php';

function slotEdit($floor, $zone, $slot_number, $Status, $Name, $assignedPhoto) {
    global $connections;

    $slot = $floor . $zone . $slot_number;

    // Get the Slot_Id from the floor, zone, and slot_number
    $slotidSql = "SELECT slot_id FROM parking_tbl WHERE floor = ? AND zone = ? AND slot_number = ?";
    if ($stmt = $connections->prepare($slotidSql)) {
        $stmt->bind_param("isi", $floor, $zone, $slot_number); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Error: Slot not found";
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

    // Update the slot with vehicle and user details
    $updateSql = "UPDATE parking_tbl SET fee = NULL, duration = NULL, time_out = NULL, time_in = NULL, status = ?, user_type = NULL, vehicle_type = NULL, plate_number = NULL WHERE slot_id = ?";
    if ($stmt = $connections->prepare($updateSql)) {
        $stmt->bind_param("si", $Status, $slot_id);
        if ($stmt->execute()) {

            // Add action to the audit log
            date_default_timezone_set('Asia/Manila');
            $current_time = date('Y-m-d H:i:s');
            $editAction = "has edited Slot $slot";
            $logSql = "INSERT INTO audit_log (Slot, Name, Photo, time, action) VALUES (?,?,?,?,?)";
            if ($logStmt = $connections->prepare($logSql)) {
                $logStmt->bind_param("sssss", $slot, $Name, $assignedPhoto, $current_time, $editAction);
                if (!$logStmt->execute()) {
                    echo "Error in audit log insertion: " . $logStmt->error;
                }
                $logStmt->close(); 
            } else {
                echo "Error preparing audit log statement: " . $connections->error; 
            }
            echo "<script>window.location.href='../../Admin/SlotManagement.php?edit_slot=true'</script>";
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