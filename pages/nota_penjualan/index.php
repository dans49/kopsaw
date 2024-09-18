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
$f_pelanggan = $_GET['f_pelanggan'];
$f_status = $_GET['f_status'];
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

                        <div class="col-md-3">
                            <select name="f_pelanggan" id="f_pelanggan" class="form-control select2get">
                                <option value="">-- Pilih Pelanggan --</option>
                                <?php
                                $sql_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
                                while ($pelanggan = mysqli_fetch_assoc($sql_pelanggan)) {
                                ?>
                                    <option <?= ($f_pelanggan == $pelanggan['id_pelanggan']) ? "selected" : ""; ?> value="<?= $pelanggan['id_pelanggan']; ?>"><?= $pelanggan['nama_pelanggan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="f_status" id="f_status" class="form-control select2">
                                <option value="">-- Pilih Status --</option>
                                <option <?= ($f_status == 'Lunas') ? "selected" : ""; ?> value="Lunas">Lunas</option>
                                <option <?= ($f_status == 'Hutang') ? "selected" : ""; ?> value="Hutang">Piutang</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="filter" id="filter" class="form-control">
                                <option value="">-- Pilih Jenis Laporan --</option>
                                <option <?= ($_GET['filter'] == 'harian') ? "selected" : ""; ?> value="harian">Harian</option>
                                <option <?= ($_GET['filter'] == 'bulanan') ? "selected" : ""; ?> value="bulanan">Bulanan</option>
                                <option <?= ($_GET['filter'] == 'tahunan') ? "selected" : ""; ?> value="tahunan">Tahun</option>
                            </select>
                        </div>
                        <div class="col-md-2">
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
                            <a href="index.php?page=nota_penjualan" class="btn btn-success">
                                <i class="fa fa-refresh"></i> Refresh
                            </a>

                            <a target="_blank" href="pages/nota_penjualan/export.php?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>&f_pelanggan=<?= $f_pelanggan ?>&f_status=<?= $f_status ?>" class="btn btn-info"><i
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
                    <table class="table table-bordered table-striped table-sm" id="table_nota">
                        <thead>
                            <tr style="background:#DFF0D8;color:#333;">
                                <th> No </th>
                                <th> ID Transaksi</th>
                                <th> Nama Pelanggan</th>
                                <th> Tanggal</th>
                                <th class="text-right"> Total Belanja</th>
                                <th class="text-right"> Total Pembayaran</th>
                                <th class="text-right"> Piutang</th>
                                <th> Status</th>
                                <th> PIC</th>
                                <th> Kasir</th>
                                <!-- <th class="text-right" data-orderable="false">Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php //include "tambah.php" 
?>
<?php //include "edit.php"; 
?>
<?php //include "hapus.php"; 
?>

<script>
    $(document).ready(function() {
        // Fungsi untuk mengambil nilai dari URL
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        // Ambil nilai dari URL
        const page = getQueryParam('page');
        const filter = getQueryParam('filter');
        const f_pelanggan = getQueryParam('f_pelanggan');
        const h_filter = getQueryParam('h_filter');
        const f_status = getQueryParam('f_status');

        // Contoh: Gunakan nilai ini dalam AJAX
        $.ajax({
            url: 'pages/nota_penjualan/ajax_datatable_nota.php', // URL PHP untuk mengambil data laporan
            method: 'POST',
            data: {
                action: 'table_data',
                page: page,
                filter: filter,
                f_pelanggan: f_pelanggan,
                h_filter: h_filter,
                f_status: f_status
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        $(function() {
            $('#table_nota').DataTable({
                processing: true,
                serverSide: true,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> '
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "pages/nota_penjualan/ajax_datatable_nota.php?action=table_data",
                    "type": "POST",
                    "data": function(d) {
                        d.page = getQueryParam('page'); // Tambahkan parameter dari URL
                        d.filter = getQueryParam('filter'); // Tambahkan parameter dari URL
                        d.f_pelanggan = getQueryParam('f_pelanggan'); // Tambahkan parameter dari URL
                        d.h_filter = getQueryParam('h_filter'); // Tambahkan parameter dari URL
                        d.f_status = getQueryParam('f_status'); // Tambahkan parameter dari URL
                    }
                },
                "columns": [{
                        "data": "no"
                    },
                    {
                        "data": "id_nota"
                    },
                    {
                        "data": "nama_pelanggan"
                    },
                    {
                        "data": "tgl_nota"
                    },
                    {
                        "data": "total_transaksi",
                        "className": "text-right"
                    },
                    {
                        "data": "total_pembayaran",
                        "className": "text-right"
                    },
                    {
                        "data": "piutang",
                        "className": "text-right"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "pic"
                    },
                    {
                        "data": "kasir"
                    },

                ],

                // "columnDefs": [{
                //         "targets": 4,
                //         "className": "text-right"
                //     },
                //     {
                //         "targets": 5,
                //         "className": "text-right"
                //     },
                //     {
                //         "targets": -1,
                //         "className": "text-center"
                //     },
                // ],
            });


        });

        let cek = $("#filter").val();
        // console.log(cek);

        if (cek == 'harian') {
            $("#f_tgl").show();
            $("#f_bln").hide();
            $("#f_thn").hide();
        } else if (cek == 'bulanan') {
            $("#f_tgl").hide();
            $("#f_bln").show();
            $("#f_thn").hide();
        } else if (cek == 'tahunan') {
            $("#f_tgl").hide();
            $("#f_bln").hide();
            $("#f_thn").show();
        } else {
            $("#f_tgl").hide();
            $("#f_bln").hide();
            $("#f_thn").hide();
        }
    });

    $(document).on('change', '#filter', function(e) {
        let cek = $("#filter").val();
        // console.log(cek);

        if (cek == 'harian') {
            $("#f_tgl").show();
            $("#f_bln").hide();
            $("#f_thn").hide();
        } else if (cek == 'bulanan') {
            $("#f_tgl").hide();
            $("#f_bln").show();
            $("#f_thn").hide();
        } else if (cek == 'tahunan') {
            $("#f_tgl").hide();
            $("#f_bln").hide();
            $("#f_thn").show();
        } else {
            $("#f_tgl").hide();
            $("#f_bln").hide();
            $("#f_thn").hide();
        }
    });
</script>

<?php
if (isset($_POST['cari'])) {
    $filter = $_POST['filter'];
    $f_pelanggan = $_POST['f_pelanggan'];
    $f_status = $_POST['f_status'];
    $tgl = $_POST['f_tgl'];
    $bln = $_POST['f_bln'];
    $thn = $_POST['f_thn'];

    if ($filter == 'harian') {
        $h_filter = $tgl;
    } else if ($filter == 'bulanan') {
        $h_filter = $bln;
    } else if ($filter == 'tahunan') {
        $h_filter = $thn;
    } else {
        $h_filter = "";
    }

?>
    <script type="text/javascript">
        window.location.href = "?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>&f_pelanggan=<?= $f_pelanggan ?>&f_status=<?= $f_status ?>";
    </script>
<?php
}
