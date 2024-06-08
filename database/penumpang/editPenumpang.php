<?php
require_once('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_penumpang = $_POST['editIdPenumpang'];
    $nama = $_POST['editNamaPenumpang'];
    $alamat = $_POST['editAlamatPenumpang'];
    $no_telpon = $_POST['editNoTeleponPenumpang'];
    $email = $_POST['editEmail'];
    $umur = $_POST['editUmurPenumpang'];

    $sql = "UPDATE penumpang SET nama = ?, alamat = ?, nomor_telepon = ?, email = ?, umur = ? WHERE id_penumpang = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssi", $nama, $alamat, $no_telpon, $email, $umur, $id_penumpang);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $connection->close();
}
?>
