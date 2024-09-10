<?php
include "../../akses/koneksi.php";

$tgl_bayar = $_POST['tgl_bayar'];
$bayar = $_POST['i_bayar'];
$id_nota2 = $_POST['id_nota2'];
$page = $_POST['page'];
$filter = $_POST['filter'];
$h_filter = $_POST['h_filter'];

$sql = mysqli_query($koneksi, "INSERT INTO pembayaran (id_nota, tgl_pembayaran, bayar) VALUE ('$id_nota2', '$tgl_bayar', '$bayar')");

if ($sql) {
?>
    <script type="text/javascript">
        alert("Data berhasil disimpan");
        window.location.href = "../../index.php?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>";
    </script>
<?php
} else {
?>
    <script type="text/javascript">
        alert("Data gagal disimpan");
        window.location.href = "../../index.php?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>";
    </script>
<?php
}
?>