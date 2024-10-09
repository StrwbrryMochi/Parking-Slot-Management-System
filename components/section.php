<?php
// Include the database connection
include 'db_connection.php';

// Prevent caching to ensure updated values are fetched
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

// Fetch Counts for Navbar with error handling
$sqlFetchCounts = "SELECT guests, slots, members, reserved FROM counts WHERE id = 1";
$resultCounts = $conn->query($sqlFetchCounts);

if ($resultCounts === false) {
    // If query fails, show a detailed error message for debugging
    die("Error fetching counts: " . $conn->error);
}

if ($resultCounts->num_rows > 0) {
    $rowCounts = $resultCounts->fetch_assoc();
    $guests = $rowCounts['guests'];
    $slots = $rowCounts['slots'];
    $members = $rowCounts['members'];
    $reserved = $rowCounts['reserved'];
} else {
    // Default values if no row is found
    $guests = 0;
    $slots = 500;
    $members = 0;
    $reserved = 0;
}

// Fetch Records for Section with error handling
$ratePerMinute = 5; // Define your rate per minute
$sqlRecords = "SELECT * FROM records";
$resultRecords = $conn->query($sqlRecords);

// Check if the query for records failed
if ($resultRecords === false) {
    die("Error fetching records: " . $conn->error);
}

?>

<!-- Main Section (Records Table) -->
<section class="container mt-4">
    <div class="row">
        <!-- Optionally include the left sidebar -->
        <?php include 'components/sidebarLeft.php'; ?>

        <!-- Center Column (Record List) -->
        <div class="col-lg-8">
             <!-- Navbar Section (Statistics) -->
            <div class="row mb-3">
                <nav class="navbar-custom">  
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="statistics card-body">
                                    <h5>Guest</h5>
                                    <p><?php echo htmlspecialchars($guests); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="statistics card-body">
                                    <h5>Member</h5>
                                    <p><?php echo htmlspecialchars($members); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="statistics card-body">
                                    <h5>Slot</h5>
                                    <p><?php echo htmlspecialchars($slots); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="statistics card-body">
                                    <h5>Reserved</h5>
                                    <p><?php echo htmlspecialchars($reserved); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
                
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Card No.</th>
                                        <th>Name</th>
                                        <th>Plate Number</th>
                                        <th>Contact</th>
                                        <th>Duration (Minutes)</th>
                                        <th>Status</th>
                                        <th>Charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($resultRecords->num_rows > 0) {
                                        $counter = 1;
                                        while ($rowRecords = $resultRecords->fetch_assoc()) {
                                            $duration = $rowRecords['duration'] ?? 0;
                                            $charge = $duration * $ratePerMinute;

                                            echo "<tr>";
                                            echo "<td>" . $counter++ . "</td>";
                                            echo "<td>" . htmlspecialchars($rowRecords['card_number']) . "</td>";
                                            echo "<td>" . htmlspecialchars($rowRecords['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($rowRecords['plate_number']) . "</td>";
                                            echo "<td>" . htmlspecialchars($rowRecords['contact']) . "</td>";
                                            echo "<td>" . ($duration > 0 ? $duration . " minutes" : "0 minutes") . "</td>";
                                            echo "<td><span class='badge " . 
                                                ($rowRecords['status'] == 'Active' ? 'bg-success' : 
                                                ($rowRecords['status'] == 'Overstay' ? 'bg-danger' : 'bg-warning')) . 
                                                "'>" . htmlspecialchars($rowRecords['status']) . "</span></td>";
                                            echo "<td>₱" . number_format($charge, 2) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No records found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optionally include the right sidebar -->
        <?php include 'components/sidebarRight.php'; ?>
    </div>
</section>
