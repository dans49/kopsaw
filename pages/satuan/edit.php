<div id="edit_satuan<?= $data_satuan['id_satuan'] ?>" class="modal fade text-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah satuan content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-primary text-white">
                <span class="modal-title"><i class="fa fa-edit fa-xs"></i> Edit <?= $page ?></span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Satuan</label>
                        <input type="text" class="form-control" name="nama_satuan" required value="<?= $data_satuan['nama_satuan']; ?>">
                        <input type="hidden" class="form-control" name="id_satuan" required readonly value="<?= $data_satuan['id_satuan']; ?>">
                    </div>

                    <div class="form-group">
                         <label for="">Status</label>
                         <select class="form-control" name="status_satuan" required>
                         <option value="AKTIF" <?= ($data_satuan['status_satuan'] == 'AKTIF') ? 'selected' : ''; ?>>AKTIF</option>
                         <option value="TIDAK" <?= ($data_satuan['status_satuan'] == 'TIDAK') ? 'selected' : ''; ?>>TIDAK</option>
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label for="">Tanggal Input</label>
                        <input type="text" class="form-control" name="waktu_data" required value="<?= $data_satuan['waktu_data']; ?>">
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="e_satuan" class="btn btn-primary btn-icon-split btn-sm">
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
if (isset($_POST['e_satuan'])) {
    $id_satuan = $_POST['id_satuan'];
    $nama = strtoupper($_POST['nama_satuan']);
    // $status_satuan = $_POST['status_satuan'];
    
    $sql_update = mysqli_query($koneksi, "UPDATE satuan SET nama_satuan='$nama' WHERE id_satuan='$id_satuan'");

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
