<?php
// include "../../akses/koneksi.php";
$id = $_GET['id'];

// get tabel barang id_barang
$sql = "SELECT * FROM barang WHERE id_barang = '$id'";
$row = mysqli_query($koneksi, $sql);
$hsl = mysqli_fetch_array($row);

if ($hsl['stok'] > 0) {
    $sqlb = "SELECT * FROM _temp_penjualan WHERE id_barang = '$id'";
    $rowb = mysqli_query($koneksi, $sqlb);
    $hslb = mysqli_fetch_array($rowb);
    
    $id_temp = temp_id($koneksi);
    $kasir =  $_GET['id_kasir'];
    $jumlah = 1;
    $diskon = 0;
    $total = $hsl['harga_jual'];
    $user = $_SESSION['admin'];

    if(mysqli_num_rows($rowb) == 0) {
        $sql1 = "INSERT INTO _temp_penjualan (id_temp,id_barang,id_user,jumlah_barang, diskon,harga_jual,total) VALUES ('$id_temp','$id','$user','$jumlah','$diskon','$total','$total')";
        $row1 = mysqli_query($koneksi, $sql1);
    } 
    elseif(mysqli_num_rows($rowb) > 0) {
        $jmlhsl = $jumlah+$hslb['jumlah_barang'];
        $tot2 = ($jumlah+$hslb['jumlah_barang']) * ($hsl['harga_jual']-$diskon);
        
        $sql2 = "UPDATE _temp_penjualan SET jumlah_barang='$jmlhsl',diskon='$diskon',total='$tot2' WHERE id_barang='$id'";
        $row2 = mysqli_query($koneksi, $sql2);
    }

    echo '<script>window.location="index.php?page=kasir&success=tambah-data"</script>';
} else {
    echo '<script>alert("Stok Barang Anda Telah Habis !");
			window.location="index.php?page=kasir#keranjang"</script>';
}