<?php
require_once('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_GET)) {
    $nama = isset($_POST['namaPenumpang']) ? $_POST['namaPenumpang'] : $_GET['namaPenumpang'];
    $alamat = isset($_POST['alamatPenumpang']) ? $_POST['alamatPenumpang'] : $_GET['alamatPenumpang'];
    $no_telpon = isset($_POST['noTelponPenumpang']) ? $_POST['noTelponPenumpang'] : $_GET['noTelponPenumpang'];
    $email = isset($_POST['noSimEmail']) ? $_POST['noSimEmail'] : $_GET['noSimEmail'];
    $umur = isset($_POST['umurPenumpang']) ? $_POST['umurPenumpang'] : $_GET['umurPenumpang'];

    $sql = "INSERT INTO penumpang (nama, alamat, nomor_telepon, email, umur) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $nama, $alamat, $no_telpon, $email, $umur);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $connection->close();
}

?>
