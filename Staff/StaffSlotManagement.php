<?php 
include '../php/connections.php';
include '../php/parkingFunction.php';
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

<div class="loader-container" id="loader-container">
    <div class="loader">
  <div class="box" style="--i: 1; --inset:44%">
    <div class="logo">
        <img src="../img/logo.png" alt="">
    </div>
  </div>
  <div class="box" style="--i: 2; --inset:40%"></div>
  <div class="box" style="--i: 3; --inset:36%"></div>
  <div class="box" style="--i: 4; --inset:32%"></div>
  <div class="box" style="--i: 5; --inset:28%"></div>
  <div class="box" style="--i: 6; --inset:24%"></div>
  <div class="box" style="--i: 7; --inset:20%"></div>
  <div class="box" style="--i: 8; --inset:16%"></div>
</div>
    </div>


    <header>
        <div class="navbar">
        <div class="header-logo"><a href="#"><img src="../img/logo.png" alt=""></a></div>
        </div>
    </header>
            
    <section>

<!-- Include the left sidebar -->
<?php include '../components/sidebarLeft.php'; ?>

<div class="main-section">
    <?php include '../components/cards.php'; ?>
    <div class="parking-container">
        <div class="parking-table-container">Table</div>
    </div>
    <footer>
        <div class="footer">
            <button><i class="fa-solid fa-house"></i></button>
            <button id="staffSlotOverview"><i class="fa-solid fa-car"></i></button>
            <button><i class="fa-solid fa-circle-info"></i></button>
            <button><i class="fa-solid fa-gear"></i></button>
        </div>
    </footer>
</div>

<!-- Include the right sidebar -->
<?php include '../components/sidebarRight.php'; ?>
<?php 
$current_page = 'StaffSlotManagement'; 
include '../components/addSlotModal.php'; 
?>

</section>

     <script>
      document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("staffSlotOverview").onclick = function () {
          location.href = "StaffSlotOverview.php";
        }
      });
     </script>
     <script>
        // Add Slot 
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('add_slot')) {
            
            document.getElementById('loader-container').style.display = 'none';
        }
     </script>
     <script rel="javascript" src="../js/script.js"></script>
     <script src="../js/loading.js"></script>
     <script src="../js/section.js"></script>


     <?php include '../php/alerts.php'; ?>
</body>
</html>
