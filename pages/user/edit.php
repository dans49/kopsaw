<div id="edit_user<?= $data_user['id_user'] ?>" class="modal fade text-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah user content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-primary text-white">
                <span class="modal-title"><i class="fa fa-edit fa-xs"></i> Edit <?= $page ?></span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" required value="<?= $data_user['nama']; ?>" autofocus>
                        <input type="hidden" class="form-control" name="id_user" required readonly value="<?= $data_user['id_user']; ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" required value="<?= $data_user['username']; ?>" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" required value="<?= $data_user['password']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" required value="<?= $data_user['email']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" required value="<?= $data_user['alamat']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Gambar</label><br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                        <input name="gambar" type="file" accept=".jpg, .jpeg, .png">
                        <input name="gambar_awal" type="hidden" value="<?= $data_user['gambar']; ?>">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="e_user" class="btn btn-primary btn-icon-split btn-sm">
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
if (isset($_POST['e_user'])) {
    $id_user = $_POST['id_user'];
    $nama = ucwords($_POST['nama']);
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $gambar = $_FILES['gambar']['name'];
    $sumber = $_FILES['gambar']['tmp_name'];
    $gambar_awal = $_POST['gambar_awal'];

    if ($gambar == "") {
        $sql_update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', username='$username', password='$password', email='$email', alamat='$alamat' WHERE id_user='$id_user'");
    } else {
        unlink("assets/img/user/".$gambar_awal);
        $sql_update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', username='$username', password='$password', email='$email', alamat='$alamat', gambar='$gambar' WHERE id_user='$id_user'");
        $upload = move_uploaded_file($sumber, "assets/img/user/" . $gambar);
    }

    if ($sql_update) {
        $upload = move_uploaded_file($sumber, "assets/img/user/" . $gambar);
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