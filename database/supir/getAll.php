<?php

require_once ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $response = array();

    $sqlSupir = "SELECT COUNT(*) as jumlah_supir FROM supir";
    $resultSupir = mysqli_query($connection, $sqlSupir);
    if ($resultSupir) {
        $rowSupir = mysqli_fetch_assoc($resultSupir);
        $response['jumlah_supir'] = $rowSupir['jumlah_supir'];
    } else {
        $response['jumlah_supir'] = 0;
    }

    $sqlPenumpang = "SELECT COUNT(*) as jumlah_penumpang FROM penumpang";
    $resultPenumpang = mysqli_query($connection, $sqlPenumpang);
    if ($resultPenumpang) {
        $rowPenumpang = mysqli_fetch_assoc($resultPenumpang);
        $response['jumlah_penumpang'] = $rowPenumpang['jumlah_penumpang'];
    } else {
        $response['jumlah_penumpang'] = 0;
    }

    $sqlBus = "SELECT COUNT(*) as jumlah_bus FROM bus";
    $resultBus = mysqli_query($connection, $sqlBus);
    if ($resultBus) {
        $rowBus = mysqli_fetch_assoc($resultBus);
        $response['jumlah_bus'] = $rowBus['jumlah_bus'];
    } else {
        $response['jumlah_bus'] = 0;
    }

    echo json_encode($response);
}

mysqli_close($connection);

?>
