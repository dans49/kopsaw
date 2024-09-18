<?php
require_once '../../akses/koneksi.php';

if ($_GET['action'] == "table_data") {


    $columns = array(
        0 => 'id_barang',
        1 => 'nama_barang',
        2 => 'harga_beli',
        3 => 'harga_jual',
        4 => 'stok',
        5 => 'id_barang',
    );

    $querycount = mysqli_query($koneksi, "SELECT count(id_barang) as jumlah FROM barang  WHERE stok < 3");
    $datacount = mysqli_fetch_array($querycount);


    $totalData = $datacount['jumlah'];

    $totalFiltered = $totalData;

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];
    $stok_kurang = 3;

    if (empty($_POST['search']['value'])) {
        $query = mysqli_query($koneksi, "SELECT * FROM barang 
                                    LEFT JOIN satuan ON barang.id_satuan=satuan.id_satuan WHERE stok < $stok_kurang order by stok $dir LIMIT $limit OFFSET $start");
    } else {
        $search = $_POST['search']['value'];
        $query = mysqli_query($koneksi, "SELECT * FROM barang 
                                    LEFT JOIN satuan ON barang.id_satuan=satuan.id_satuan WHERE stok < $stok_kurang AND 
                                                                        id_barang LIKE '%$search%' 
                                                                        or nama_barang LIKE '%$search%' 
                                                                        or nama_satuan LIKE '%$search%' 
                                                                        or harga_beli LIKE '%$search%' 
                                                                        or harga_jual LIKE '%$search%' 
                                                                        order by stok $dir 
                                                                        LIMIT $limit 
                                                                        OFFSET $start");

        $querycount = mysqli_query($koneksi, "SELECT count(id_barang) as jumlah FROM barang
                                         LEFT JOIN satuan ON barang.id_satuan=satuan.id_satuan WHERE stok < $stok_kurang 
                                                                                            AND id_barang LIKE '%$search%' 
                                                                                            OR nama_barang LIKE '%$search%' 
                                                                                            or nama_satuan LIKE '%$search%' 
                                                                                            or harga_beli LIKE '%$search%' 
                                                                                            or harga_jual LIKE '%$search%'");


        $datacount = mysqli_fetch_array($querycount);
        $totalFiltered = $datacount['jumlah'];
    }

    $data = array();
    if (!empty($query)) {
        $no = $start + 1;
        while ($r = mysqli_fetch_array($query)) {
            $nestedData['no'] = $no;
            $nestedData['id_barang'] = $r['id_barang'];
            $nestedData['nama_barang'] = $r['nama_barang'];
            if ($r['stok'] == '0') {
                $nestedData['stok'] = "<button class='btn btn-danger btn-sm'> Habis</button>";
            } else {
                $nestedData['stok'] = number_format($r['stok']);
            }
            $nestedData['harga_beli'] = ($r['harga_beli'] == 0) ? 0 : number_format($r['harga_beli']);
            $nestedData['harga_jual'] = ($r['harga_jual'] == 0) ? 0 : number_format($r['harga_jual']);
            $nestedData['satuan'] = $r['nama_satuan'];
            if ($r['stok'] <= 3) {
                $nestedData['aksi'] = "<form method='POST' enctype='multipart/form-data'>";
                $nestedData['aksi'] .= "<input type='number' name='restok' class='form-control form-control-sm' placeholder='Jumlah restok'>";
                $nestedData['aksi'] .= "<input type='hidden' name='id_barang' value='$r[id_barang]'>";
                $nestedData['aksi'] .= "<input type='hidden' name='stok' value='$r[stok]'>";
                $nestedData['aksi'] .= "<button class='btn btn-primary btn-icon-split btn-sm' name='restok_barang'>";
                $nestedData['aksi'] .= "<span class='icon text-white'><i class='fas fa-recycle'></i></span><span class='text'>Restok</span></button> ";
                $nestedData['aksi'] .= "<button class='btn btn-danger btn-icon-split btn-sm' name='hapus_restok' onclick='return confirm(\"Yakin ingin menghapus data?\")'>";
                $nestedData['aksi'] .= "<span class='icon text-white'><i class='fas fa-trash'></i></span><span class='text'> Hapus</span></button>";
                $nestedData['aksi'] .= "</form>";
            } else {
                $nestedData['aksi'] = "<button href='#' class='btn btn-primary btn-icon-split btn-sm editbarang' data-toggle='modal' data-target='#edit_barang' data-idbarang='$r[id_barang]'>";
                $nestedData['aksi'] .= "<span class='icon text-white'><i class='fas fa-edit'></i></span><span class='text'> Edit</span></button> ";
                $nestedData['aksi'] .= "<button href='#' class='btn btn-danger btn-icon-split btn-sm delbarang' data-toggle='modal' data-target='hapus_barang' data-idbdel='$r[id_barang]'>";
                $nestedData['aksi'] .= "<span class='icon text-white'><i class='fas fa-trash'></i></span><span class='text'> Hapus</span></button>";
            }

            $data[] = $nestedData;
            $no++;
        }
    }

    $json_data = array(
        "draw"            => intval($_POST['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    );

    echo json_encode($json_data);
}
