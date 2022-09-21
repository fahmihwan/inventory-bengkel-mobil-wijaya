<?php

include './koneksi.php';

$id = $_GET['id'];

$selectBarangMasuk = mysqli_query($conn, "SELECT * FROM transaksi_barang_masuk WHERE barang_masuk_id='$id'");

if (mysqli_num_rows($selectBarangMasuk) == 0) {
    mysqli_query($conn, "DELETE FROM barang_masuk WHERE id='$id'");
    echo "<script>
    window.location.href ='index.php?menu=barang-masuk';
   </script>";
}


try {
    // Matikan autocommit 
    mysqli_autocommit($conn, FALSE);

    while ($fetchBarangMasuk = mysqli_fetch_assoc($selectBarangMasuk)) {
        $qty = $fetchBarangMasuk['qty'];
        $barang_id = $fetchBarangMasuk['barang_id'];

        //update stok barang
        $queryQtyBarang = mysqli_query($conn, "SELECT qty FROM barang WHERE id='$barang_id'");
        $currentQty = mysqli_fetch_array($queryQtyBarang)['qty'];
        $currentQty -= $qty;

        if ($currentQty <= 0) {
            echo "
            <script>
            alert('gagal, stok tidak cukup ')
            </script>
            ";
            throw new Exception('File could not be found');
        }
        // update
        mysqli_query($conn, "UPDATE barang SET qty='$currentQty' WHERE id='$barang_id'");

        // delete transaksi & barang 
        mysqli_query($conn, "DELETE FROM transaksi_barang_masuk WHERE barang_masuk_id='$id'");
        mysqli_query($conn, "DELETE FROM barang_masuk WHERE id='$id'");
    }

    mysqli_commit($conn);
    echo "<script>
     window.location.href ='index.php?menu=barang-masuk';
    </script>";
} catch (\Throwable $e) {
    mysqli_rollback($conn);
    throw $e;
}
