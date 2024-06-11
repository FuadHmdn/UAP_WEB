<?php
require_once('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_GET)) {
    $rute = isset($_POST['rute']) ? $_POST['rute'] : $_GET['rute'];
    $namaPenumpang = isset($_POST['namaPenumpang']) ? $_POST['namaPenumpang'] : $_GET['namaPenumpang'];
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : $_GET['tanggal'];
    $tiket = isset($_POST['tiket']) ? $_POST['tiket'] : $_GET['tiket'];
    $totalBayar = isset($_POST['totalBayar']) ? $_POST['totalBayar'] : $_GET['totalBayar'];
    $pembayaran = isset($_POST['pembayaran']) ? $_POST['pembayaran'] : $_GET['pembayaran'];

    $sql = "INSERT INTO transaksi (id_perjalanan, id_penumpang, tanggal_transaksi, jumlah_tiket, total_bayar, metode_pembayaran) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss", $rute, $namaPenumpang, $tanggal, $tiket, $totalBayar, $pembayaran);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $connection->close();
}

?>
