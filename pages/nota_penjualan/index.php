<?php
$bulan_tes = array(
    '01' => "Januari",
    '02' => "Februari",
    '03' => "Maret",
    '04' => "April",
    '05' => "Mei",
    '06' => "Juni",
    '07' => "Juli",
    '08' => "Agustus",
    '09' => "September",
    '10' => "Oktober",
    '11' => "November",
    '12' => "Desember"
);

$filter = $_GET['filter'];
$h_filter = $_GET['h_filter'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info">
                <!-- <h5 class="card-title mt-2">Cari Laporan</h5> -->
                <b style="color: white; font-size: 15pt;">Cari Laporan</b>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-4">
                            <select name="filter" id="filter" class="form-control">
                                <option value="">-- Pilih Jenis Laporan --</option>
                                <option <?= ($_GET['filter'] == 'harian') ? "selected" : ""; ?> value="harian">Harian</option>
                                <option <?= ($_GET['filter'] == 'bulanan') ? "selected" : ""; ?> value="bulanan">Bulanan</option>
                                <option <?= ($_GET['filter'] == 'tahunan') ? "selected" : ""; ?> value="tahunan">Tahun</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <Input type="date" name="f_tgl" id="f_tgl" class="form-control" value="<?= ($_GET['filter'] == 'harian') ? $_GET['h_filter'] : date("Y-m-d"); ?>">
                            <Input type="month" name="f_bln" id="f_bln" class="form-control" value="<?= ($_GET['filter'] == 'bulanan') ? $_GET['h_filter'] : date("Y-m"); ?>">
                            <select name="f_thn" id="f_thn" id="f_thn" class="form-control">
                                <?php
                                for ($i = date("Y"); $i >= 2023; $i--) { ?>
                                    <option <?= ($_GET['filter'] == 'tahunan' && $_GET['h_filter'] == $i) ? "selected" : ""; ?> value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3 text-right">
                            <button type="submit" class="btn btn-primary" name="cari" id="cari">
                                <i class="fa fa-search"></i> Cari
                            </button>
                            <a href="index.php?page=nota_penjualan" class="btn btn-success">
                                <i class="fa fa-refresh"></i> Refresh
                            </a>

                            <a target="_blank" href="pages/penjualan barang/export.php?filter=<?= $filter; ?>&h_filter=<?= $h_filter; ?>" class="btn btn-info"><i
                                    class="fa fa-download"></i>
                                Excel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br />

        <!-- view barang -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm" id="dataTable">
                        <thead>
                            <tr style="background:#DFF0D8;color:#333;">
                                <th> No </th>
                                <th> ID Transaksi</th>
                                <th> Nama Pelanggan</th>
                                <th> Tanggal</th>
                                <th class="text-right"> Total Belanja</th>
                                <th> Pembayaran</th>
                                <th> Piutang</th>
                                <th> Kasir</th>
                                <th> Status</th>
                                <th class="text-right" data-orderable="false">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;

                            if ($filter == "") {
                                $sql_data_nota = mysqli_query($koneksi, "SELECT * FROM nota
                                    LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
                                    LEFT JOIN user ON user.id_user=nota.id_user
                                    ORDER BY nota.id_nota DESC");
                            } else {
                                $sql_data_nota = mysqli_query($koneksi, "SELECT * FROM nota
                                    LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
                                    LEFT JOIN user ON user.id_user=nota.id_user
                                    WHERE nota.tgl_nota LIKE '$h_filter%'
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
                                    <td class="text-right"><?= ($data_nota['total_transaksi'] != 0) ? number_format($data_nota['total_transaksi']) : 0; ?></td>
                                    <td class="text-right"><?= ($cek['t_bayar'] != 0) ? number_format($cek['t_bayar']) : 0; ?></td>
                                    <td class="text-right"><?= ($piutang != 0) ? number_format($piutang) : 0; ?></td>
                                    <td><?= $data_nota['nama']; ?></td>
                                    <td align="center">
                                        <?php if ($data_nota['total_transaksi'] <= $cek['t_bayar']) { ?>
                                            <button for="" class="btn btn-success btn-sm">Lunas</button>
                                        <?php } else { ?>
                                            <button for="" class="btn btn-danger btn-sm">Piutang</button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-right">
                                        <button href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_nota<?= $id; ?>">
                                            <span class="icon text-white">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </button>
                                        <?php include "detail.php"; ?>

                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_nota<?= $id ?>">
                                            <span class="icon text-white">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let cek = $("#filter").val();
        // console.log(cek);

        if (cek == 'harian') {
            $("#f_tgl").show();
            $("#f_bln").hide();
            $("#f_thn").hide();
            $("#cari").show();
        } else if (cek == 'bulanan') {
            $("#f_tgl").hide();
            $("#f_bln").show();
            $("#f_thn").hide();
            $("#cari").show();
        } else if (cek == 'tahunan') {
            $("#f_tgl").hide();
            $("#f_bln").hide();
            $("#f_thn").show();
            $("#cari").show();
        } else {
            $("#f_tgl").hide();
            $("#f_bln").hide();
            $("#f_thn").hide();
            $("#cari").hide();
        }
    });

    $(document).on('change', '#filter', function(e) {
        let cek = $("#filter").val();
        // console.log(cek);

        if (cek == 'harian') {
            $("#f_tgl").show();
            $("#f_bln").hide();
            $("#f_thn").hide();
            $("#cari").show();
        } else if (cek == 'bulanan') {
            $("#f_tgl").hide();
            $("#f_bln").show();
            $("#f_thn").hide();
            $("#cari").show();
        } else if (cek == 'tahunan') {
            $("#f_tgl").hide();
            $("#f_bln").hide();
            $("#f_thn").show();
            $("#cari").show();
        } else {
            $("#f_tgl").hide();
            $("#f_bln").hide();
            $("#f_thn").hide();
            $("#cari").hide();
        }
    });
</script>

<?php
if (isset($_POST['cari'])) {
    $filter = $_POST['filter'];
    $tgl = $_POST['f_tgl'];
    $bln = $_POST['f_bln'];
    $thn = $_POST['f_thn'];

    if ($filter == 'harian') {
        $h_filter = $tgl;
    } else if ($filter == 'bulanan') {
        $h_filter = $bln;
    } else if ($filter == 'tahunan') {
        $h_filter = $thn;
    }

?>
    <script type="text/javascript">
        window.location.href = "?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>";
    </script>
<?php
}
