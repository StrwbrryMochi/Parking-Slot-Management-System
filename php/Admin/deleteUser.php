<?php
include '../connections.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["deleteStaff"])) {
    $userID = $_GET['deleteStaff'];

    $sql = "DELETE FROM usertbl WHERE userID = $userID";

    if ($connections->query($sql) === TRUE) {
        echo "<script>window.location.href='../../Admin/UserManagement.php?staff_delete=true';</script>";
    } else {
        echo "Error: " . $connections->error;
    }
}