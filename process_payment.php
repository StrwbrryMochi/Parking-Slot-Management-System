<?php
include 'db_connection.php';

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = $_POST['cardNumber'];
    $charge = $_POST['charge'];

    // Begin the transaction
    $conn->begin_transaction();

    try {
        $sql = "DELETE FROM records WHERE card_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cardNumber);
        
        if ($stmt->execute()) {
            // Update counts only if the record deletion is successful
            $sqlUpdateCounts = "UPDATE counts SET guests = guests - 1, slots = slots + 1 WHERE id = 1";
            $conn->query($sqlUpdateCounts);
            
            // Commit the transaction
            $conn->commit();

            echo "<script>alert('Payment processed successfully'); window.location.href='index.php';</script>";
        } else {
            throw new Exception("Error processing payment");
        }
    } catch (Exception $e) {
        // Rollback the transaction if something goes wrong
        $conn->rollback();
        echo "<script>alert('" . $e->getMessage() . "'); window.location.href='index.php';</script>";
    } finally {
        $stmt->close();
        $conn->close();
    }
}
?>
