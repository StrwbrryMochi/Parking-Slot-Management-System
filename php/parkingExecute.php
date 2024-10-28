<?php 
    
    include 'connections.php';
    include 'parkingFunction.php';

    // POST METHOD
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
        
        if (isset($_POST['checkoutSlot'])) {

            $floor = $_POST['floor'];
            $zone = $_POST['zone'];
            $slot_number = $_POST['slot_number'];
            $plateNumber = $_POST['plate_number'];
            $vehicleType = $_POST['vehicle_type'];
            $userType = $_POST['user_type'];
            $status = $_POST['status'];
            $time_in = $_POST['time_in'];
            $time_out = $_POST['time_out'];
            $duration = $_POST['duration'];
            $fee = $_POST['fee'];

            $current_page = isset($_POST['current_page']) ? $_POST['current_page'] : 'default';

            if ($floor !== null && $zone !== null && $slot_number !== null && $plateNumber !== null && $vehicleType !== null && $userType !== null && $status !== null && $time_in !== null && $time_out !== null && $duration !== null && $fee !== null) {
                // Call the checkoutSlot function to update the slot information
                slotCheckout($floor, $zone, $slot_number, $plateNumber, $vehicleType, $userType, $status, $time_in, $time_out, $duration, $fee, $current_page);
            } else {
                echo "Error: Missing or invalid data.";
            }
        }
    }

// GET METHOD
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $selectedFloors = isset($_GET['floors']) ? $_GET['floors'] : [];
    $selectedZones = isset($_GET['zones']) ? $_GET['zones'] : [];
    $selectedVehicleTypes = isset($_GET['vehicle_types']) ? $_GET['vehicle_types'] : [];

    // Filter for occupied slots by plate number
    $occupiedSlots = searchSlot($search, $selectedFloors, $selectedZones, $selectedVehicleTypes);

    if (empty($occupiedSlots)) {
        echo "<tr><td colspan='6'>No parking data available for this plate number.</td></tr>";
    } else {
        foreach ($occupiedSlots as $parkingData) { ?>
            <tr>
                <td><?php echo htmlspecialchars($parkingData['floor']); ?></td>
                <td><?php echo htmlspecialchars($parkingData['zone']); ?></td>
                <td><?php echo htmlspecialchars($parkingData['slot_number']); ?></td>
                <td><?php echo htmlspecialchars($parkingData['plate_number']); ?></td>
                <td><?php echo htmlspecialchars($parkingData['vehicle_type']); ?></td>
                <td><?php echo htmlspecialchars($parkingData['status']); ?></td>
                <td>
                    <button
                        class="view-btn"
                        data-slot-id="<?php echo htmlspecialchars($parkingData['slot_id']); ?>" 
                        data-floor="<?php echo htmlspecialchars($parkingData['floor']); ?>" 
                        data-zone="<?php echo htmlspecialchars($parkingData['zone']); ?>" 
                        data-slot-number="<?php echo htmlspecialchars($parkingData['slot_number']); ?>" 
                        data-plate-number="<?php echo htmlspecialchars($parkingData['plate_number']); ?>"
                        data-user-type="<?php echo htmlspecialchars($parkingData['user_type']); ?>" 
                        data-vehicle-type="<?php echo htmlspecialchars($parkingData['vehicle_type']); ?>"
                        data-status="<?php echo htmlspecialchars($parkingData['status']); ?>"
                        data-time-in="<?php echo htmlspecialchars($parkingData['time_in']); ?>"
                        data-toggle="modal"
                        data-target="#slotModal">View</button>
                </td>
            </tr>
        <?php 
        }
    }
}