<?php 
	$r = mysqli_query($koneksi, "SELECT * from barang WHERE stok <= 3");
	if(mysqli_num_rows($r) > 0){
        $jml = mysqli_num_rows($r);
?>
<?php
		echo "
		<div class='alert alert-warning'>
			<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$jml</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
			<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
		</div>
		";	
	}
?>
<?php $hasil_barang = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM barang")); ?>
<?php $stok = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(stok) as jml FROM barang"));?>
<?php $jual = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(total_penjualan) as stok FROM penjualan")); ?>
<?php $untung = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(total_penjualan)-sum(harga_satuan_beli*jumlah_barang) as keuntungan FROM `penjualan`; ")); ?>
<div class="row">
    <!--STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Data Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_barang, 0, ',','.');?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>Tabel Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Stok Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format((int) $stok['jml'], 0, ',','.');?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>Tabel Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Telah Terjual</h6>
            </div>
            <div class="card-body">
                <center>
                    <h2>Rp <?php echo number_format((int) $jual['stok'], 0, ',','.');?></h2>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=nota_penjualan'>Tabel Barang Terjual <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->

    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h6 class="pt-2"><i class="fas fa-list"></i> Jumlah Keuntungan </h6>
            </div>
            <div class="card-body">
                <center>
                    <h2>Rp <?php echo number_format((int) $untung['keuntungan'], 0, ',','.');?></h2>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=nota_penjualan'>Nota Penjualan <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
</div>

<div class="row">
    <div class="col-md-12 mb-3" id="grafikPenjualan">
        <div class="card">
            <div class="card-header bg-success text-white">
                Grafik Penjualan
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-md-2">
                        <input type="hidden" name="getnow" id="yearnow" value="<?=date('Y') ?>">
                        <select class="form-control" id="chartyear">
                                
                            <?php
                            for ($i=date('Y'); $i > 2019; $i--) { 
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <a href="index.php" class="btn btn-success"><i class="fa fa-sync"></i></a>
                    </div>
                </div>
                <div class="chart cp">
                    <canvas id="penjualan-chart" style="min-height: 250px; height: 450px; max-height: 550px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
</div>