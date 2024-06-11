<?php

require_once ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT transaksi.id_transaksi,
                   transaksi.id_perjalanan, 
                   perjalanan.rute, 
                   penumpang.nama,
                   transaksi.tanggal_transaksi,
                   transaksi.jumlah_tiket,
                   transaksi.total_bayar,
                   transaksi.metode_pembayaran
            FROM transaksi
            INNER JOIN perjalanan ON transaksi.id_perjalanan = perjalanan.id_perjalanan
            INNER JOIN penumpang ON transaksi.id_penumpang = penumpang.id_penumpang";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $response = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
        echo json_encode($response);
    } else {
        echo json_encode(array('message' => 'Belum ada data'));
    }
}

mysqli_close($connection);

?>
