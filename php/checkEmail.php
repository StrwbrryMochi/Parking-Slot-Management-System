<?php
session_start();
include 'connections.php';

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents("php://input"), true);

    // Sanitize email input
    $Email = filter_var($data['Email'], FILTER_SANITIZE_EMAIL);

    // Prepare and execute statement
    $checkEmailStmt = $connections->prepare("SELECT * FROM usertbl WHERE Email = ?");
    $checkEmailStmt->bind_param("s", $Email);
    $checkEmailStmt->execute();
    $result = $checkEmailStmt->get_result();

    // Check if email exists and send JSON response
    if ($result->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }

    // Close statement
    $checkEmailStmt->close();
    exit;
}
