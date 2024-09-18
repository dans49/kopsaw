<?php
// $id = $_SESSION['admin']['id_member'];
// $hasil = $lihat -> member_edit($id);
?>
<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        <p>Edit Data Berhasil !</p>
    </div>
<?php } ?>
<?php if (isset($_GET['remove'])) { ?>
    <div class="alert alert-danger">
        <p>Hapus Data Berhasil !</p>
    </div>
<?php } ?>
<div class="row">
    <div class="col-sm-4">
        <div class="card card-primary mb-3">
            <div class="card-header bg-info text-white">
                <i class="fa fa-search"></i> Cari Barang
            </div>
            <div class="card-body">
                <input type="text" id="cari" class="form-control" name="cari" placeholder="Masukan : Kode / Nama Barang  [ENTER]">
            </div>
        </div>

    </div>
    <div class="col-sm-8">
        <div class="card card-info mb-3">
            <div class="card-header bg-info text-white">
                <i class="fa fa-list"></i> Hasil Pencarian
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="hasil_cari"></div>
                    <div id="tunggu"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-header bg-info text-white">
                <h5><i class="fa fa-shopping-cart"></i> KASIR
                    <a class="btn btn-danger btn-sm float-right"
                        onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="index.php?page=kasir&empty=1">
                        <b><span class="fa fa-trash"></span> Reset Keranjang</b></a>
                </h5>
            </div>
            <div class="card-body">
                <div id="keranjang" class="table-responsive">
                    <table class="table table-bordered w-100" id="example1">
                        <thead>
                            <tr>
                                <th> No</th>
                                <th> Nama Barang</th>
                                <th> Harga</th>
                                <th> Diskon</th>
                                <th> Jumlah</th>
                                <th> Total</th>
                                <th> Kasir</th>
                                <th> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_bayar = 0;
                            $no = 1;
                            $sqltemp = "SELECT _temp_penjualan.* , barang.id_barang, barang.nama_barang, barang.harga_beli, user.id_user, user.nama from _temp_penjualan 
                                        left join barang on barang.id_barang=_temp_penjualan.id_barang 
                                        left join user on user.id_user=_temp_penjualan.id_user
                                        ORDER BY id_temp";
                            $hasil_penjualan = mysqli_query($koneksi, $sqltemp);

                            while ($isi = mysqli_fetch_array($hasil_penjualan)) {
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $isi['nama_barang']; ?></td>

                                    <td>
                                        <input type="text" name="harjul" class="form-control harjul" value="<?= $isi['harga_jual'] ?>" data-id="<?php echo $isi['id_temp']; ?>" data-id-barang="<?php echo $isi['id_barang']; ?>" data-user="<?php echo $isi['id_user']; ?>" data-jumlah="<?php echo $isi['jumlah_barang']; ?>" readonly>
                                        <input type="hidden" name="harjul2" class="form-control" id="harjul2<?= $no ?>" data-idhar="<?php echo $isi['id_temp']; ?>" value="<?= $isi['harga_jual'] ?>">
                                    </td>
                                    <!-- aksi ke table penjualan -->
                                    <form method="POST" action="fungsi/edit/edit.php?jual=jual">
                                        <td>
                                            <input type="number" name="diskon" value="<?php echo $isi['diskon']; ?>" class="form-control cdskn udskn<?= $no ?>" data-id="<?php echo $isi['id_temp']; ?>" data-id-barang="<?php echo $isi['id_barang']; ?>" data-user="<?php echo $isi['id_user']; ?>" data-jumlah="<?php echo $isi['jumlah_barang']; ?>">
                                        </td>
                                        <td>
                                            <input type="number" name="jumlah" value="<?php echo $isi['jumlah_barang']; ?>" class="form-control cjml jmldskn<?= $no ?>" data-id="<?php echo $isi['id_temp']; ?>" data-id-barang="<?php echo $isi['id_barang']; ?>" data-user="<?php echo $isi['id_user']; ?>" data-diskon="<?php echo $isi['diskon']; ?>">
                                            <input type="hidden" name="id" value="<?php echo $isi['id_temp']; ?>" class="form-control">
                                            <input type="hidden" name="id_barang" value="<?php echo $isi['id_barang']; ?>" class="form-control">

                                        </td>

                                        <td>
                                            Rp. <span class="totaltemp<?= $no ?>" data-id3="<?= $isi['id_temp']; ?>"><?php echo number_format($isi['total'], 0, ',', '.'); ?></span>,-
                                            <input type="hidden" name="totaltemp" id="coltotal<?= $no ?>" data-id2="<?php echo $isi['id_temp']; ?>" value="<?php echo $isi['total']; ?>" class="form-control">
                                        </td>
                                        <td><?php echo $isi['nama']; ?></td>
                                        <td>
                                            <!-- <button type="submit" class="btn btn-warning">Update</button> -->
                                    </form>
                                    <!-- aksi ke table penjualan -->
                                    <a href="index.php?page=kasir&remove=1&id=<?php echo $isi['id_temp']; ?>&brg=<?php echo $isi['id_barang']; ?>&jml=<?php echo $isi['jumlah_barang']; ?>" class="btn btn-danger"><i class="fa fa-times"></i>
                                    </a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                $diskon_total += $isi['diskon'];
                                $total_bayar += $isi['total'];
                            }
                            ?>
                            <input type="hidden" name="no" value="<?php echo $no; ?>" class="gnomor">
                        </tbody>
                    </table>
                    <br />
                    <?php
                    $sqljml = "SELECT SUM(total_penjualan) as bayar FROM penjualan";
                    $hasil = mysqli_fetch_array(mysqli_query($koneksi, $sqljml));
                    ?>
                    <div id="kasirnya">
                        <?php
                        // $idnota = getnota($koneksi,'2024-09-09');
                        // echo $idnota.' Kodenya';
                        // proses bayar dan ke nota
                        if (!empty($_GET['nota'] == 'yes')) {
                            $total = $_POST['total'];
                            $bayar = $_POST['bayar'] ?? '0';
                            $kembali = $_POST['kembalian'];
                            $pic = $_POST['pic'];
                            $jml2 = 0;
                            $tot2 = 0;
                            $status = $_POST['status'] ?? 'Lunas';
                            if (!empty($bayar) || $bayar == '0') {
                                $hitung = $bayar - $total;

                                $id_barang = $_POST['id_barang'];
                                $id_user = $_POST['id_user'];
                                $hsb = $_POST['harga_satuan_beli'];
                                $hsj = $_POST['harga_satuan_jual'];
                                $getplg = $_POST['plg'];
                                $jumlah = $_POST['jumlah'];
                                $diskon = $_POST['diskon'];
                                $total = $_POST['total1'];
                                $periode = $_POST['tgl'];

                                $idnota = getnota($koneksi, $periode);
                                $jumlah_dipilih = count($id_barang);
                                if ($status == 'Hutang') {
                                    $jb = 'credit';
                                } else {
                                    $jb = 'cash';
                                }

                                for ($x = 0; $x < $jumlah_dipilih; $x++) {

                                    $idjual = getpenjualan($koneksi);
                                    $sql = "INSERT INTO penjualan (id_penjualan,id_barang,harga_satuan_beli,harga_satuan_jual,id_user,id_nota,diskon,jenis_bayar,jumlah_barang,total_penjualan) VALUES('$idjual','$id_barang[$x]','$hsb[$x]', '$hsj[$x]', '$id_user[$x]','$idnota','$diskon[$x]','$jb','$jumlah[$x]','$total[$x]')";
                                    $row = mysqli_query($koneksi, $sql);

                                    // ubah stok barang
                                    $sql_barang = "SELECT * FROM barang WHERE id_barang = '$id_barang[$x]'";
                                    $row_barang = mysqli_query($koneksi, $sql_barang);
                                    $hsl = mysqli_fetch_array($row_barang);

                                    $stok = $hsl['stok'];
                                    $idb  = $hsl['id_barang'];

                                    $total_stok = $stok - $jumlah[$x];
                                    // echo $total_stok;
                                    $sql_stok = "UPDATE barang SET stok = '$total_stok' WHERE id_barang = '$idb'";
                                    $row_stok = mysqli_query($koneksi, $sql_stok);

                                    $jml2 = $jml2 + $jumlah[$x];
                                    $tot2 = $tot2 + $total[$x];
                                    // $perio = $periode;
                                    $user = $id_user[$x];
                                }

                                $sql2 = "INSERT INTO nota (id_nota,id_user,id_pelanggan,total_transaksi,status_nota,tgl_nota,pic) VALUES('$idnota','$user','$getplg','$tot2','$status','$periode','$pic')";
                                $row2 = mysqli_query($koneksi, $sql2);

                                $id = $id_barang[$i];
                                $total_pembelian = $total[$i];
                                if ($status == 'Lunas') {
                                    $query_bayar = "INSERT into pembayaran (id_nota, tgl_pembayaran, bayar) values ('$idnota','$periode','$bayar')";
                                    $row3 = mysqli_query($koneksi, $query_bayar);
                                }

                                echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
                            }
                        }
                        ?>
                        <form method="POST" id="subkasir" action="#"> <!-- index.php?page=jual&nota=yes#kasirnya -->
                            <?php
                            $no2 = 1;
                            $sqltemp2 = "SELECT _temp_penjualan.* , barang.id_barang, barang.nama_barang, barang.harga_beli, user.id_user, user.nama from _temp_penjualan 
                                        left join barang on barang.id_barang=_temp_penjualan.id_barang 
                                        left join user on user.id_user=_temp_penjualan.id_user
                                        ORDER BY id_temp";
                            $hasilp = mysqli_query($koneksi, $sqltemp2);
                            while ($isi = mysqli_fetch_array($hasilp)) {

                            ?>
                                <input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang']; ?>">
                                <input type="hidden" name='harga_satuan_beli[]' value='<?php echo $isi['harga_beli']; ?>'>
                                <input type="hidden" name='harga_satuan_jual[]' value='<?= $isi['harga_jual']; ?>'>
                                <input type="hidden" name="id_user[]" value="<?php echo $isi['id_user']; ?>">
                                <input type="hidden" name="jumlah[]" class="cjml2<?= $no2 ?>" value="<?php echo $isi['jumlah_barang']; ?>">
                                <input type="hidden" name="diskon[]" class="cdskn<?= $no2 ?>" value="<?php echo $isi['diskon']; ?>">
                                <input type="hidden" name="total1[]" class="totalg1<?= $no2 ?>" value="<?php echo $isi['total']; ?>">
                                <input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input']; ?>">
                                <input type="hidden" name="periode[]" value="<?php echo date('Y-m-d'); ?>">
                            <?php $no++;
                                $no2++;
                            } ?>
                            <div class="row mb-3">
                                <div class="col-sm-6">&nbsp;</div>
                                <div class="col-sm-2 text-right">Tanggal</div>
                                <div class="col-sm-4"><input type="date" class="form-control" name="tgl" value="<?= date('Y-m-d') ?>" required></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">&nbsp;</div>
                                <div class="col-sm-2 text-right">PIC (Yang mengambil)</div>
                                <div class="col-sm-4"><input type="text" class="form-control" name="pic" required></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">&nbsp;</div>
                                <div class="col-sm-2 text-right">Sub Total</div>
                                <div class="col-sm-4"><input type="text" id="totals" class="form-control" name="total" value="<?php echo $total_bayar; ?>" readonly></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">&nbsp;</div>
                                <div class="col-sm-2 text-right">Pelanggan *Opsi</div>
                                <div class="col-sm-2">

                                    <select class="form-control select2get pilpelanggan" name="plg" required>
                                        <option value="">-Pilih-</option>
                                        <?php
                                        $sqlplg = "select * from pelanggan";
                                        $getplg = mysqli_query($koneksi, $sqlplg);
                                        while ($gdata = mysqli_fetch_array($getplg)) {
                                            echo "<option value='$gdata[id_pelanggan]'>$gdata[nama_pelanggan]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Tambah</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">&nbsp;</div>
                                <div class="col-sm-2 text-right">Bayar</div>
                                <div class="col-sm-2"><input type="number" id="dibayar" class="form-control" name="bayar" value="<?php echo $bayar; ?>" required min="<?php echo $total_bayar - $total_diskon; ?>" placeholder="<?php echo $total_bayar; ?>"></div>
                                <div class="col-sm-2">
                                    <!-- <?php if (!empty($_GET['nota'] == 'yes')) { ?>
                                    <a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual">
                                    <b>RESET</b></a><?php } ?> -->
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input paylater" id="customSwitch1" data-on-text="ON" data-off-text="OFF">
                                        <label class="custom-control-label" for="customSwitch1">Bayar Nanti</label>
                                    </div>
                                    <input type="hidden" id="status" name="status" value="">

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">&nbsp;</div>
                                <div class="col-sm-2 text-right">Kembali</div>
                                <div class="col-sm-3"><input type="text" readonly id="kembalian" name="kembalian" class="form-control" value="<?php echo $hitung; ?>"></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-shopping-cart"></i> Proses Transaksi</button>
                                    <!-- <a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member']; ?>
                                    &bayar=<?php echo $bayar; ?>&kembali=<?php echo $hitung; ?>" target="_blank" class="btn btn-secondary btn-sm btnprint">
                                        <i class="fa fa-print"></i> Print Invoice
                                </a> -->
                                </div>
                            </div>
                        </form>
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['beli_barang'])) {
        include "pages/kasir/tambahpesanan.php";
    }
    if (isset($_GET['remove'])) {
        $brg = htmlentities($_GET['brg']);
        $sqlI = "select*from barang where id_barang='$brg'";
        $rowI = mysqli_query($koneksi, $sqlI);
        $hasil = mysqli_fetch_array();

        $id = htmlentities($_GET['id']);
        $sql = "DELETE FROM _temp_penjualan WHERE id_temp='$id'";
        $row = mysqli_query($koneksi, $sql);

        echo '<script>window.location="index.php?page=kasir"</script>';
    }

    if (isset($_GET['empty'])) {
        $sql = "DELETE FROM _temp_penjualan WHERE id_user='$_SESSION[admin]'";
        $row = mysqli_query($koneksi, $sql);
        echo '<script>window.location="index.php?page=kasir"</script>';
    }
    ?>


    <!-- ======================== MODAL =================== -->

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style=" border-radius:0px;">
                <div class="modal-header" style="background:#285c64;color:#fff;">
                    <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <table class="table table-striped bordered">
                            <?php
                            $sqlformat = 'SELECT * FROM pelanggan ORDER BY id_pelanggan DESC';
                            $row = mysqli_query($koneksi, $sqlformat);
                            $hasilformat = mysqli_fetch_array($row);

                            $urut = substr($hasilformat['id_pelanggan'], 2, 4);
                            $tambah = (int) $urut + 1;
                            $format = "PW" . sprintf('%04d', $tambah);
                            ?>
                            <tr>
                                <td>ID Pelanggan</td>
                                <td><input type="text" readonly="readonly" required value="<?php echo $format; ?>"
                                        class="form-control" name="id"></td>
                            </tr>
                            <tr>
                                <td>Nama Pelanggan*</td>
                                <td><input type="text" placeholder="Nama Pelanggan" required class="form-control"
                                        name="nama"></td>
                            </tr>
                            <tr>
                                <td>NAK*</td>
                                <td><input type="text" placeholder="Identitas" class="form-control" name="identitas"></td>
                            </tr>
                            <tr>
                                <td>Nomor HP*</td>
                                <td><input type="text" placeholder="Telepon" required class="form-control"
                                        name="telepon" maxlength="15"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="t_pelanggan" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                            Data</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div id="myKasir" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style=" border-radius:0px;">
                <div class="modal-header" style="background:#285c64;color:#fff;">
                    <h5 class="modal-title"> Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="fungsi/tambah/tambah.php?pelanggan_jual=tambah" method="POST">
                    <div class="modal-body">
                        <center>KPRI Sawangan</center>
                        <center>Bappelitbangda Kab. Tasikmalaya</center>
                        <center>Tanggal : <?php echo date("j F Y, H:i"); ?></center>
                        <table width="100%" class="mt-2">
                            <tr>
                                <td>TRX</td>
                                <td>: <span id="trx"></span></td>
                            </tr>
                            <tr>
                                <td>Kasir </td>
                                <td>: <?php echo htmlentities($_SESSION['nama']); ?></td>
                            </tr>
                        </table>
                        <table class="table bordered mt-2">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Barang</td>
                                    <td>Harga</td>
                                    <td>Diskon</td>
                                    <td>Jumlah</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody id="dataTrx"></tbody>
                        </table>
                        <div class="pull-right">

                            Total : Rp. <span id="gettotal"></span>,-
                            <br />
                            Bayar : Rp. <span id="getbayar"></span>,-
                            <br />
                            Kembali : Rp. <span id="getkembali"></span>,-
                        </div>
                        <div class="clearfix"></div>
                        <center>
                            <p>Terima Kasih Telah berbelanja di toko kami !</p>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <!-- <a href="" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</a> -->
                        <a href="#" id="printinv" target="_blank" class="btn btn-secondary btn-sm btnprint">
                            <i class="fa fa-print"></i> Print Invoice
                        </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <?php
    if (isset($_POST['t_pelanggan'])) {
        $nama_pelanggan = ucwords($_POST['nama']);
        $identitas = $_POST['identitas'];
        $telepon = $_POST['telepon'];
        // Ambil nomor urut terakhir dari id_pelanggan
        $query = mysqli_query($koneksi, "SELECT id_pelanggan FROM pelanggan ORDER BY id_pelanggan DESC LIMIT 1");
        $data = mysqli_fetch_array($query);

        // Jika belum ada data, mulai dari 1
        $last_number = $data ? intval(substr($data['id_pelanggan'], 2)) + 1 : 1;

        // Buat kode unik baru dengan format PW"nomor urut"
        $id_pelanggan = "PW" . str_pad($last_number, 3, '0', STR_PAD_LEFT);

        // Insert ke database
        $sql = mysqli_query($koneksi, "INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, identitas, telepon, status_data) VALUES ('$id_pelanggan', '$nama_pelanggan', '$identitas', '$telepon', 'AKTIF')");

        if (!$sql) {
            echo "Error: " . mysqli_error($koneksi);
        } else {
    ?>
            <script type="text/javascript">
                alert("Data berhasil disimpan");
                window.location.href = "?page=kasir";
            </script>
    <?php
        }
    }
    ?>

    <script>
        // AJAX call for autocomplete 
        $(document).ready(function() {
            $("#cari").change(function() {
                // console.log("tes")
                $.ajax({
                    type: "POST",
                    url: "pages/kasir/tampilbarang.php",
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function() {
                        $("#hasil_cari").hide();
                        $("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
                    },
                    success: function(html) {
                        // console.log(html);
                        $("#tunggu").html('');
                        $("#hasil_cari").show();
                        $("#hasil_cari").html(html);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#subkasir').on('submit', function(e) {
                e.preventDefault();
                let idm = "<?php echo $_SESSION['admin']; ?>"

                $.ajax({
                    type: 'POST',
                    url: "index.php?page=kasir&nota=yes",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $.ajax({
                            type: 'GET',
                            url: "akses/apisnota.php?userid=" + idm,
                            dataType: 'json',
                            success: function(res) {
                                // console.log(res)
                                $("#trx").html(res.nota)
                                $("#gettotal").html(res.total)
                                $("#getbayar").html(res.bayar)
                                $("#getkembali").html(res.kembali)
                                $("#dataTrx").html(res.penjualan)
                                $("#printinv").prop("href", "print.php?nota=" + res.nota)
                            }
                        })
                        $("#myKasir").modal('show')
                    }
                });
            });

            $('#myKasir').on('hidden.bs.modal', function() {
                $.ajax({
                    url: "index.php?page=kasir&empty=1",
                    method: "GET",
                    success: function() {
                        location.reload();
                    }
                })
            })
        });


        // // ======== KONDISI AWAL =======
        $("#kembalian").val('0')
        $(".btnprint").hide();
        // // =============================


        $(document).on('keyup', '#dibayar', function() {
            // var total = $("#totals").val()
            var total = $("#totals").val()
            var bayar = $("#dibayar").val()
            var getang = 0;
            getang = bayar - total;

            $("#kembalian").val(getang);
        });

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        var nomor = $('.gnomor').val()

        $(document).on('change', '.paylater', function(e) {
            let cek = e.target.checked;

            if (cek == true) {
                $("#dibayar").prop('readonly', true);
                $("#dibayar").prop('required', false);
                $("#dibayar").val(0);
                $("#status").val('Hutang');
                $(".btnprint").show();

                $(".harjul").attr('readonly', false)
            } else {
                $("#dibayar").prop('readonly', false);
                $("#dibayar").prop('required', true);
                $("#status").val('');
                $(".btnprint").hide();

                $(".harjul").attr('readonly', true)
            }
            $("#kembalian").val('0');
        });

        $(document).on('keyup', '#dibayar', function() {
            let balik = $("#kembalian").val();

            if (balik < '0') {
                $("#status").val('');
                $(".btnprint").hide();
            } else {
                $("#status").val('Lunas');
                $(".btnprint").show();
            }
        });

        $(document).on('change keyup', '.cjml', function() {
            var idt = $(this).data('id')
            var idbarang = $(this).data('id-barang')
            var userid = $(this).data('user')
            var jml = $(this).val()

            for (var i = 1; i < nomor; i++) {
                var harjul = $('#harjul2' + i).val()
                if (idt == $('#coltotal' + i).data('id2')) {
                    var diskon = $('.udskn' + i).val()
                    // console.log($('#coltotal'+i).val())
                    $.ajax({
                        url: "akses/apieditkasir.php",
                        method: "POST",
                        data: {
                            id: idt,
                            id_barang: idbarang,
                            jumlah: jml,
                            harjul: harjul,
                            diskon: diskon,
                        },
                        success: function(res) {

                            if (jml < 1) {
                                alert("Minimal Harus memilih 1 jumlah barang atau dihapus!")
                            } else {
                                if (res == 1) {
                                    // AJAX RELOAD HTML
                                    $.ajax({
                                        type: 'GET',
                                        url: "akses/apitemppenjualan.php?userid=" + userid + "&idt=" + idt,
                                        dataType: 'json',
                                        success: function(response) {
                                            // console.log(response.data[4])
                                            for (var j = 1; j < nomor; j++) {
                                                if (idt == $('.totaltemp' + j).data('id3')) {
                                                    $(".totaltemp" + j).html(numberWithCommas(response.data[6]))
                                                    $(".totalg1" + j).val(response.data[6])
                                                    $(".cdskn" + j).val(response.data[4])
                                                    $(".cjml2" + j).val(response.data[3])
                                                }
                                            }
                                        }

                                    })


                                    $.ajax({
                                        type: 'GET',
                                        url: "akses/apitempjualall.php?userid=" + userid,
                                        dataType: 'json',
                                        success: function(response) {
                                            // console.log(response.data[0])
                                            $("#totals").val(response.data[0])
                                            $("#dibayar").attr('placeholder', response.data[0]);
                                        }

                                    })


                                } else {
                                    alert("Keranjang Melebihi Stok Barang Anda !")
                                    location.reload()
                                }
                            }
                        }
                    })
                }
            }
        });

        $(document).on('change keyup', '.cdskn', function() {
            var idt7 = $(this).data('id')
            var idbarang7 = $(this).data('id-barang')
            var userid7 = $(this).data('user')
            var diskon = $(this).val()


            for (var i = 1; i < nomor; i++) {
                var harjul = $('#harjul2' + i).val()
                if (idt7 == $('#coltotal' + i).data('id2')) {
                    var jml7 = $('.jmldskn' + i).val()
                    // console.log($('#coltotal'+i).val())
                    $.ajax({
                        url: "akses/apieditkasir.php",
                        method: "POST",
                        data: {
                            id: idt7,
                            id_barang: idbarang7,
                            jumlah: jml7,
                            harjul: harjul,
                            diskon: diskon,
                        },
                        success: function(res) {


                            if (res == 1) {
                                // AJAX RELOAD HTML
                                $.ajax({
                                    type: 'GET',
                                    url: "akses/apitemppenjualan.php?userid=" + userid7 + "&idt=" + idt7,
                                    dataType: 'json',
                                    success: function(response) {
                                        // console.log(response.data[4])
                                        for (var j = 1; j < nomor; j++) {
                                            if (idt7 == $('.totaltemp' + j).data('id3')) {
                                                $(".totaltemp" + j).html(numberWithCommas(response.data[6]))
                                                $(".totalg1" + j).val(response.data[6])
                                                $(".cdskn" + j).val(response.data[4])
                                                $(".cjml2" + j).val(response.data[3])
                                            }
                                        }
                                    }

                                })

                                $.ajax({
                                    type: 'GET',
                                    url: "akses/apitempjualall.php?userid=" + userid7,
                                    dataType: 'json',
                                    success: function(response) {
                                        // console.log(response.data[4])
                                        $("#totals").val(response.data[0])
                                        $("#dibayar").attr('placeholder', response.data[0]);
                                    }

                                })

                            }
                        }
                    })
                }
            }
        });


        $(document).on('change keyup', '.harjul', function() {
            var idt2 = $(this).data('id')
            var idbarang2 = $(this).data('id-barang')
            var userid2 = $(this).data('user')
            var harjul = $(this).val()


            for (var i = 1; i < nomor; i++) {
                if (idt2 == $('#harjul2' + i).data('idhar')) {
                    $('#harjul2' + i).val(harjul)
                }

                if (idt2 == $('#coltotal' + i).data('id2')) {
                    var jml2 = $('.jmldskn' + i).val()
                    var diskon = $('.udskn' + i).val()
                    // console.log($('#coltotal'+i).val())
                    $.ajax({
                        url: "akses/apieditkasir.php",
                        method: "POST",
                        data: {
                            id: idt2,
                            id_barang: idbarang2,
                            jumlah: jml2,
                            diskon: diskon,
                            harjul: harjul,
                        },
                        success: function(res) {


                            if (res == 1) {
                                // AJAX RELOAD HTML
                                $.ajax({
                                    type: 'GET',
                                    url: "akses/apitemppenjualan.php?userid=" + userid2 + "&idt=" + idt2,
                                    dataType: 'json',
                                    success: function(response) {
                                        // console.log(response.data[4])
                                        for (var j = 1; j < nomor; j++) {
                                            if (idt2 == $('.totaltemp' + j).data('id3')) {
                                                $(".totaltemp" + j).html(numberWithCommas(response.data[6]))
                                                $(".totalg1" + j).val(response.data[6])
                                                $(".cjml2" + j).val(response.data[3])
                                            }
                                        }
                                    }

                                })

                                $.ajax({
                                    type: 'GET',
                                    url: "akses/apitempjualall.php?userid=" + userid2,
                                    dataType: 'json',
                                    success: function(response) {
                                        // console.log(response.data[4])
                                        $("#totals").val(response.data[0])
                                        $("#dibayar").attr('placeholder', response.data[0]);
                                    }

                                })

                            }
                        }
                    })
                }
            }
        });


        $(document).on('change', '.pilpelanggan', function() {
            var pil = $(".pilpelanggan").val()
            $.ajax({
                url: 'akses/apicekpelanggan.php?idpil=' + pil,
                method: 'GET',
                dataType: "JSON",
                success: function(response) {
                    // console.log(response.status)
                    if (response.status == 'TIDAK') {
                        $(".paylater").attr('disabled', true)
                    } else {
                        $(".paylater").attr('disabled', false)
                    }
                }
            })
        });

        //To select country name
    </script>