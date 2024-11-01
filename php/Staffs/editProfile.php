<?php
session_start();
include '../connections.php'; 

header('Content-Type: application/json');

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['Email'])) {
        $Email = $_SESSION['Email'];

        // Get the current user details from the database
        $stmt = $connections->prepare("SELECT FirstName, LastName, Email, Gender, PhoneNumber, BirthDate, Address, Photo FROM usertbl WHERE Email = ?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();
        $currentUser = $result->fetch_assoc();

        // Get and sanitize POST data
        $FirstName = htmlspecialchars(trim($_POST['FirstName']));
        $LastName = htmlspecialchars(trim($_POST['LastName']));
        $NewEmail = htmlspecialchars(trim($_POST['Email']));
        $Gender = htmlspecialchars(trim($_POST['Gender']));
        $PhoneNumber = htmlspecialchars(trim($_POST['PhoneNumber']));
        $BirthDate = htmlspecialchars(trim($_POST['BirthDate']));
        $Address = htmlspecialchars(trim($_POST['Address']));
        $current_page = htmlspecialchars(trim($_POST['current_page']));
        
        $photoFilePath = $currentUser['Photo']; 
        $isChanged = false; 

        // Check if there is a new image uploaded
        if (isset($_FILES['Photo']) && $_FILES['Photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['Photo']['tmp_name'];
            $fileName = $_FILES['Photo']['name'];
            $fileSize = $_FILES['Photo']['size'];
            $fileType = $_FILES['Photo']['type'];

            // Validate the image file type
            $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($fileType, $allowedFileTypes)) {
                $response['status'] = 'error';
                $response['message'] = 'Invalid image format. Please upload JPEG, PNG, or GIF.';
                echo json_encode($response);
                exit;
            }

            // Validate file size (limit to 2MB)
            if ($fileSize > 2 * 1024 * 1024) {
                $response['status'] = 'error';
                $response['message'] = 'File size exceeds 2MB limit.';
                echo json_encode($response);
                exit;
            }

            // Move the uploaded file to the uploads directory
            $uploadFileDir = '../../uploads/';
            $newFileName = uniqid() . '_' . basename($fileName);
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photoFilePath = $newFileName; 
                $isChanged = true; 
            } else {
                $response['status'] = 'error';
                $response['message'] = 'There was an error moving the uploaded file.';
                echo json_encode($response);
                exit;
            }
        }

        // Check for changes in the other fields
        if ($FirstName !== $currentUser['FirstName']) {
            $isChanged = true;
        }
        if ($LastName !== $currentUser['LastName']) {
            $isChanged = true;
        }
        if ($NewEmail !== $currentUser['Email']) {
            $isChanged = true;
        }
        if ($Gender !== $currentUser['Gender']) {
            $isChanged = true;
        }
        if ($PhoneNumber !== $currentUser['PhoneNumber']) {
            $isChanged = true;
        }
        if ($BirthDate !== $currentUser['BirthDate']) {
            $isChanged = true;
        }
        if ($Address !== $currentUser['Address']) {
            $isChanged = true;
        }

        // If no changes detected, send a response and exit
        if (!$isChanged) {
            $response = [
                'status' => 'no_change',
                'message' => 'No changes detected. Please update your details.'
            ];
            echo json_encode($response);
            exit;
        }

        // Update user details in the database
        $stmt = $connections->prepare("UPDATE usertbl SET FirstName = ?, LastName = ?, Email = ?, Gender = ?, PhoneNumber = ?, BirthDate = ?, Address = ?, Photo = ? WHERE Email = ?");
        $stmt->bind_param("sssssssss", $FirstName, $LastName, $NewEmail, $Gender, $PhoneNumber, $BirthDate, $Address, $photoFilePath, $Email);

        if ($stmt->execute()) {
            // Update session with new email if changed
            if ($NewEmail !== $Email) {
                $_SESSION['Email'] = $NewEmail;
            }
            
            // Set the redirect URL in the response
            if ($current_page === 'StaffSlotManagement') {
                $response = [
                    'status' => 'success',
                    'message' => 'Profile updated successfully!',
                    'redirect' => '../Staff/StaffSlotManagement.php?user_edit=true'
                ];
            } else {
                $response = [
                    'status' => 'success',
                    'message' => 'Profile updated successfully!',
                    'redirect' => '../Staff/StaffSlotOverview.php?user_edit=true'
                ]; 
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to update the profile. Please try again.'
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'User not authenticated. Please log in.'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method. Please use POST.'
    ];
}

echo json_encode($response);
?>
