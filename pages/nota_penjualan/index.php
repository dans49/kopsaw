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
                            <a href="excel_penjualan.php?hari=cek&tgl=<?= $_POST['hari']; ?>" class="btn btn-info"><i
                                    class="fa fa-download"></i>
                                Excel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br />
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
                                <th style="width:10%;"> Tanggal</th>
                                <th> Total Belanja</th>
                                <th style="width:10%;"> Pembayaran</th>
                                <th> Kasir</th>
                                <th style="width:10%;"> Status</th>
                                <th class="text-right" data-orderable="false">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tanggal_mulai = isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '';
                            $tanggal_selesai = isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : '';
                            $where_clause = '';
                            if (!empty($tanggal_mulai) && !empty($tanggal_selesai)) {
                                $where_clause = "WHERE nota.tgl_nota BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
                            }
                            $sql_nota = mysqli_query($koneksi, "
                    SELECT 
                        nota.id_nota, 
                        pelanggan.nama_pelanggan, 
                        nota.tgl_nota, 
                        nota.total_transaksi, 
                        nota.bayar, 
                        user.nama AS kasir, 
                        nota.status_nota
                    FROM 
                        nota
                    JOIN 
                        pelanggan ON nota.id_pelanggan = pelanggan.id_pelanggan
                    JOIN 
                        user ON nota.id_user = user.id_user
                    $where_clause
                    ORDER BY 
                        nota.id_nota ASC");
                            $no = 1;
                            while ($data_nota = mysqli_fetch_assoc($sql_nota)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data_nota['id_nota']; ?></td>
                                    <td><?= $data_nota['nama_pelanggan']; ?></td>
                                    <td><?= $data_nota['tgl_nota']; ?></td>
                                    <td><?= $data_nota['total_transaksi']; ?></td>
                                    <td><?= $data_nota['bayar']; ?></td>
                                    <td><?= $data_nota['kasir']; ?></td>
                                    <td>
                                        <?php if ($data_nota['status_nota'] == 'LUNAS') { ?>
                                            <button class="badge badge-success"> LUNAS </button>
                                        <?php } else { ?>
                                            <button class="badge badge-warning"> PIUTANG </button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-right">
                                        <!-- <button href="#" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#edit_nota<?= $data_nota['id_nota']; ?>">
                                <span class="icon text-white">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text"> Edit</span>
                            </button> -->
                                        <?php include "edit.php"; ?>

                                        <button href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#hapus_nota<?= $data_nota['id_nota']; ?>">
                                            <span class="icon text-white">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text"> Hapus</span>
                                        </button>
                                        <?php include "hapus.php"; ?>
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
?>