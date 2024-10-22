<?php 
session_start();
$Email = $passwordPost = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Email
    if (empty($_POST["Email"])) {
        echo "<script>window.location.href='login.php?email_empty=true';</script>";
        exit; 
    } else {
        $Email = $_POST["Email"];
    }

    // Validate Password
    if (empty($_POST["Password"])) {
        echo "<script>window.location.href='login.php?password_empty=true';</script>";
        exit; 
    } else {
        $passwordPost = $_POST["Password"];
    }

    // Check credentials only if both fields are filled
    if ($Email && $passwordPost) {
        include("php/connections.php");

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $connections->prepare("SELECT Password, Account_type FROM usertbl WHERE Email = ?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db_password = $row["Password"];
            $db_account_type = $row["Account_type"]; 

            // Verify the password using password_verify
            if (password_verify($passwordPost, $db_password)) {
                // Password is correct, start the session based on account type
                $_SESSION['Email'] = $Email;
                if ($db_account_type == "1") {
                    echo "<script>window.location.href='adminPage/adminDashboard.php?welcome_admin=true';</script>";
                } elseif ($db_account_type == "2") {
                    echo "<script>window.location.href='Staff/StaffSlotManagement.php?welcome_user=true';</script>";
                } else {
                    echo "<script>window.location.href='staffPage/StaffDashboard.php?welcome_user=true';</script>";
                }
            } else {
                // Password incorrect
                echo "<script>window.location.href='login.php?password_error=true';</script>";
            }
        } else {
            // Email is not registered
            echo "<script>window.location.href='login.php?email_error=true';</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Reset error messages when the page is loaded initially
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $EmailErr = $passwordErr = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="icon" href="img/logo.png">
    <!-- Libraries -->
    <link rel="stylesheet" href="lib/css/sweetalert.css">
    <link rel="stylesheet" href="lib/css/toastr.css">
    <link rel="stylesheet" href="lib/icons/css/all.css"/>
    <script src="lib/js/jquery-3.7.1.min.js"></script>
    <script src="lib/js/sweetalert.js"></script>
    <!-- Styling -->
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <div class="main-container">
        <div class="wrapper">
            <div class="back-button">
                <a href=""><i class="fa-solid fa-house"></i></a>
            </div>
            <form action="login.php" method="POST">
            <div class="content-container">
                <div class="logo">
                    <img src="img/logo.png" alt="">
                    <div class="header">Log In <span>To Your Account</span></div>
                </div>
                <div class="content">
                    <div class="input-container">
                        <span class="input-title">EMAIL</span>
                        <input type="text" id="Email" name="Email" autocomplete="off" placeholder="">
                        <label for="Email"><i class="fa-solid fa-user"></i></label>
                    </div>
                    <div class="input-container">
                        <span class="input-title">PASSWORD</span>
                        <input type="password" id="Password" name="Password" placeholder="">
                        <label for="Password"><i class="fa-solid fa-unlock"></i></label>
                        <button type="button" class="input-button">Show</button>
                    </div>
                    <div class="button-container">
                        <button type="submit">Log In</button>
                        <span>Don't Have an Account ? <a href="register.php">Sign Up</a></span>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="image-container">
        <div class="svg-container"></div>
    </div>
</body>
</html>

<script>
    const button = document.querySelector(".buttons");

    button.addEventListener('click', function() {
        alert("it works");
    });
</script>