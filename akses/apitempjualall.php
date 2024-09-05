<?php
session_start();
require 'koneksi.php';

$user = $_GET['userid'];

$sql2 ="SELECT sum(total), sum(diskon) from _temp_penjualan WHERE _temp_penjualan.id_user = '$user'";
$row2 = mysqli_query($koneksi, $sql2);
$hasil2 = mysqli_fetch_array($row2);

// foreach ($hasil as $value) {
    $data['data'] = $hasil2;
// }

echo json_encode($data);