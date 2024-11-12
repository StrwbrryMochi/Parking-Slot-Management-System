<?php
include 'connections.php';

function fetchUser() {
    global $connections;

    if ($connections->ping()) {
        $sql = "SELECT * FROM usertbl";
        $result = mysqli_query($connections, $sql);

        if (!$result) {
            echo "Error executing query: " . mysqli_error($connections);
            return [];
        }

        $userFetch = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $userFetch[] = $row;
        }

        return $userFetch;
    } else {
        echo "Error: Database connectection is closed";
        return [];
    }
}

function fetchLogs() {
    global $connections;

    if ($connections->ping()) {
        $sql = "SELECT * FROM audit_log";
        $result = mysqli_query($connections, $sql);

        if (!$result) {
            echo "Error executing query: " . $connections->error;
            return [];
        }

        $logFetch = [];
        while($row = mysqli_fetch_assoc($result)) {
            $logFetch[] = $row;
        }

        return $logFetch;
    } else {
        echo "Error: Database connection is closed";
        return [];
    }
}
