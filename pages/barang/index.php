<?php
include './koneksi.php';

$query = mysqli_query($conn, "SELECT 
barang.id as id,
barang.nama as nama,
merek.nama as merek,
kategori.nama as kategori,
rak.nama as rak,
qty
FROM barang 
INNER JOIN rak
ON barang.rak_id = rak.id
INNER JOIN kategori
ON barang.kategori_id = kategori.id
INNER JOIN merek 
ON barang.merek_id = merek.id");
?>

<div class="container-fluid px-4 ">
    <ol class="breadcrumb pt-2">
        <li class="breadcrumb-item ">Data Barang</li>
        <li class="breadcrumb-item active">list Barang</li>
    </ol>
    <div class="mb-4">
        <div class="card-header clearfix mb-3" style="border-radius: 20px ;background-color: white; border:0px;">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span class="ms-2 fw-bolder"> Data Barang</span>

            <!-- Button trigger modal -->
            <a href="index.php?data-barang=add" class="btn btn-sm btn-primary float-end rounded-pill">
                tambah data <i class="fa-solid fa-boxes-stacked"></i>
            </a>
        </div>
        <div class="p-3  bg-white " style="border-radius: 20px; ">
            <table id="datatablesSimple" style="border-color: white;">
                <thead class="">
                    <tr>
                        <th>no</th>
                        <th>Nama Barang</th>
                        <th>Merek</th>
                        <th>Kategori</th>
                        <th>Rak</th>
                        <th>Qty</th>
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($query)) :
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['merek'] ?></td>
                            <td><?= $data['kategori'] ?></td>
                            <td><?= $data['rak'] ?></td>
                            <td><?= $data['qty'] ?></td>
                            <td class="text-center">
                                <a href="index.php?data-barang=update&id=<?= $data['id']; ?>" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="index.php?data-barang=delete&id=<?= $data['id']; ?>" onclick="confirmDelete(event)" class="btn btn-sm btn-danger" id="delete-alert">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
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


<script>
    function confirmDelete(event) {
        event.preventDefault()
        const linkHref = event.currentTarget.getAttribute('href')
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "apakah anda yakin ingin menghapus?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = linkHref
            }
        })
    }
</script>