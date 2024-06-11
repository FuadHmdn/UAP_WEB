<?php

require_once('../koneksi.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = $_GET['id'];

    $sql = "DELETE FROM admin WHERE id = '$id'";

    if (mysqli_query($connection, $sql)) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = mysqli_error($connection);
    }

    echo json_encode($response);
}

mysqli_close($connection);

?>
