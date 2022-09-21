<?php

include './koneksi.php';

$id = $_GET['id'];

$selectBarangKeluar = mysqli_query($conn, "SELECT * FROM transaksi_barang_keluar WHERE barang_keluar_id='$id'");

if (mysqli_num_rows($selectBarangKeluar) == 0) {
    mysqli_query($conn, "DELETE FROM barang_keluar WHERE id='$id'");
    echo "<script>
    window.location.href ='index.php?menu=barang-keluar';
   </script>";
}


try {
    // Matikan autocommit 
    mysqli_autocommit($conn, FALSE);

    while ($fetchBarangMasuk = mysqli_fetch_assoc($selectBarangKeluar)) {
        $qty = $fetchBarangMasuk['qty'];
        $barang_id = $fetchBarangMasuk['barang_id'];

        // query Qty +
        $queryQty = mysqli_query($conn, "SELECT qty FROM barang WHERE id='$barang_id'");
        $currentQty = mysqli_fetch_assoc($queryQty)['qty'];

        $currentQty += $qty;

        // update qty barang
        mysqli_query($conn, "UPDATE barang SET qty='$currentQty' WHERE id='$barang_id'");

        // delete transaksi & barang 
        mysqli_query($conn, "DELETE FROM transaksi_barang_keluar WHERE barang_keluar_id='$id'");
        mysqli_query($conn, "DELETE FROM barang_keluar WHERE id='$id'");
    }
    mysqli_query($conn, "UPDATE barang SET qty='$currentQty' WHERE id='$barang_id'");

    mysqli_commit($conn);
    echo "<script>
     window.location.href ='index.php?menu=barang-keluar';
    </script>";
} catch (\Throwable $e) {
    mysqli_rollback($conn);
    throw $e;
}
