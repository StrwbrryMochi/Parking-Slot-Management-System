<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (isset($_SESSION['Email'])) {
        $Email = $_SESSION['Email'];

        include '../connections.php';

        // Retrieve and sanitize posted data
        $currentPassword = $_POST['currentPassword'] ?? null;
        $newPassword = $_POST['newPassword'] ?? null;
        $confirmPassword = $_POST['confirmPassword'] ?? null;
        $current_page = $_POST['current_page'];
        $Gender = $_POST['Gender'];
        $Name = htmlspecialchars($_POST['Name']);
        $assignedPhoto = htmlspecialchars($_POST['assignedPhoto']);

        if (!$currentPassword || !$newPassword || !$confirmPassword) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit();
        }

        // Check if the new password and confirm password match
        if ($newPassword !== $confirmPassword) {
            echo json_encode(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
            exit();
        }

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $connections->prepare("SELECT Password FROM usertbl WHERE Email = ?");
        if (!$stmt) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $connections->error]);
            exit();
        }

        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $actualPassword = $row['Password'];

            // Verify the current password with the hashed password
            if (!password_verify($currentPassword, $actualPassword)) {
                echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
                exit();
            }

            // Hash the new password before storing it
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Prepare the update statement
            $updateStmt = $connections->prepare("UPDATE usertbl SET Password = ? WHERE Email = ?");
            if (!$updateStmt) {
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $connections->error]);
                exit();
            }

            $updateStmt->bind_param("ss", $hashedNewPassword, $Email);

            // Execute the update statement and set the redirect URL in the response
            if ($updateStmt->execute()) {

                // Add action to the audit log
                date_default_timezone_set('Asia/Manila');
                $current_time = date('Y-m-d H:i:s');
                $pronoun = ($Gender == 'Male') ? "his" : "her";
                $editAction = "has changed $pronoun password";
                $logSql = "INSERT INTO audit_log  (Name, Photo, time, action) VALUES (?,?,?,?)";
                if ($logStmt = $connections->prepare($logSql)) {
                    $logStmt->bind_param("ssss", $Name, $assignedPhoto, $current_time, $editAction);
                    if ($logStmt->execute()) {
                        $logStmt->close(); 
                    } else {
                        echo "Error in audit log insertion: " . $logStmt->error;  
                    }
                } else {
                    echo "Error preparing audit log statement: " . $connections->error;  
                }

                if ($current_page === 'StaffSlotManagement') {
                    $response = [
                        'status' => 'success',
                        'message' => 'Profile updated successfully!',
                        'redirect' => '../Staff/StaffSlotManagement.php?password_changed=true'
                    ];
                } else {
                    $response = [
                        'status' => 'success',
                        'message' => 'Profile updated successfully!',
                        'redirect' => '../Staff/StaffSlotOverview.php?password_changed=true'
                    ]; 
                }
                echo json_encode($response);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $connections->error]);
            }

            $updateStmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Session expired. Please log in again.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
