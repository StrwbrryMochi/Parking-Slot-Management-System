<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST values with default fallbacks
    $cardNumber = $_POST['cardNumber'] ?? '';
    $name = $_POST['name'] ?? '';
    $plateNumber = $_POST['plateNumber'] ?? '';
    $contactNumber = $_POST['contactNumber'] ?? '';
    $vehicleType = $_POST['vehicleType'] ?? 'Unknown';
    $duration = (int)($_POST['duration'] ?? 0);  // Ensure duration is an integer
    $ratePerMinute = 5;
    $charge = $duration * $ratePerMinute;  // Calculate charge
    $status = 'Active';
    
    // Validate required fields
    if (empty($cardNumber) || empty($name) || empty($plateNumber) || empty($contactNumber)) {
        echo "All fields are required!";
        exit();
    }

    // Check if any of cardNumber, name, plateNumber, or contactNumber already exists in the records table
    $sqlCheck = "SELECT * FROM records WHERE card_number = ? OR name = ? OR plate_number = ? OR contact = ?";
    $stmtCheck = $conn->prepare($sqlCheck);

    if (!$stmtCheck) {
        die("Error preparing check statement: " . $conn->error);
    }

    // Bind parameters for checking duplicate values
    $stmtCheck->bind_param("ssss", $cardNumber, $name, $plateNumber, $contactNumber);

    // Execute the query
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    // Check if any record exists
    if ($resultCheck->num_rows > 0) {
        // If a record is found, return an error message
        echo "Error: A record with the same card number, name, plate number, or contact number already exists.";
        $stmtCheck->close();
        exit();
    }

    // If no duplicates found, proceed with the insert
    $stmtCheck->close();

    // Prepare and bind the insert query
    $sqlInsert = "INSERT INTO records (card_number, name, plate_number, contact, duration, vehicle_type, status, charge) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);

    if (!$stmtInsert) {
        die("Error preparing insert statement: " . $conn->error);
    }

    // Bind parameters for insertion
    $stmtInsert->bind_param("ssssissd", $cardNumber, $name, $plateNumber, $contactNumber, $duration, $vehicleType, $status, $charge);

    // Execute statement
    if ($stmtInsert->execute()) {
        // Successfully inserted the record, now update the counts table
        $sqlUpdateCounts = "UPDATE counts SET guests = guests + 1, slots = slots - 1 WHERE id = 1";
        $stmtUpdate = $conn->prepare($sqlUpdateCounts);

        // Execute update statement
        if ($stmtUpdate->execute()) {
            echo "Record and counts updated successfully.";
        } else {
            echo "Error updating counts: " . $stmtUpdate->error;
        }

        $stmtUpdate->close();

        // Redirect to index.php on successful insertion and update
        header("Location: index.php");
        exit();
    } else {
        // Capture detailed error if record insertion fails
        echo "Error adding record: " . $stmtInsert->error;
    }

    // Close statement and connection
    $stmtInsert->close();
    $conn->close();
}
?>
