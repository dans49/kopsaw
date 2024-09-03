<div id="register" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah user content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-primary text-white">
                <span class="modal-title"><i class="fa fa-plus fa-xs"></i> Register</span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" required autofocus>
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="register" class="btn btn-primary btn-icon-split btn-sm">
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
if (isset($_POST['register'])) {
    $nama = ucwords($_POST['nama']);
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $sql = mysqli_query($koneksi, "INSERT INTO user (nama, username, password, email, alamat, gambar) VALUES ('$nama', '$username', '$password', '$email', '$alamat', '')");

    if ($sql) {
        ?>
            <script type="text/javascript">
                alert("Akun berhasil dibuat");
                window.location.href="index.php";
            </script>
        <?php
    } else {
        ?>
            <script type="text/javascript">
                alert("Data gagal dibuat");
                window.location.href="index.php";
            </script>
        <?php
    }
}
?>