<?php
require_once('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_GET)) {
    $nama = isset($_POST['namaSupir']) ? $_POST['namaSupir'] : $_GET['namaSupir'];
    $alamat = isset($_POST['alamatSupir']) ? $_POST['alamatSupir'] : $_GET['alamatSupir'];
    $no_telpon = isset($_POST['noTelponSupir']) ? $_POST['noTelponSupir'] : $_GET['noTelponSupir'];
    $no_sim = isset($_POST['noSimSupir']) ? $_POST['noSimSupir'] : $_GET['noSimSupir'];
    $umur = isset($_POST['umurSupir']) ? $_POST['umurSupir'] : $_GET['umurSupir'];

    $sql = "INSERT INTO supir (nama, alamat, no_telpon, no_sim, umur) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $nama, $alamat, $no_telpon, $no_sim, $umur);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $connection->close();
}

?>
