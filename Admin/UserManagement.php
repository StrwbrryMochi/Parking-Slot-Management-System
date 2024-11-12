<?php include '../php/connections.php';
      include '../php/adminLoginData.php';
      include '../php/userFunction.php';
      $current_page = 'UserManagement'; 
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
            <img src="../img/logo.png" alt="">
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
                <a class="links active" href="UserManagement.php">
                        <i class='bx bx-user' ></i>
                        <span class="circle"></span>
                        <span class="link-text">User Management</span>
                </a>
                </li>
            </ul>
        </div>

        <div class="side-footer">
            
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
                    <h1>User Management</h1>
                </div> 
                <div class="user-container">
                    <img class="user-image" src="<?php echo htmlspecialchars($Photo); ?>" alt="">
                    <span class="indicator"></span>
                </div>
            </div>
        </nav>

        <?php
        $userFetch = fetchUser();

        $totalUsers = 0;
        $staffs = 0;
        $admins = 0;
        $onlineUsers = 0;

        foreach ($userFetch as $user) {
            $totalUsers++;

            if($user['Status'] === 'Online') {
                $onlineUsers++;
            }

            if ($user['Account_type'] === '1') {
                $admins++;
            } else if ($user['Account_type'] === '2') {
                $staffs++;
            }
        }
        ?>
        <div class="userCard-Container">

            <div class="card userCard1">
            <div class="card-title">Total Users</div>
                <div class="card-data"><?php echo htmlspecialchars($totalUsers)?></div>
                <div class="card-desc">
                    <span class="comparison"><?php echo htmlspecialchars($admins)?> Admins | <?php echo htmlspecialchars($staffs)?> Staffs</span>
                </div>
            </div>

            <div class="card userCard2">
                <div class="card-title">Online Users</div>
                <div class="card-data"><?php echo htmlspecialchars($onlineUsers)?></div>
                <div class="card-desc">
                    <span class="comparison">out of <?php echo htmlspecialchars($totalUsers)?> Users</span>
                </div>
            </div>

            <div class="card userCard3">
                <div class="card-title log">Audit Logs</div>
                <table class="log-table">
                    <?php
                    $logFetch = fetchLogs();

                    usort($logFetch, function($a, $b) {
                        return strtotime($b['time']) - strtotime($a['time']);
                    });
                    
                    foreach ($logFetch as $logData):
                        $loggedTime = htmlspecialchars($logData['time']);
                    ?>
                    <tr class="log-row">
                        <td class="log-data">
                            <div class="data">
                                <img src="<?php echo htmlspecialchars($logData['Photo'])?>" class="table-image" alt="User Photo">
                                <div class="log-info">
                                    <span><?php echo htmlspecialchars($logData['Name']) . ' ' . htmlspecialchars($logData['action'])?></span>
                                    <span class="duration" data-time="<?php echo htmlspecialchars($loggedTime); ?>"><?php echo htmlspecialchars($loggedTime); ?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="card userCard4" style="padding: 0;">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Permission</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th></th>
                        </tr>
                        <tbody>
                         <?php
                            $userFetch = fetchUser();
                            foreach ($userFetch as $userData):
                                if ($userData['Account_type'] == 2) {
                                    $Account_role = "Staff";
                                    $role_class = "role-staff"; 
                                } else if ($userData['Account_type'] == 1) {
                                    $Account_role = "Admin";
                                    $role_class = "role-admin";  
                                }

                                $joinedDate = htmlspecialchars($userData['Joined']);
                                $date = new DateTime($joinedDate);
                                $formattedDate = $date->format('F j, Y');
                            ?>
                                <tr class="table-row">
                                    
                                    <td class="data-detail">
                                    <img class="table-image" src="<?php echo htmlspecialchars('../uploads/' . ($userData['Photo'] ?: 'profile.png')); ?>" alt="">
                                        <div class="userInfo">
                                        <span class="data-name"><?php echo htmlspecialchars($userData['FirstName'] . ' ' . $userData['LastName']); ?></span>
                                        <span class="data-email"><?php echo htmlspecialchars($userData['Email'])?></span>
                                        </div>
                                    </td>

                                    <td><span class="<?php echo htmlspecialchars($role_class); ?>"><?php echo htmlspecialchars($Account_role); ?></span></td>

                                    <td><?php echo htmlspecialchars($userData['Status'])?></td>

                                    <td><?php echo htmlspecialchars($formattedDate)?></td>
                                    
                                    <td>
                                        <i class='bx bx-dots-vertical-rounded'
                                        data-id="<?php echo htmlspecialchars($userData['userID'])?>"
                                        data-firstname="<?php echo htmlspecialchars($userData['FirstName'])?>"
                                        data-lastname="<?php echo htmlspecialchars($userData['LastName'])?>"
                                        data-email="<?php echo htmlspecialchars($userData['Email'])?>"
                                        data-gender="<?php echo htmlspecialchars($userData['Gender'])?>"
                                        data-birthdate="<?php echo htmlspecialchars($userData['BirthDate'])?>"
                                        data-address="<?php echo htmlspecialchars($userData['Address'])?>"
                                        data-phonenumber="<?php echo htmlspecialchars($userData['PhoneNumber'])?>"
                                        data-accounttype="<?php echo htmlspecialchars($userData['Account_type'])?>"
                                        data-photo="<?php echo htmlspecialchars('../uploads/' . ($userData['Photo'] ?: 'profile.png'))?>"
                                        data-status="<?php echo htmlspecialchars($userData['Status'])?>"
                                        data-joined="<?php echo htmlspecialchars($userData['Joined'])?>" 
                                        data-lastactive="<?php echo htmlspecialchars($userData['Last_active'])?>"
                                        onclick="openOption(this)">
                                        </i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    <?php include '../components/Admin/optionModal.php'; ?>
    <?php include '../components/Admin/ViewProfile.php'; ?>
    <?php include '../components/Admin/SnipModal.php'; ?>
    <?php include '../components/Admin/ProfileModal.php'; ?>
    <?php include '../components/Admin/EditProfile.php'; ?>
    <?php include '../components/Admin/PasswordModal.php'; ?>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const durationElements = document.querySelectorAll(".duration");

        durationElements.forEach(durationElement => {
            const currentTime = new Date();
            const loggedTime = durationElement.getAttribute("data-time");
            const loggedTimeParsed = new Date(loggedTime);

            const diffInSeconds = Math.floor((currentTime - loggedTimeParsed) / 1000);
            
            let displayDuration;

            if (diffInSeconds < 60) {
                displayDuration = diffInSeconds === 1 ? 'a second ago' : `${diffInSeconds} seconds ago`;
            } else if (diffInSeconds < 3600) {
                const minutes = Math.floor(diffInSeconds / 60);
                displayDuration = minutes === 1 ? 'a minute ago' : `${minutes} minutes ago`;
            } else if (diffInSeconds < 86400) {
                const hours = Math.floor(diffInSeconds / 3600);
                displayDuration = hours === 1 ? 'an hour ago' : `${hours} hours ago`;
            } else if (diffInSeconds < 604800) {
                const days = Math.floor(diffInSeconds / 86400);
                displayDuration = days === 1 ? 'a day ago' : `${days} days ago`;
            } else if (diffInSeconds < 2419200) {
                const weeks = Math.floor(diffInSeconds / 604800);
                displayDuration = weeks === 1 ? 'a week ago' : `${weeks} weeks ago`;
            } else if (diffInSeconds < 31536000) {
                const months = Math.floor(diffInSeconds / 2419200);
                displayDuration = months === 1 ? 'a month ago' : `${months} months ago`;
            } else {
                const years = Math.floor(diffInSeconds / 31536000);
                displayDuration = years === 1 ? 'a year ago' : `${years} years ago`;
            }

            durationElement.textContent = displayDuration;
        });
    });
    </script>

    <script>
    const optionContainer = document.querySelector(".optionModal");
    const overlay = document.querySelector(".option-overlay");
    const viewProfile = document.getElementById("view-Profile");
    const deleteUser = document.getElementById("delete-User");
    const indicator = document.querySelector(".indicator-lg");
    const deleteButton = document.getElementById("delete-User");
    let selectedIcon = null;

    function openOption(icon) {
        const iconRect = icon.getBoundingClientRect();
        const offsetX = window.scrollX;
        const offsetY = window.scrollY;
        selectedIcon = icon;

        const userID = $(icon).data('id');
        const FirstName = $(icon).data('firstname');
        const LastName = $(icon).data('lastname');
        const Email = $(icon).data('email');
        const Gender = $(icon).data('gender');
        const BirthDate = new Date ($(icon).data('birthdate'));
        const Address = $(icon).data('address');
        const PhoneNumber = $(icon).data('phonenumber');
        const accountType = $(icon).data('accounttype');
        const Photo = $(icon).data('photo');
        const Status = $(icon).data('status').trim(); 
        const Joined = new Date($(icon).data('joined'));
        const Lastactive = new Date ($(icon).data('lastactive'));

        if (accountType == 1) {
            deleteUser.style.display = "none";
        } else if (accountType == 2) {
            deleteUser.style.display = "flex";
        } else {
            deleteUser.style.display = "block";
        }

        const isNearBottom = (iconRect.bottom + 100) > window.innerHeight;
        optionContainer.style.left = `${iconRect.right + offsetX + 10}px`;

        if (accountType === 2 && !isNearBottom) {
            optionContainer.style.top = `${iconRect.top + offsetY - 65}px`;
        } else if (accountType === 1 && !isNearBottom) {
            optionContainer.style.top = `${iconRect.top + offsetY - 18}px`;
        } else {
            optionContainer.style.top = `${iconRect.top + offsetY + (isNearBottom ? -65 : -18)}px`;
        }

        if (Status === "Online") {
            indicator.classList.add("Online");
        } else if (Status === "Offline") {
            indicator.classList.add("Offline");
        }

        const roleAdmin = document.querySelector(".role-admin");
        const roleStaff = document.querySelector(".role-staff");
        const accountTypeSpan = document.getElementById("span-accounttype"); 

        if (accountType == '2') {
            accountTypeSpan.textContent = 'Staff';
            accountTypeSpan.className = roleStaff.className; 
        } else if (accountType == '1') {
            accountTypeSpan.textContent = 'Admin';
            accountTypeSpan.className = roleAdmin.className; 
        }

        const GenderSpan = document.getElementById("span-gender");
        const genderIcon = document.getElementById("genderIcon");
        const genderText = document.getElementById("genderText");

        if (Gender === 'Male') {
            GenderSpan.classList.add("Male");
            genderText.textContent = 'Male';
            genderIcon.className = 'fa-solid fa-mars';
        } else if (Gender === 'Female') {
            GenderSpan.classList.add("Female");
            genderText.textContent = 'Female';
            genderIcon.className = 'fa-solid fa-venus';
        }

        const options = {year: 'numeric', month: 'long', day: 'numeric'};

        const formattedBirthDate = BirthDate.toLocaleDateString('en-Us', options);
        const formattedJoined = Joined.toLocaleDateString('en-Us', options);
        const formattedLastActive = Lastactive.toLocaleDateString('en-Us', options);

        const lastActiveWrapper = document.querySelector(".active-wrapper");

        if (Status === 'Online') {
            lastActiveWrapper.classList.add("invisible");
            lastActiveWrapper.classList.remove("visible");
        } if (Status === 'Offline') {
            lastActiveWrapper.classList.add("visible");
            lastActiveWrapper.classList.remove("invisible");
        }

        deleteButton.setAttribute("data-id", userID);

        document.getElementById("span-firstname").textContent = FirstName;
        document.getElementById("span-lastname").textContent = LastName;
        document.getElementById("span-email").textContent = Email;
        document.getElementById("span-birthdate").textContent = formattedBirthDate;
        document.getElementById("span-address").textContent = Address;
        document.getElementById("span-phonenumber").textContent = PhoneNumber;
        document.getElementById("user-photo").src = Photo;
        document.getElementById("span-joined").textContent = formattedJoined;
        document.getElementById("span-lastactive").textContent = formattedLastActive;

        viewProfile.addEventListener('click', function () {
            closeOptionModal();
        });

        icon.classList.add("clicked");

        optionContainer.style.display = "block";
        overlay.style.display = "block";
    }

    function closeOptionModal() {
        // Hide the modal and overlay
        optionContainer.style.display = "none";
        overlay.style.display = "none";

        if (selectedIcon) {
            selectedIcon.classList.remove("clicked");
            selectedIcon = null; 
        }
    }

    deleteUser.addEventListener('click', function () {
        closeOptionModal();
    });

    function confirmDelete(button) {
        const userID = button.getAttribute('data-id'); 

        if (userID) {
            console.log("User ID:", userID);
        } else {
            console.error("User ID not found.");
        }
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#53539b',
            cancelButtonColor: '#9f5d8bcc',
            confirmButtonText: '<span style="color: #fff">Yes, Delete it!</span>',
            cancelButtonText: '<span style="color: #fff">Cancel</span>',
            customClass: {
                confirmButton: 'custom-confirm-btn',
                cancelButton: 'custom-cancel-btn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../php/Admin/deleteUser.php?deleteStaff=" + userID;
            }
        });
    }
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

    <script>
        const visibilityObserver = new IntersectionObserver((observedEntries, visibilityObserver) => {
            observedEntries.forEach(entry => {
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

        document.querySelectorAll('.log-row').forEach(tableRow => {
            visibilityObserver.observe(tableRow);
        });
    </script>

    <script src="../js/toggleSidebar.js"></script>
    <script src="../js/Admin/modal.js"></script>
</body>
</html>