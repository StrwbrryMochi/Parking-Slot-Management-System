<?php include '../php/connections.php';
      include '../php/adminLoginData.php';
      include '../php/userFunction.php';
      include '../php/parkingFunction.php';
      $current_page = 'Archive'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin" />
    <title>Slot Management</title>
    <link rel="icon" href="../img/logo.png">
    <!-- Libraries -->
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../lib/css/sweetalert.css">
    <link rel="stylesheet" href="../lib/css/toastr.css">
    <link rel="stylesheet" href="../lib/css/flatpickr.min.css">
    <link rel="stylesheet" href="../lib/icons/css/all.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="../lib/js/jquery-3.7.1.min.js"></script>
    <script src="../lib/js/bootstrap.bundle.js"></script>
    <script src="../lib/js/qrious.min.js"></script>
    <script src="../lib/js/sweetalert.js"></script>
    <script src="../lib/js/toastr.js"></script>
    <script src="../lib/js/flatpickr.min.js"></script>
    <!-- Styling -->
    <link rel="stylesheet" href="../admin.css">
</head>
<body>

    <div class="sidebar shrink">
        <div class="logo">
            <img class="logo-img" src="../img/logo.png" alt="">
        </div>

        <div class="links-container">
            <ul class="list">
                <li>
                    <a class="links" href="Dashboard.php">
                        <i class='bx bx-command' ></i>
                        <span class="link-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="links" href="SlotManagement.php">
                        <i class='bx bx-car' ></i>
                        <span class="link-text">Slot Management </span>
                    </a>
                </li>
                <li>
                    <a class="links" href="UserManagement.php">
                            <i class='bx bx-user' ></i>
                            <span class="link-text">User Management</span>
                    </a>
                </li>
                <li>
                    <a class="links active" href="Archive.php">
                            <i class='bx bx-archive' ></i>
                            <span class="circle"></span>
                            <span class="link-text">Archive Management</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>

    <section class="content">
        <nav class="navbar">
            <div class="nav-contents">
                <div class="navRight">
                <button class="sidebarToggle">
                    <svg id="icon" width="24" height="24" viewBox="0 0 24 24">
                        <path class="line line1" d="M3 6h18"></path>
                        <path class="line line2" d="M3 12h18"></path>
                        <path class="line line3" d="M3 18h18"></path>
                    </svg>
                </button>
                    <h1>Archive Management</h1>
                </div> 
                <div class="user-container">
                    <img class="user-image" src="<?php echo htmlspecialchars($Photo); ?>" alt="">
                    <span class="indicator"></span>
                </div>
            </div>
        </nav>

        <div class="table-container">
    <!-- First Table -->
     <div class="table-wrapper">
        <table class="user-archive">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Permission</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userArchiveFetch = fetchUserArchives();
                foreach ($userArchiveFetch as $userData):
                    $Account_role = ($userData['Account_type'] == 2) ? "Staff" : "Admin";
                    $role_class = ($userData['Account_type'] == 2) ? "role-staff" : "role-admin";

                    $joinedDate = htmlspecialchars($userData['Joined']);
                    $date = new DateTime($joinedDate);
                    $formattedDate = $date->format('F j, Y');
                ?>
                    <tr class="table-row">
                        <td class="data-detail">
                            <img class="table-image" src="<?php echo htmlspecialchars('../uploads/' . ($userData['Photo'] ?: 'profile.png')); ?>" alt="">
                            <div class="userInfo">
                                <span class="data-name"><?php echo htmlspecialchars($userData['FirstName'] . ' ' . $userData['LastName']); ?></span>
                                <span class="data-email"><?php echo htmlspecialchars($userData['Email']); ?></span>
                            </div>
                        </td>
                        <td><span class="<?php echo htmlspecialchars($role_class); ?>"><?php echo htmlspecialchars($Account_role); ?></span></td>
                        <td><?php echo htmlspecialchars($userData['Status']); ?></td>
                        <td><?php echo htmlspecialchars($formattedDate); ?></td>
                        <td>
                            <i class='bx bx-dots-vertical-rounded'
                                data-id="<?php echo htmlspecialchars($userData['userID']); ?>"
                                data-firstname="<?php echo htmlspecialchars($userData['FirstName']); ?>"
                                data-lastname="<?php echo htmlspecialchars($userData['LastName']); ?>"
                                data-email="<?php echo htmlspecialchars($userData['Email']); ?>"
                                data-gender="<?php echo htmlspecialchars($userData['Gender']); ?>"
                                data-birthdate="<?php echo htmlspecialchars($userData['BirthDate']); ?>"
                                data-address="<?php echo htmlspecialchars($userData['Address']); ?>"
                                data-phonenumber="<?php echo htmlspecialchars($userData['PhoneNumber']); ?>"
                                data-accounttype="<?php echo htmlspecialchars($userData['Account_type']); ?>"
                                data-photo="<?php echo htmlspecialchars('../uploads/' . ($userData['Photo'] ?: 'profile.png')); ?>"
                                data-status="<?php echo htmlspecialchars($userData['Status']); ?>"
                                data-joined="<?php echo htmlspecialchars($userData['Joined']); ?>"
                                data-lastactive="<?php echo htmlspecialchars($userData['Last_active']); ?>"
                                data-toggle="modal"
                                data-target="#ViewProfile"
                                onclick="openOption(this)">
                            </i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Second Table -->
     <div class="table-wrapper">
        <table class="parking-archive">
            <thead>
                <tr>
                    <th>Slot</th>
                    <th>Vehicle</th>
                    <th>User</th>
                    <th>Assigned</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $archiveFetch = fetchArchive();

                usort($archiveFetch, function($a, $b) {
                    return strtotime($b['time_out']) - strtotime($a['time_out']);
                });
                foreach ($archiveFetch as $archiveData):
                    $floor = $archiveData['floor'] ?? '';
                    $zone = $archiveData['zone'] ?? '';
                    $slot_number = $archiveData['slot_number'] ?? '';
                    $slot = $floor . $zone . $slot_number;
                    $loggedTime = htmlspecialchars($archiveData['time_out']);
                
                ?>
                    <tr class="table-row">
                        <td><?php echo htmlspecialchars($slot); ?></td>
                        <td><?php echo htmlspecialchars($archiveData['vehicle_type'])?></td>
                        <td><?php echo htmlspecialchars($archiveData['user_type'])?></td>
                        <td class="data-detail">
                            <img class="table-image" src="<?php echo htmlspecialchars('../uploads/' . ($archiveData['assignedPhoto'] ?: 'profile.png')); ?>" alt="">
                            <div class="userInfo">
                                <span class="data-name"><?php echo htmlspecialchars($archiveData['assignedBy']); ?></span>
                                <span style="display: none;" class="duration" data-time="<?php echo htmlspecialchars($loggedTime); ?>"><?php echo htmlspecialchars($loggedTime); ?></span>
                            </div>
                        </td>
                        <td>
                            <i class='bx bx-dots-vertical-rounded'
                            data-slot-id="<?php echo htmlspecialchars($archiveData['slot_id']); ?>" 
                            data-floor="<?php echo htmlspecialchars($archiveData['floor']); ?>" 
                            data-zone="<?php echo htmlspecialchars($archiveData['zone']); ?>" 
                            data-slot-number="<?php echo htmlspecialchars($archiveData['slot_number']); ?>" 
                            data-plate-number="<?php echo htmlspecialchars($archiveData['plate_number']); ?>"
                            data-user-type="<?php echo htmlspecialchars($archiveData['user_type']); ?>" 
                            data-vehicle-type="<?php echo htmlspecialchars($archiveData['vehicle_type']); ?>"
                            data-status="<?php echo htmlspecialchars($archiveData['status']); ?>"
                            data-time-in="<?php echo htmlspecialchars($archiveData['time_in']); ?>"
                            data-time-out="<?php echo htmlspecialchars($archiveData['time_out']); ?>"
                            data-duration="<?php echo htmlspecialchars($archiveData['duration']); ?>"
                            data-fee="<?php echo htmlspecialchars($archiveData['fee']); ?>"
                            data-toggle="modal"
                            data-target="#slotModal">
                        </i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>


    </section>

    <?php include '../components/Admin/ViewProfile.php'; ?>
    <?php include '../components/Admin/SnipModal.php'; ?>
    <?php include '../components/Admin/ProfileModal.php'; ?>
    <?php include '../components/Admin/EditProfile.php'; ?>
    <?php include '../components/Admin/PasswordModal.php'; ?>
    <?php include '../components/Admin/ViewArchiveSlot.php'; ?>

    <script>
    document.querySelector('.user-archive').addEventListener('click', function (event) {
        const targetIcon = event.target.closest('i[data-toggle="modal"]');
        if (targetIcon) {
            // Fetch data from the clicked icon
            const userID = targetIcon.getAttribute('data-id');
            const FirstName = targetIcon.getAttribute('data-firstname');
            const LastName = targetIcon.getAttribute('data-lastname');
            const Email = targetIcon.getAttribute('data-email');
            const Gender = targetIcon.getAttribute('data-gender');
            const BirthDate = new Date(targetIcon.getAttribute('data-birthdate'));
            const Address = targetIcon.getAttribute('data-address');
            const PhoneNumber = targetIcon.getAttribute('data-phonenumber');
            const accountType = targetIcon.getAttribute('data-accounttype');
            const Photo = targetIcon.getAttribute('data-photo');
            const Status = targetIcon.getAttribute('data-status').trim();
            const Joined = new Date(targetIcon.getAttribute('data-joined'));
            const Lastactive = new Date(targetIcon.getAttribute('data-lastactive'));

            // Update modal fields
            document.getElementById('span-firstname').textContent = FirstName;
            document.getElementById('span-lastname').textContent = LastName;
            document.getElementById('span-email').textContent = Email;
            document.getElementById('span-birthdate').textContent = BirthDate.toLocaleDateString('en-US');
            document.getElementById('span-address').textContent = Address;
            document.getElementById('span-phonenumber').textContent = PhoneNumber;
            document.getElementById('span-joined').textContent = Joined.toLocaleDateString('en-US');
            document.getElementById('span-lastactive').textContent = Lastactive.toLocaleDateString('en-US');
            document.getElementById('user-photo').src = Photo;

            // Handle status display
            const indicator = document.querySelector('.indicator-lg');
            if (Status === 'Online') {
                indicator.classList.add("Online");
                indicator.classList.remove("Offline");
            } else if (Status === 'Offline' || Status === 'Removed') {
                indicator.classList.add("Offline");
                indicator.classList.remove("Online");
            }

            // Account type display
            const accountTypeSpan = document.getElementById("span-accounttype");
            if (accountType == '2') {
                accountTypeSpan.textContent = 'Staff';
            } else if (accountType == '1') {
                accountTypeSpan.textContent = 'Admin';
            }

            // Gender display
            const genderSpan = document.getElementById("span-gender");
            const genderIcon = document.getElementById("genderIcon");
            const genderText = document.getElementById("genderText");
            if (Gender === 'Male') {
                genderSpan.classList.add("Male");
                genderText.textContent = 'Male';
                genderIcon.className = 'fa-solid fa-mars';
            } else if (Gender === 'Female') {
                genderSpan.classList.add("Female");
                genderText.textContent = 'Female';
                genderIcon.className = 'fa-solid fa-venus';
            }

            // Show modal
            $('#ViewProfile').modal('show');
        }
    });
    </script>

    <script>
        document.querySelector('.parking-archive').addEventListener('click', function (event) {
            const targetIcon = event.target.closest('i[data-toggle="modal"]');
            if (targetIcon) {
                // Fetch data from the clicked icon
                const slotId = targetIcon.getAttribute('data-slot-id');
                const floor = targetIcon.getAttribute('data-floor');
                const zone = targetIcon.getAttribute('data-zone');
                const slotNumber = targetIcon.getAttribute('data-slot-number');
                const plateNumber = targetIcon.getAttribute('data-plate-number');
                const userType = targetIcon.getAttribute('data-user-type');
                const vehicleType = targetIcon.getAttribute('data-vehicle-type');
                const status = targetIcon.getAttribute('data-status');
                const timeIn = targetIcon.getAttribute('data-time-in');

                // Update modal fields
                document.getElementById('modal-floor').textContent = floor || 'N/A';
                document.getElementById('modal-zone').textContent = zone || 'N/A';
                document.getElementById('modal-slot').textContent = slotNumber || 'N/A';
                document.getElementById('modal-license-plate').textContent = plateNumber || 'N/A';
                document.getElementById('modal-user-type').textContent = userType || 'N/A';
                document.getElementById('modal-vehicle-type').textContent = vehicleType || 'N/A';
                document.getElementById('modal-status').textContent = status || 'N/A';

                // Handle Time In
                const timeInField = document.getElementById('modal-time-in-field');
                const timeInSpan = document.getElementById('modal-time-in');
                if (timeIn && timeIn.trim()) {
                    const formattedTime = new Date(timeIn).toLocaleString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true,
                    });
                    timeInSpan.textContent = formattedTime;
                    timeInField.style.display = 'block';
                } else {
                    timeInField.style.display = 'none';
                }

                // Display vehicle type image
                const vehicleImageContainer = document.querySelector('.view-vehicle-type');
                vehicleImageContainer.innerHTML = ''; // Clear previous image
                let imgSrc;
                switch (vehicleType) {
                    case 'Car':
                        imgSrc = '../img/Cars.svg';
                        break;
                    case 'Motorcycle':
                        imgSrc = '../img/Moto.svg';
                        break;
                    case 'Bicycle':
                        imgSrc = '../img/Bikes.svg';
                        break;
                    default:
                        imgSrc = '../img/Parking.svg';
                }
                const vehicleImg = document.createElement('img');
                vehicleImg.src = imgSrc;
                vehicleImg.alt = vehicleType || 'Vehicle';
                vehicleImageContainer.appendChild(vehicleImg);

                // Show modal
                $('#slotModal').modal('show');
            }
        });
    </script>

    <script>
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    entry.target.classList.remove('not-visible'); 
                } else {
                    entry.target.classList.add('not-visible'); 
                    entry.target.classList.remove('visible'); 
                }
            });
        }, {
            threshold: 0.3  
        });

        document.querySelectorAll('.table-row').forEach(row => {
            observer.observe(row);
        });
    </script>

    
    <script src="../js/toggleSidebar.js"></script>
    <script src="../js/Admin/modal.js"></script>

</body>
</html>