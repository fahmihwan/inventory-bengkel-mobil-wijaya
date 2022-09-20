<?php
include './koneksi.php';



$sql = "SELECT
barang_keluar.id as id, kode_referensi, tanggal, nama, catatan
FROM barang_keluar
INNER JOIN montir
ON montir.id = barang_keluar.montir_id ";
$queryBarang = mysqli_query($conn, $sql);




?>
<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">Data Barang Keluar</li>
        <li class="breadcrumb-item active">list Barang Keluar</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-box"></i>
            <span class="ms-2 fw-bolder"> Data Barang Keluar</span>

            <!-- Button trigger modal -->
            <a href="index.php?barang-keluar=add" class=" btn btn-sm btn-primary float-end rounded-pill">
                tambah data
                <i class="fa-solid fa-box"></i>
            </a>
        </div>
        <div class="p-3  bg-white " style="border-radius: 20px; ">
            <table id="datatablesSimple" style="border-color: white;">
                <thead class="">
                    <tr>
                        <th>no</th>
                        <th>Kode Refernsi</th>
                        <th>Tanggal</th>
                        <th>Montir</th>
                        <th>Catatan</th>
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($queryBarang)) :
                    ?>
                        <tr>
                            <td><?= $i += 1 ?></td>
                            <td><?= $data['kode_referensi'] ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['catatan'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <a href="index.php?barang-masuk=delete&id= <?= $data['id'] ?>" class="btn btn-sm btn-danger">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="index.php?barang-keluar=detail&id= <?= $data['id'] ?>" class="btn btn-sm btn-info text-white">
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