<div id="modalHapus" class="modal fade text-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah nota content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-danger text-white">
                <span class="modal-title"><i class="fa fa-trash fa-xs"></i> Hapus Nota</span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <span class="mb-2">Anda akan menghapus data Transaksi ini.</span>
                    <input type="hidden" name="id_nota" id="id_nota">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="h_nota" class="btn btn-danger btn-icon-split btn-sm">
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
if (isset($_POST['h_nota'])) {
    $id_nota = $_POST['id_nota'];

    $sql_barang = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_nota='$id_nota'");
    while ($barang = mysqli_fetch_assoc($sql_barang)) {
        $update_stok = mysqli_query($koneksi, "UPDATE barang SET stok=stok+'$barang[jumlah_barang]' WHERE id_barang='$barang[id_barang]'");
    }

    $sql_hapus = mysqli_query($koneksi, "DELETE FROM nota WHERE id_nota='$id_nota'");
    $sql_hapus1 = mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id_nota='$id_nota'");
    $sql_hapus2 = mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_nota='$id_nota'");

    if ($sql_hapus) {
?>
        <script type="text/javascript">
            alert("Data berhasil dihapus");
            window.location.href = "?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>&f_pelanggan=<?= $f_pelanggan ?>&f_status=<?= $f_status ?>";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Data gagal dihapus");
            window.location.href = "?page=<?= $page ?>&filter=<?= $filter ?>&h_filter=<?= $h_filter ?>&f_pelanggan=<?= $f_pelanggan ?>&f_status=<?= $f_status ?>";
        </script>
<?php
    }
}
?>