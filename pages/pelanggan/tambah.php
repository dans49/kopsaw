<div id="tambah_pelanggan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal tambah pelanggan content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header bg-success text-white">
                <span class="modal-title"><i class="fa fa-plus fa-xs"></i> Tambah <?= $page ?></span>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan" required>
                    </div>

                        <div class="form-group">
                            <label for="">NAK</label>
                            <input type="number" class="form-control" name="identitas" required>
                        </div>

                        <div class="form-group">
                            <label for="">Nomor HP</label>
                            <input type="number" class="form-control" name="telepon" required>
                        </div>

                        <div class="form-group">
                         <label for="">Status</label>
                         <select class="form-control" name="status_data" required>
                         <option value="AKTIF" <?= ($data_satuan['status_data'] == 'AKTIF') ? 'selected' : ''; ?>>AKTIF</option>
                         <option value="TIDAK" <?= ($data_satuan['status_data'] == 'TIDAK') ? 'selected' : ''; ?>>TIDAK</option>
                         </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="t_pelanggan" class="btn btn-success btn-icon-split btn-sm">
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
if (isset($_POST['t_pelanggan'])) {
    $nama_pelanggan = ucwords($_POST['nama_pelanggan']);
    $identitas = $_POST['identitas'];
    $telepon = $_POST['telepon'];
    $status = $_POST['status_data'];
// Ambil nomor urut terakhir dari id_pelanggan
$query = mysqli_query($koneksi, "SELECT id_pelanggan FROM pelanggan ORDER BY id_pelanggan DESC LIMIT 1");
$data = mysqli_fetch_array($query);

// Jika belum ada data, mulai dari 1
$last_number = $data ? intval(substr($data['id_pelanggan'], 2)) + 1 : 1;

// Buat kode unik baru dengan format PW"nomor urut"
$id_pelanggan = "PW" . str_pad($last_number, 4, '0', STR_PAD_LEFT);

// Insert ke database
    $sql = mysqli_query($koneksi, "INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, identitas, telepon, status_data) VALUES ('$id_pelanggan', '$nama_pelanggan', '$identitas', '$telepon', '$status')");

    if (!$sql) {
        echo "Error: " . mysqli_error($koneksi);
    } else {
        ?>
        <script type="text/javascript">
            alert("Data berhasil disimpan");
            window.location.href="?page=<?= $page ?>";
        </script>
        <?php
    }
}
?>