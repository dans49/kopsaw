<?php
require_once '../../akses/koneksi.php';

if ($_GET['action'] == "table_data") {
    $page = isset($_POST['page']) ? $_POST['page'] : '';
    $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
    $f_pelanggan = isset($_POST['f_pelanggan']) ? $_POST['f_pelanggan'] : '';
    $h_filter = isset($_POST['h_filter']) ? $_POST['h_filter'] : '';


    $columns = array(
        0 => 'tgl_nota',
        1 => 'id_nota',
        2 => 'nama_pelanggan',
        3 => 'nama_barang',
        4 => 'harga_satuan_jual',
        5 => 'diskon',
        6 => 'harga_diskon',
        7 => 'jumlah_barang',
        8 => 'total_penjualan',
        9 => 'pic',
        10 => 'nama',
    );


    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];
    $search = $_POST['search']['value'];


    if ($h_filter == "" && $f_pelanggan == "") {
        if (empty($search)) {
            $query = mysqli_query($koneksi, "SELECT * FROM penjualan
            LEFT JOIN nota ON nota.id_nota=penjualan.id_nota
            LEFT JOIN barang ON barang.id_barang=penjualan.id_barang
            LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
            LEFT JOIN user ON user.id_user=nota.id_user
            ORDER BY nota.id_nota DESC
            LIMIT $limit 
            OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT count(id_penjualan) as jumlah, sum(total_penjualan) as total FROM penjualan
            LEFT JOIN nota ON nota.id_nota=penjualan.id_nota");
            $datacount = mysqli_fetch_array($querycount);

            $totalData = $datacount['jumlah'];
            $gettotal = $datacount['total'];
            //
        } else {
            $query = mysqli_query($koneksi, "SELECT * FROM penjualan
            LEFT JOIN nota ON nota.id_nota=penjualan.id_nota
            LEFT JOIN barang ON barang.id_barang=penjualan.id_barang
            LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
            LEFT JOIN user ON user.id_user=nota.id_user
            WHERE penjualan.id_nota LIKE '%$search%' 
            OR pelanggan.nama_pelanggan LIKE '%$search%' 
            OR barang.nama_barang LIKE '%$search%' 
            OR user.nama LIKE '%$search%' 
            ORDER BY nota.id_nota DESC
            LIMIT $limit 
            OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT count(id_penjualan) as jumlah, sum(total_penjualan) as total FROM penjualan
            LEFT JOIN nota ON nota.id_nota=penjualan.id_nota
            LEFT JOIN barang ON barang.id_barang=penjualan.id_barang
            LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
            LEFT JOIN user ON user.id_user=nota.id_user
            WHERE penjualan.id_nota LIKE '%$search%' 
            OR pelanggan.nama_pelanggan LIKE '%$search%' 
            OR barang.nama_barang LIKE '%$search%' 
            OR user.nama LIKE '%$search%' ");
            $datacount = mysqli_fetch_array($querycount);

            $totalData = $datacount['jumlah'];
            $gettotal = $datacount['total'];
        }
    } else {
        if ($f_pelanggan != "") {
            $fp = "AND nota.id_pelanggan='$f_pelanggan'";
        }

        if (empty($search)) {

            $query = mysqli_query($koneksi, "SELECT * FROM penjualan
            LEFT JOIN nota ON nota.id_nota=penjualan.id_nota
            LEFT JOIN barang ON barang.id_barang=penjualan.id_barang
            LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
            LEFT JOIN user ON user.id_user=nota.id_user
            WHERE nota.tgl_nota LIKE '$h_filter%' $fp
            ORDER BY nota.id_nota DESC
            LIMIT $limit 
            OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT count(id_penjualan) as jumlah, sum(total_penjualan) as total FROM penjualan
            LEFT JOIN nota ON nota.id_nota=penjualan.id_nota
            WHERE nota.tgl_nota LIKE '$h_filter%' $fp");
            $datacount = mysqli_fetch_array($querycount);

            $totalData = $datacount['jumlah'];
            $gettotal = $datacount['total'];
            //
        } else {
            $query = mysqli_query($koneksi, "SELECT * FROM penjualan
            LEFT JOIN nota ON nota.id_nota=penjualan.id_nota
            LEFT JOIN barang ON barang.id_barang=penjualan.id_barang
            LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
            LEFT JOIN user ON user.id_user=nota.id_user
            WHERE nota.tgl_nota LIKE '$h_filter%' $fp
            AND (penjualan.id_nota LIKE '%$search%' 
            OR pelanggan.nama_pelanggan LIKE '%$search%' 
            OR barang.nama_barang LIKE '%$search%' 
            OR user.nama LIKE '%$search%' )
            ORDER BY nota.id_nota DESC
            LIMIT $limit 
            OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT count(id_penjualan) as jumlah, sum(total_penjualan) as total FROM penjualan
            LEFT JOIN nota ON nota.id_nota=penjualan.id_nota
            LEFT JOIN barang ON barang.id_barang=penjualan.id_barang
            LEFT JOIN pelanggan ON pelanggan.id_pelanggan=nota.id_pelanggan
            LEFT JOIN user ON user.id_user=nota.id_user
            WHERE nota.tgl_nota LIKE '$h_filter%' $fp
            AND (penjualan.id_nota LIKE '%$search%' 
            OR pelanggan.nama_pelanggan LIKE '%$search%' 
            OR barang.nama_barang LIKE '%$search%' 
            OR user.nama LIKE '%$search%' )");
            $datacount = mysqli_fetch_array($querycount);

            $totalData = $datacount['jumlah'];
            $gettotal = $datacount['total'];
        }
    }

    $totalFiltered = $totalData;

    $data = array();
    if (!empty($query)) {
        $no = $start + 1;
        while ($r = mysqli_fetch_array($query)) {
            $nestedData['no'] = $no;
            $nestedData['tgl_nota'] = date("d-m-Y", strtotime($r['tgl_nota']));
            $nestedData['id_nota'] = $r['id_nota'];
            $nestedData['nama_pelanggan'] = $r['nama_pelanggan'];
            $nestedData['nama_barang'] = $r['nama_barang'];
            $nestedData['harga_satuan_jual'] = ($r['harga_satuan_jual'] != 0) ? number_format($r['harga_satuan_jual'], 0, ',', '.') : 0;
            $nestedData['diskon'] = ($r['diskon'] != 0) ? number_format($r['diskon'], 0, ',', '.') : 0;
            $nestedData['harga_diskon'] = number_format($r['harga_satuan_jual'] - $r['diskon'], 0, ',', '.');
            $nestedData['jumlah_barang'] = ($r['jumlah_barang'] != 0) ? number_format($r['jumlah_barang'], 0, ',', '.') : 0;
            $nestedData['total_penjualan'] = ($r['total_penjualan'] != 0) ? number_format($r['total_penjualan'], 0, ',', '.') : 0;
            $nestedData['pic'] = $r['pic'];
            $nestedData['nama'] = $r['nama'];


            $data[] = $nestedData;
            $no++;
        }
    }

    $json_data = array(
        "draw"            => intval($_POST['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data,

        "totalPenjualan" => number_format($gettotal, 0, ',', '.')
    );

    echo json_encode($json_data);
}
