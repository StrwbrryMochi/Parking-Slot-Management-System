<?php
include '../connections.php';
include 'parkingFunction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['slotEdit'])) {
        $floor = $_POST['floor'];
        $zone = $_POST['zone'];
        $slot_number = $_POST['slot_number'];
        $Status = $_POST['Status'];
        $Name = $_POST['Name'];
        $assignedPhoto = $_POST['assignedPhoto'];

         if ($floor !== null && $zone !== null && $slot_number !== null && $Status !== null) {
            // Call the slotEdit function to update the slot information
            slotEdit($floor, $zone, $slot_number, $Status, $Name, $assignedPhoto);
        } else {
            echo "Error: Missing or invalid data.";
        }
    }
}