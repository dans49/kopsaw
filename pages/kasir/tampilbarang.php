<?php
	include "../../akses/koneksi.php";
	$cari = trim(strip_tags($_POST['keyword']));
    if ($cari == '') {

    } else {
        $sql = "SELECT barang.*, satuan.id_satuan, satuan.nama_satuan
				from barang 
                inner join satuan on barang.id_satuan = satuan.id_satuan
				where barang.id_barang like '%$cari%' or barang.nama_barang like '%$cari%'";
        $row = mysqli_query($koneksi, $sql);
        ?>
	<table class="table table-stripped" width="100%" id="example2">
		<tr>
			<th>ID Barang</th>
			<th>Nama Barang</th>
            <th>Harga Jual</th>
			<th>Stok</th>
			<th>Aksi</th>
		</tr>
	<?php 
		while ($hasil = mysqli_fetch_array($row)) {
			// $member = $_SESSION['admin']['id_member'];
			$member = 1;
		?>
		<tr>
			<td><?php echo $hasil['id_barang'];?></td>
			<td><?php echo $hasil['nama_barang'];?></td>
            <td><?php echo $hasil['harga_jual'];?></td>
			<td><?php echo $hasil['stok'];?></td>
			<td>
			<a href="index.php?page=kasir&beli_barang=1&id=<?php echo $hasil['id_barang'];?>&id_kasir=<?php echo $member;?>" 
				class="btn btn-success">
				<i class="fa fa-shopping-cart"></i></a></td>
		</tr>
	<?php }?>
	</table>
<?php
	}