<?php
include "akses/koneksi.php";

$q1 = mysqli_query($koneksi, "SELECT * FROM nota");
?>
<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<div class="container">
	
	<h2>Data Nota</h2>
	<table width="100%" id="table_barang" style="color: black">
		<thead>
			<tr><td>No</td><td>ID Nota</td><td>Total Transaksi</td><td>Total Penjualan</td><td>Selisih</td></tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			while ($data = mysqli_fetch_array($q1)) {
				$total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(total_penjualan) as tot_p FROM penjualan WHERE id_nota = '$data[id_nota]'"));
				$total_p = $total_p + $total['tot_p'];
				if($data[total_transaksi] <> $total_p){
					$col = "pink";
				} else {
					$col = "";
				}
				$kurang = $total_p - $data[total_transaksi];
				echo "<tr bgcolor='".$col."'><td>".$no++."</td><td>$data[id_nota]</td><td>".number_format($data[total_transaksi])."</td><td>".number_format($total_p)."</td><td>".$kurang."</td></tr>";
				$total_p = 0;
			}
			?>
		</tbody>
	</table>
</div>

<script>
	$(function() {
        $('#table_barang').DataTable({})
    })
</script>