<!-- Modal Edit Barang -->
<div id="edit_barang" class="modal fade text-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah barang content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-primary text-white">
                <span class="modal-title"><i class="fa fa-edit fa-xs"></i> Edit <?= $page ?></span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" required >
                        <input type="hidden" class="form-control" name="id_barang" id="id_barang" required readonly >
                    </div>

                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="number" class="form-control" name="stok" id="stok" required >
                        </div>

                        <div class="form-group">
                            <label for="">Harga Beli</label>
                            <input type="number" class="form-control" name="harga_beli" id="harga_beli" required>
                        </div>

                    <div class="form-group">
                        <label for="">Harga Jual</label>
                        <input type="number" class="form-control" name="harga_jual" id="harga_jual" required>
                    </div>

                    <div class="form-group">
                        <label for="">Satuan</label>
                        <select class="form-control" name="id_satuan" id="satuan" required>
                            <?php
                            $query_satuan = mysqli_query($koneksi, "SELECT * FROM satuan ORDER BY nama_satuan ASC");
                            while ($data_satuan = mysqli_fetch_assoc($query_satuan)) {
                                ?>
                                <option value="<?= $data_satuan['id_satuan'];?>"><?= $data_satuan['nama_satuan'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="e_barang" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text"> Edit Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['e_barang'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = ucwords($_POST['nama_barang']);
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $id_satuan = $_POST['id_satuan'];
   
    $sql_update = mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama_barang',  id_satuan='$id_satuan', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE id_barang='$id_barang'");

    if ($sql_update) {
        ?>
            <script type="text/javascript">
                alert("Data berhasil diupdate");
                window.location.href="?page=<?= $page ?>";
            </script>
        <?php
    } else {
        ?>
            <script type="text/javascript">
                alert("Data gagal diupdate");
                window.location.href="?page=<?= $page ?>";
            </script>
        <?php
    }
}
?>
