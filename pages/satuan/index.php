<form form method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td style="width:25pc;">
            <input type="text" class="form-control" required name="nama_satuan" placeholder="Masukan satuan">
            </td>
            <td style="padding-left:10px;">
                <button type="submit" name="t_satuan" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text"> Tambah Data </span>
                </button>
            </td>
        </tr>
    </table>
</form>


<br><br>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="dataTable">
                <thead>
                    <tr class="bg-success text-white">
                        <th>No.</th>
                        <th>Satuan</th>
                        <th>Status</th>
                        <th>Tanggal Input</th>
                        <th class="text-right" data-orderable="false" width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;

                        $sql_satuan = mysqli_query($koneksi, "SELECT * FROM satuan ORDER BY id_satuan ASC");
                        while ($data_satuan = mysqli_fetch_assoc($sql_satuan)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data_satuan['nama_satuan']; ?></td>
                        <td><?= $data_satuan['status_satuan']; ?></td>
                        <td><?= $data_satuan['waktu_data']; ?></td>
                        <td class="text-right">
                            <button href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#edit_satuan<?= $data_satuan['id_satuan']; ?>">
                                <span class="icon text-white">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text"> Edit</span>
                            </button>
                            <?php include "edit.php"; ?>

                            <button href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#hapus_satuan<?= $data_satuan['id_satuan']; ?>">
                                <span class="icon text-white">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text"> Hapus</span>
                            </button>
                            <?php include "hapus.php"; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>


<?php
if (isset($_POST['t_satuan'])) {
    $nama_satuan = $_POST['nama_satuan'];
    $sql = mysqli_query($koneksi, "INSERT INTO satuan (nama_satuan) VALUES ('$nama_satuan')");

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