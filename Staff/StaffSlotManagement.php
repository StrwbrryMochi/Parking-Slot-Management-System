<?php 
include '../php/connections.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slot Management</title>
    <link rel="icon" href="../img/logo.png">
    <!-- Libraries -->
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../lib/css/sweetalert.css">
    <link rel="stylesheet" href="../lib/css/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="../lib/js/jquery-3.7.1.min.js"></script>
    <script src="../lib/js/bootstrap.bundle.js"></script>
    <script src="../lib/js/sweetalert.js"></script>
    <script src="../lib/js/toastr.js"></script>
    <!-- Styling -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <header>
        <div class="header-logo"><a href="#"><img src="../img/logo.png" alt=""></a></div>
    </header>
            
    <section id="section1">

<!-- Include the left sidebar -->
<?php include '../components/sidebarLeft.php'; ?>

<div class="main-section">
    <div class="cards-container">
        <div class="cards">CARD</div>
        <div class="cards">CARD</div>
        <div class="cards">CARD</div>
        <div class="cards">CARD</div>
    </div>
    <div class="parking-container">
        <div class="parking-table-container">Table</div>
        <div class="modal-container">Modal</div>
    </div>
    <footer>
        <div class="footer">
            <button><i class="fa-solid fa-house"></i></button>
            <button id="showSection2Btn"><i class="fa-solid fa-car"></i></button>
            <button><i class="fa-solid fa-circle-info"></i></button>
            <button><i class="fa-solid fa-gear"></i></button>
        </div>
    </footer>
</div>

<!-- Include the right sidebar -->
<?php include '../components/sidebarRight.php'; ?>

</section>

<section id="section2">
<?php include '../components/sidebarLeft.php'; ?>
            <div class="parking-overview">
              <div class="slot-overview">
              <?php include '../php/parkingFunction.php';
              $fetchParking = fetchParking();?>
              <?php include '../components/floorsLayout.php';?>
              </div>
              <footer>
                <div class="footer">
                    <button><i class="fa-solid fa-house"></i></button>
                    <button id="showSection1Btn"><i class="fa-solid fa-car"></i></button>
                    <button><i class="fa-solid fa-circle-info"></i></button>
                    <button><i class="fa-solid fa-gear"></i></button>
                </div>
                </footer>
            </div>
<?php include '../components/sidebarRight.php'; ?>
</section>


    
    
    <!-- Functions -->
    <script>
    const zones = ['A', 'B', 'C', 'D', 'E', 'F'];
    const slotsPerZone = 10;
    const floors = [1, 2, 3, 4, 5];
    const parkingData = <?php echo json_encode($fetchParking); ?>;

    // Function to show one section and hide others
    function showSection(showElement, hideElements) {
        hideElements.forEach((element) => {
            element.classList.remove("active");
            element.style.display = "none";
        });

        showElement.style.display = "flex";
        setTimeout(() => {
            showElement.classList.add("active");
        }, 0);
    }

    // Loop through each floor
    floors.forEach(floor => {
        // Loop through each zone
        zones.forEach(zone => {
            const container = document.getElementById(`floor${floor}-zone${zone}-slots`);

            // Loop through parking data to find slots for the current floor and zone
            parkingData.forEach(slot => {
                if (slot.floor == floor && slot.zone == zone) {
                    const button = document.createElement('button');
                    button.className = 'slot';
                    button.setAttribute('data-zone', zone);
                    button.setAttribute('data-slot', slot.slot_number);
                    button.setAttribute('data-floor', floor);
                    button.setAttribute('data-slot-id', slot.slot_id);
                    button.setAttribute('data-license-plate', slot.license_plate);
                    button.setAttribute('data-user-type', slot.user_type);
                    button.setAttribute('data-vehicle-type', slot.vehicle_type);
                    button.setAttribute('data-status', slot.status);

                    // Check if the status is "Occupied" and add the occupied class if true
                    if (slot.status === 'Occupied') {
                        button.classList.add('occupied');
                    }

                    button.addEventListener('click', function () {
                        const selectedZone = this.getAttribute('data-zone');
                        const selectedSlot = this.getAttribute('data-slot');
                        const selectedFloor = this.getAttribute('data-floor');
                        const licensePlate = this.getAttribute('data-license-plate');
                        const userType = this.getAttribute('data-user-type');
                        const vehicleType = this.getAttribute('data-vehicle-type');
                        const status = this.getAttribute('data-status');

                        // Update the slot-view modal with the clicked slot's information
                        document.querySelector('.slot-view h2:nth-child(1)').textContent = `Floor: ${selectedFloor}`;
                        document.querySelector('.slot-view h2:nth-child(2)').textContent = `Zone: ${selectedZone}`;
                        document.querySelector('.slot-view h2:nth-child(3)').textContent = `Slot: ${selectedSlot}`;
                        document.querySelector('.slot-view h2:nth-child(4)').textContent = `Plate Number: ${licensePlate}`;
                        document.querySelector('.slot-view h2:nth-child(5)').textContent = `User Type: ${userType}`;
                        document.querySelector('.slot-view h2:nth-child(6)').textContent = `Vehicle Type: ${vehicleType}`;
                        document.querySelector('.slot-view h2:nth-child(7)').textContent = `Status: ${status}`;

                        // Get references to other modal elements
                        const slotAdd = document.getElementById("slotAdd");
                        const slotTable = document.getElementById("slotTable");
                        const slotEdit = document.getElementById("slotEdit");
                        const slotCheckout = document.getElementById("slotCheckout");
                        const slotView = document.getElementById("slotView");

                        // Show the slotView modal and hide the others
                        showSection(slotView, [slotTable, slotAdd, slotEdit, slotCheckout]);
                    });

                    container.appendChild(button);
                }
            });
        });
    });
    </script>
     <script rel="javascript" src="../js/script.js"></script>
     <script src="../js/floorPagination.js"></script>
     <script src="../js/section.js"></script>
</body>
</html>
