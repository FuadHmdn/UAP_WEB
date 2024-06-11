<?php
require_once('../koneksi.php');

$sql = "SELECT * FROM perjalanan";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    $supirs = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $supirs[] = $row;
    }
    echo json_encode($supirs);
} else {
    echo json_encode(array('message' => 'No supirs found'));
}

mysqli_close($connection);
?>
