<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['Email'])) { 
    $Email = $_SESSION['Email'];

    include 'connections.php'; 

    // Fetch all necessary data, including the status
    $sqlfetch = "SELECT * FROM usertbl WHERE Email = ?";
    $stmt = $connections->prepare($sqlfetch);
    
    if (!$stmt) {
        die("SQL prepare failed: " . $connections->error);
    }

    $stmt->bind_param("s", $Email);
    
    if (!$stmt->execute()) {
        die("SQL execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['userID'];
        $Email = $row['Email'];
        $Password = $row['Password'];
        $FirstName = $row['FirstName'];
        $LastName = $row['LastName'];
        $Gender = $row['Gender'];
        $BirthDate = $row['BirthDate'];
        $Address = $row['Address'];
        $PhoneNumber = $row['PhoneNumber'];
        $Photo = '../uploads/' . $row['Photo'];
        $Account_type = $row['Account_type'];
        $Status = $row['Status']; 

        // Set account role if staff
        if ($Account_type == 2) {
            $Account_role = "Staff";
        }

        // Redirect if the user is not a staff member
        if ($Account_type != 2) {
            echo "<script>window.location.href='../loginPage.php?Error=true';</script>";
            exit;
        }

        // Set status to online
        $updateStatus = "UPDATE usertbl SET Status = 'Online' WHERE Email = ?";
        $statusStmt = $connections->prepare($updateStatus);
        
        if (!$statusStmt) {
            die("SQL prepare failed: " . $connections->error);
        }

        $statusStmt->bind_param("s", $Email);
        
        if (!$statusStmt->execute()) {
            die("SQL execute failed: " . $statusStmt->error);
        }

        $statusStmt->close();
    } else {
        echo "<script>window.location.href='../Staff/session.php?session=error';</script>";
        exit;
    }

    $stmt->close();
    $connections->close();
} else {
    echo "<script>window.location.href='../staffPage/session.php?session=error';</script>";
    exit;
}



