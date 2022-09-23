<?php
include './koneksi.php';

$id = $_GET['id'];

$sql = "SELECT
barang_keluar.id as id, kode_referensi, tanggal, nama, catatan
FROM barang_keluar 
INNER JOIN montir
ON montir.id = barang_keluar.montir_id
WHERE barang_keluar.id='$id'";

$queryBrgMasuk = mysqli_query($conn, $sql);
$brgMasuk = mysqli_fetch_assoc($queryBrgMasuk);


?>
<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">Detail Barang Keluar</li>
        <li class="breadcrumb-item active">list Barang Keluar</li>
    </ol>
    <div class="mb-4">
        <div class="card-header justify-content-between mb-3 align-items-center d-flex" style="border-radius: 20px ;background-color: white; border:0px;">
            <div class=" ">
                <i class="fa-solid fa-box"></i>
                <span class="ms-2 fw-bolder"> Detail Barang Keluar</span>
            </div>
            <div>
            </div>
            <div class="d-flex align-items-center">
                <div class="me-3">

                    <a href="pages/print/print_barang_keluar.php?id=<?= $id ?>" class="btn btn-outline-info me-2">
                        <i class="fa-solid fa-print"></i>
                    </a>

                </div>
                <table>
                    <tr>
                        <td style="width: 130px;">Kode Referensi</td>
                        <td class="text-danger">: <?= $brgMasuk['kode_referensi'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td class="text-primary">: <?= $brgMasuk['tanggal'] ?></td>
                    </tr>
                </table>
            </div>

        </div>

    </div>

    <div class="container">
        <div class="row ">
            <div class="col-md-12 mb-3">
                <table>
                    <tr>
                        <td>Monitr</td>
                        <td>: <?= $brgMasuk['nama'] ?></td>
                    </tr>

                    <tr>
                        <td>Catatan</td>
                        <td>: <?= $brgMasuk['catatan'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="container" style="width: 90%;">
                <div class="bg-white p-2 rounded">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">barang</th>
                                <th scope="col">merek</th>
                                <th scope="col">kategori</th>
                                <th scope="col">qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqll = "SELECT barang.nama as barang, merek.nama as merek, kategori.nama as kategori, transaksi_barang_keluar.qty as qty
                        FROM transaksi_barang_keluar 
                        INNER JOIN barang 
                        ON barang.id = transaksi_barang_keluar.barang_id 
                        INNER JOIN merek 
                        ON merek.id = barang.merek_id
                        INNER JOIN kategori 
                        ON kategori.id = barang.kategori_id
                        WHERE barang_keluar_id='$id'";

                            $dataBarang = mysqli_query($conn, $sqll);
                            $i = 1;
                            while ($data = mysqli_fetch_assoc($dataBarang)) :

                            ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $data['barang']; ?></td>
                                    <td><?= $data['merek']; ?></td>
                                    <td><?= $data['kategori']; ?></td>
                                    <td><?= $data['qty'] ?></td>
                                </tr>

                            <?php
                            endwhile;

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 d-flex justify-content-center ">
                <a href="index.php?laporan=barang-keluar" class="btn btn-outline-danger"> <i class="fa-solid fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

    </div>


</div>