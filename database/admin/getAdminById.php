<?php

require_once('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM `admin` WHERE id = $id";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $response = mysqli_fetch_assoc($result);
            echo json_encode($response);
        } else {
            echo json_encode(array('message' => 'No data found'));
        }
    } else {
        echo json_encode(array('message' => 'Query failed: ' . mysqli_error($connection)));
    }
} else {
    echo json_encode(array('message' => 'Invalid request'));
}

mysqli_close($connection);

?>