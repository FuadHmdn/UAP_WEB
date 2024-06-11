<?php
require_once('../koneksi.php');

$sql = "SELECT id_bus, model FROM bus";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    $buses = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $buses[] = $row;
    }
    echo json_encode($buses);
} else {
    echo json_encode(array('message' => 'No buses found'));
}

mysqli_close($connection);
?>
