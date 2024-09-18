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
            <table class="table table-bordered table-striped table-sm" id="<?= ($_GET['sort'] == 'stok_kurang' ? 'table_sort_barang' : 'table_barang') ?>"> <!-- id=dataTable -->
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

                </tbody>

            </table>
        </div>
    </div>
</div>

<?php include "tambah.php" ?>
<?php include "edit.php"; ?>
<?php include "hapus.php"; ?>


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
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> '
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "pages/barang/ajax_datatable_barang.php?action=table_data",
                "dataType": "json",
                "type": "POST"
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
                    "data": "stok"
                },
                {
                    "data": "harga_beli"
                },
                {
                    "data": "harga_jual"
                },
                {
                    "data": "satuan"
                },
                {
                    "data": "aksi"
                },
            ],
            "columnDefs": [{
                    "targets": 4,
                    "className": "text-right"
                },
                {
                    "targets": 5,
                    "className": "text-right"
                },
                {
                    "targets": -1,
                    "className": "text-center"
                },
            ]
        });


        $('#table_sort_barang').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> '
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "pages/barang/ajax_datatable_sortbarang.php?action=table_data",
                "dataType": "json",
                "type": "POST"
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
                    "data": "stok"
                },
                {
                    "data": "harga_beli"
                },
                {
                    "data": "harga_jual"
                },
                {
                    "data": "satuan"
                },
                {
                    "data": "aksi"
                },
            ],
            "columnDefs": [{
                    "targets": 4,
                    "className": "text-right"
                },
                {
                    "targets": 5,
                    "className": "text-right"
                },
                {
                    "targets": -1,
                    "className": "text-center"
                },
            ]
        });
    });

    $(document).ready(function() {

        $('#table_barang').on('click', ".editbarang", function() {

            var idb = $(this).data("idbarang");

            $.ajax({
                url: "pages/barang/apishow.php?idbarang=" + idb,
                method: "GET",
                dataType: "json",
                success: function(res) {
                    // console.log(res.idbarang)
                    $("#id_barang").val(res.idbarang)
                    $("#nama_barang").val(res.nama_barang)
                    $("#stok").val(res.stok)
                    $("#harga_beli").val(res.harga_beli)
                    $("#harga_jual").val(res.harga_jual)
                    $("#satuan").val(res.id_satuan)
                }
            })
        })
        // $(".editbarang").on('click', function(){

        // })

        $('#table_barang').on('click', ".delbarang", function() {

            var idb = $(this).data("idbdel");

            $.ajax({
                url: "pages/barang/apishow.php?idbarang=" + idb,
                method: "GET",
                dataType: "json",
                success: function(res) {
                    console.log(res.idbarang)
                    $("#idb_hapus").val(res.idbarang)
                }
            })
        })

        // $(".delbarang").on('click', function(){

        // })
    })
</script>