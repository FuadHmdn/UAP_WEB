<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "uap_web";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak Bisa Terkoneksi Ke database");
}
?>
