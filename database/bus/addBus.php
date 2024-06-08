<?php
require_once('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_GET)) {
    $nomor_polisi = isset($_POST['nomorPolisi']) ? $_POST['nomorPolisi'] : $_GET['nomorPolisi'];
    $kapasitas = isset($_POST['kapasitas']) ? $_POST['kapasitas'] : $_GET['kapasitas'];
    $model = isset($_POST['model']) ? $_POST['model'] : $_GET['model'];
    $tahunPembuatan = isset($_POST['tahunPembuatan']) ? $_POST['tahunPembuatan'] : $_GET['tahunPembuatan'];

    $sql = "INSERT INTO bus (nomor_polisi, kapasitas, model, tahun_Pembuatan) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("siss", $nomor_polisi, $kapasitas, $model, $tahunPembuatan);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $connection->close();
}

?>
