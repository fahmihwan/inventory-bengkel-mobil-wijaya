<?php

$conn = mysqli_connect('localhost', 'root', 'root', 'db_inventroy_wijaya');

$start = $_GET['start'];
$end = $_GET['end'];

$sql = "SELECT
barang_masuk.id as id, no_referensi, tanggal, nama, catatan
FROM barang_masuk
INNER JOIN supplier
ON barang_masuk.supplier_id = supplier.id";
$queryBarang = mysqli_query($conn, $sql);

if ($start != '' || $end != '') {
    $queryBarang = mysqli_query($conn, "SELECT
    barang_masuk.id as id, no_referensi, tanggal, nama, catatan
    FROM barang_masuk
    INNER JOIN supplier
    ON barang_masuk.supplier_id = supplier.id WHERE tanggal BETWEEN '$start' AND '$end'");
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>.</title>
    <style>

    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row ">
            <h5 class="text-center mb-0 pb-0">Detail Barang Masuk</h5>
            <p class="text-center mt-2 " style="font-size: 10px;">Bengkel LBS Auto Service Jl. Lintas Sumatera No.KM 123,
                <br> Lubuk Seberuk, Lempuing Jaya, Kabupaten Ogan Komering Ilir, Sumatera Selatan
            </p>
            <hr>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <table class="" style="width: 400px">
                    <!-- <tr>
                        <td style="width: 120px;">Tanggal </td>
                        <td> : <?= 22    ?></td>
                    </tr> -->
                </table>
            </div>

        </div>

        <div class="row">
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>No Refernsi</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Qty</td>
                </tr>
                <?php
                $i = 1;
                while ($data = mysqli_fetch_assoc($queryBarang)) :
                    $id = $data['id'];
                    $queryCountQty = mysqli_query($conn, "SELECT sum(qty) as qty FROM transaksi_barang_masuk WHERE barang_masuk_id='$id'");
                    $getQty = mysqli_fetch_assoc($queryCountQty);
                ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $data['no_referensi']; ?></td>
                        <td><?= $data['tanggal']; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $getQty['qty'] ?></td>
                    </tr>

                <?php
                endwhile;
                ?>
            </table>
        </div>
    </div>
    <script>
        window.print()
    </script>

</body>

</html>

<script>

</script>
<!-- pages/print/print_barang_masuk.php -->