<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

include "akses/koneksi.php";

$page = $_GET['page'];
$aksi = $_GET['aksi'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KPRI Sawangan Bappelitbangda</title>

    <link rel="icon" type="image/x-icon" href="assets/img/kpri-sawangan.jpeg">

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-cash-register"></i>
                </div>
                <div class="sidebar-brand-text mx-3">KPRI SAWANGAN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($page=='') ? 'active' : '' ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item <?= ($page=='barang' || $page=='satuan' || $page=='pelanggan') ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collaps1" aria-expanded="true" aria-controls="collaps1">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Data Master</span>
                </a>
                <div id="collaps1" class="collapse <?= ($page=='barang' || $page=='satuan' || $page=='pelanggan') ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($page=='barang') ? 'active' : '' ?>" href="?page=barang">Barang</a>
                        <a class="collapse-item <?= ($page=='satuan') ? 'active' : '' ?>" href="?page=satuan">Satuan</a>
                        <a class="collapse-item <?= ($page=='pelanggan') ? 'active' : '' ?>" href="?page=pelanggan">Pelangan</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Transaksi
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item  <?= ($page=='kasir') ? 'active' : '' ?>">
                <a class="nav-link" href="?page=kasir">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Kasir</span>
                </a>
            </li>
            <li class="nav-item <?= ($page=='nota_penjualan' || $page=='penjualan_barang') ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collaps2"
                    aria-expanded="true" aria-controls="collaps2">
                    <i class="fas fa-fw fa-desktop"></i>
                    <span>Laporan</span>
                </a>
                <div id="collaps2" class="collapse <?= ($page=='nota_penjualan' || $page=='penjualan_barang') ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($page=='nota_penjualan') ? 'active' : '' ?>" href="?page=nota_penjualan">Nota Penjualan</a>
                        <a class="collapse-item <?= ($page=='penjualan_barang') ? 'active' : '' ?>" href="?page=penjualan_barang">Penjualan Barang</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= ($page=='user' || $page=='backup restore') ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
                <div id="collapse3" class="collapse <?= ($page=='user' || $page=='backup_restore') ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($page=='user') ? 'active' : '' ?>" href="?page=user">Data User</a>
                        <a class="collapse-item <?= ($page=='backup_restore') ? 'active' : '' ?>" href="?page=backup_restore">Backup & Restore</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <h5 class="d-lg-block d-none mt-2"><b>KPRI Sawangan - Bappelitbangda Kab. Tasikmalaya</b></h5>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small ml-2">Douglas McGee</span>
                                <i class="fas fa-angle-down"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="?page=profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                        if ($page=='') {
                            echo "<h4>Dashboard</h4><br>";
                        } else {
                            $exp = explode('_', $page);
                            $satukan = '';
                            for ($i=0; $i < count($exp); $i++) { 
                                $satukan .= $exp[$i].' ';
                            }
                            echo "<h4>Data ".ucwords($satukan)."</h4><br>";
                        }
                        

                        if ($page == "") {
                            if ($aksi == "") {
                                include "pages/dashboard.php";
                            }
                        }

                        if ($page == "profile") {
                            if ($aksi == "") {
                                include "pages/profile/index.php";
                            }
                            if ($aksi == "edit") {
                                include "pages/profile/edit.php";
                            }
                        }

                        if ($page == "barang") {
                            if ($aksi == "") {
                                include "pages/barang/index.php";
                            }
                            if ($aksi == "tambah") {
                                include "pages/barang/tambah.php";
                            }
                            if ($aksi == "edit") {
                                include "pages/barang/edit.php";
                            }
                            if ($aksi == "hapus") {
                                include "pages/barang/hapus.php";
                            }
                        }

                        if ($page == "satuan") {
                            if ($aksi == "") {
                                include "pages/satuan/index.php";
                            }
                            if ($aksi == "tambah") {
                                include "pages/satuan/tambah.php";
                            }
                            if ($aksi == "edit") {
                                include "pages/satuan/edit.php";
                            }
                            if ($aksi == "hapus") {
                                include "pages/satuan/hapus.php";
                            }
                        }

                        if ($page == "pelanggan") {
                            if ($aksi == "") {
                                include "pages/pelanggan/index.php";
                            }
                            if ($aksi == "tambah") {
                                include "pages/pelanggan/tambah.php";
                            }
                            if ($aksi == "edit") {
                                include "pages/pelanggan/edit.php";
                            }
                            if ($aksi == "hapus") {
                                include "pages/pelanggan/hapus.php";
                            }
                        }

                        if ($page == "user") {
                            if ($aksi == "") {
                                include "pages/user/index.php";
                            }
                            if ($aksi == "tambah") {
                                include "pages/user/tambah.php";
                            }
                            if ($aksi == "edit") {
                                include "pages/user/edit.php";
                            }
                            if ($aksi == "hapus") {
                                include "pages/user/hapus.php";
                            }
                        }

                        if ($page == "backup_restore") {
                            if ($aksi == "") {
                                include "pages/backup_restore/index.php";
                            }
                            if ($aksi == "tambah") {
                                include "pages/backup_restore/tambah.php";
                            }
                            if ($aksi == "edit") {
                                include "pages/backup_restore/edit.php";
                            }
                            if ($aksi == "hapus") {
                                include "pages/backup_restore/hapus.php";
                            }
                        }
                    
                    ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; KPRI Sawangan Bappelitbangda 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <script>
    $(document).ready(function(){
        var now = $("#yearnow").val()
        $.ajax({
            url: "akses/apigetsumpenjualan.php?tahun="+now,
            method: "GET",
            dataType: 'json',
            success: function(response) {
                penjualanChart(response)
            }
        })

        $("#chartyear").on('change',function(){
            var thn = $("#chartyear").val()
            $.ajax({
                url: "akses/apigetsumpenjualan.php?tahun="+thn,
                method: "GET",
                dataType: 'json',
                success: function(response) {
                    resetChart()
                    penjualanChart(response)
                }
            })
        })
    })

    function resetChart() {
        $('#penjualan-chart').remove();
        $('.chartjs-size-monitor').remove();
        $('.cp').append("<canvas id='penjualan-chart' style='min-height: 250px; height: 450px; max-height: 550px; max-width: 100%;'></canvas>");
    }

    function penjualanChart(getdata) {
        var areaChartData = {
          labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'],
          datasets: [
            {
              label               : 'Penjualan Barang',
              backgroundColor     : 'rgba(60,141,188,0.9)',
              borderColor         : 'rgba(60,141,188,0.8)',
              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : getdata
            }
          ]
        }
        
        var barChartCanvas = $('#penjualan-chart').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        barChartData.datasets[0] = temp0

        var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return "Rp. "+tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            },
        }

        var barChart = new Chart(barChartCanvas, {
          type: 'bar', 
          data: barChartData,
          options: barChartOptions
        })
    }
    </script>

</body>

</html>