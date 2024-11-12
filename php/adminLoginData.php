<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['Email'])) { 
    $Email = $_SESSION['Email'];

    include 'connections.php'; 

    // Fetch all necessary data
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
        // Fetch data into $row
        $row = $result->fetch_assoc();
        
        // Assign individual variables from $row
        $FirstName = $row['FirstName'];
        $LastName = $row['LastName'];
        $Email = $row['Email'];
        $Gender = $row['Gender'];
        $PhoneNumber = $row['PhoneNumber'];
        $BirthDate = $row['BirthDate'];
        $Address = $row['Address'];
        $Photo = '../uploads/' . $row['Photo'];
        $Account_type = $row['Account_type'];
        $Status = $row['Status']; 

        // Create the $currentUser array after fetching for Editing User
        $currentUser = [
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Gender' => $Gender,
            'PhoneNumber' => $PhoneNumber,
            'BirthDate' => $BirthDate,
            'Address' => $Address,
            'Photo' => $Photo,
            'Account_type' => $Account_type,
            'Status' => $Status
        ];

        // Set account role if staff
        if ($Account_type == 2) {
            $Account_role = "Staff";
        } else if ($Account_type == 1) {
            $Account_role = "Admin";
        }

        // Redirect if the user is not a staff member
        if ($Account_type != 1) {
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
?>
