<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Export Data Ke Excel Dengan PHP - www.malasngoding.com</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 3px 8px;

        }

        table,
        th,
        td {
            border: 0.5px solid black;
            border-collapse: collapse;
        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    include "../../akses/koneksi.php";
    $filter = $_GET['filter'];
    $h_filter = $_GET['h_filter'];

    header("Content-type: application/vnd-ms-excel");
    if ($filter == "") {
        header("Content-Disposition: attachment; filename=Laporan-Penjualan-Barang_" . date("Y-m-d") . ".xls");
    } else {
        header("Content-Disposition: attachment; filename=Laporan-Penjualan-Barang_" . $filter . "_" . date("Y-m-d") . ".xls");
    }


    ?>

    <center>
        <h6>Laporan Penjualan Barang <br /> Periode : <?= ($filter == "") ? "Keseluruhan" : $h_filter; ?></h6>
    </center>

    <table>
        <thead>
            <tr style="background:#DFF0D8;color:#333;">
                <th style="text-align: center;"> No</th>
                <th style="text-align: center;"> ID Barang</th>
                <th style="text-align: center;"> Nama Barang</th>
                <th style="text-align: center;"> Terjual</th>
                <th style="text-align: center;"> Modal</th>
                <th style="text-align: center;"> Total Terjual</th>
                <th style="text-align: center;"> Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;


            if (empty($filter)) {
                $query = mysqli_query($koneksi, "SELECT 
                                    pj.id_penjualan,
                                    pj.id_barang,
                                    pj.id_nota,
                                    pj.jumlah_barang,
                                    pj.harga_satuan_beli,
                                    pj.harga_satuan_jual,
                                    pj.total_penjualan,
                                    pj.jenis_bayar,
                                    b.nama_barang,
                                    n.tgl_nota,
                                    SUM(pj.harga_satuan_beli * pj.jumlah_barang) AS total_modal,
                                    SUM(pj.total_penjualan) AS total_penjualan,
                                    (SUM(pj.total_penjualan) - SUM(pj.harga_satuan_beli * pj.jumlah_barang)) AS keuntungan,
                                    SUM(pj.jumlah_barang) AS total_jumlah_terjual
                                    FROM penjualan pj
                                    JOIN barang b ON pj.id_barang = b.id_barang
                                    JOIN nota n ON pj.id_nota = n.id_nota
                                    GROUP BY pj.id_barang  
                                    ORDER BY `b`.`nama_barang` ASC");
            } else {
                $query = mysqli_query($koneksi, "SELECT 
                                    pj.id_penjualan,
                                    pj.id_barang,
                                    pj.id_nota,
                                    pj.jumlah_barang,
                                    pj.harga_satuan_beli,
                                    pj.harga_satuan_jual,
                                    pj.total_penjualan,
                                    pj.jenis_bayar,
                                    b.nama_barang,
                                    n.tgl_nota,
                                    SUM(pj.harga_satuan_beli * pj.jumlah_barang) AS total_modal,
                                    SUM(pj.total_penjualan) AS total_penjualan,
                                    (SUM(pj.total_penjualan) - SUM(pj.harga_satuan_beli * pj.jumlah_barang)) AS keuntungan,
                                    SUM(pj.jumlah_barang) AS total_jumlah_terjual
                                    FROM penjualan pj
                                    JOIN barang b ON pj.id_barang = b.id_barang
                                    JOIN nota n ON pj.id_nota = n.id_nota
                                    WHERE n.tgl_nota LIKE '$h_filter%'
                                    GROUP BY pj.id_barang  
                                    ORDER BY `b`.`nama_barang` ASC");
            }
            while ($barang = mysqli_fetch_assoc($query)) {
                $t_modal = $barang['total_modal'] + $t_modal;
                $t_total = $barang['total_penjualan'] + $t_total;
                $t_keuntungan = $barang['keuntungan'] + $t_keuntungan;
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $barang['id_barang'] ?></td>
                    <td><?= $barang['nama_barang'] ?></td>
                    <td style="text-align: right;"><?= $barang['total_jumlah_terjual']; ?></td>
                    <td style="text-align: right;"><?= $barang['total_modal']; ?></td>
                    <td style="text-align: right;"><?= $barang['total_penjualan'] ?></td>
                    <td style="text-align: right;"><?= $barang['keuntungan']; ?></td>
                </tr>
            <?php
            }
            ?>


        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align: center;">JUMLAH</th>
                <th style="text-align: right;"><?= $t_modal; ?></th>
                <th style="text-align: right;"><?= $t_total; ?></th>
                <th style="text-align: right;"><?= $t_keuntungan; ?></th>
            </tr>
        </tfoot>
    </table>
</body>

</html>