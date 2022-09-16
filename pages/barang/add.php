<?php

include './koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $merek_id = $_POST['merek_id'];
    $kategori_id = $_POST['kategori_id'];
    $rak_id = $_POST['rak_id'];
    $qty = $_POST['qty'];

    $query_insert = mysqli_query($conn, "INSERT INTO barang (nama,merek_id,kategori_id,rak_id,qty) VALUES ('$nama','$merek_id','$kategori_id','$rak_id','$qty')");

    if ($query_insert) {
        echo "<script>
        alert('success');   
        window.location.href = 'index.php?menu=data-barang  '
        </script>";
    } else {
        echo "<script>
        alert('success');   
        window.location.href = 'index.php?menu=data-barang  '       
        </script>";
    }
}


$merek = mysqli_query($conn, "SELECT * FROM merek");
$rak = mysqli_query($conn, "SELECT * FROM rak");
$kategori = mysqli_query($conn, "SELECT * FROM kategori");



?>

<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">Barang</li>
        <li class="breadcrumb-item"><a href="index.php?menu=montir">List Data</a></li>
        <li class="breadcrumb-item active">Input Data Barang</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-users"></i>
            <span class="ms-2 fw-bolder"> Form Input Barang</span>
            <a href="menu=data-barang" class="btn btn-sm btn-primary float-end rounded-pill ">
                <i class="fa-solid fa-arrow-left"></i> kembali
            </a>
        </div>
    </div>
    <div class="row ">
        <div class="mb-4 col-md-6">
            <div class="card border-none" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;">
                <div class="rounded-bottom mx-4  py-3 px-2  text-light" style="background-color: #1a1c2f;">
                    <span class="p-2 rounded-pill flex" style="background-color: #343549;"> Form Barang</span>
                </div>
                <div class="card-body px-4">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label py-0 m-0">nama</label>
                            <input type="text" class="form-control rounded-pill border-none" id="nama" name="nama" placeholder="nama" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                        </div>

                        <div class="mb-3">
                            <label for="">merek</label>
                            <select id="" class="form-control" name="merek_id">
                                <?php while ($fetch_merek = mysqli_fetch_assoc($merek)) { ?>
                                    <option value="<?= $fetch_merek['id']; ?>"><?= $fetch_merek['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">kategori</label>
                            <select id="" class="form-control" name="kategori_id">
                                <?php while ($fetch_kategori = mysqli_fetch_assoc($kategori)) { ?>
                                    <option value="<?= $fetch_kategori['id']; ?>"><?= $fetch_kategori['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">rak</label>
                            <select id="" class="form-control" name="rak_id">
                                <?php while ($fetch_rak = mysqli_fetch_assoc($rak)) { ?>
                                    <option value="<?= $fetch_rak['id']; ?>"><?= $fetch_rak['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label py-0 m-0">qty</label>
                            <input type="text" class="form-control rounded-pill border-none" id="qty" name="qty" placeholder="qty" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                        </div>

                        <button name="submit" class="btn btn-primary rounded-pill">submit</button>
                        <button class="btn btn-secondary rounded-pill">clear</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

</div>