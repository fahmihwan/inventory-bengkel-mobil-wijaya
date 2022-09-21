<?php
include './koneksi.php';

$sql = "SELECT barang.id as id, barang.nama as nama,  merek.nama as merek, kategori.nama as kategori, rak.nama as rak,qty
FROM barang
INNER JOIN merek
ON barang.merek_id = merek.id
INNER JOIN kategori
ON barang.kategori_id = kategori.id
INNER JOIN rak
ON barang.rak_id = rak.id";

$queryAllBarang = mysqli_query($conn, $sql);
$queryAllSupplier = mysqli_query($conn, "SELECT * FROM montir");

// function membuat nomer referensi
function create_no_referens($select_kode_ref)
{
    if ($select_kode_ref == null) {
        $nota = "OUT" . date('Ymd') . "001";
    } else if (substr($select_kode_ref, 9, 2) != date('d')) {
        $nota = "OUT" . date('Ymd') . "001";
    } else {
        $cut = (int)substr($select_kode_ref, 11, 3);
        $number = str_pad($cut + 1, 3, "0", STR_PAD_LEFT);;
        $nota = "OUT" . date('Ymd') . $number;
    }
    return $nota;
}

if (isset($_POST['submit-barang'])) {

    // get value from input user
    $cart = json_decode($_POST['cart'], true);
    $tanggal = $_POST['tanggal'];
    $montir = $_POST['montir'];
    $catatan = $_POST['catatan'];


    try {
        // Matikan autocommit 
        mysqli_autocommit($conn, FALSE);

        // get no referensi & create no referensi using function and return $get_no_referensi
        $kode_referensi = mysqli_query($conn, "SELECT kode_referensi FROM barang_keluar ORDER BY kode_referensi DESC LIMIT 1");
        $select_kode_referensi = mysqli_fetch_assoc($kode_referensi)['kode_referensi'];
        $get_kode_referensi = create_no_referens($select_kode_referensi);

        // // query insert barang
        mysqli_query($conn, "INSERT INTO barang_keluar (kode_referensi, montir_id, tanggal, catatan) VALUES ('$get_kode_referensi','$montir','$tanggal','$catatan')");

        // // query insert many 
        $insertId =  mysqli_query($conn, "SELECT id FROM barang_keluar ORDER BY id DESC LIMIT 1");
        $get_insertId = mysqli_fetch_assoc($insertId)['id'];

        foreach ($cart as $c) {
            $barang_id = $c['barang_id'];
            $qty = $c['qty'];
            mysqli_query($conn, "INSERT INTO transaksi_barang_keluar (barang_keluar_id, barang_id, qty) VALUES ('$get_insertId','$barang_id','$qty')");

            //update stok barang
            $queryQtyBarang = mysqli_query($conn, "SELECT qty FROM barang WHERE id='$barang_id'");
            $currentQty = mysqli_fetch_array($queryQtyBarang)['qty'];
            $currentQty -= $qty;
            if ($currentQty <= 0) {
                echo "
                <script>
                alert('gagal, stok barang habis')
                window.location.href='index.php?barang-keluar=add';
                </script>
                ";
                throw new Exception('File could not be found');
            }
            mysqli_query($conn, "UPDATE barang SET qty='$currentQty' WHERE id='$barang_id'");
        }
        echo "<script>
        window.location.href ='index.php?menu=barang-keluar';
       </script>";

        mysqli_commit($conn);
    } catch (\Throwable $e) {
        mysqli_rollback($conn);
        throw $e;
    }
}

?>

<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">Barang Keluar</li>
        <li class="breadcrumb-item"><a href="index.php?menu=barang-keluar">List Data</a></li>
        <li class="breadcrumb-item active">Input Barang Keluar</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-cart-plus"></i>
            <span class="ms-2 fw-bolder"> Form Barang Keluar</span>
            <a href="index.php?menu=barnag-keluar" class="btn btn-sm btn-primary float-end rounded-pill ">
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
                        Detail Barang Keluar</span>
                    <span class="float-end text-small">Current Date : <?= date('Y-m-d'); ?></span>
                </div>
                <div class="card-body px-4">
                    <form action="" method="POST">
                        <div class="row">

                            <input type="hidden" name="cart" id="input-cart" readonly>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="nama" class="form-label py-0 m-0">Tanggal</label>
                                    <input type="date" class="form-control rounded-pill border-none" id="nama" name="tanggal" placeholder="nama" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nama" class="form-label py-0 m-0">montir</label>
                                    <!-- <input type="text" class="form-control rounded-pill border-none" id="nama" name="supplier" placeholder="nama" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;"> -->
                                    <select name="montir" id="select-supplier" class="js-example-basic-single-supplier form-control rounded-pill border-none py-2" style=" box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                                        <option selected value="default"> -- pilih montir-- </option>
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
                            <textarea class="form-control" name="catatan" id="catatan" cols="10" rows="2"></textarea>
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

                                <!-- <tr style="font-size: 12px;">
                                    <th scope="row">1</th>
                                    <td>ssd</td>
                                    <td>ssd</td>
                                    <td>ssd</td>
                                    <td>ssd</td>
                                    <td>
                                        <button class="btn btn-delete-table  btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr> -->

                            </tbody>
                        </table>
                        <button type="submit" name="submit-barang" class="btn btn-primary rounded-pill">submit</button>
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
                console.log(index)
                cartBarang.splice(index, 1);
                printHtml()
            })
        }








    });
</script>