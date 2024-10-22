<?php 
session_start();

if (isset($_SESSION['Email'])) {
    include "connections.php";

    $Email = $_SESSION['Email'];

    $updateSql = "UPDATE usertbl SET Status = 'Offline' WHERE Email = ?";
    $stmt = $connections->prepare($updateSql);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->close();
    $connections->close();
}

session_destroy();

header("Location: ../login.php");
exit();
