<?php
include 'db_connection.php';

// Execute statement
if ($stmt->execute()) {
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
    echo "Error adding record: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
