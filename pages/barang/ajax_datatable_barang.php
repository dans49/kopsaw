<?php 
require_once '../../akses/koneksi.php';

if($_GET['action'] == "table_data"){


		$columns = array( 
	                            0 =>'id_barang', 
	                            1 =>'nama_barang',
                                2 => 'harga_beli',
                                3 => 'harga_jual',
	                            4 => 'stok',
	                            5 => 'id_barang',
	                        );

		$querycount = mysqli_query($koneksi, "SELECT count(id_barang) as jumlah FROM barang");
		$datacount = mysqli_fetch_array($querycount);
	
  
        $totalData = $datacount['jumlah'];
            
        $totalFiltered = $totalData; 

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
            
        if(empty($_POST['search']['value']))
        {            
        	$query = mysqli_query($koneksi, "SELECT * FROM barang 
                                    LEFT JOIN satuan ON barang.id_satuan=satuan.id_satuan order by $order $dir 
        																LIMIT $limit 
        																OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = mysqli_query($koneksi, "SELECT * FROM barang 
                                    LEFT JOIN satuan ON barang.id_satuan=satuan.id_satuan WHERE nama_barang LIKE '%$search%' 
            															or nama_satuan LIKE '%$search%' 
                                                                        or harga_beli LIKE '%$search%' 
                                                                        or harga_jual LIKE '%$search%' 
            															order by $order $dir 
            															LIMIT $limit 
            															OFFSET $start");


           $querycount = mysqli_query($koneksi, "SELECT count(id_barang) as jumlah FROM barang
                                         LEFT JOIN satuan ON barang.id_satuan=satuan.id_satuan WHERE nama_barang LIKE '%$search%' 
       																						or nama_satuan LIKE '%$search%' 
                                                                                            or harga_beli LIKE '%$search%' 
                                                                                            or harga_jual LIKE '%$search%'");
		   $datacount = mysqli_fetch_array($querycount);
           $totalFiltered = $datacount['jumlah'];
        }

        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
            while ($r = mysqli_fetch_array($query))
            {
                $nestedData['no'] = $no;
                $nestedData['id_barang'] = $r['id_barang'];
                $nestedData['nama_barang'] = $r['nama_barang'];
                $nestedData['stok'] = $r['stok'];
                $nestedData['harga_beli'] = $r['harga_beli'];
                $nestedData['harga_jual'] = $r['harga_jual'];
                $nestedData['satuan'] = $r['nama_satuan'];
                $nestedData['aksi'] = "<a href='#' class='btn-warning btn-sm'>Ubah</a>&nbsp; <a href='#' class='btn-danger btn-sm'>Hapus</a>";
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