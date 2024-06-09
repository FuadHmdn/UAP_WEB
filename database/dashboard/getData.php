<?php

require_once ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $supirCountQuery = "SELECT COUNT(*) as jumlah_supir FROM supir";
    $penumpangCountQuery = "SELECT COUNT(*) as jumlah_penumpang FROM penumpang";
    $busCountQuery = "SELECT COUNT(*) as jumlah_bus FROM bus";

    $supirResult = mysqli_query($connection, $supirCountQuery);
    $penumpangResult = mysqli_query($connection, $penumpangCountQuery);
    $busResult = mysqli_query($connection, $busCountQuery);

    if ($supirResult && $penumpangResult && $busResult) {
        $response = array(
            'jumlah_supir' => mysqli_fetch_assoc($supirResult)['jumlah_supir'],
            'jumlah_penumpang' => mysqli_fetch_assoc($penumpangResult)['jumlah_penumpang'],
            'jumlah_bus' => mysqli_fetch_assoc($busResult)['jumlah_bus']
        );
        echo json_encode($response);
    } else {
        echo json_encode(array('message' => 'Gagal mengambil data'));
    }
}

mysqli_close($connection);

?>
