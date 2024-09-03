<div class="row">
	<div class="col-sm-3">
		<div class="card card-primary">
			<div class="card-header">
				<h5 class="mt-2"><i class="fa fa-user"></i> Foto Pengguna </h5>
			</div>
			<div class="card-body">
				<img src="assets/img/user/<?= $data_user['gambar'];?>" alt="#" class="img-fluid w-100" />
			</div>
			<div class="card-footer">
				<form method="POST" action="" enctype="multipart/form-data">
					<input type="file" accept="image/*" name="gambar" required>
					<br><br>	
					<button type="submit" class="btn btn-primary btn-md"  name="g_foto">
						<i class="fas fa-edit mr-1"></i>  Ganti Foto
					</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="card card-primary">
			<div class="card-header">
				<h5 class="mt-2"><i class="fa fa-user"></i> Kelola Pengguna </h5>
			</div>
			<div class="card-body">
				<div class="box-content">
					<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
						<fieldset>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Nama </label>
								<div class="input-group">
									<input type="text" class="form-control" style="border-radius:0px;" name="nama"
										data-items="4" value="<?= $data_user['nama']; ?>"
										required="required" />
								</div>
							</div>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Username </label>
								<div class="input-group">
									<input type="text" class="form-control" style="border-radius:0px;" name="username"
										data-items="4" value="<?= $data_user['username']; ?>"
										required="required" readonly/>
								</div>
							</div>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Email </label>
								<div class="input-group">
									<input type="email" class="form-control" style="border-radius:0px;" name="email"
										value="<?= $data_user['email']; ?>" required="required" />
								</div>
							</div>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Alamat </label>
								<div class="controls">
									<textarea name="alamat" rows="3" class="form-control" style="border-radius:0px;"
										required="required"><?= $data_user['alamat']; ?></textarea>
								</div>
							</div>
							<button class="btn btn-primary" name="g_profile" >
								<i class="fas fa-edit"></i> Ubah Profil
							</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="card card-primary">
			<div class="card-header">
				<h5 class="mt-2"><i class="fa fa-lock"></i> Ganti Password</h5>
			</div>
			<div class="card-body">
				<div class="box-content">
					<form class="form-horizontal" method="POST" action="">
						<fieldset>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Password Lama</label>
								<div class="input-group">
									<input type="password" class="form-control" style="border-radius:0px;" name="p_lama" data-items="4" placeholder="Masukan password lama!" required/>
								</div>
							</div>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Password Baru</label>
								<div class="input-group">
									<input type="password" class="form-control" placeholder="Masukan password baru!" id="pass" name="p_baru" data-items="4" value="" required />
								</div>
							</div>
							<div class="control-group mb-3">
								<label class="control-label" for="typeahead">Konfirmasi Password Baru</label>
								<div class="input-group">
									<input type="password" class="form-control" placeholder="Masukan kembali password baru!" id="pass" name="kp_baru" data-items="4" value="" required/>
								</div>
							</div>
							<button type="submit" class="btn btn-primary" name="g_password"><i class="fas fa-edit"></i> Ubah Password</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php

if (isset($_POST['g_foto'])) {
    $gambar = $_FILES['gambar']['name'];
    $sumber = $_FILES['gambar']['tmp_name'];

	$sql_updt_gambar = mysqli_query($koneksi, "UPDATE user SET gambar='$gambar' WHERE id_user='$data_user[id_user]'");

	if ($sql_updt_gambar) {
		$upload = move_uploaded_file($sumber, "assets/img/user/" . $gambar);
		?>
			<script type="text/javascript">
				alert("Foto berhasil diupdate");
				window.location.href="?page=<?= $page ?>";
			</script>
		<?php
	} else {
		?>
		<script type="text/javascript">
			alert("Foto gagal diupdate");
			window.location.href="?page=<?= $page ?>";
		</script>
	<?php
	}
}

if (isset($_POST['g_profile'])) {
    $nama = ucwords($_POST['nama']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

	$sql_updt_profile = mysqli_query($koneksi, "UPDATE user SET nama='$nama', username='$username', email='$email', alamat='$alamat' WHERE id_user='$data_user[id_user]'");

	if ($sql_updt_profile) {
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


if (isset($_POST['g_password'])) {
    $p_lama = $_POST['p_lama'];
    $p_baru = $_POST['p_baru'];
    $kp_baru = $_POST['kp_baru'];

	if (password_verify($p_lama, $data_user['password'])) {
        if ($p_baru == $kp_baru) {
            $password = password_hash($p_baru, PASSWORD_DEFAULT);
            $sql = mysqli_query($koneksi, "UPDATE user SET password='$password' WHERE id_user='$data_user[id_user]'");

			?>
				<script type="text/javascript">
					alert("Password berhasil diupdate");
					window.location.href="?page=<?= $page ?>";
				</script>
			<?php
        } else {
            ?>
			<script type="text/javascript">
				alert("Password tidak sama");
				window.location.href="?page=<?= $page ?>";
			</script>
		<?php
        }
    } else {
        ?>
			<script type="text/javascript">
				alert("Password salah");
				window.location.href="?page=<?= $page ?>";
			</script>
		<?php
    }
}
?>