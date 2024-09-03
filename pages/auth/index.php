<?php
session_start();
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../akses/koneksi.php";

if ($_SESSION['admin']) {
    header("location:../../index.php");
} else {
    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user"));
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login - KPRI Sawangan Kab. Tasikmalaya</title>
    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
						<div class="p-5">
							<div class="text-center">
								<h4 class="h4 text-gray-900 mb-4"><b>Login KPRI Sawangan</b></h4>
							</div>
							<form class="form-login" method="POST">
								<div class="form-group">
									<input type="text" class="form-control form-control-user" name="username"
										placeholder="Username" autofocus>
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-user" name="password"
										placeholder="Password">
								</div>
								<button class="btn btn-primary btn-block" name="login" type="submit">
                                    <i class="fa fa-lock"></i> 
									Sign In
                                </button>
                            </form>

                            <?php if($cek==0) { ?>
							<div class="text-center">
								<a class="small" data-toggle="modal" data-target="#register">Buat Akun!</a>
							</div>
                            <?php } ?>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>
</body>
</html>

<?php
include "register.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user where  username='$username'"));

    if (password_verify($password, $data['password'])) {
        session_start();
        $_SESSION['admin'] = $data["id_user"];

        ?>
        <script type="text/javascript">
            alert("Akun berhasil login");
            window.location.href="../../index.php";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Username atau passwor salah");
            window.location.href="index.php";
        </script>
        <?php
    }
}
}
?>