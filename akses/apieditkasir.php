<?php
session_start();
require 'koneksi.php';

$id = htmlentities($_POST['id']);
$id_barang = htmlentities($_POST['id_barang']);
$jumlah = htmlentities($_POST['jumlah']);
$diskon = htmlentities($_POST['diskon']);
$harjul = htmlentities($_POST['harjul']);

$sql_tampil = "select *from barang where barang.id_barang= '$id_barang'";
$row_tampil = mysqli_query($koneksi, $sql_tampil);
$hasil = mysqli_fetch_array($row_tampil);

if ($hasil['stok'] > $jumlah) {
    $jual = $harjul;
    $total = ($jual-$diskon) * $jumlah;
    $sql1 = "UPDATE _temp_penjualan SET jumlah_barang='$jumlah', diskon='$diskon', harga_jual='$jual', total='$total' WHERE id_temp='$id'";
    $row1 = mysqli_query($koneksi, $sql1);
    // echo '<script>window.location="../../index.php?page=jual#keranjang"</script>';
    echo "1";
} else {
//        echo '<script>alert("Keranjang Melebihi Stok Barang Anda !");
			// window.location="../../index.php?page=jual#keranjang"</script>';
    echo "0";
}