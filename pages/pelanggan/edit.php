<div id="edit_pelanggan<?= $data_pelanggan['id_pelanggan'] ?>" class="modal fade text-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah pelanggan content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-primary text-white">
                <span class="modal-title"><i class="fa fa-edit fa-xs"></i> Edit <?= $page ?></span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan" required value="<?= $data_pelanggan['nama_pelanggan']; ?>">
                        <input type="hidden" class="form-control" name="id_pelanggan" required readonly value="<?= $data_pelanggan['id_pelanggan']; ?>">
                    </div>

                    <div class="form-group">
                         <label for="">NAK</label>
                         <input class="form-control" name="identitas" required value="<?= $data_pelanggan['identitas']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Nomor HP</label>
                        <input type="text" class="form-control" name="telepon" required value="<?= $data_pelanggan['telepon']; ?>">
                    </div>
                    <div class="form-group">
                         <label for="">Status</label>
                         <select class="form-control" name="status_data" required>
                         <option value="AKTIF" <?= ($data_pelanggan['status_data'] == 'AKTIF') ? 'selected' : ''; ?>>AKTIF</option>
                         <option value="TIDAK" <?= ($data_pelanggan['status_data'] == 'TIDAK') ? 'selected' : ''; ?>>TIDAK</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="e_pelanggan" class="btn btn-primary btn-icon-split btn-sm">
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
if (isset($_POST['e_pelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama_pelanggan'];
    $identitas = $_POST['identitas'];
    $telepon = $_POST['telepon'];
    $status_data = $_POST['status_data'];

    $sql_update = mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama', identitas='$identitas', telepon='$telepon', status_data='$status_data' WHERE id_pelanggan='$id_pelanggan'");

    if ($sql_update) {
        ?>
            <script type="text/javascript">
                alert("Data berhasil diupdate");
                window.location.href="?page=<?= $page ?>";
            </script>
        <?php
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>