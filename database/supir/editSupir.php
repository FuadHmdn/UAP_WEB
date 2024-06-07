<?php
require_once('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_supir = $_POST['editIdSupir'];
    $nama = $_POST['editNamaSupir'];
    $alamat = $_POST['editAlamatSupir'];
    $no_telpon = $_POST['editNoTelponSupir'];
    $no_sim = $_POST['editNoSimSupir'];
    $umur = $_POST['editUmurSupir'];

    $sql = "UPDATE supir SET nama = ?, alamat = ?, no_telpon = ?, no_sim = ?, umur = ? WHERE id_supir = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssi", $nama, $alamat, $no_telpon, $no_sim, $umur, $id_supir);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $connection->close();
}

?>
