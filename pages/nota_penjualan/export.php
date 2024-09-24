<!DOCTYPE html>
<html>

<head>
    <title>Export Nota Penjualan</title>
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
    $f_status = $_GET['f_status'];

    header("Content-type: application/vnd-ms-excel");
    if ($filter == "") {
        header("Content-Disposition: attachment; filename=Laporan-Nota-Penjualan_" . date("Y-m-d") . ".xls");
    } else {
        header("Content-Disposition: attachment; filename=Laporan-Nota-Penjualan-" . $filter . "_" . date("Y-m-d") . ".xls");
    }


    ?>

    <center>
        <h6>Laporan Nota Penjualan <br /> Periode : <?= ($filter == "") ? "Keseluruhan" : $h_filter; ?></h6>
    </center>

    <table>
        <thead>
            <tr style="background:#DFF0D8;color:#333;">
                <th> No </th>
                <th> ID Transaksi</th>
                <th> Nama Pelanggan</th>
                <th> Tanggal</th>
                <th style="text-align: right;"> Total Belanja</th>
                <th style="text-align: right;"> Pembayaran</th>
                <th style="text-align: right;"> Piutang</th>
                <th> PIC</th>
                <th> Kasir</th>
                <th> Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;

            if ($h_filter == "" && $f_pelanggan == "" && $f_status == "") {
                $sql_data_nota = mysqli_query($koneksi, "SELECT * FROM nota
                    LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
                    LEFT JOIN user ON user.id_user=nota.id_user
                    ORDER BY nota.id_nota DESC");
            } else {
                if ($f_pelanggan != "") {
                    $fp = "AND nota.id_pelanggan='$f_pelanggan'";
                }
                if ($f_status != "") {
                    $fs = "AND nota.status_nota='$f_status'";
                }

                $fs =
                    $sql_data_nota = mysqli_query($koneksi, "SELECT * FROM nota
                    LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
                    LEFT JOIN user ON user.id_user=nota.id_user
                    WHERE nota.tgl_nota LIKE '$h_filter%' $fp $fs
                    ORDER BY nota.id_nota DESC");
            }
            while ($data_nota = mysqli_fetch_assoc($sql_data_nota)) {
                $cek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(bayar) as t_bayar FROM pembayaran WHERE id_nota='$data_nota[id_nota]'"));
                $piutang = $data_nota['total_transaksi'] - $cek['t_bayar'];

                $exp = explode('.', $data_nota['id_nota']);
                $satukan = '';
                for ($i = 0; $i < count($exp); $i++) {
                    $id .= $exp[$i];
                }
            ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data_nota['id_nota']; ?></td>
                    <td><?= $data_nota['nama_pelanggan']; ?></td>
                    <td><?= date("d-m-Y", strtotime($data_nota['tgl_nota'])); ?></td>
                    <td style="text-align: right;"><?= $data_nota['total_transaksi']; ?></td>
                    <td style="text-align: right;"><?= $cek['t_bayar']; ?></td>
                    <td style="text-align: right;"><?= $piutang; ?></td>
                    <td><?= $data_nota['pic']; ?></td>
                    <td><?= $data_nota['nama']; ?></td>
                    <td align="center">
                        <?php if ($data_nota['total_transaksi'] <= $cek['t_bayar']) { ?>
                            <label for="">Lunas</label>
                        <?php } else { ?>
                            <label for="">Piutang</label>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>

</body>

</html>