<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../../akses/koneksi.php";

$tgl_bayar = $_POST['tgl_bayar'];
$bayar = $_POST['i_bayar'];
$id_nota2 = $_POST['id_nota2'];
$page = $_POST['page'];
$filter = $_POST['filter'];
$h_filter = $_POST['h_filter'];
$f_status = $_POST['f_status'];
$f_pelanggan = $_POST['f_pelanggan'];

$sql = mysqli_query($koneksi, "INSERT INTO pembayaran (id_nota, tgl_pembayaran, bayar) VALUE ('$id_nota2', '$tgl_bayar', '$bayar')");

$cek_pembayaran = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(bayar) as totalbayar FROM pembayaran WHERE id_nota='$id_nota2'"));
$cek_total = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM nota WHERE id_nota='$id_nota2'"));

if ($cek_pembayaran['totalbayar'] >= $cek_total['total_transaksi']) {
    $updt_status = mysqli_query($koneksi, "UPDATE nota SET status_nota='Lunas' WHERE id_nota='$id_nota2'");
}

if ($sql) {

?>
    <script type="text/javascript">
        alert("Data berhasil disimpan");
        window.location.href = "../../index.php?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>&f_pelanggan=<?= $f_pelanggan ?>&f_status=<?= $f_status ?>";
    </script>
<?php } else { ?>
    <script type="text/javascript">
        alert("Data gagal disimpan");
        window.location.href = "../../index.php?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>&f_pelanggan=<?= $f_pelanggan ?>&f_status=<?= $f_status ?>";
    </script>
<?php } ?>