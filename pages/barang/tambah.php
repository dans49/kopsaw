<div id="tambah_barang" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah barang content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-success text-white">
                <span class="modal-title"><i class="fa fa-plus fa-xs"></i> Tambah <?= $page ?></span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" required>
                    </div>

                    <div class="form-group">
                            <label for="">Stok</label>
                            <input type="number" class="form-control" name="stok" required>
                    </div>

                    <div class="form-group">
                            <label for="">Harga Beli</label>
                            <input type="number" class="form-control" name="harga_beli" required>
                    </div>
                    

                    <div class="form-group">
                        <label for="">Harga Jual</label>
                        <input type="number" class="form-control" name="harga_jual" required>
                    </div>

                    <div class="form-group">
                        <label for="">Satuan</label>
                        <select class="form-control" name="satuan_barang" required>
                            <option value="">Pilih Satuan</option>
                            <?php
                            $query_satuan = mysqli_query($koneksi, "SELECT id_satuan, nama_satuan FROM satuan ORDER BY nama_satuan ASC");
                            while ($data_satuan = mysqli_fetch_assoc($query_satuan)) {
                                echo "<option value='".$data_satuan['nama_satuan']."'>".$data_satuan['nama_satuan']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="t_barang" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text"> Tambah Data</span>
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['t_barang'])) {
    $nama_barang = $_POST['nama_barang'];
    $stok = intval($_POST['stok']);
    $harga_beli = intval($_POST['harga_beli']);
    $harga_jual = intval($_POST['harga_jual']);
    $satuan_barang = $_POST['satuan_barang'];

    // Ambil nomor urut terakhir dari id_barang
    $query = mysqli_query($koneksi, "SELECT id_barang FROM barang ORDER BY id_barang DESC LIMIT 1");
    $data = mysqli_fetch_array($query);

    // Jika belum ada data, mulai dari 1
    $last_number = $data ? intval(substr($data['id_barang'], 2)) + 1 : 1;

    // Buat kode unik baru dengan format BR"nomor urut"
    $id_barang = "BR" . str_pad($last_number, 3, '0', STR_PAD_LEFT);

    // Insert ke database
    $sql = mysqli_query($koneksi, "INSERT INTO barang (id_barang, nama_barang, stok, harga_beli, harga_jual, satuan_barang) VALUES ('$id_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', '$satuan_barang')");

    if ($sql) {
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
