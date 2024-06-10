<?php
require_once('../koneksi.php');

$response = ['success' => false, 'error' => ''];

$id = isset($_POST['id']) ? $_POST['id'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$address = isset($_POST['address']) ? $_POST['address'] : null;

try {
    if (!$id || !$name || !$email || !$phone || !$address) {
        throw new Exception('Missing required fields.');
    }

    $stmt = $connection->prepare("UPDATE admin SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare statement.');
    }

    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        throw new Exception('Failed to update profile.');
    }

    $stmt->close();
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);

$connection->close();
?>
