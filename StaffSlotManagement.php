<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCP Parking System</title>
    <link rel="icon" href="img/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        BCP PARKING SYSTEM
    </header>
            
    <section>

<!-- Optionally include the left sidebar -->
<?php include 'components/sidebarLeft.php'; ?>

<div class="main-section">
    <div class="cards-container"></div>
    <div class="parking-table-container"></div>
    <footer>
        <div class="footer">
            <button><i class="fa-solid fa-house"></i></button>
            <button><i class="fa-solid fa-car"></i></button>
            <button><i class="fa-solid fa-circle-info"></i></button>
            <button><i class="fa-solid fa-gear"></i></button>
        </div>
    </footer>
</div>

<!-- Optionally include the right sidebar -->
<?php include 'components/sidebarRight.php'; ?>

</section>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <!-- Custom JS -->
     <script rel="javascript" src="js/script.js"></script>
</body>
</html>
