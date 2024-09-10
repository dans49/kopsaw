<?php
function temp_id($koneksi)
{
	$sql = "select max(right(id_temp,3)) as kode from _temp_penjualan where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
	$row = mysqli_query($koneksi, $sql);
    $hasil = mysqli_fetch_array($row);

    if($hasil['kode'] == NULL || $hasil['kode'] == 0){
		$sql2 = "select concat(date_format(now(),'TE%m%Y.'),lpad(count(id_temp)+1,3,0)) as kode from _temp_penjualan where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
		$row2 = mysqli_query($koneksi, $sql2);
		$hasil = mysqli_fetch_array($row2);
		
	} else {
		$sql2 = "select concat(date_format(now(),'TE%m%Y.'),lpad(max(right(id_temp,3))+1,3,0)) as kode from _temp_penjualan where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
		$row2 = mysqli_query($koneksi, $sql2);
		$hasil = mysqli_fetch_array($row2);
	}

	return $hasil['kode'];
}

function getnota($koneksi,$tgl)
{
	$sql = "select max(right(id_nota,4)) as kode from nota where year(tgl_nota)=year('$tgl') and month(tgl_nota)=month('$tgl')";
	$row = mysqli_query($koneksi, $sql);
    $hasil = mysqli_fetch_array($row);

    if($hasil['kode'] == NULL || $hasil['kode'] == 0){
		$sql2 = "select concat(date_format('$tgl','TRX%m%Y.'),lpad(count(id_nota)+1,4,0)) as kode from nota where year(tgl_nota)=year('$tgl') and month(tgl_nota)=month('$tgl')";
		$row2 = mysqli_query($koneksi, $sql2);
		$hasil = mysqli_fetch_array($row2);
		
	} else {
		$sql2 = "select concat(date_format('$tgl','TRX%m%Y.'),lpad(max(right(id_nota,4))+1,4,0)) as kode from nota where year(tgl_nota)=year('$tgl') and month(tgl_nota)=month('$tgl')";
		$row2 = mysqli_query($koneksi, $sql2);
		$hasil = mysqli_fetch_array($row2);
	}

	return $hasil['kode'];
}

function getpenjualan($koneksi)
{
	$sql = "select max(right(id_penjualan,4)) as kode from penjualan where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
	$row = mysqli_query($koneksi, $sql);
    $hasil = mysqli_fetch_array($row);

    if($hasil['kode'] == NULL || $hasil['kode'] == 0){
		$sql2 = "select concat(date_format(now(),'PJ%m%Y.'),lpad(count(id_penjualan)+1,4,0)) as kode from penjualan where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
		$row2 = mysqli_query($koneksi, $sql2);
		$hasil = mysqli_fetch_array($row2);
		
	} else {
		$sql2 = "select concat(date_format(now(),'PJ%m%Y.'),lpad(max(right(id_penjualan,4))+1,4,0)) as kode from penjualan where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
		$row2 = mysqli_query($koneksi, $sql2);
		$hasil = mysqli_fetch_array($row2);
	}

	return $hasil['kode'];
}

// function restok_id($koneksi)
// {
// 	$sql = "select max(right(id_trestok,3)) as kode from _temp_restok where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
// 	$row = $koneksi -> prepare($sql);
//     $row -> execute();
//     $hasil = $row -> fetch();

//     if($hasil['kode'] == NULL || $hasil['kode'] == 0){
// 		$sql2 = "select concat(date_format(now(),'TRS%m%Y.'),lpad(count(id_trestok)+1,3,0)) as kode from _temp_restok where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
// 		$row = $koneksi -> prepare($sql2);
// 		$row -> execute();
// 		$hasil = $row -> fetch();
		
// 	} else {
// 		$sql2 = "select concat(date_format(now(),'TRS%m%Y.'),lpad(max(right(id_trestok,3))+1,3,0)) as kode from _temp_restok where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
// 		$row = $koneksi -> prepare($sql2);
// 		$row -> execute();
// 		$hasil = $row -> fetch();
// 	}

// 	return $hasil['kode'];
// }

// function getstok($koneksi)
// {
// 	$sql = "select max(right(id_getstok,4)) as kode from restok_barang where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
// 	$row = $koneksi -> prepare($sql);
//     $row -> execute();
//     $hasil = $row -> fetch();

//     if($hasil['kode'] == NULL || $hasil['kode'] == 0){
// 		$sql2 = "select concat(date_format(now(),'ST%m%Y.'),lpad(count(id_getstok)+1,4,0)) as kode from restok_barang where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
// 		$row = $koneksi -> prepare($sql2);
// 		$row -> execute();
// 		$hasil = $row -> fetch();
		
// 	} else {
// 		$sql2 = "select concat(date_format(now(),'ST%m%Y.'),lpad(max(right(id_getstok,4))+1,4,0)) as kode from restok_barang where year(waktu_data)=year(now()) and month(waktu_data)=month(now())";
// 		$row = $koneksi -> prepare($sql2);
// 		$row -> execute();
// 		$hasil = $row -> fetch();
// 	}

// 	return $hasil['kode'];
// }

