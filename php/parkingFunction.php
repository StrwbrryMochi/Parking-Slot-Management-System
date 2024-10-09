<?php 
include 'connections.php';

function fetchParking() {
    global $connections;

    if ($connections->ping()) {
        $sql = "SELECT * FROM parking_tbl";
        $result = mysqli_query($connections, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($connections);
            return[];
        }

        $parkingFetch = [];
        while($row = mysqli_fetch_assoc($result)) {
            $parkingFetch[] = $row;
        }

        return $parkingFetch;
    } else {
        echo "Error: Database connection is closed.";
        return [];
    }
}