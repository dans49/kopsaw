<button href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_pelanggan">
    <span class="icon text-white-50">
        <i class="fas fa-plus-circle"></i>
    </span>
    <span class="text"> Tambah Data</span>
</button>

<br><br>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="dataTable">
                <thead>
                    <tr class="bg-success text-white">
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>NAK</th>
                        <th>Nomor HP</th>
                        <th>Status</th>
                        <th class="text-right" data-orderable="false" width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;

                        $sql_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");
                        while ($data_pelanggan = mysqli_fetch_assoc($sql_pelanggan)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data_pelanggan['nama_pelanggan']; ?></td>
                        <td><?= $data_pelanggan['identitas']; ?></td>
                        <td><?= $data_pelanggan['telepon']; ?></td>
                        <td><?= $data_pelanggan['status_data']; ?></td>
                        <td class="text-right">
                            <button href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#edit_pelanggan<?= $data_pelanggan['id_pelanggan']; ?>">
                                <span class="icon text-white">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text"> Edit</span>
                            </button>
                            <?php include "edit.php"; ?>

                            <button href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#hapus_pelanggan<?= $data_pelanggan['id_pelanggan']; ?>">
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

<?php include "tambah.php" ?>