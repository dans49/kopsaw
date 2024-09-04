<?php
session_start();
require 'koneksi.php';

$pelanggan = $_GET['idpil'];

$sql2 ="SELECT * from ksw_pelanggan WHERE id_pelanggan = '$pelanggan'";
$row2 = mysqli_query($koneksi, $sql2);
$hasil = mysqli_fetch_array($row2);

$data['status'] = $hasil['statusdata'];

echo json_encode($data);