<div id="tambah_user" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah user content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-success text-white">
                <span class="modal-title"><i class="fa fa-plus fa-xs"></i> Tambah <?= $page ?></span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label><br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                        <input name="gambar" type="file" accept=".jpg, .jpeg, .png">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="t_user" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text"> Tambah Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
if (isset($_POST['t_user'])) {
    $nama = ucwords($_POST['nama']);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $gambar = $_FILES['gambar']['name'];
    $sumber = $_FILES['gambar']['tmp_name'];

    $sql = mysqli_query($koneksi, "INSERT INTO user (nama, username, password, email, alamat, gambar) VALUES ('$nama', '$username', '$password', '$email', '$alamat', '$gambar')");

    if ($sql) {
        $upload = move_uploaded_file($sumber, "assets/img/user/" . $gambar);
        ?>
            <script type="text/javascript">
                alert("Data berhasil disimpan");
                window.location.href="?page=<?= $page ?>";
            </script>
        <?php
    } else {
        ?>
            <script type="text/javascript">
                alert("Data gagal disimpan");
                window.location.href="?page=<?= $page ?>";
            </script>
        <?php
    }
}
?>