<?php 
	$bulan_tes =array(
		'01'=>"Januari",
		'02'=>"Februari",
		'03'=>"Maret",
		'04'=>"April",
		'05'=>"Mei",
		'06'=>"Juni",
		'07'=>"Juli",
		'08'=>"Agustus",
		'09'=>"September",
		'10'=>"Oktober",
		'11'=>"November",
		'12'=>"Desember"
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
								<option <?= ($_GET['filter']=='harian') ? "selected" : ""; ?> value="harian">Harian</option>
								<option <?= ($_GET['filter']=='bulanan') ? "selected" : ""; ?> value="bulanan">Bulanan</option>
								<option <?= ($_GET['filter']=='tahunan') ? "selected" : ""; ?> value="tahunan">Tahun</option>
							</select>
						</div>
						<div class="col-md-5">
							<Input type="date" name="f_tgl" id="f_tgl" class="form-control" value="<?= ($_GET['filter']=='harian') ? $_GET['h_filter'] : date("Y-m-d"); ?>"></Input>
							<Input type="month" name="f_bln"  id="f_bln" class="form-control" value="<?= ($_GET['filter']=='bulanan') ? $_GET['h_filter'] : date("Y-m"); ?>"></Input>
							<select name="f_thn" id="f_thn"  id="f_thn" class="form-control">
								<?php 
									for ($i= date("Y"); $i >= 2023; $i--) { ?>
									<option <?= ($_GET['filter']=='tahunan' && $_GET['h_filter']==$i) ? "selected" : ""; ?> value="<?= $i ?>"><?= $i ?></option>
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
							<a href="excel_penjualan.php?hari=cek&tgl=<?= $_POST['hari'];?>" class="btn btn-info"><i
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
					<table class="table table-bordered w-100 table-sm" id="dataTable">
						<thead>
							<tr style="background:#DFF0D8;color:#333;">
								<th width="7%"> No</th>
								<th width="10%"> ID Barang</th>
								<th> Nama Barang</th>
								<th width="12%"> Jumlah Terjual</th>
								<th style="width:10%;"> Modal</th>
								<th style="width:10%;"> Cash</th>
								<th style="width:10%;"> Credit</th>
								<th style="width:10%;"> Total Terjual</th>
								<th width="20%"> Kasir</th>
							</tr>
						</thead>
						<tbody>
						 	<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
     </div>
 </div>

<script>
	$(document).ready(function(){
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

	$(document).on('change','#filter', function(e) {
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
			window.location.href="?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>";
		</script>
	<?php
}