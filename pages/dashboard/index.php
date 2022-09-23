<?php

include './koneksi.php';

$brg = mysqli_query($conn, "SELECT * FROM barang");
$dataBrg = mysqli_num_rows($brg);

$sisaBrg = mysqli_query($conn, "SELECT id, qty FROM barang");

$sisa = [];
$stokHabis = [];
while ($dataSisa = mysqli_fetch_assoc($sisaBrg)) {
    if ($dataSisa['qty'] < 10) {
        $sisa[] = $dataSisa['id'];
    }

    if ($dataSisa['qty'] == 0) {
        $stokHabis[] = $dataSisa['id'];
    }
}

// top 5 barang keluar
// cari top 5 barang keluar dimana total qty pada tahun ini paling banyak



$topBarangKeluar = [];
$currentDate = date('Y');
$queryTop = mysqli_query($conn, "SELECT id, nama FROM barang");
while ($data = mysqli_fetch_assoc($queryTop)) {
    $id = $data['id'];
    $result = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT sum(qty) as qty FROM transaksi_barang_keluar
        INNER JOIN barang_keluar
        ON transaksi_barang_keluar.barang_keluar_id = barang_keluar.id 
        WHERE barang_id='$id' AND YEAR(barang_keluar.tanggal)='$currentDate'")
    )['qty'];

    $topBarangKeluar[] = [
        'nama' => $data['nama'],
        'qty' => $result != null ? $result : "0",
    ];
}

array_multisort(array_column($topBarangKeluar, 'qty'), SORT_DESC, $topBarangKeluar);
$topFiveOut = array_slice($topBarangKeluar, 0, 5);



?>
<div class="container-fluid px-4">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item  active"> Dashboard</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-box"></i>
            <span class="ms-2 fw-bolder"> Data Dashboard</span>
        </div>
    </div>


    <div class="row">
        <div class="col-6 col-xl-3 col-md-3">
            <div class="bg-white rounded p-3 " style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                <div class="d-flex">
                    <div class=" ">
                        <div class="bg-info rounded-pill align-items-center d-flex justify-content-center mb-2" style="width: 50px; height: 50px; padding: 5px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                            <i class="fa-solid fa-desktop"></i>
                        </div>
                    </div>
                    <div class="  ps-2">
                        <p class="py-0 m-0">Data Barang <span class="text-success"><i class="fa-solid fa-up-long"></i></span></p>
                        <p class="py-0 m-0 fw-bold"><?= $dataBrg ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3 col-md-3">
            <div class="bg-white rounded p-3" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                <div class="d-flex">
                    <div class=" ">
                        <div class="bg-warning rounded-pill align-items-center d-flex justify-content-center mb-2" style="width: 50px; height: 50px; padding: 5px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                    </div>
                    <div class=" ps-2">
                        <p class="py-0 m-0">Sisa Sedikit <span class="text-success"><i class="fa-solid fa-up-long"></i></span></p>
                        <p class="py-0 m-0 fw-bold"><?= count($sisa) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3 col-md-3">
            <div class="bg-white rounded p-3" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                <div class="d-flex">
                    <div class=" ">
                        <div class="bg-danger text-white rounded-pill align-items-center d-flex justify-content-center mb-2" style="width: 50px; height: 50px; padding: 5px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                    </div>
                    <div class="  ps-2">
                        <p class="py-0 m-0">Stok Habis <span class="text-success"><i class="fa-solid fa-up-long"></i></span></p>
                        <p class="py-0 m-0 fw-bold"><?= count($stokHabis) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row mt-5">
        <?php include './grafik/jmlBarangKeluar.php' ?>
        <div class="col-xl-4 ">
            <div class="card mt-2 mt-md-0 mb-4 mb-md-0">
                <div class="card-header">
                    Top 5 barang keluar
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">nama</th>
                            <th scope="col">qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($topFiveOut as $out) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $out['nama'] ?></td>
                                <td><?= $out['qty'] ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <?php include './grafik/stok.php'; ?>
        <!-- <div class="col-xl-4 border">
            dsd
        </div> -->

    </div>
</div>