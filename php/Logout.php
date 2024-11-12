<?php 
session_start();

if (isset($_SESSION['Email'])) {
    include "connections.php";

    $Email = $_SESSION['Email'];

    date_default_timezone_set('Asia/Manila');
    $current_time = date('Y-m-d');

    $updateSql = "UPDATE usertbl SET Status = 'Offline', Last_active = ?  WHERE Email = ?";
    $stmt = $connections->prepare($updateSql);
    $stmt->bind_param("ss", $current_time, $Email);
    $stmt->execute();
    $stmt->close();
    $connections->close();
}

session_destroy();

header("Location: ../login.php");
exit();
