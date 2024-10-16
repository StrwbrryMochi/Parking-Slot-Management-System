<?php 
    
    include 'connections.php';
    include 'parkingFunction.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // For Adding Slot
        if (isset($_POST['addSlot'])) {
            
            $floor = $_POST['floor'];
            $zone = $_POST['zone'];
            $slot_number = $_POST['slot_number'];
            $plateNumber = $_POST['plate_number'];
            $vehicleType = $_POST['vehicle_type'];
            $userType = $_POST['user_type'];
            
            $current_page = isset($_POST['current_page']) ? $_POST['current_page'] : 'default';
    
            if ($floor !== null && $zone !== null && $slot_number !== null && $plateNumber !== null && $vehicleType !== null && $userType !== null) {
                // Call Function To Add A Slot
                slotAdd($floor, $zone, $slot_number, $plateNumber, $vehicleType, $userType, $current_page);
            } else {
                echo "Error: Missing or invalid data.";
            }
        }

        if (isset($_POST['editSlot'])) {

            $floor = $_POST['floor'];
            $zone = $_POST['zone'];
            $slot_number = $_POST['slot_number'];
            $plateNumber = $_POST['plate_number'];
            $vehicleType = $_POST['vehicle_type'];
            $userType = $_POST['user_type'];

            $current_page = isset($_POST['current_page']) ? $_POST['current_page'] : 'default';

             if ($floor !== null && $zone !== null && $slot_number !== null && $plateNumber !== null && $vehicleType !== null && $userType !== null) {
                // Call the slotEdit function to update the slot information
                slotEdit($floor, $zone, $slot_number, $plateNumber, $vehicleType, $userType, $current_page);
            } else {
                echo "Error: Missing or invalid data.";
            }
        }


    }