<?php
$servername = "localhost";  // or your server's IP address
$username = "root";         // or your MySQL username
$password = "";             // or your MySQL password
$dbname = "parking_system"; // the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

