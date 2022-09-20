<?php
include './koneksi.php';

$barang_masuk_id = $_GET['id'];


$queryEditBarangMasuk = mysqli_query($conn, "SELECT * FROM barang_masuk 
INNER JOIN supplier
ON supplier.id = barang_masuk.supplier_id
WHERE barang_masuk.id='$barang_masuk_id'");
$fetchEdit = mysqli_fetch_assoc($queryEditBarangMasuk);

// select barang
$queryAllBarang = mysqli_query($conn, "SELECT barang.id as id, barang.nama as nama, merek.nama as merek, kategori.nama as kategori, rak.nama as rak,qty
FROM barang
INNER JOIN merek
ON barang.merek_id = merek.id
INNER JOIN kategori
ON barang.kategori_id = kategori.id
INNER JOIN rak
ON barang.rak_id = rak.id");

// select supplier
$queryAllSupplier = mysqli_query($conn, "SELECT * FROM supplier");


if (isset($_POST['submit-barang'])) {

    // get value from input user
    $cart = json_decode($_POST['cart'], true);
    $delete_cart = json_decode($_POST['delete_cart'], true);
    $tanggal = $_POST['tanggal'];
    $supplier = $_POST['supplier'];
    $catatan = $_POST['catatan'];


    $tes =  mysqli_query($conn, "UPDATE barang_masuk 
    SET supplier_id='$supplier',
    catatan='$catatan',
    tanggal='$tanggal'
    WHERE id='$barang_masuk_id'");





    try {
        // Matikan autocommit 
        mysqli_autocommit($conn, FALSE);

        // insert cart
        for ($i = 0; $i <= count($cart) - 1; $i++) {
            if ($cart[$i]['transaksi_masuk_id'] == null) {
                $barang_id = $cart[$i]['barang_id'];
                $qty = $cart[$i]['qty'];
                mysqli_query($conn, "INSERT INTO transaksi_barang_masuk (barang_masuk_id, barang_id, qty) VALUES ('$barang_masuk_id','$barang_id','$qty')");

                //update stok barang
                $queryQtyBarang = mysqli_query($conn, "SELECT qty FROM barang WHERE id='$barang_id'");
                $currentQty = mysqli_fetch_array($queryQtyBarang)['qty'];
                $currentQty += $qty;
                mysqli_query($conn, "UPDATE barang SET qty='$currentQty' WHERE id='$barang_id'");
            }
        }

        // delete cart
        if ($delete_cart) {
            for ($j = 0; $j <= count($delete_cart) - 1; $j++) {
                if ($delete_cart[$j]['transaksi_masuk_id'] != null) {
                    $transaksi_id = $delete_cart[$j]['transaksi_masuk_id'];
                    mysqli_query($conn, "DELETE FROM transaksi_barang_masuk WHERE id='$transaksi_id'");
                }
            }
        }
        mysqli_commit($conn);
        echo "<script>
         window.location.href ='index.php?barang-masuk=detail&id=$barang_masuk_id';
        </script>";
    } catch (\Throwable $e) {
        mysqli_rollback($conn);
        throw $e;
    }
}

$barang_masuk_id = $_GET['id'];


?>

<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">Detail Barang Masuk</li>
        <li class="breadcrumb-item"><a href="index.php?menu=barang-masuk">List Data</a></li>
        <li class="breadcrumb-item active">Input Barang Masuk</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-cart-plus"></i>
            <span class="ms-2 fw-bolder"> Form Barang Masuk </span>
            <a href="index.php?menu=montir" class="btn btn-sm btn-primary float-end rounded-pill ">
                <i class="fa-solid fa-arrow-left"></i> kembali
            </a>
        </div>
    </div>
    <div class="row ">
        <div class="mb-4 col-md-5">
            <div class="card border-none" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;">
                <div class="rounded-bottom mx-4  py-3 px-2  text-light" style="background-color: #1a1c2f;">
                    <span class="p-2 rounded-pill flex" style="background-color: #343549;"> <i class="fa-solid fa-lock"></i> Barang</span>
                </div>
                <div class="card-body px-4">

                    <!-- add bararng -->
                    <!-- <form action="" method="POST"> -->
                    <div class="mb-3 clearfix">
                        <div class="" style="width: 100%;">
                            <input type="hidden" id="get-id-from-url" value="<?= $barang_masuk_id ?>">


                            <!-- <input type="" value="" id="cart-barang" name="select-barang"> -->
                            <label for="nama" class="form-label py-0 m-0">cari barang</label>
                            <select id="select-barang" class="js-example-basic-single form-control rounded-pill border-none py-2" style=" box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                                <option selected value="default"> -- pilih barang-- </option>
                                <?php while ($data = mysqli_fetch_assoc($queryAllBarang)) : ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                                <?php
                                endwhile;
                                ?>
                            </select>
                        </div>
                        <div class="d-flex mt-3">
                            <label for="nama" class="form-label py-0 m-0 me-2">Total barang saat ini : </label>
                            <input id="current-qty" type="number" class="form-control" readonly value="" style="width:100px; padding: 0px 0px 0px 10px;">
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class=" me-3 ">
                            <label for="" class="">Jumlah : </label>
                            <input type="number" id="input-qty" min="0" class="form-control" style="width:100px" value="0">
                        </div>
                        <button id="add-barang" class="btn btn-outline-success rounded mt-4" style="height: 40px;"><i class="fa-solid fa-plus"></i> add</button>
                    </div>

                    <div id="alert-barang">

                    </div>
                    <!-- </form> -->
                </div>
                <!-- end add barang -->


            </div>
        </div>
        <div class="mb-4 col-md-7">
            <div class="card border-none" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;">
                <div class="rounded-bottom mx-4  py-3 px-2  text-light" style="background-color: #1a1c2f;">
                    <span class="p-2 rounded-pill flex" style="background-color: #343549;">
                        <i class="fa-solid fa-cart-plus"></i>
                        Detail Barang Masuk</span>
                    <span class="float-end text-small">Current Date : <?= date('Y-m-d'); ?></span>
                </div>
                <div class="card-body px-4">
                    <form action="" method="POST">
                        <div class="row">
                            <input type="hidden" name="edit_id_barang" readonly value="<?= $fetchEdit['id'] ?>">
                            <input type="hidden" name="cart" id="input-cart" readonly>
                            <input type="hidden" name="delete_cart" id="delete-cart" value="">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nama" class="form-label py-0 m-0">Tanggal</label>
                                    <input type="date" value="<?= $fetchEdit['tanggal'] ?>" class="form-control rounded-pill border-none" id="nama" name="tanggal" placeholder="nama" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nama" class="form-label py-0 m-0">Supplier</label>
                                    <!-- <input type="text" class="form-control rounded-pill border-none" id="nama" name="supplier" placeholder="nama" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;"> -->
                                    <select name="supplier" id="select-supplier" class="js-example-basic-single-supplier form-control rounded-pill border-none py-2" style=" box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                                        <?php if ($fetchEdit['nama']) { ?>
                                            <option selected value="<?= $fetchEdit['id'] ?>"><?= $fetchEdit['nama'] ?></option>
                                        <?php } ?>
                                        <option value="default"> -- pilih supplier-- </option>
                                        <?php while ($data = mysqli_fetch_assoc($queryAllSupplier)) : ?>
                                            <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label py-0 m-0">Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" cols="10" rows="2"><?= $fetchEdit['catatan'] ?></textarea>
                        </div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">no</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Merek</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">qty</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="append-array-cart">

                                <!-- data -->

                            </tbody>
                        </table>
                        <button type="submit" name="submit-barang" class="btn btn-primary rounded-pill">update</button>
                        <button class="btn btn-secondary rounded-pill">clear</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $('.js-example-basic-single-supplier').select2();

        let barang = ''

        let cartBarang = []
        let cartDeleteBarang = []

        $.ajax({
            url: "pages/json-data/get_detail_barang_masuk.php?id=" + $('#get-id-from-url').val(),
            type: "GET",
            dataType: 'json',
            ContentType: 'application/json',
            success: (response) => {
                if (response.data != null) {
                    barang = response.data
                    console.log(barang)
                    barang.forEach(e => {
                        cartBarang.push({
                            cart_id: Math.floor((Math.random() * 1000) + 1),
                            transaksi_masuk_id: e.transaksi_masuk_id,
                            barang_id: e.barang_id,
                            nama: e.barang,
                            kategori_nama: e.kategori,
                            merek_nama: e.merek,
                            qty: e.qty,
                        })
                    });

                    $('#input-cart').val(JSON.stringify(cartBarang))
                    printHtml()

                }
            },
            error: (err) => {
                alert('terjadi kesalahan')
            }
        })



        $('.js-example-basic-single').change(function(e) {
            $.ajax({
                url: "pages/json-data/get_barang.php?id=" + $('.js-example-basic-single').val(),
                type: "GET",
                dataType: 'json',
                ContentType: 'application/json',
                success: (response) => {
                    if (response.data != null) {
                        barang = response.data
                        $('#current-qty').val(barang.qty)
                    }
                },
                error: (err) => {
                    alert('terjadi kesalahan')
                }
            })
        })


        // script
        let inputQty = 0
        $('#input-qty').keyup(function(e) {
            inputQty = e.target.value
        })
        $('#input-qty').change(function(e) {
            inputQty = e.target.value
        })

        // add click
        $('#add-barang').click(function() {
            inputQty = $('#input-qty').val();
            let currentQty = $('.js-example-basic-single').val()
            if (inputQty <= 0 || inputQty == 'undefined' || inputQty == null || currentQty == 'default') {
                console.log('fail')
                $('#alert-barang').html(`  
                 <div class="alert p-1 alert-danger mt-3" role="alert">
                    <i class="fa-solid fa-circle-exclamation"></i> Oops! Barang dan jumlah harus diisi...
                </div>`)
            } else {
                $('#alert-barang').html(``) //add barang success
                cartBarang.push({
                    cart_id: Math.floor((Math.random() * 1000) + 1),
                    transaksi_masuk_id: null,
                    barang_id: barang.id,
                    nama: barang.nama,
                    kategori_nama: barang.kategori_nama,
                    merek_nama: barang.merek_nama,
                    qty: $('#input-qty').val(),
                })

                $('#input-cart').val(JSON.stringify(cartBarang))
                $("#select-barang").val('default').change();
                $('#input-qty').val('')
                $('#current-qty').val('')
                printHtml()
            }

            // end add click
        })

        // print Html
        function printHtml() {
            let text = ''
            for (let i = 0; i <= cartBarang.length - 1; i++) {
                text += `<tr style="font-size: 12px;">
                                    <th scope="row">${i + 1}</th>
                                    <td>${cartBarang[i].nama}</td>
                                    <td>${cartBarang[i].merek_nama}</td>
                                    <td>${cartBarang[i].kategori_nama}</td>
                                    <td>${cartBarang[i].qty}</td>
                                    <td>
                                        <a href='#' data-id=${cartBarang[i].cart_id} class="btn btn-delete-table btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>`
            }
            $('#append-array-cart').html(text);
            deleteBarang()
        }

        function deleteBarang() {
            $('.btn-delete-table').click(function(e) {
                e.preventDefault()
                const index = cartBarang.findIndex(x => x.cart_id == $(this).attr('data-id'))
                cartDeleteBarang.push(cartBarang[index]);
                $('#delete-cart').val(JSON.stringify(cartDeleteBarang));
                cartBarang.splice(index, 1);
                $('#input-cart').val(JSON.stringify(cartBarang))
                printHtml()
            })
        }








    });
</script>