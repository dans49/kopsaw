<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['restore'])) {
    // Konfigurasi koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "kasir_kopsaw");

    // Cek koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Periksa apakah file diunggah
    if ($_FILES['backup_file']['error'] != UPLOAD_ERR_OK) {
        die("Error: Terjadi kesalahan saat mengunggah file. Error code: " . $_FILES['backup_file']['error']);
    }

    // Path sementara untuk file yang diunggah
    $temp_file = $_FILES['backup_file']['tmp_name'];

    // Baca file SQL
    $sqlScript = file_get_contents($temp_file);
    if ($sqlScript === false) {
        die("Error: Tidak bisa membaca file.");
    }

    // Pisahkan perintah SQL
    $queries = explode(';', $sqlScript);

    // Eksekusi setiap perintah SQL
    foreach ($queries as $query) {
        $query = trim($query);
        if (!empty($query)) {
            // Cek apakah perintah adalah CREATE TABLE
            if (stripos($query, 'CREATE TABLE') === 0) {
                // Coba hapus tabel jika sudah ada
                $table_name = '';
                if (preg_match('/CREATE TABLE `([^`]*)`/', $query, $matches)) {
                    $table_name = $matches[1];
                }
                if ($table_name) {
                    $drop_table_query = "DROP TABLE IF EXISTS `$table_name`;";
                    if ($koneksi->query($drop_table_query) === false) {
                        die("Error: Gagal menghapus tabel `$table_name` - " . $koneksi->error);
                    }
                }
            }
            // Log query untuk debugging

            // echo "Executing query: $query\n";
            
            // Eksekusi perintah SQL
            if ($koneksi->query($query) === false) {
                die("Error: Gagal mengeksekusi perintah SQL - " . $koneksi->error);
            }
        }
    }

    ?>
    <script type="text/javascript">
        alert("Database berhasil direstore");
        window.location.href="?page=<?= $page ?>";
    </script>
    <?php

    // Hapus file sementara
    unlink($temp_file);
}
?>
