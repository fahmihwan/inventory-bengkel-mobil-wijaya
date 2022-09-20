<div class="container-fluid px-4">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item  active"> Dashboard</li>
        <!-- <li class="breadcrumb-item active">list Dashboard</li> -->
    </ol>

    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-box"></i>
            <span class="ms-2 fw-bolder"> Data Dashboard</span>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary float-end rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                tambah data <i class="fa-solid fa-box"></i>
            </button>
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
                        <p class="py-0 m-0 fw-bold">10</p>
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
                        <p class="py-0 m-0 fw-bold">10</p>
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
                        <p class="py-0 m-0 fw-bold">10</p>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <div class="row mt-5">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Barang Masuk
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Stok
                </div>
                <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>






</div>