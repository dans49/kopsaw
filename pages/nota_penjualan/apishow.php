<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../../akses/koneksi.php';

$id = $_GET['id'];

$query = "
    SELECT 
        nota.*, 
        pelanggan.nama_pelanggan, 
        GROUP_CONCAT(barang.nama_barang SEPARATOR ', ') AS nama_barang,
        GROUP_CONCAT(penjualan.jumlah_barang SEPARATOR ', ') AS jumlah_barang,
        SUM(pembayaran.bayar) AS total_pembayaran,
        user.nama
    FROM 
        nota 
    LEFT JOIN pelanggan ON nota.id_pelanggan = pelanggan.id_pelanggan
    LEFT JOIN penjualan ON nota.id_nota = penjualan.id_nota
    LEFT JOIN barang ON penjualan.id_barang = barang.id_barang
    LEFT JOIN pembayaran ON nota.id_nota = pembayaran.id_nota
    LEFT JOIN user ON nota.id_user = user.id_user
    WHERE 
        nota.id_nota = '$id'
    GROUP BY 
        nota.id_nota, 
        pelanggan.nama_pelanggan
";

$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    // Fetch detail penjualan separately
    $penjualan_query = "SELECT barang.nama_barang, penjualan.jumlah_barang, penjualan.diskon, penjualan.total_penjualan 
                        FROM penjualan 
                        LEFT JOIN barang ON penjualan.id_barang = barang.id_barang
                        WHERE penjualan.id_nota = '$id'";
    $penjualan_result = mysqli_query($koneksi, $penjualan_query);
    $penjualan_data = [];
    while ($row = mysqli_fetch_assoc($penjualan_result)) {
        $penjualan_data[] = $row;
    }

    $data['penjualan'] = $penjualan_data;

    // Fetch total pembayaran
    $pembayaran_query = "SELECT SUM(bayar) AS tbayar FROM pembayaran WHERE id_nota='$id'";
    $pembayaran_result = mysqli_query($koneksi, $pembayaran_query);
    $pembayaran_data = mysqli_fetch_assoc($pembayaran_result);
    $data['sisa'] = $data['total_transaksi'] - $pembayaran_data['tbayar'];
    $data['tbayar'] = $pembayaran_data['tbayar'];

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Data not found']);
}
