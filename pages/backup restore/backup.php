<?php
    // Konfigurasi koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "kasir_kopsaw");

    // Cek koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Ambil semua tabel dalam database
    $tables = array();
    $result = $koneksi->query("SHOW TABLES");
    if ($result === false) {
        die("Error: " . $koneksi->error);
    }
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    $sqlScript = "";
    foreach ($tables as $table) {
        // SQL script untuk membuat struktur tabel
        $result = $koneksi->query("SHOW CREATE TABLE `$table`");
        if ($result === false) {
            die("Error: " . $koneksi->error);
        }
        $row = $result->fetch_row();
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";

        // SQL script untuk menambahkan data tabel
        $result = $koneksi->query("SELECT * FROM `$table`");
        if ($result === false) {
            die("Error: " . $koneksi->error);
        }
        $columnCount = $result->field_count;

        while ($row = $result->fetch_row()) {
            $sqlScript .= "INSERT INTO `$table` VALUES(";
            for ($j = 0; $j < $columnCount; $j++) {
                $value = $row[$j];

                if (isset($value)) {
                    $value = $koneksi->real_escape_string($value);
                    $sqlScript .= '"' . $value . '"';
                } else {
                    $sqlScript .= 'NULL';
                }
                if ($j < ($columnCount - 1)) {
                    $sqlScript .= ',';
                }
            }
            $sqlScript .= ");\n";
        }

        $sqlScript .= "\n";
    }

    if (!empty($sqlScript)) {
        // Menentukan path file backup
        $backup_file_name = '/tmp/kasir_kopsaw - ' . time() . '.sql';
        $fileHandler = fopen($backup_file_name, 'w+');
        
        // Cek apakah fopen berhasil
        if ($fileHandler === false) {
            die("Error: Tidak bisa membuat file backup.");
        }
        
        fwrite($fileHandler, $sqlScript);
        fclose($fileHandler);

        // Set headers untuk unduhan file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backup_file_name));

        ob_clean();
        flush();
        readfile($backup_file_name);

        // Hapus file setelah dikirim
        unlink($backup_file_name);
        exit;
    }
?>
