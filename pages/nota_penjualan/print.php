<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Nota Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h6 {
            font-size: 1.25rem;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-info b {
            font-size: 1.1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table tfoot th {
            text-align: right;
        }

        table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        table .text-right {
            text-align: right;
        }

        .no-border td {
            border: none !important;
        }

        .footer {
            text-align: right;
            margin-top: 12px;
        }

        .footer span {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .btn-print {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
        }

        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <?php
    include "../../akses/koneksi.php";
    $id_nota = $_GET['id_nota'];

    $data_nota = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM nota
                                    LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
                                    LEFT JOIN user ON user.id_user=nota.id_user
                                    WHERE nota.id_nota='$id_nota'"));

    $cek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(bayar) as t_bayar FROM pembayaran WHERE id_nota='$data_nota[id_nota]'"));
    $piutang = $data_nota['total_transaksi'] - $cek['t_bayar'];
    ?>

    <div class="container">
        <!-- <h6>Print Nota Penjualan</h6> -->

        <div class="company-info">
            <b>KPRI Sawangan</b><br>
            <b>Bappelitbangda Kab. Tasikmalaya</b><br>
            <span>Tanggal: <?= date("j F Y", strtotime($data_nota['tgl_nota'])); ?></span>
        </div>

        <!-- Tabel Transaksi -->
        <table class="no-border">
            <tr>
                <td>TRX</td>
                <td>: <?= $data_nota['id_nota']; ?></td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>: <?= $data_nota['nama']; ?></td>
            </tr>
        </table>

        <!-- Tabel Barang -->
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Barang</th>
                    <th class="text-right">Diskon</th>
                    <th class="text-right">Jumlah</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;

                $cek_pembayaran = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(bayar) as tbayar FROM pembayaran WHERE id_nota='$data_nota[id_nota]'"));
                $sisa = $data_nota['total_transaksi'] - $cek_pembayaran['tbayar'];

                $sql_barang = mysqli_query($koneksi, "SELECT * FROM penjualan 
                            LEFT JOIN barang ON barang.id_barang=penjualan.id_barang
                            WHERE id_nota='$data_nota[id_nota]'");
                while ($barang = mysqli_fetch_assoc($sql_barang)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $barang['nama_barang']; ?></td>
                        <td class="text-right"><?= ($barang['diskon'] == 0) ? 0 : number_format($barang['diskon']); ?></td>
                        <td class="text-right"><?= ($barang['jumlah_barang'] == 0) ? 0 : number_format($barang['jumlah_barang']); ?></td>
                        <td class="text-right"><?= ($barang['total_penjualan'] == 0) ? 0 : number_format($barang['total_penjualan']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total :</th>
                    <th><?= number_format($data_nota['total_transaksi']); ?></th>
                </tr>
                <?php if ($piutang > 0) { ?>
                    <tr>
                        <th colspan="4">Bayar :</th>
                        <th><?= number_format($data_nota['tbayar']); ?></th>
                    </tr>
                    <tr>
                        <th colspan="4">Piutang :</th>
                        <th><?= number_format($piutang); ?></th>
                    </tr>
                <?php } ?>
            </tfoot>
        </table>
    </div>

    <a href="#" onclick="window.print();" class="btn-print">Print</a>

</body>

</html>