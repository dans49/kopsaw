<?php
session_start();
require 'koneksi.php';

$year = $_GET['tahun'] ?? date('Y');

$bln = ['01','02','03','04','05','06','07','08','09','10','11','12'];

for ($i=0; $i < count($bln); $i++) { 

    $sql2 ="SELECT sum(total) as jml from penjualan 
            WHERE year(penjualan.waktu_data) = '$year' AND month(penjualan.waktu_data)= '$bln[$i]'";
    $row = mysqli_query($db, $sql2);
    $hasil = mysqli_fetch_assoc($row);

    $data[] = $hasil['jml'];
}

echo json_encode($data);