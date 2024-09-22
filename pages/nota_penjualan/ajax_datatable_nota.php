<?php
require_once '../../akses/koneksi.php';

if ($_GET['action'] == "table_data") {

    $page = isset($_POST['page']) ? $_POST['page'] : '';
    $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
    $f_pelanggan = isset($_POST['f_pelanggan']) ? $_POST['f_pelanggan'] : '';
    $h_filter = isset($_POST['h_filter']) ? $_POST['h_filter'] : '';
    $f_status = isset($_POST['f_status']) ? $_POST['f_status'] : '';

    $columns = array(
        0 => 'id_nota',
        1 => 'nama_pelanggan',
        2 => 'tgl_nota',
        3 => 'total_transaksi',
        4 => 'total_pembayaran',
        5 => 'piutang',
        6 => 'status',
        7 => 'pic',
        8 => 'kasir',
    );

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];
    $search = $_POST['search']['value'];

    if ($h_filter == "" && $f_pelanggan == "" && $f_status == "") {
        if (empty($search)) {
            $query = mysqli_query($koneksi, "SELECT 
                    n.*,
                    p.nama_pelanggan,
                    u.nama
                    FROM nota n
                    JOIN pelanggan p ON n.id_pelanggan = p.id_pelanggan
                    JOIN user u ON n.id_user = u.id_user
                    GROUP BY n.id_nota
                    ORDER BY n.id_nota DESC
                    LIMIT $limit 
                    OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT count(n.id_nota) as jumlah FROM nota n
                            JOIN pelanggan p ON n.id_pelanggan = p.id_pelanggan
                            JOIN user u ON n.id_user = u.id_user");
            $datacount = mysqli_fetch_array($querycount);
            $totalData = $datacount['jumlah'];
        } else {
            $query = mysqli_query($koneksi, "SELECT 
                    n.*,
                    p.nama_pelanggan,
                    u.nama
                    FROM nota n
                    JOIN pelanggan p ON n.id_pelanggan = p.id_pelanggan
                    JOIN user u ON n.id_user = u.id_user
                    WHERE n.id_nota LIKE '%$search%' 
                    OR p.nama_pelanggan LIKE '%$search%' 
                    OR n.tgl_nota LIKE '%$search%' 
                    OR n.status_nota LIKE '%$search%' 
                    OR n.pic LIKE '%$search%' 
                    OR u.nama LIKE '%$search%' 
                    ORDER BY n.id_nota DESC
                    LIMIT $limit 
                    OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT count(n.id_nota) as jumlah FROM nota n
                            JOIN pelanggan p ON n.id_pelanggan = p.id_pelanggan
                            JOIN user u ON n.id_user = u.id_user
                            WHERE n.id_nota LIKE '%$search%' 
                            OR p.nama_pelanggan LIKE '%$search%' 
                            OR n.tgl_nota LIKE '%$search%' 
                            OR n.status_nota LIKE '%$search%' 
                            OR n.pic LIKE '%$search%' 
                            OR u.nama LIKE '%$search%' ");
            $datacount = mysqli_fetch_array($querycount);
            $totalData = $datacount['jumlah'];
        }
    } else {
        if ($f_pelanggan != "") {
            $fp = "AND n.id_pelanggan='$f_pelanggan'";
        }
        if ($f_status != "") {
            $fs = "AND n.status_nota='$f_status'";
        }

        if (empty($search)) {
            $query = mysqli_query($koneksi, "SELECT 
                    n.*,
                    p.nama_pelanggan,
                    u.nama
                    FROM nota n
                    JOIN pelanggan p ON n.id_pelanggan = p.id_pelanggan
                    JOIN user u ON n.id_user = u.id_user
                    WHERE n.tgl_nota LIKE '$h_filter%' $fp $fs
                    ORDER BY n.id_nota DESC
                    LIMIT $limit 
                    OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT count(n.id_nota) as jumlah FROM nota n
                            JOIN pelanggan p ON n.id_pelanggan = p.id_pelanggan
                            JOIN user u ON n.id_user = u.id_user
                            WHERE n.tgl_nota LIKE '$h_filter%' $fp $fs");
            $datacount = mysqli_fetch_array($querycount);
            $totalData = $datacount['jumlah'];
        } else {
            $query = mysqli_query($koneksi, "SELECT 
                    n.*,
                    p.nama_pelanggan,
                    u.nama
                    FROM nota n
                    JOIN pelanggan p ON n.id_pelanggan = p.id_pelanggan
                    JOIN user u ON n.id_user = u.id_user
                    WHERE n.tgl_nota LIKE '$h_filter%' $fp $fs
                    AND (n.id_nota LIKE '%$search%' 
                    OR p.nama_pelanggan LIKE '%$search%' 
                    OR n.tgl_nota LIKE '%$search%' 
                    OR n.status_nota LIKE '%$search%' 
                    OR n.pic LIKE '%$search%' 
                    OR u.nama LIKE '%$search%')
                    ORDER BY n.id_nota DESC
                    LIMIT $limit 
                    OFFSET $start");

            $querycount = mysqli_query($koneksi, "SELECT count(n.id_nota) as jumlah FROM nota n
                            JOIN pelanggan p ON n.id_pelanggan = p.id_pelanggan
                            JOIN user u ON n.id_user = u.id_user
                            WHERE n.tgl_nota LIKE '$h_filter%' $fp $fs
                            AND (n.id_nota LIKE '%$search%' 
                            OR p.nama_pelanggan LIKE '%$search%' 
                            OR n.tgl_nota LIKE '%$search%' 
                            OR n.status_nota LIKE '%$search%' 
                            OR n.pic LIKE '%$search%' 
                            OR u.nama LIKE '%$search%') ");
            $datacount = mysqli_fetch_array($querycount);
            $totalData = $datacount['jumlah'];
        }
    }

    $totalFiltered = $totalData;

    $data = array();
    if (!empty($query)) {
        $no = $start + 1;
        while ($r = mysqli_fetch_array($query)) {
            $cek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(bayar) as t_bayar FROM pembayaran WHERE id_nota='$r[id_nota]'"));
            $piutang = $r['total_transaksi'] - $cek['t_bayar'];

            $status = (($r['status_nota'] == 'Lunas') ? "<center><button class='btn btn-success btn-sm'>Lunas</button></center>" : "<center><button class='btn btn-danger btn-sm'>Piutang</button></center>");

            $nestedData['no'] = $no;
            $nestedData['id_nota'] = $r['id_nota'];
            $nestedData['nama_pelanggan'] = $r['nama_pelanggan'];
            $nestedData['tgl_nota'] = date("d-m-Y", strtotime($r['tgl_nota']));
            $nestedData['total_transaksi'] = ($r['total_transaksi'] == 0) ? 0 : number_format($r['total_transaksi']);
            $nestedData['total_pembayaran'] = ($cek['t_bayar'] == 0) ? 0 : number_format($cek['t_bayar']);
            $nestedData['piutang'] = ($piutang == 0) ? 0 : number_format($piutang);
            $nestedData['status'] = $status;
            $nestedData['pic'] = $r['pic'];
            $nestedData['kasir'] = $r['nama'];
            $nestedData['aksi'] = "<button href='#'' class='btn btn-primary btn-sm det_nota' data-idnota= '" . $r['id_nota'] . "' data-toggle='modal' data-target='#edit_nota'";
            $nestedData['aksi'] .= "<span class='icon text-white'><i class='fas fa-search'></i></span></button> ";
            $nestedData['aksi'] .= "<button class='btn btn-danger btn-sm hapus_nota' data-toggle='modal' data-idnh='" . $r['id_nota'] . "' data-target='#hapus_nota'>";
            $nestedData['aksi'] .= "<span class='icon text-white'><i class='fas fa-trash'></i></span></button>";


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
