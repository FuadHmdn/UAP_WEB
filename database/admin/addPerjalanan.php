<?php
require_once('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_bus = $_POST['id_bus'];
    $id_supir = $_POST['id_supir'];
    $tanggal_berangkat = $_POST['tanggal_berangkat'];
    $tanggal_tiba = $_POST['tanggal_tiba'];
    $rute = $_POST['rute'];

    $sql = "INSERT INTO perjalanan (id_bus, id_supir, tanggal_berangkat, tanggal_tiba, rute) VALUES ('$id_bus', '$id_supir', '$tanggal_berangkat', '$tanggal_tiba', '$rute')";

    if (mysqli_query($connection, $sql)) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error: ' . mysqli_error($connection)));
    }

    mysqli_close($connection);
}
?>
