<?php

require_once ('../koneksi.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Mengambil data dari tabel transaksi join perjalanan dan tabel terkait
    $sql = "SELECT p.rute AS rute_perjalanan, b.model AS model_bus, s.nama AS nama_supir, pen.nama AS nama_penumpang, p.tanggal_berangkat, p.tanggal_tiba, t.jumlah_tiket, t.total_bayar, t.metode_pembayaran 
            FROM perjalanan AS p
            JOIN transaksi AS t ON p.id_perjalanan = t.id_perjalanan
            JOIN bus AS b ON p.id_bus = b.id_bus
            JOIN supir AS s ON p.id_supir = s.id_supir
            JOIN penumpang AS pen ON t.id_penumpang = pen.id_penumpang";

    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rute = $row['rute_perjalanan'];
            if (!isset($response[$rute])) {
                $response[$rute] = array();
            }
            $response[$rute][] = $row;
        }
    } else {
        $response['message'] = 'Belum ada data';
    }

    echo json_encode($response);
}

mysqli_close($connection);

?>
