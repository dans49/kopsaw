<div id="hapus_user<?= $data_user['id_user']; ?>" class="modal fade text-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah user content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-danger text-white">
                <span class="modal-title"><i class="fa fa-trash fa-xs"></i> Hapus <?= $page ?></span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <span class="mb-2">Anda akan menghapus data user ini.</span>
                    <input type="text" name="id_user" value="<?= $data_user['id_user']; ?>" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="h_user" class="btn btn-danger btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text"> Hapus Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
if (isset($_POST['h_user'])) {
    echo $id_user = $_POST['id_user'];
    $cek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'"));

    // unlink("assets/img/user/".$cek['gambar']);

    $sql_hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");

    if ($sql_hapus) {
        ?>
            <script type="text/javascript">
                alert("Data berhasil dihapus");
                window.location.href="?page=<?= $page ?>";
            </script>
        <?php
    } else {
        ?>
            <script type="text/javascript">
                alert("Data gagal dihapus");
                window.location.href="?page=<?= $page ?>";
            </script>
        <?php
    }
}
?>