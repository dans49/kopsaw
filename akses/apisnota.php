<?php
session_start();

require 'koneksi.php';

$user = $_GET['userid'];

$sql ="SELECT * FROM nota WHERE id_user = '$user' ORDER BY id_nota DESC";
$row = mysqli_query($koneksi, $sql);
$hasil = mysqli_fetch_array($row);

$sql2 ="SELECT penjualan.*,barang.* FROM penjualan
		INNER JOIN barang ON barang.id_barang=penjualan.id_barang
		WHERE penjualan.id_nota = '$hasil[id_nota]'";
$row2 = mysqli_query($koneksi, $sql2);

$nom = 1;
$getjual = "";
while ($value = mysqli_fetch_array($row2)) {
	$getjual .= "<tr>";
	$getjual .= "<td>$nom</td>";
	$getjual .= "<td>$value[nama_barang]</td>";
	$getjual .= "<td>$value[harga_jual]</td>";
	$getjual .= "<td>$value[diskon]</td>";
	$getjual .= "<td>".number_format($value['jumlah_barang'],0,',','.')."</td>";
	$getjual .= "<td>Rp. ".number_format($value['total_penjualan'],0,',','.').",-</td>";
	$getjual .= "</tr>";
	$nom++;
}

$data = array(
			'nota' => $hasil['id_nota'],
			'total' => $hasil['total_transaksi'],
			'bayar' => $hasil['bayar'],
			'kembali' => $hasil['kembalian'],
			'penjualan' => $getjual
		);
echo json_encode($data);