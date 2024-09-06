<!-- form buat filter gais -->
<form method="GET" action="index.php">
    <input type="hidden" name="page" value="nota_penjualan">
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="tanggal_mulai">Dari</label>
            <input type="date" id="tanggal mulai" name="tanggal_mulai" class="form-control" value="<?= isset($_GET['tanggal_mulai']) ? htmlspecialchars($_GET['tanggal_mulai']) : '' ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="tanggal_selesai">Sampai</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="<?= isset($_GET['tanggal_selesai']) ? htmlspecialchars($_GET['tanggal_selesai']) : '' ?>">
        </div>
        <div class="form-group ">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-primary btn-sm  form-control">
                <span class="icon text-white">
                <i class="fas fa-filter"></i>
                </span>
                <span class="text"> Filter </span>
            </button>
        </div>
    </div>
</form>

<!-- view data -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="dataTable">
                <thead>
                    <tr style="background:#DFF0D8;color:#333;">
                        <th> No </th>
                        <th> ID Transaksi</th>
                        <th> Nama Pelanggan</th>
                        <th style="width:10%;"> Tanggal</th>
                        <th> Total Belanja</th>
                        <th style="width:10%;"> Pembayaran</th>
                        <th> Kasir</th>
                        <th style="width:10%;"> Status</th>
                        <th class="text-right" data-orderable="false">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tanggal_mulai = isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '';
                    $tanggal_selesai = isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : '';
                    $where_clause = '';
                    if (!empty($tanggal_mulai) && !empty($tanggal_selesai)) {
                        $where_clause = "WHERE nota.tgl_nota BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
                    }
                    $sql_nota = mysqli_query($koneksi, "
                    SELECT 
                        nota.id_nota, 
                        pelanggan.nama_pelanggan, 
                        nota.tgl_nota, 
                        nota.total_transaksi, 
                        nota.bayar, 
                        user.nama AS kasir, 
                        nota.status_nota
                    FROM 
                        nota
                    JOIN 
                        pelanggan ON nota.id_pelanggan = pelanggan.id_pelanggan
                    JOIN 
                        user ON nota.id_user = user.id_user
                    $where_clause
                    ORDER BY 
                        nota.id_nota ASC");
                    $no = 1;
                    while ($data_nota = mysqli_fetch_assoc($sql_nota)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data_nota['id_nota'];?></td>
                        <td><?= $data_nota['nama_pelanggan'];?></td>
                        <td><?= $data_nota['tgl_nota']; ?></td>
                        <td><?= $data_nota['total_transaksi']; ?></td>
                        <td><?= $data_nota['bayar']; ?></td>
                        <td><?= $data_nota['kasir']; ?></td>
                        <td>
                            <?php if($data_nota['status_nota'] == 'LUNAS'){?>
                            <button class="badge badge-success"> LUNAS </button>
                            <?php }else{?>
                            <button class="badge badge-warning"> PIUTANG </button>
                            <?php }?>
                        </td>
                        <td class="text-right">
                            <!-- <button href="#" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#edit_nota<?= $data_nota['id_nota']; ?>">
                                <span class="icon text-white">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text"> Edit</span>
                            </button> -->
                            <?php include "edit.php"; ?>

                            <button href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#hapus_nota<?= $data_nota['id_nota']; ?>">
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