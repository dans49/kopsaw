<?php
session_start();
require 'koneksi.php';

$user = $_GET['userid'];
$idtemp = $_GET['idt'];

$sql ="SELECT _temp_penjualan.* , barang.id_barang, barang.nama_barang, barang.merk, barang.harga_jual, user.id_user,
        user.nama from _temp_penjualan 
        left join barang on barang.id_barang=_temp_penjualan.id_barang 
        left join user on user.id_user=_temp_penjualan.id_user
        WHERE _temp_penjualan.id_user = '$user' AND _temp_penjualan.id_temp = '$idtemp'";
$row = mysqli_query($koneksi, $sql);
$hasil = mysqli_fetch_array($row);

$data['data'] = $hasil;
// foreach ($hasil as $value) {
// }

echo json_encode($data);