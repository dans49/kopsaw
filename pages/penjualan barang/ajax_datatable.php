<?php
require_once '../../akses/koneksi.php';

if ($_GET['action'] == "table_data") {
    $page = isset($_POST['page']) ? $_POST['page'] : '';
    $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
    $h_filter = isset($_POST['h_filter']) ? $_POST['h_filter'] : '';


    $columns = array(
        0 => 'id_barang',
        1 => 'nama_barang',
        2 => 'jumlah_terjual',
        3 => 'modal',
        4 => 'total_terjual',
        5 => 'keuntungan',
    );


    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];
    $search = $_POST['search']['value'];


    if (empty($filter)) {
        if (empty($search)) {
            $query = mysqli_query($koneksi, "SELECT 
                            pj.*,
                            b.nama_barang,
                            n.tgl_nota,
                            SUM(pj.harga_satuan_beli * pj.jumlah_barang) AS total_modal,
                            SUM(pj.total_penjualan) AS total_penjualan,
                            (SUM(pj.total_penjualan) - SUM(pj.harga_satuan_beli * pj.jumlah_barang)) AS keuntungan,
                            SUM(pj.jumlah_barang) AS total_jumlah_terjual
                            FROM penjualan pj
                            JOIN barang b ON pj.id_barang = b.id_barang
                            JOIN nota n ON pj.id_nota = n.id_nota
                            GROUP BY pj.id_barang  
                            ORDER BY `b`.`nama_barang` ASC
                            LIMIT $limit 
                            OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT 
                            COUNT(DISTINCT pj.id_barang) AS jumlah
                            FROM penjualan pj
                            JOIN nota n ON pj.id_nota = n.id_nota");
            $datacount = mysqli_fetch_array($querycount);
            $totalData = $datacount['jumlah'];
        } else {
            $query = mysqli_query($koneksi, "SELECT 
                            pj.*,
                            b.nama_barang,
                            n.tgl_nota,
                            SUM(pj.harga_satuan_beli * pj.jumlah_barang) AS total_modal,
                            SUM(pj.total_penjualan) AS total_penjualan,
                            (SUM(pj.total_penjualan) - SUM(pj.harga_satuan_beli * pj.jumlah_barang)) AS keuntungan,
                            SUM(pj.jumlah_barang) AS total_jumlah_terjual
                            FROM penjualan pj
                            JOIN barang b ON pj.id_barang = b.id_barang
                            JOIN nota n ON pj.id_nota = n.id_nota
                            WHERE pj.id_nota LIKE '%$search%'
                            OR b.nama_barang LIKE '%$search%'
                            GROUP BY pj.id_barang  
                            ORDER BY `b`.`nama_barang` ASC
                            LIMIT $limit 
                            OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT 
                            COUNT(DISTINCT pj.id_barang) AS jumlah
                            FROM penjualan pj
                            JOIN barang b ON pj.id_barang = b.id_barang
                            JOIN nota n ON pj.id_nota = n.id_nota
                            WHERE pj.id_nota LIKE '%$search%'
                            OR b.nama_barang LIKE '%$search%'");
            $datacount = mysqli_fetch_array($querycount);
            $totalData = $datacount['jumlah'];
        }
    } else {
        if (empty($search)) {
            $query = mysqli_query($koneksi, "SELECT 
                            pj.*,
                            b.nama_barang,
                            n.tgl_nota,
                            SUM(pj.harga_satuan_beli * pj.jumlah_barang) AS total_modal,
                            SUM(pj.total_penjualan) AS total_penjualan,
                            (SUM(pj.total_penjualan) - SUM(pj.harga_satuan_beli * pj.jumlah_barang)) AS keuntungan,
                            SUM(pj.jumlah_barang) AS total_jumlah_terjual
                            FROM penjualan pj
                            JOIN barang b ON pj.id_barang = b.id_barang
                            JOIN nota n ON pj.id_nota = n.id_nota
                            WHERE n.tgl_nota LIKE '$h_filter%'
                            GROUP BY pj.id_barang  
                            ORDER BY `b`.`nama_barang` ASC
                            LIMIT $limit 
                            OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT 
                            COUNT(DISTINCT pj.id_barang) AS jumlah
                            FROM penjualan pj
                            JOIN nota n ON pj.id_nota = n.id_nota
                            WHERE n.tgl_nota LIKE '$h_filter%'");
            $datacount = mysqli_fetch_array($querycount);
            $totalData = $datacount['jumlah'];
        } else {
            $query = mysqli_query($koneksi, "SELECT 
                            pj.*,
                            b.nama_barang,
                            n.tgl_nota,
                            SUM(pj.harga_satuan_beli * pj.jumlah_barang) AS total_modal,
                            SUM(pj.total_penjualan) AS total_penjualan,
                            (SUM(pj.total_penjualan) - SUM(pj.harga_satuan_beli * pj.jumlah_barang)) AS keuntungan,
                            SUM(pj.jumlah_barang) AS total_jumlah_terjual
                            FROM penjualan pj
                            JOIN barang b ON pj.id_barang = b.id_barang
                            JOIN nota n ON pj.id_nota = n.id_nota
                            WHERE n.tgl_nota LIKE '$h_filter%'
                            AND (pj.id_nota LIKE '%$search%'
                            OR b.nama_barang LIKE '%$search%')
                            GROUP BY pj.id_barang  
                            ORDER BY `b`.`nama_barang` ASC
                            LIMIT $limit 
                            OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT 
                            COUNT(DISTINCT pj.id_barang) AS jumlah
                            FROM penjualan pj
                            JOIN barang b ON pj.id_barang = b.id_barang
                            JOIN nota n ON pj.id_nota = n.id_nota
                            WHERE n.tgl_nota LIKE '$h_filter%'
                            AND (pj.id_nota LIKE '%$search%'
                            OR b.nama_barang LIKE '%$search%')");
            $datacount = mysqli_fetch_array($querycount);
            $totalData = $datacount['jumlah'];
        }
    }


    $totalFiltered = $totalData;

    $data = array();
    if (!empty($query)) {
        $no = $start + 1;
        while ($r = mysqli_fetch_array($query)) {


            $nestedData['no'] = $no;
            $nestedData['id_barang'] = $r['id_barang'];
            $nestedData['nama_barang'] = $r['nama_barang'];
            $nestedData['jumlah_terjual'] = ($r['total_jumlah_terjual'] != 0) ? number_format($r['total_jumlah_terjual']) : 0;
            $nestedData['modal'] = ($r['total_modal'] != 0) ? number_format($r['total_modal']) : 0;
            $nestedData['total_terjual'] = ($r['total_penjualan'] != 0) ? number_format($r['total_penjualan']) : 0;
            $nestedData['keuntungan'] = ($r['keuntungan'] != 0) ? number_format($r['keuntungan']) : 0;


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
