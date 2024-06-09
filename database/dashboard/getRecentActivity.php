<?php
require_once ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Fetch recent activities from all tables
    $penumpangQuery = "SELECT nama AS name, email AS contact, created_at AS joined, 'Penumpang' AS type FROM penumpang ORDER BY created_at DESC LIMIT 10";
    $supirQuery = "SELECT nama AS name, no_telpon AS contact, created_at AS joined, 'Supir' AS type FROM supir ORDER BY created_at DESC LIMIT 10";
    $busQuery = "SELECT model AS name, nomor_polisi AS contact, created_at AS joined, 'Bus' AS type FROM bus ORDER BY created_at DESC LIMIT 10";

    $penumpangResult = mysqli_query($connection, $penumpangQuery);
    $supirResult = mysqli_query($connection, $supirQuery);
    $busResult = mysqli_query($connection, $busQuery);

    $activities = array();

    if ($penumpangResult) {
        while ($row = mysqli_fetch_assoc($penumpangResult)) {
            $activities[] = $row;
        }
    }

    if ($supirResult) {
        while ($row = mysqli_fetch_assoc($supirResult)) {
            $activities[] = $row;
        }
    }

    if ($busResult) {
        while ($row = mysqli_fetch_assoc($busResult)) {
            $activities[] = $row;
        }
    }

    // Sort activities by joined date
    usort($activities, function($a, $b) {
        return strtotime($b['joined']) - strtotime($a['joined']);
    });

    echo json_encode(array_slice($activities, 0, 10)); // Return only the top 10 recent activities
}

mysqli_close($connection);
?>
