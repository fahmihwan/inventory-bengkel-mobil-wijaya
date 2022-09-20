<?php
include './koneksi.php';


$sql = "SELECT
barang_masuk.id as id, no_referensi, tanggal, nama, catatan
FROM barang_masuk 
INNER JOIN supplier
ON supplier.id = barang_masuk.supplier_id 
ORDER BY tanggal DESC";

$queryBarang = mysqli_query($conn, $sql);

?>

<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">Data Barang Masuk</li>
        <li class="breadcrumb-item active">list Barang Masuk</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-box"></i>
            <span class="ms-2 fw-bolder"> Data Barang Masuk</span>

            <!-- Button trigger modal -->
            <a href="index.php?barang-masuk=add" class="btn btn-sm btn-primary float-end rounded-pill">
                tambah data <i class="fa-solid fa-box"></i>
            </a>
        </div>

        <div class="p-3  bg-white " style="border-radius: 20px; ">
            <table id="datatablesSimple" style="border-color: white;">
                <thead class="">
                    <tr>
                        <th>no</th>
                        <th>no referensi</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>QTY</th>
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 0;
                    while ($data = mysqli_fetch_assoc($queryBarang)) :
                        $id = $data['id'];
                        $queryCountQty = mysqli_query($conn, "SELECT sum(qty) as qty FROM transaksi_barang_masuk WHERE barang_masuk_id='$id'");
                        $getQty = mysqli_fetch_assoc($queryCountQty);
                    ?>
                        <tr>
                            <td><?= $i += 1 ?></td>
                            <td><?= $data['no_referensi'] ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $getQty['qty'] ?></td>
                            <td class="text-center">
                                <a href="index.php?barang-masuk=detail&id= <?= $data['id'] ?>" class="btn btn-sm btn-info text-white">
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