<?php
require_once ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id_bus'])) {
    $id_bus = mysqli_real_escape_string($connection, $_GET['id_bus']);
    $sql = "DELETE FROM `bus` WHERE id_bus = '$id_bus'";

    if (mysqli_query($connection, $sql)) {
        echo "Berhasil";
        http_response_code(204);
    } else {
        http_response_code(500);
    }
}

mysqli_close($connection);
?>
