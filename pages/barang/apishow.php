<?php
require_once '../../akses/koneksi.php';
$id = $_GET['idbarang'];
$data = array();
$getq = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'"));

$data = array(
	'idbarang' 		=> $getq['id_barang'],
	'nama_barang' 	=> $getq['nama_barang'],
	'stok' 			=> $getq['stok'],
	'harga_beli' 	=> $getq['harga_beli'],
	'harga_jual' 	=> $getq['harga_jual'],
	'id_satuan' 	=> $getq['id_satuan'],
);

echo json_encode($data, 200);
