<?php
require_once('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bus = $_POST['editIdBus'];
    $nomor_polisi = $_POST['editNomorPolisi'];
    $kapasitas = $_POST['editKapasitas'];
    $model = $_POST['editModel'];
    $tahun_pembuatan = $_POST['editTahunPembuatan'];

    $sql = "UPDATE bus SET nomor_polisi = ?, kapasitas = ?, model = ?, tahun_pembuatan = ? WHERE id_bus = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sissi", $nomor_polisi, $kapasitas, $model, $tahun_pembuatan, $id_bus);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $connection->close();
}
?>
