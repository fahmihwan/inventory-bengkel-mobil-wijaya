
<?php
include './../koneksi.php';

function average($month)
{
    $date = date('Y');
    global $conn;
    $queryBarang = mysqli_query($conn, "SELECT sum(qty) as qty FROM transaksi_barang_keluar 
    INNER JOIN barang_keluar ON transaksi_barang_keluar.barang_keluar_id = barang_keluar.id
    WHERE month(barang_keluar.tanggal)='$month' AND year(barang_keluar.tanggal)='$date'");
    $data = mysqli_fetch_assoc($queryBarang)['qty'];
    return $data;
}

$average = [];
for ($i = 1; $i <= 12; $i++) {
    $average[] = average($i) != null ? average($i) : 0;
    // $average[] = [$i => average($i) != null ? average($i) : 0];
}

$json = [
    "status" => 200,
    "data" => $average,
];


echo json_encode($json);
