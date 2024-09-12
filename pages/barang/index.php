<?php
$r = mysqli_query($koneksi, "select * from barang where stok <= 3");
if (mysqli_num_rows($r) > 0) {
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


<button href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_barang">
    <span class="icon text-white-50">
        <i class="fas fa-plus-circle"></i>
    </span>
    <span class="text"> Tambah Barang</span>
</button>

<a href="index.php?page=<?= $page ?>&sort=stok_kurang" class="btn btn-warning  btn-sm">
    <span class="icon text-white-50">
        <i class="fa fa-list"></i>
    </span>
    <span class="text">Sortir Stok Kurang</span></a>

<a href="index.php?page=<?= $page ?>" class="btn btn-info btn-icon-split btn-sm">
    <span class="icon text-white-50">
        <i class="fas fa-sync-alt"></i>
    </span>
    <span class="text"> Refresh Data</span>
</a>

<br><br>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="dataTable"> <!-- id=dataTable --> 
                <thead>
                    <tr class="bg-success text-white">
                        <th>No.</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th class="text-right">Stok</th>
                        <th class="text-right">Harga Beli</th>
                        <th class="text-right">Harga Jual</th>
                        <th>Satuan</th>
                        <th class="text-right" data-orderable="false" width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // var_dump($_GET['sort']);
                    $stok_kurang = 3;

                    if (isset($_GET['sort']) && $_GET['sort'] == 'stok_kurang') {
                        $sql_barang = mysqli_query($koneksi, "SELECT * FROM barang LEFT JOIN satuan ON barang.id_satuan=satuan.id_satuan WHERE stok < $stok_kurang ORDER BY stok ASC");
                    } else {
                        $sql_barang = mysqli_query($koneksi, "SELECT * FROM barang LEFT JOIN satuan ON barang.id_satuan=satuan.id_satuan ORDER BY barang.id_barang ASC");
                    }

                    // $sql_barang = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id_barang ASC");
                    while ($data_barang = mysqli_fetch_assoc($sql_barang)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data_barang['id_barang']; ?></td>
                            <td><?= $data_barang['nama_barang']; ?></td>
                            <td class="text-right">
                                <?php if ($data_barang['stok'] == '0') { ?>
                                    <button class="btn btn-danger btn-sm"> Habis</button>
                                <?php } else { ?>
                                    <?php echo number_format($data_barang['stok']); ?>
                                <?php } ?>
                            </td>
                            <td class="text-right"><?= ($data_barang['harga_beli'] == 0) ? 0 : number_format($data_barang['harga_beli']); ?></td>
                            <td class="text-right"><?= ($data_barang['harga_jual'] == 0) ? 0 : number_format($data_barang['harga_jual']); ?></td>
                            <td><?= $data_barang['nama_satuan']; ?></td>
                            <td class="text-right">
                                <?php if ($data_barang['stok'] <= 3) { ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="number" name="restok" class="form-control form-control-sm" placeholder="Jumlah restok">
                                        <input type="hidden" name="id_barang" value="<?php echo $data_barang['id_barang']; ?>">
                                        <input type="hidden" name="stok" value="<?php echo $data_barang['stok']; ?>">
                                        <button class="btn btn-primary btn-icon-split btn-sm " name="restok_barang">
                                            <span class="icon text-white">
                                                <i class="fas fa-recycle"></i>
                                            </span>
                                            <span class="text">Restok</span>
                                        </button>
                                        <button class="btn btn-danger btn-icon-split btn-sm" name="hapus_restok" onclick="return confirm('Yakin ingin menghapus data?')">
                                            <span class="icon text-white">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text"> Hapus</span>
                                        </button>
                                    </form>
                                <?php } else { ?>
                                    <button href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#edit_barang<?= $data_barang['id_barang']; ?>">
                                        <span class="icon text-white">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text"> Edit</span>
                                    </button>
                                    <?php include "edit.php"; ?>

                                    <button href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#hapus_barang<?= $data_barang['id_barang']; ?>">
                                        <span class="icon text-white">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text"> Hapus</span>
                                    </button>
                                    <?php include "hapus.php"; ?>
                                <?php } ?>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php include "tambah.php" ?>


<?php
if (isset($_POST['restok_barang'])) {
    $id_barang = $_POST['id_barang'];
    $restok = $_POST['restok'];
    $stok = $_POST['stok'];
    $stok_ahir = (int)$stok + (int)$restok;
    $sql_update = mysqli_query($koneksi, "UPDATE barang SET stok='$stok_ahir' WHERE id_barang='$id_barang'");

    if ($sql_update) {
?>
        <script type="text/javascript">
            alert("Data berhasil diupdate");
            window.location.href = "?page=<?= $page ?>";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Data gagal diupdate");
            window.location.href = "?page=<?= $page ?>";
        </script>
    <?php
    }
}

if (isset($_POST['hapus_restok'])) {
    $id_barang = $_POST['id_barang'];
    $sql_hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id_barang'");
    if ($sql_hapus) {
    ?>
        <script type="text/javascript">
            alert("Data berhasil dihapus");
            window.location.href = "?page=<?= $page ?>";
        </script>
    <?php
    } else {
        $error_message = mysqli_error($koneksi);
    ?>
        <script type="text/javascript">
            alert("Data gagal dihapus: <?php echo $error_message; ?>");
            window.location.href = "?page=<?= $page ?>";
        </script>
<?php
    }
}
?>

<script>
    // JIKA INGIN MENGGUNAKAN DATATABLE SERVERSIDE
    $(function() {
        $('#table_barang').DataTable({
            processing: true,
            serverSide: true,
            "processing": true,
            "serverSide": true,
            "ajax":{
                   "url": "pages/barang/ajax_datatable_barang.php?action=table_data",
                   "dataType": "json",
                   "type": "POST"
                },
            "columns": [
                { "data": "no" },
                { "data": "id_barang" },
                { "data": "nama_barang" },
                { "data": "stok" },
                { "data": "harga_beli" },
                { "data": "harga_jual" },
                { "data": "satuan" },
                { "data": "aksi" },
            ] 
        });
    });
</script>