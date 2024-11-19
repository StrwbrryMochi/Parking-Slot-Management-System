<?php
include '../connections.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["deleteStaff"])) {
    $userID = $_GET['deleteStaff'];
    $firstName = $_GET['firstname'] ?? null;
    $lastName = $_GET['lastname'] ?? null;
    $email = $_GET['email'] ?? null;
    $gender = $_GET['gender'] ?? null;
    $birthDate = $_GET['birthdate'] ?? null;
    $address = $_GET['address'] ?? null;
    $phoneNumber = $_GET['phonenumber'] ?? null;
    $accountType = $_GET['accounttype'] ?? null;
    $photo = $_GET['photo'] ?? null;
    $status = $_GET['status'] ?? null;
    $joined = $_GET['joined'] ?? null;
    $lastActive = $_GET['lastactive'] ?? null;

    // Archive the user data into the user_archive table
    $archiveSql = "INSERT INTO user_archive (userID, Email, Password, FirstName, LastName, Gender, BirthDate, Address, PhoneNumber, Photo, Account_type, Status, Joined, Last_active)
                   SELECT userID, Email, Password, FirstName, LastName, Gender, BirthDate, Address, PhoneNumber, Photo, Account_type, 'Removed', Joined, Last_active
                   FROM usertbl WHERE userID = ?";

    if ($stmt = $connections->prepare($archiveSql)) {
        $stmt->bind_param("i", $userID);

        if ($stmt->execute()) {
            $stmt->close();

            // Delete the user from the main table
            $deleteSql = "DELETE FROM usertbl WHERE userID = ?";
            if ($deleteStmt = $connections->prepare($deleteSql)) {
                $deleteStmt->bind_param("i", $userID);

                if ($deleteStmt->execute()) {
                    echo "<script>window.location.href='../../Admin/UserManagement.php?staff_delete=true';</script>";
                } else {
                    echo "Error during deletion: " . $deleteStmt->error;
                }

                $deleteStmt->close();
            } else {
                echo "Error preparing delete query: " . $connections->error;
            }
        } else {
            echo "Error archiving user: " . $stmt->error;
        }
    } else {
        echo "Error preparing archive query: " . $connections->error;
    }
} else {
    echo "Invalid request.";
}
?>
