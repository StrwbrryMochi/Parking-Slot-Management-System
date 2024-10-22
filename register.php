<?php include "php/connections.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $Password = htmlspecialchars($_POST['Password']);
    $FirstName = htmlspecialchars(trim($_POST['FirstName']));
    $LastName = htmlspecialchars(trim($_POST['LastName']));
    $Gender = htmlspecialchars(trim($_POST['Gender']));
    $BirthDate = htmlspecialchars($_POST['BirthDate']);
    $Address = htmlspecialchars($_POST['Address']);
    $PhoneNumber = htmlspecialchars($_POST['PhoneNumber']);
    $Account_type = '2';
    
    $photoFilePath = ''; // Initialize variable for photo file path

    if (isset($_FILES['Photo'])) {
        if ($_FILES['Photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['Photo']['tmp_name'];
            $fileName = $_FILES['Photo']['name'];
            $fileSize = $_FILES['Photo']['size'];
            $fileType = $_FILES['Photo']['type'];

            // Validate the image file type
            $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($fileType, $allowedFileTypes)) {
                echo "<script>alert('Invalid image format. Please upload JPEG, PNG, or GIF.'); window.location.href='register.php?register_error=true';</script>";
                exit;
            }

            // Validate file size (e.g., max size 2MB)
            if ($fileSize > 2 * 1024 * 1024) {
                echo "<script>alert('File size exceeds 2MB limit.'); window.location.href='register.php?register_error=true';</script>";
                exit;
            }

            // Move the uploaded file to the uploads directory
            $uploadFileDir = 'uploads/';
            $newFileName = uniqid() . '_' . basename($fileName); // Create a unique filename
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photoFilePath = $newFileName; // Store the new file name for database insertion
            } else {
                echo "<script>alert('There was an error moving the uploaded file.'); window.location.href='register.php?register_error=true';</script>";
                exit;
            }
        } else {
            echo "<script>alert('No image uploaded or there was an upload error.'); window.location.href='register.php?register_error=true';</script>";
            exit;
        }
    } else {
        echo "<script>alert('File input not set.'); window.location.href='register.php?register_error=true';</script>";
        exit;
    }

    // Validate email
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location.href='register.php?register_error=true';</script>";
        exit;
    }

    // Validate password length
    if (strlen($Password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long'); window.location.href='register.php?register_error=true';</script>";
        exit;
    }

    // Check if email already exists
    $checkEmailStmt = $connections->prepare("SELECT * FROM usertbl WHERE Email = ?");
    $checkEmailStmt->bind_param("s", $Email);
    $checkEmailStmt->execute();
    $result = $checkEmailStmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>window.location.href='register.php?email_exists=true'</script>";
        $checkEmailStmt->close();
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Prepare to insert data into the database
    $stmt = $connections->prepare("INSERT INTO usertbl (Email, Password, FirstName, LastName, Gender, BirthDate, Address, PhoneNumber, Account_type, Photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssis", $Email, $hashedPassword, $FirstName, $LastName, $Gender, $BirthDate, $Address, $PhoneNumber, $Account_type, $photoFilePath);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['Email'] = $Email;
        echo "<script>window.location.href='Staff/StaffSlotManagement.php?register_success=true';</script>";
    } else {
        echo "<script>alert('Error registering user: " . $stmt->error . "'); window.location.href='register.php?register_error=true';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $connections->close();
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
            <form action="register.php" method="POST" enctype="multipart/form-data">
            <div class="register-container" id="register">
            <div class="logo">
                <img src="img/logo.png" alt="">
                <div class="header">Create <span>an Account</span></div>
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
                    <button type="button" class="next-button">Create</button>
                    <span>Already Have an Account ? <a href="login.php">Sign In</a></span>
                </div>
            </div>
        </div>
        
        <div class="register-container" id="container1">
            <div class="progress-container">
                <div class="progress active">1</div>
                <div class="progress">2</div>
                <div class="progress">3</div>
            </div>
            <div class="logo">
                <div class="header">Personal Details</div>
            </div>
            <div class="content">
                <div class="input-container-name">
                    <span class="input-title">NAME</span>
                    <div class="name-input">
                    <input type="text" name="FirstName" autocomplete="off" placeholder="First Name">
                    <input type="text" name="LastName" autocomplete="off" placeholder="Last Name">
                    </div>
                </div>
                <div class="input-container">
                    <span class="input-title">GENDER</span>
                    <select id="Gender" name="Gender" onchange="changeColor(); moveLabel('gender')" required>
                        <option value="" disabled selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <label for="Gender"><i class="fa-solid fa-venus-mars"></i></label>
                </div>
                <div class="button-container">
                    <button type="button" class="next-button">Next</button>
                    <span>Already Have an Account ? <a href="login.php">Sign In</a></span>
                </div>
            </div>
        </div>

        <div class="register-container" id="container2">
            <div class="progress-container">
                <div class="progress active">1</div>
                <div class="progress active">2</div>
                <div class="progress">3</div>
            </div>
            <div class="logo">
                <div class="header">Personal Details</div>
            </div>
            <div class="content">
                <div class="input-container">
                    <span class="input-title">BIRTHDATE</span>
                    <input type="date" id="BirthDate" name="BirthDate" autocomplete="off" placeholder="MM/DD/YY" class="custom-date-input">
                    <label for="BirthDate"><i class="fa-regular fa-calendar"></i></label>
                </div>
                <div class="input-container">
                    <span class="input-title">ADDRESS</span>
                    <input type="text" id="Address" name="Address" placeholder="">
                    <label for="Address"><i class="fa-solid fa-location-dot"></i></label>
                </div>
                <div class="input-container">
                    <span class="input-title">TEL NO.</span>
                    <input type="tel" id="PhoneNumber" name="PhoneNumber" placeholder="">
                    <label for="PhoneNumber"><i class="fa-solid fa-phone"></i></label>
                </div>
                <div class="button-container">
                    <button type="button" class="next-button">Next</button>
                    <span>Already Have an Account ? <a href="login.php">Sign In</a></span>
                </div>
            </div>
        </div>

        <div class="register-container" id="container3">
            <div class="progress-container">
                <div class="progress active">1</div>
                <div class="progress active">2</div>
                <div class="progress active">3</div>
            </div>
            <div class="logo">
                <div class="header">Choose a Photo</div>
            </div>
            <div class="content">
                <div class="input-container-photo">
                    <div class="drop-area" id="drop-area">
                        <p>Drag & Drop your image here or <strong>click to select image</strong></p>
                        <input type="file" name="Photo" id="fileElem" accept="image/*" style="display:none;">
                        <img id="preview" class="preview-img" alt="Image Preview">
                        <div class="file-info" id="file-info"></div>
                    </div>
                </div>
                <div class="button-container">
                    <button type="submit">Submit</button>
                    <span>Already Have an Account ? <a href="login.php">Sign In</a></span>
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
document.querySelectorAll('.next-button').forEach(button => {
    button.addEventListener('click', function () {
        const currentContainer = this.closest('.register-container');
        const nextContainer = currentContainer.nextElementSibling;

        if (nextContainer) {
            currentContainer.classList.remove('active');
            nextContainer.classList.add('active');
        }
    });
});

document.querySelectorAll('.prev-button').forEach(button => {
    button.addEventListener('click', function () {
        const currentContainer = this.closest('.register-container');
        const prevContainer = currentContainer.previousElementSibling;

        if (prevContainer) {
            currentContainer.classList.remove('active');
            prevContainer.classList.add('active');
        }
    });
});

// Set the first container to active on load
document.getElementById('register').classList.add('active');
</script>

<script>
    document.getElementById('BirthDate').addEventListener('click', function (e) {
    e.stopPropagation(); 
    this.showPicker(); 
    });
</script>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileElem');
    const previewImg = document.getElementById('preview');
    const fileInfo = document.getElementById('file-info');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    // Remove highlight when dragging leaves
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);
    dropArea.addEventListener('click', () => fileInput.click(), false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight() {
        dropArea.classList.add('highlight');
    }

    function unhighlight() {
        dropArea.classList.remove('highlight');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        handleFiles(files);
    });

    function handleFiles(files) {
    fileInfo.innerHTML = '';
    if (files.length > 0) {
        const file = files[0]; // Get the first file
        if (file && file.type.startsWith('image/')) { // Check if it's an image
            // Update the input's files property
            fileInput.files = files; // Set the file input's files property

            const reader = new FileReader();
            reader.onload = function (event) {
                previewImg.src = event.target.result; // Set the preview image
                previewImg.style.display = 'block'; // Show the image
            };
            reader.readAsDataURL(file);
            fileInfo.innerHTML = `<p>${file.name} (${(file.size / 1024).toFixed(2)} KB)</p>`;
        } else {
            alert('Please upload a valid image file (JPEG, PNG, or GIF).');
            fileInput.value = ''; // Clear the file input if the file is invalid
            previewImg.style.display = 'none'; // Hide the preview image
            fileInfo.innerHTML = ''; // Clear the file info
        }
    }
}

</script>
