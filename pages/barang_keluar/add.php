<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">montir</li>
        <li class="breadcrumb-item"><a href="index.php?menu=barang-keluar">List Data</a></li>
        <li class="breadcrumb-item active">Input Barang Keluar</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-cart-plus"></i>
            <span class="ms-2 fw-bolder"> Form Barang Keluar</span>
            <a href="index.php?menu=barang-keluar" class="btn btn-sm btn-primary float-end rounded-pill ">
                <i class="fa-solid fa-arrow-left"></i> kembali
            </a>
        </div>
    </div>
    <div class="row ">
        <div class="mb-4 col-md-6">
            <div class="card border-none" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;">
                <div class="rounded-bottom mx-4  py-3 px-2  text-light" style="background-color: #1a1c2f;">
                    <span class="p-2 rounded-pill flex" style="background-color: #343549;"> <i class="fa-solid fa-lock"></i> Barang</span>
                </div>
                <div class="card-body px-4">
                    <form action="" class="">
                        <div class="mb-3 clearfix">
                            <div class="float-start" style="width:86%;">
                                <label for="nama" class="form-label py-0 m-0">cari barang</label>
                                <input type="text" class="form-control rounded-pill border-none " id="nama" name="nama" placeholder="nama" required style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;">
                            </div>

                            <div class="float-end text-center">
                                <label for="nama" class="form-label py-0 m-0 ">qty</label>
                                <input type="text" class="form-control  " style="width:40px" disabled>
                            </div>
                        </div>

                        <div class="clear-fix float-end ">
                            <div class="float-start me-2">
                                <label for="" class="float-start me-2 mt-2">Jumlah : </label>
                                <input type="number" class="form-control" style="width:100px">
                            </div>
                            <button class="btn btn-outline-success rounded-pill "><i class="fa-solid fa-plus"></i> add</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="mb-4 col-md-6">
            <div class="card border-none" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;">
                <div class="rounded-bottom mx-4  py-3 px-2  text-light" style="background-color: #1a1c2f;">
                    <span class="p-2 rounded-pill flex" style="background-color: #343549;">
                        <i class="fa-solid fa-cart-plus"></i>
                        Detail Barang Keluar</span>
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
                                    <label for="nama" class="form-label py-0 m-0">Picker</label>
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
                                    <th scope="col">qty</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
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