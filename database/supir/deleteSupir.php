<?php
require_once ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id_supir'])) {
    $id_supir = mysqli_real_escape_string($connection, $_GET['id_supir']);
    $sql = "DELETE FROM `supir` WHERE id_supir = '$id_supir'";

    if (mysqli_query($connection, $sql)) {
        echo "Berhasil";
        http_response_code(204);
    } else {
        http_response_code(500);
    }
}

mysqli_close($connection);
?>
