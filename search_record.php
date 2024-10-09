<?php
include 'db_connection.php';

if (isset($_GET['cardNumber'])) {
    $cardNumber = $_GET['cardNumber'];
    $sql = "SELECT * FROM records WHERE card_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cardNumber);

    $stmt->execute();
    $result = $stmt->get_result();

    header('Content-Type: application/json');

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        echo json_encode(['success' => true, 'record' => $record]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Record not found']);
    }
    $stmt->close();
    $conn->close();
}
?>
