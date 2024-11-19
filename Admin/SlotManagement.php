<?php include '../php/connections.php';
      include '../php/adminLoginData.php';    
      $current_page = 'SlotManagement'; 
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
                    <a class="links active" href="SlotManagement.php">
                        <i class='bx bx-car' ></i>
                        <span class="circle"></span>
                        <span class="link-text">Slot Management</span>
                    </a>
                </li>
                <li>
                <a class="links" href="UserManagement.php">
                        <i class='bx bx-user' ></i>
                        <span class="link-text">User Management</span>
                </a>
                </li>
                <li>
                <a class="links" href="Archive.php">
                        <i class='bx bx-archive' ></i>
                        <span class="link-text">Archive Management</span>
                </a>
                </li>
            </ul>
        </div>

        <div class="side-footer">
            
        </div>
    </div>

    <section id="content" class="content">
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
                <h1>Slot Management</h1>
            </div> 
            <div class="user-container">
                <img class="user-image" src="<?php echo htmlspecialchars($Photo); ?>" alt="">
                <span class="indicator"></span>
            </div>
        </div>
    </nav>

    <div class="slot-container">
        <div class="slot-overview">
            <?php include '../php/parkingFunction.php';
            $fetchParking = fetchParking();?>
            <div class="legend-container">
                <div class="legend-data occupy">
                    <span class="legend occupy"></span>
                    <div class="legend-text">Occupied</div>
                </div>

                <div class="legend-data overstayed">
                    <span class="legend overstayed"></span>
                    <div class="legend-text">Overstayed</div>
                </div>

                <div class="legend-data outofService">
                    <span class="legend outofService"></span>
                    <div class="legend-text">Unavailable</div>
                </div>
            </div>
            <?php include '../components/floorsLayout.php';?>
        </div>
    </div>
    </section>

    <?php include '../components/Admin/SnipModal.php'; ?>
    <?php include '../components/Admin/EditProfile.php'; ?>
    <?php include '../components/Admin/ProfileModal.php'; ?>
    <?php include '../components/Admin/PasswordModal.php'; ?>
    <?php include '../components/Admin/ViewSlot.php'; ?>
    <?php include '../components/Admin/EditSlot.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const Container = document.querySelector(".slot-container");

            Container.classList.add("appear");
        });
    </script>

    <script>
        const zones = ['A', 'B', 'C', 'D', 'E', 'F'];
        const slotsPerZone = 10;
        const floors = [1, 2, 3, 4, 5];
        const parkingData = <?php echo json_encode($fetchParking); ?>; 

        // Get current time
        const currentTime = new Date();

        // Loop through each floor
        floors.forEach(floor => {
            // Loop through each zone
            zones.forEach(zone => {
                const container = document.getElementById(`floor${floor}-zone${zone}-slots`);
                let slotNumber = 1; 

                // Loop through parking data to find slots for the current floor and zone
                parkingData.forEach(slot => {
                    if (slot.floor == floor && slot.zone == zone) {
                        const button = document.createElement('button');
                        button.className = 'slot';
                        button.setAttribute('data-zone', zone);
                        button.setAttribute('data-slot', slotNumber); 
                        button.setAttribute('data-floor', floor);
                        button.setAttribute('data-slot-id', slot.slot_id);
                        button.setAttribute('data-license-plate', slot.plate_number);
                        button.setAttribute('data-user-type', slot.user_type);
                        button.setAttribute('data-vehicle-type', slot.vehicle_type);
                        button.setAttribute('data-status', slot.status);
                        button.setAttribute('data-time-in', slot.time_in);
                        
                        // Set the button's inner text to the slot number
                        button.textContent = slotNumber;

                        // Check if slot status is occupied
                        if (slot.status === 'Occupied') {
                            button.classList.add('occupied');

                            // Calculate time difference
                            const timeIn = new Date(slot.time_in);
                            const duration = (currentTime - timeIn) / (1000 * 60 * 60);

                            if (duration > 8) {
                                button.classList.add('overstay');
                            }
                        } else {
                            button.setAttribute('enabled', 'enabled');
                            button.style.pointerEvents = 'auto';
                        }

                        if (slot.status === 'Unavailable') {
                            button.classList.add("unavailable");
                        }

                        if (slot.status === 'Reserved') {
                            button.classList.add("reserved")
                        }
                        
                        button.addEventListener('click', function () {
                            const selectedZone = this.getAttribute('data-zone');
                            const selectedSlot = this.getAttribute('data-slot');
                            const selectedFloor = this.getAttribute('data-floor');
                            const licensePlate = this.getAttribute('data-license-plate');
                            const userType = this.getAttribute('data-user-type');
                            const vehicleType = this.getAttribute('data-vehicle-type');
                            const status = this.getAttribute('data-status');
                            const timeIn = this.getAttribute('data-time-in');

                            // Update the Bootstrap modal with the slot's information
                            document.getElementById('modal-floor').textContent = `${selectedFloor}`;
                            document.getElementById('modal-zone').textContent = `${selectedZone}`;
                            document.getElementById('modal-slot').textContent = `${selectedSlot}`;
                            document.getElementById('modal-license-plate').textContent = `${licensePlate}`;
                            document.getElementById('modal-user-type').textContent = `${userType}`;
                            document.getElementById('modal-vehicle-type').textContent = `${vehicleType}`;
                            document.getElementById('modal-status').textContent = `${status}`;

                            document.getElementById('hidden-time-in').value = timeIn;

                            // Handle time_in: if it's 'null', empty, or invalid, hide the field
                            const modalTimeIn = document.getElementById('modal-time-in');
                            const modalTimeInField = document.getElementById('modal-time-in-field');

                            if (timeIn && timeIn !== 'null' && timeIn.trim() !== '') {
                                const date = new Date(timeIn);
                                const formattedDate = date.toLocaleString('en-US', { 
                                    year: 'numeric', 
                                    month: '2-digit', 
                                    day: '2-digit', 
                                    hour: '2-digit', 
                                    minute: '2-digit', 
                                    hour12: true 
                                });
                                modalTimeIn.textContent = formattedDate;
                                modalTimeInField.style.display = 'block'; 
                            } else {
                                modalTimeInField.style.display = 'none'; 
                            }

                            // Display vehicle type Image
                            const vehicleImageContainer = document.querySelector('.view-vehicle-type');
                            vehicleImageContainer.innerHTML = ''; 

                            let imgSrc = '';

                            // Match vehicle type and set corresponding image
                            if (vehicleType === 'Car') {
                                imgSrc = '../img/Cars.svg';
                            } else if (vehicleType === 'Motorcycle') {
                                imgSrc = '../img/Moto.svg';
                            } else if (vehicleType === 'Bicycle') {
                                imgSrc = '../img/Bikes.svg';
                            } else {
                                imgSrc = '../img/Parking.svg'; 
                            }

                            const vehicleImg = document.createElement('img');
                            vehicleImg.src = imgSrc;
                            vehicleImg.alt = vehicleType;
                            vehicleImageContainer.appendChild(vehicleImg);

                            const modal = new bootstrap.Modal(document.getElementById('slotModal'));
                            modal.show();
                        });

                        container.appendChild(button);
                        slotNumber++; 
                    }
                });
            });
        });
    </script>

    <?php include '../php/Admin/alerts.php'; ?>
    
    <script src="../js/Admin/modal.js"></script>
    <script src="../js/floorPagination.js"></script>
    <script src="../js/toggleSidebar.js"></script>
    <script src="../js/Admin/pageTransition.js"></script>
</body>
</html>