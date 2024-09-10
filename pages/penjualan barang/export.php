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
                <th style="text-align: center;"> Cash</th>
                <th style="text-align: center;"> Credit</th>
                <th style="text-align: center;"> Total Terjual</th>
                <th style="text-align: center;"> Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;

            $sql_barang = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($barang = mysqli_fetch_assoc($sql_barang)) {

                if ($filter == "") {
                    $cek_barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_barang='$barang[id_barang]'"));
                    $jumlah_terjual = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah_barang) as jml, SUM(total_penjualan) as total FROM penjualan WHERE id_barang='$barang[id_barang]'"));
                    $cash = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_penjualan) as cash FROM penjualan WHERE id_barang='$barang[id_barang]' AND jenis_bayar='cash'"));
                    $credit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_penjualan) as credit FROM penjualan WHERE id_barang='$barang[id_barang]' AND jenis_bayar='credit'"));
                } else {
                    $cek_barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM penjualan LEFT JOIN nota ON nota.id_nota=penjualan.id_nota WHERE penjualan.id_barang='$barang[id_barang]' AND nota.tgl_nota LIKE '$h_filter%'"));
                    $jumlah_terjual = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah_barang) as jml, SUM(total_penjualan) as total FROM penjualan LEFT JOIN nota ON nota.id_nota=penjualan.id_nota WHERE id_barang='$barang[id_barang]' AND nota.tgl_nota LIKE '$h_filter%'"));
                    $cash = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_penjualan) as cash FROM penjualan LEFT JOIN nota ON nota.id_nota=penjualan.id_nota WHERE id_barang='$barang[id_barang]' AND jenis_bayar='cash' AND nota.tgl_nota LIKE '$h_filter%'"));
                    $credit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_penjualan) as credit FROM penjualan LEFT JOIN nota ON nota.id_nota=penjualan.id_nota WHERE id_barang='$barang[id_barang]' AND jenis_bayar='credit' AND nota.tgl_nota LIKE '$h_filter%'"));
                }

                if ($cek_barang != "") {
                    $modal = $cek_barang['harga_satuan_beli'] * $jumlah_terjual['jml'];
                    $keuntungan = $jumlah_terjual['total'] - $modal;
                    $t_modal = $modal + $t_modal;
                    $t_cash = $t_cash + $cash['cash'];
                    $t_credit = $t_credit + $credit['credit'];
                    $t_total = $t_total + $jumlah_terjual['total'];
                    $t_keuntungan = $t_total - $t_modal;
            ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $barang['id_barang'] ?></td>
                        <td><?= $barang['nama_barang'] ?></td>
                        <td style="text-align: right;"><?= $jumlah_terjual['jml']; ?></td>
                        <td style="text-align: right;"><?= $modal; ?></td>
                        <td style="text-align: right;"><?= $cash['cash'] ?></td>
                        <td style="text-align: right;"><?= $credit['credit'] ?></td>
                        <td style="text-align: right;"><?= $jumlah_terjual['total'] ?></td>
                        <td style="text-align: right;"><?= $keuntungan; ?></td>
                    </tr>
            <?php
                }
            }
            ?>


        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align: center;">JUMLAH</th>
                <th style="text-align: right;"><?= $t_modal; ?></th>
                <th style="text-align: right;"><?= $t_cash; ?></th>
                <th style="text-align: right;"><?= $t_credit; ?></th>
                <th style="text-align: right;"><?= $t_total; ?></th>
                <th style="text-align: right;"><?= $t_keuntungan; ?></th>
            </tr>
        </tfoot>
    </table>
</body>

</html>