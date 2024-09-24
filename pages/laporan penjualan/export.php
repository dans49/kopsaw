<!DOCTYPE html>
<html>

<head>
    <title>Export Laporan Penjualan</title>
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
    $f_pelanggan = $_GET['f_pelanggan'];

    header("Content-type: application/vnd-ms-excel");
    if ($filter == "") {
        header("Content-Disposition: attachment; filename=Laporan-Nota-Penjualan_" . date("Y-m-d") . ".xls");
    } else {
        header("Content-Disposition: attachment; filename=Laporan-Nota-Penjualan-" . $filter . "_" . date("Y-m-d") . ".xls");
    }


    ?>

    <center>
        <h6>Laporan Penjualan <br /> Periode : <?= ($filter == "") ? "Keseluruhan" : $h_filter; ?></h6>
    </center>

    <table>
        <thead>
            <tr style="background:#DFF0D8;color:#333;">
                <th> No </th>
                <th> Tanggal</th>
                <th> ID Transaksi</th>
                <th> Nama Pelanggan</th>
                <th> Barang</th>
                <th style="text-align:right;"> Harga</th>
                <th style="text-align:right;"> Diskon</th>
                <th style="text-align:right;"> Harga Diskon</th>
                <th style="text-align:right;"> Jumlah</th>
                <th style="text-align:right;"> Total</th>
                <th> PIC</th>
                <th> Kasir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $num = 1;

            if ($h_filter == "" && $f_pelanggan == "") {
                $sql_data_nota = mysqli_query($koneksi, "SELECT * FROM nota
                                    LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
                                    LEFT JOIN user ON user.id_user=nota.id_user
                                    ORDER BY nota.id_nota DESC");
            } else {
                if ($f_pelanggan != "") {
                    $fp = "AND nota.id_pelanggan='$f_pelanggan'";
                }

                $sql_data_nota = mysqli_query($koneksi, "SELECT * FROM nota
                                LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
                                LEFT JOIN user ON user.id_user=nota.id_user
                                WHERE nota.tgl_nota LIKE '$h_filter%' $fp
                                ORDER BY nota.id_nota DESC");
            }
            while ($data_nota = mysqli_fetch_assoc($sql_data_nota)) {
                $sql_barang = mysqli_query($koneksi, "SELECT * FROM penjualan LEFT JOIN barang ON barang.id_barang=penjualan.id_barang WHERE penjualan.id_nota='$data_nota[id_nota]'");
                while ($barang = mysqli_fetch_assoc($sql_barang)) {
            ?>

                    <tr>
                        <td><?= $num++; ?></td>
                        <td><?= date("d-m-Y", strtotime($data_nota['tgl_nota'])) ?></td>
                        <td><?= $barang['id_nota']; ?></td>
                        <td><?= $data_nota['nama_pelanggan']; ?></td>
                        <td><?= $barang['nama_barang']; ?></td>
                        <td style="text-align:right;"><?= $barang['harga_satuan_jual']; ?></td>
                        <td style="text-align:right;"><?= $barang['diskon']; ?></td>
                        <td style="text-align:right;"><?= $barang['harga_satuan_jual'] - $barang['diskon'] ?></td>
                        <td style="text-align:right;"><?= $barang['jumlah_barang']; ?></td>
                        <td style="text-align:right;"><?= $barang['total_penjualan']; ?></td>
                        <td><?= $data_nota['pic']; ?></td>
                        <td><?= $data_nota['nama']; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>

    </table>

</body>

</html>