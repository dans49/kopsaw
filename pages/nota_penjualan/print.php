<!DOCTYPE html>
<html>

<head>
    <title>Print Nota</title>
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
    $id_nota = $_GET['id_nota'];

    $data_nota = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM nota
                                    LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
                                    LEFT JOIN user ON user.id_user=nota.id_user
                                    WHERE nota.id_nota='$id_nota'"));

    $cek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(bayar) as t_bayar FROM pembayaran WHERE id_nota='$data_nota[id_nota]'"));
    $piutang = $data_nota['total_transaksi'] - $cek['t_bayar'];
    ?>

    <center>
        <h6>Print Nota Penjualan </h6>
    </center>

    <div class="modal-body">
        <center>KPRI Sawangan</center>
        <center>Bappelitbangda Kab. Tasikmalaya</center>
        <center>Tanggal : <?= date("j F Y", strtotime($data_nota['tgl_nota'])); ?></center>
        <table width="100%" class="mt-2 text-left">
            <tr>
                <td>TRX</td>
                <td>: <span> <?= $data_nota['id_nota']; ?></span></td>
            </tr>
            <tr>
                <td>Kasir </td>
                <td>: <?= $data_nota['nama']; ?></td>
            </tr>
        </table>
        <table class="table bordered mt-2 text-left">
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
                    <th colspan="4 text-center">TOTAL</th>
                    <th class="text-right"><?= number_format($data_nota['total_transaksi']); ?></th>
                </tr>
                <?php if ($piutang > 0) { ?>
                    <tr>
                        <th colspan="4 text-center">Bayar</th>
                        <th class="text-right"><?= number_format($cek_pembayaran['tbayar']); ?></th>
                    </tr>
                    <tr>
                        <th colspan="4 text-center">PIUTANG</th>
                        <th class="text-right"><?= number_format($piutang); ?></th>
                    </tr>
                <?php } ?>
            </tfoot>
        </table>
    </div>

    <script>
        window.print();
    </script>

</body>

</html>