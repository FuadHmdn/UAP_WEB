<?php

require_once ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM `penumpang`";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $response = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
        echo json_encode($response);
    } else {
        echo json_encode(array('message' => 'Belum ada data'));
    }
}

mysqli_close($connection);

?>