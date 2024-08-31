<button href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_user">
    <span class="icon text-white-50">
        <i class="fas fa-plus-circle"></i>
    </span>
    <span class="text"> Tambah Data</span>
</button>

<a href="index.php?page=<?= $page ?>" class="btn btn-info btn-icon-split btn-sm">
    <span class="icon text-white-50">
        <i class="fas fa-sync-alt"></i>
    </span>
    <span class="text"> Refresh Data</span>
</a>

<br><br>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="dataTable">
                <thead>
                    <tr class="bg-success text-white">
                        <th>No.</th>
                        <th data-orderable="false">Gambar</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th class="text-right" data-orderable="false" width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;

                        $sql_user = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user ASC");
                        while ($data_user = mysqli_fetch_assoc($sql_user)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <img src="assets/img/user/<?= $data_user['gambar'];?>" width="60px">
                        </td>
                        <td><?= $data_user['nama']; ?></td>
                        <td><?= $data_user['username']; ?></td>
                        <td><?= $data_user['email']; ?></td>
                        <td><?= $data_user['alamat']; ?></td>
                        <td class="text-right">
                            <button href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#edit_user<?= $data_user['id_user']; ?>">
                                <span class="icon text-white">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text"> Edit</span>
                            </button>
                            <?php include "edit.php"; ?>

                            <button href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#hapus_user<?= $data_user['id_user']; ?>">
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