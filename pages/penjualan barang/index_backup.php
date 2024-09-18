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
                            <Input type="date" name="f_tgl" id="f_tgl" class="form-control" value="<?= ($_GET['filter'] == 'harian') ? $_GET['h_filter'] : date("Y-m-d"); ?>"></Input>
                            <Input type="month" name="f_bln" id="f_bln" class="form-control" value="<?= ($_GET['filter'] == 'bulanan') ? $_GET['h_filter'] : date("Y-m"); ?>"></Input>
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
                            <a href="index.php?page=penjualan_barang" class="btn btn-success">
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
                    <table class="table table-bordered table-striped table-sm display nowrap" id="dataTable">
                        <thead>
                            <tr style="background:#DFF0D8;color:#333;">
                                <th> No</th>
                                <th> ID Barang</th>
                                <th> Nama Barang</th>
                                <th width="12%"> Jumlah Terjual</th>
                                <th> Modal</th>
                                <th> Cash</th>
                                <th> Credit</th>
                                <th> Total Terjual</th>
                                <th> Keuntungan</th>
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
                                        <td class="text-right"><?= ($jumlah_terjual['jml'] == 0) ? 0 : number_format($jumlah_terjual['jml']); ?></td>
                                        <td class="text-right"><?= ($modal == 0) ? 0 : number_format($modal); ?>.-</td>
                                        <td class="text-right"><?= ($cash['cash'] == 0) ? 0 : number_format($cash['cash']) ?>.-</td>
                                        <td class="text-right"><?= ($credit['credit'] == -0) ? 0 : number_format($credit['credit']) ?>.-</td>
                                        <td class="text-right"><?= ($jumlah_terjual['total'] == 0) ? 0 : number_format($jumlah_terjual['total']) ?>.-</td>
                                        <td class="text-right"><?= ($keuntungan == 0) ? 0 : number_format($keuntungan); ?>.-</td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>


                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-center">JUMLAH</th>
                                <th class="text-right"><?= ($t_modal == 0) ? 0 : number_format($t_modal); ?>.-</th>
                                <th class="text-right"><?= ($t_cash == 0) ? 0 : number_format($t_cash); ?>.-</th>
                                <th class="text-right"><?= ($t_credit == 0) ? 0 : number_format($t_credit); ?>.-</th>
                                <th class="text-right"><?= ($t_total == 0) ? 0 : number_format($t_total); ?>.-</th>
                                <th class="text-right"><?= ($t_keuntungan == 0) ? 0 : number_format($t_keuntungan); ?>.-</th>
                            </tr>
                        </tfoot>
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
