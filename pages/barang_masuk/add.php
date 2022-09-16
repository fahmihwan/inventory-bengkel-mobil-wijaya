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


// if (isset($_POST['add-barang'])) {
//     $brg = $_POST['select-barang'];
//     $data = json_decode($brg, true);
//     var_dump($data['nama']);
//     var_dump($data['id']);
//     die;
// }

?>

<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">montir</li>
        <li class="breadcrumb-item"><a href="index.php?menu=montir">List Data</a></li>
        <li class="breadcrumb-item active">Input Barang Masuk</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-cart-plus"></i>
            <span class="ms-2 fw-bolder"> Form Barang Masuk</span>
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
                    <form action="" class="">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nama" class="form-label py-0 m-0">Tanggal</label>
                                    <input type="date" class="form-control rounded-pill border-none" id="nama" name="nama" placeholder="nama" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nama" class="form-label py-0 m-0">Supplier</label>
                                    <input type="text" class="form-control rounded-pill border-none" id="nama" name="nama" placeholder="nama" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label py-0 m-0">Catatan</label>
                            <!-- <input type="text" class="form-control rounded-pill border-none" id="alamat" name="alamat" placeholder="alamat" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;"> -->
                            <textarea class="form-control" name="" id="" cols="10" rows="2"></textarea>
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
                            <tbody>

                                <tr style="font-size: 12px;">
                                    <th scope="row">1</th>
                                    <td>ssd</td>
                                    <td>ssd</td>
                                    <td>ssd</td>
                                    <td>ssd</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <button class="btn btn-primary rounded-pill">submit</button>
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
        let barang = ''

        let cartBarang = []
        $('.js-example-basic-single').change(function(e) {
            $.ajax({
                url: "pages/json-data/get_barang.php?id=" + $('.js-example-basic-single').val(),
                type: "GET",
                dataType: 'json',
                ContentType: 'application/json',
                success: (response) => {
                    // $('#current-qty').val = barang.qty;
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

        let inputQty = 0
        $('#input-qty').keyup(function(e) {
            inputQty = e.target.value
        })

        $('#input-qty').change(function(e) {
            inputQty = e.target.value
        })
        // console.log($('#input-qty').val())


        $('#add-barang').click(function() {
            // console.log($('.js-example-basic-single'))
            if (inputQty <= 0 || inputQty == 'undefined' || inputQty == null) {
                console.log('fail')
            } else {
                cartBarang.push({
                    id: barang.id,
                    kategori_id: barang.nama,
                    kategori_nama: barang.kategori_nama,
                    merek_id: barang.merek_id,
                    merek_nama: barang.merek_nama,
                    nama: barang.nama,
                    qty: barang.qty,
                    rak_id: barang.rak_id,
                    rak_nama: barang.rak_nama
                })
                console.log(cartBarang)
                // console.log($('#select-barang').val())
            }

            $("#select-barang").val('default').change();
            $('#current-qty').val('')
        })





    });
</script>