<?php
session_start();
require 'koneksi.php';

$year = $_GET['tahun'] ?? date('Y');

$bln = ['01','02','03','04','05','06','07','08','09','10','11','12'];

for ($i=0; $i < count($bln); $i++) { 

    $sql2 ="SELECT sum(penjualan.total_penjualan) as jml, nota.* from nota
            INNER JOIN penjualan ON penjualan.id_nota=nota.id_nota
            WHERE year(nota.tgl_nota) = '$year' AND month(nota.tgl_nota)= '$bln[$i]'";
    $row = mysqli_query($koneksi, $sql2);
    $hasil = mysqli_fetch_assoc($row);

    $data[] = (int) $hasil['jml'];
}

echo json_encode($data);