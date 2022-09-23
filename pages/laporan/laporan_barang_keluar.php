<?php
include './koneksi.php';


$sql = "SELECT
barang_keluar.id as id, kode_referensi, tanggal, nama, catatan
FROM barang_keluar
INNER JOIN montir
ON montir.id = barang_keluar.montir_id ";
$queryBarang = mysqli_query($conn, $sql);
// $arr = [];
// while ($data = mysqli_fetch_assoc($queryBarang)) {
//     $arr[] = $data;
// }
// var_dump($arr);
// die;

?>
<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">Data Barang Keluar</li>
        <li class="breadcrumb-item active">list Barang Keluar</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <div class="float-start pt-1">
                <i class="fa-solid fa-box"></i>
                <span class="ms-2 fw-bolder"> Data Barang Keluar</span>
            </div>
        </div>
        <div class="card-header mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <div class="d-flex flex-wrap align-items-center">
                <div class="me-4 mb-2 mb-md-0 d-flex align-items-center  ">
                    <label for="" class="me-0" style="width: 110px;">start date</label>
                    <input type="date" class="form-control">
                </div>
                <div class="me-4  d-flex align-items-center ">
                    <label for="" class="me-0 pe-0" style="width: 110px;">start date</label>
                    <input type="date" class="form-control">
                </div>

                <div class="me-4 d-flex align-items-center ">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
        <div class="p-3  bg-white " style="border-radius: 20px; ">
            <table id="datatablesSimple" style="border-color: white;">
                <thead class="">
                    <tr>
                        <th>no</th>
                        <th>Kode Refernsi</th>
                        <th>Tanggal</th>
                        <th>Montir</th>
                        <th>Qty</th>
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($queryBarang)) :
                        $id = $data['id'];
                        $queryCountQty = mysqli_query($conn, "SELECT sum(qty) as qty FROM transaksi_barang_keluar WHERE barang_keluar_id='$id'");
                        $getQty = mysqli_fetch_assoc($queryCountQty);
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data['kode_referensi'] ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $getQty['qty'] ?></td>
                            <td class="text-center">
                                <a href="index.php?laporan=detail-barang-keluar&id= <?= $data['id'] ?>" class="btn btn-sm btn-info text-white">
                                    <i class="fa-solid fa-folder-open"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>