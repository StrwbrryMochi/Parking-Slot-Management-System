<?php 
    
    include 'connections.php';
    include 'parkingFunction.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // For Adding Slot
        if (isset($_POST['addParking'])) {
            
            $floor = $_POST['floor'];
            $zone = $_POST['zone'];
            $slot_number = $_POST['slot_number'];
            $plateNumber = $_POST['plate_number'];
            $vehicleType = $_POST['vehicle_type'];
            $userType = $_POST['user_type'];
            
            // Get the current page from the form
            $current_page = isset($_POST['current_page']) ? $_POST['current_page'] : 'default';
    
            // Call Function To Add A Slot
            parkingAdd($floor, $zone, $slot_number, $plateNumber, $vehicleType, $userType, $current_page);
        }
    }