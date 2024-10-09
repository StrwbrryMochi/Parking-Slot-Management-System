<?php
$localhost = "localhost";  
$root = "root";         
$password = "";             
$database = "parking_system"; 

// Create connection
$connections = mysqli_connect($localhost, $root, $password, $database);

// Check connection
if ($connections->connect_errno) {
    echo "Error: " . $connections->errno;
}
