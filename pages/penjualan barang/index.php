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
					<table class="table table-bordered table-striped table-sm display nowrap" id="table_laporan_barang">
						<thead>
							<tr style="background:#DFF0D8;color:#333;">
								<th> No</th>
								<th> ID Barang</th>
								<th> Nama Barang</th>
								<th> Jumlah Terjual</th>
								<th> Total Modal</th>
								<th> Total Terjual</th>
								<th> Keuntungan</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
						<!-- <tfoot>
							<tr>
								<th colspan="4" class="text-center">TOTAL</th>
								<th class="text-right"></th>
								<th class="text-right"></th>
								<th class="text-right"></th>
								<th class="text-right"></th>
								<th class="text-right"></th>
							</tr>
						</tfoot> -->
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

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
		const h_filter = getQueryParam('h_filter');

		// Contoh: Gunakan nilai ini dalam AJAX
		$.ajax({
			url: 'pages/penjualan barang/ajax_datatable.php', // URL PHP untuk mengambil data laporan
			method: 'POST',
			data: {
				action: 'table_data',
				page: page,
				filter: filter,
				h_filter: h_filter
			},
			success: function(response) {
				console.log(response);
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});

		$(function() {
			$('#table_laporan_barang').DataTable({
				processing: true,
				serverSide: true,
				"language": {
					processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> '
				},
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "pages/penjualan barang/ajax_datatable.php?action=table_data",
					"type": "POST",
					"data": function(d) {
						d.page = getQueryParam('page'); // Tambahkan parameter dari URL
						d.filter = getQueryParam('filter'); // Tambahkan parameter dari URL
						d.h_filter = getQueryParam('h_filter'); // Tambahkan parameter dari URL
					}
				},
				"columns": [{
						"data": "no"
					},
					{
						"data": "id_barang"
					},
					{
						"data": "nama_barang"
					},
					{
						"data": "jumlah_terjual",
						"className": "text-right"
					},
					{
						"data": "modal",
						"className": "text-right"
					},
					{
						"data": "total_terjual",
						"className": "text-right"
					},
					{
						"data": "keuntungan",
						"className": "text-right"
					}
				],

			});


		});

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
