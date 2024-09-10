<div id="edit_nota<?= $id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header" style="background:#285c64;color:#fff;">
                <h5 class="modal-title"> Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

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
                    </tfoot>
                </table>

                <?php if ($sisa > 0) { ?>
                    <form action="pages/nota_penjualan/proses_detail.php" method="post">
                        <table style="width: 100%;" class="text-left">
                            <tr>
                                <td colspan="2">
                                    <label for="">Tanggal Pembayaran</label>
                                    <input name="tgl_bayar" type="date" class="form-control" value="<?= date("Y-m-d"); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="i_bayar" class="form-control" value="<?= $sisa; ?>">
                                    <input type="hidden" name="id_nota2" class="form-control" value="<?= $data_nota['id_nota']; ?>">
                                    <input type="hidden" name="page" class="form-control" value="<?= $page ?>">
                                    <input type="hidden" name="filter" class="form-control" value="<?= $filter ?>">
                                    <input type="hidden" name="h_filter" class="form-control" value="<?= $h_filter; ?>">
                                </td>
                                <td class="text-right">
                                    <button name="s_bayar" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="text"> Bayar</span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php } ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <a target="_blank" href="pages/nota_penjualan/print.php?id_nota=<?= $data_nota['id_nota']; ?>" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text"> Print</span>
                </a>
            </div>

        </div>

    </div>
</div>