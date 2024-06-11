<?php
require_once ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id_transaksi'])) {
    $id_transaksi = mysqli_real_escape_string($connection, $_GET['id_transaksi']);
    $sql = "DELETE FROM `transaksi` WHERE id_transaksi = '$id_transaksi'";

    if (mysqli_query($connection, $sql)) {
        echo "Berhasil";
        http_response_code(204);
    } else {
        http_response_code(500);
    }
}

mysqli_close($connection);
?>
