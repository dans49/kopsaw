-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 09 Sep 2024 pada 19.32
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_kopsaw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(7) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `tgl_update` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_satuan`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `tgl_input`, `tgl_update`) VALUES
('BR002', 15, 'Sabun', 1800, 3000, 38, '6 October 2020, 0:41', '6 October 2020, 0:54'),
('BR003', 0, 'Pulpen', 1500, 2000, 68, '6 October 2020, 1:34', NULL),
('BR004', 0, 'Cemilan', 2000, 2500, 14, '22 April 2024, 22:50', '22 April 2024, 22:51'),
('BR005', 0, 'Nasi Goreng', 5000, 7000, 18, '30 April 2024, 9:14', NULL),
('BR006', 16, 'Es KopiSusu Gula Aren', 8250, 15000, 4, '6 May 2024, 9:19', '6 June 2024, 20:01'),
('BR007', 15, 'Jazy Bold 20', 25000, 27000, 10, '6 May 2024, 9:20', NULL),
('BR008', 15, 'Djarum Super 12', 26000, 27000, 15, '6 May 2024, 9:21', NULL),
('BR009', 15, 'Sampoernamild', 31700, 34000, 4, '8 May 2024, 14:19', '21 June 2024, 15:46'),
('BR010', 15, 'Garfit', 24200, 27000, 4, '8 May 2024, 14:35', '6 June 2024, 11:33'),
('BR011', 15, 'Esse Punch Pop', 31450, 34000, 8, '8 May 2024, 14:37', '19 June 2024, 12:29'),
('BR013', 15, 'Marlboro Filter Black', 37100, 40000, 8, '8 May 2024, 14:40', '24 June 2024, 10:15'),
('BR014', 15, 'Marlboro Merah', 42000, 44000, 8, '8 May 2024, 14:41', '24 June 2024, 10:12'),
('BR015', 15, 'Magnum', 24350, 27000, 9, '8 May 2024, 14:42', '7 June 2024, 9:34'),
('BR016', 15, 'Esse Juicy', 36650, 38000, 6, '14 May 2024, 12:58', '6 June 2024, 11:32'),
('BR017', 15, 'Jazy Bold', 24500, 27000, 3, '14 May 2024, 13:22', '6 June 2024, 11:31'),
('BR018', 15, 'Samsu', 18200, 21000, 9, '14 May 2024, 13:23', NULL),
('BR019', 15, 'Samsu Refill', 19300, 25000, 3, '14 May 2024, 13:27', NULL),
('BR020', 15, 'Classmild', 27100, 30000, 9, '14 May 2024, 13:29', '6 June 2024, 11:30'),
('BR021', 15, 'Djarum Super', 22900, 25000, 5, '14 May 2024, 13:30', '6 June 2024, 11:30'),
('BR022', 15, 'Djarum Coklat', 15250, 17000, 4, '14 May 2024, 13:31', '24 June 2024, 10:11'),
('BR023', 15, 'MLD Putih', 35100, 38000, 11, '14 May 2024, 13:35', '6 June 2024, 11:29'),
('BR024', 15, 'Juara Jambu', 13300, 15000, 8, '14 May 2024, 13:39', '6 June 2024, 11:26'),
('BR025', 15, 'Esse Change', 37650, 40000, 7, '14 May 2024, 13:40', '24 June 2024, 10:14'),
('BR026', 15, 'Lucky Strike', 26500, 29000, 10, '14 May 2024, 13:41', NULL),
('BR027', 14, 'Buku Tulis', 3050, 5000, 6, '14 May 2024, 13:52', NULL),
('BR028', 14, 'Buku Expedisi', 9000, 11000, 1, '14 May 2024, 14:04', NULL),
('BR029', 14, 'Tinta Suntik Canon', 20000, 50000, 1, '14 May 2024, 14:07', NULL),
('BR030', 14, 'Stapler SDI', 12000, 15000, 5, '14 May 2024, 14:07', NULL),
('BR031', 17, 'Isi Stapler No.10 SDI Kecil', 2400, 4000, 7, '14 May 2024, 14:11', NULL),
('BR032', 14, 'Memo Stick', 7000, 10000, 10, '14 May 2024, 14:14', NULL),
('BR033', 14, 'Index Pembatas Kertas', 3500, 7000, 7, '14 May 2024, 14:19', NULL),
('BR034', 17, 'Isi Cutter Kecil', 2200, 5000, 8, '14 May 2024, 14:20', NULL),
('BR035', 14, 'Kwitansi Vision Besar', 3400, 8000, 10, '14 May 2024, 14:23', NULL),
('BR036', 17, 'Amplop Paperline 110', 17500, 20000, 5, '14 May 2024, 14:24', NULL),
('BR037', 14, 'Amplop Coklat/Kabinet', 800, 4500, 7, '14 May 2024, 14:27', NULL),
('BR038', 14, 'Pita Mesin Tik DAITO', 10000, 15000, 6, '14 May 2024, 14:28', NULL),
('BR039', 0, 'Spidol White Board Snowman', 6500, 8500, 6, '14 May 2024, 14:29', NULL),
('BR040', 14, 'Nota Kontan', 3000, 5000, 6, '14 May 2024, 14:31', NULL),
('BR041', 14, 'CD-R GT PRO', 2300, 5000, 27, '14 May 2024, 14:33', NULL),
('BR042', 14, 'DVD-R GT PRO', 2300, 5000, 13, '14 May 2024, 14:35', NULL),
('BR043', 18, 'HVS A4 Copy Paper', 40400, 45000, 2, '14 May 2024, 14:35', NULL),
('BR044', 13, 'HVS F4 Copy Paper', 46000, 50000, 5, '14 May 2024, 14:37', NULL),
('BR045', 14, 'Pensil 2b Faber Castel', 3500, 7000, 10, '15 May 2024, 14:10', NULL),
('BR046', 14, 'Reffil PANTEL Hitam', 13333, 17000, 8, '15 May 2024, 14:13', NULL),
('BR047', 14, 'Reffil PANTEL Biru', 13333, 17000, 4, '15 May 2024, 14:15', NULL),
('BR048', 17, 'Trigonal Clip Joyco No.3', 1650, 3500, 5, '15 May 2024, 14:16', NULL),
('BR049', 14, 'Map Odner Box File R&amp;R', 14000, 19000, 2, '15 May 2024, 14:18', NULL),
('BR050', 14, 'Map Odner Forte', 12500, 19000, 2, '15 May 2024, 14:19', NULL),
('BR051', 14, 'Map Biasa R&amp;R', 370, 1000, 85, '15 May 2024, 14:20', NULL),
('BR052', 14, 'Map Jinjing', 5000, 7000, 4, '15 May 2024, 14:21', NULL),
('BR053', 14, 'Map Biola Biasa', 1370, 3000, 17, '15 May 2024, 14:21', NULL),
('BR054', 14, 'Box Lipat', 12000, 17000, 1, '15 May 2024, 14:22', NULL),
('BR055', 14, 'Binder Clip No.260 Joyco', 1300, 3500, 43, '15 May 2024, 14:22', NULL),
('BR056', 14, 'Binder Clip No.200 Joyco', 900, 2000, 36, '15 May 2024, 14:27', NULL),
('BR057', 17, 'Binder Clip No.111 Joyco', 3660, 4500, 12, '15 May 2024, 14:28', NULL),
('BR058', 17, 'Binder Clip No.155 Joyco', 500, 6000, 10, '15 May 2024, 14:30', NULL),
('BR059', 17, 'Binder Clip no.107 Joyco', 2650, 4000, 13, '15 May 2024, 14:32', '5 June 2024, 13:04'),
('BR060', 17, 'Binder Clip No.105', 2350, 3500, 18, '15 May 2024, 14:33', '5 June 2024, 13:03'),
('BR061', 14, 'Tip-ex Cair Kenko', 3750, 8000, 11, '15 May 2024, 14:36', NULL),
('BR062', 14, 'Tip-ex Roll Joyko', 5333, 8000, 11, '15 May 2024, 14:37', NULL),
('BR063', 14, 'Cutter A-300-A', 5000, 8000, 1, '15 May 2024, 14:38', NULL),
('BR064', 14, 'Lakban Hitam 2&quot; Daimaru', 13500, 20000, 4, '15 May 2024, 14:39', NULL),
('BR065', 14, 'Materai 10.000', 10000, 11000, 194, '15 May 2024, 14:40', '26 June 2024, 16:00'),
('BR066', 0, 'Baterai Alkaline AA', 13500, 18000, 5, '15 May 2024, 14:41', NULL),
('BR067', 14, 'Baterai Alkaline AA', 13500, 18000, 5, '15 May 2024, 14:43', NULL),
('BR068', 14, 'Baterai Alkaline AAA', 13500, 18000, 4, '15 May 2024, 14:44', '19 June 2024, 12:31'),
('BR069', 14, 'Lem Glue', 1791, 5000, 8, '16 May 2024, 8:33', NULL),
('BR070', 14, 'Lem Stik Kecil JOYCO', 3500, 5000, 13, '16 May 2024, 8:37', '16 May 2024, 8:38'),
('BR071', 14, 'Pulpen Balliner Biru PILOT', 17000, 22000, 10, '16 May 2024, 8:39', NULL),
('BR072', 14, 'Pulpen Balliner Hijau PILOT', 17000, 22000, 7, '16 May 2024, 8:40', NULL),
('BR073', 14, 'Pulpen Balliner Hitam PILOT', 17000, 22000, 7, '16 May 2024, 8:41', NULL),
('BR074', 14, 'Pulpen Biasa Castello', 1600, 3000, 13, '16 May 2024, 8:41', NULL),
('BR075', 14, 'Pulpen Tizo Biru Gel Liner', 3750, 6000, 2, '16 May 2024, 8:42', NULL),
('BR076', 14, 'Pulpen Tizo Hitam Gel Liner', 3750, 6000, 12, '16 May 2024, 8:45', NULL),
('BR077', 14, 'Solasiban Bening Besar DAIMARU', 8000, 15000, 3, '16 May 2024, 8:46', NULL),
('BR078', 14, 'Solasiban Bening Kecil DAIMARU', 2000, 5000, 8, '16 May 2024, 8:47', NULL),
('BR079', 14, 'Stabilo Joyco', 2500, 7000, 14, '16 May 2024, 8:48', NULL),
('BR080', 14, 'Double Tipe Besar', 5000, 8000, 2, '16 May 2024, 8:50', NULL),
('BR081', 14, 'Double Tipe Kecil', 2000, 5000, 4, '16 May 2024, 8:53', NULL),
('BR082', 14, 'Lebel Stiker', 3500, 5000, 4, '16 May 2024, 8:54', NULL),
('BR083', 14, 'Spidol Permanent SNOWMAN', 4500, 8500, 8, '16 May 2024, 8:55', NULL),
('BR084', 14, 'Bengbeng', 1800, 2000, 3, '16 May 2024, 8:57', NULL),
('BR085', 14, 'Pop Mie', 4400, 6000, 6, '16 May 2024, 8:58', '6 June 2024, 11:25'),
('BR086', 14, 'Keju Cake', 1800, 2000, 3, '16 May 2024, 8:59', NULL),
('BR087', 14, 'Nabati Siip', 400, 500, 2, '16 May 2024, 8:59', NULL),
('BR088', 14, 'Wafer Selamat', 950, 2000, 21, '16 May 2024, 9:00', NULL),
('BR089', 14, 'Kalpa', 1750, 2000, 8, '16 May 2024, 9:01', NULL),
('BR090', 14, 'Sarigandum', 1750, 2000, 12, '16 May 2024, 9:04', NULL),
('BR091', 14, 'Monde Eggroll', 3000, 4000, 8, '16 May 2024, 9:05', NULL),
('BR092', 14, 'Chocholatos', 1750, 2000, 19, '16 May 2024, 9:05', '19 June 2024, 12:36'),
('BR093', 14, 'Sukro Garuda', 900, 1000, 25, '16 May 2024, 9:06', NULL),
('BR094', 14, 'Nextar', 1700, 2000, 2, '16 May 2024, 9:06', NULL),
('BR095', 14, 'Ritz Chocholate', 1750, 2000, 1, '16 May 2024, 9:07', NULL),
('BR096', 14, 'Blastoz', 1750, 2000, 7, '16 May 2024, 9:07', NULL),
('BR097', 14, 'Wafle Tango', 1750, 2000, 10, '16 May 2024, 9:08', NULL),
('BR098', 14, 'Superstar', 875, 2000, 2, '16 May 2024, 9:09', NULL),
('BR099', 14, 'Arden', 1750, 2000, 1, '16 May 2024, 9:09', NULL),
('BR100', 14, 'Malkist Keju Panggang', 1750, 2000, 9, '16 May 2024, 9:10', NULL),
('BR101', 14, 'Astor Single', 875, 1000, 9, '16 May 2024, 9:11', NULL),
('BR102', 14, 'Oreo cake', 1800, 2000, 10, '16 May 2024, 9:11', NULL),
('BR103', 14, 'Hexos', 1200, 3000, 10, '16 May 2024, 9:12', NULL),
('BR104', 14, 'Biskies Black', 1750, 2000, 11, '16 May 2024, 9:12', NULL),
('BR105', 14, 'Choki-Choki', 850, 1000, 6, '16 May 2024, 9:13', NULL),
('BR106', 14, 'Gerry Salut Wafer', 1750, 2000, 18, '16 May 2024, 9:14', NULL),
('BR107', 14, 'Chunkybar', 7500, 9000, 11, '16 May 2024, 9:15', NULL),
('BR108', 14, 'Ozlo', 1800, 2000, 1, '16 May 2024, 9:16', NULL),
('BR109', 14, 'Granola', 540, 650, 58, '16 May 2024, 9:17', '10 June 2024, 20:16'),
('BR110', 14, 'Slai Olai', 1750, 2000, 13, '16 May 2024, 9:18', NULL),
('BR111', 14, 'Gerry Salut Roll', 437, 500, 9, '16 May 2024, 9:19', '6 June 2024, 11:24'),
('BR112', 14, 'Apetito', 1750, 2000, 90, '16 May 2024, 9:20', '6 June 2024, 11:22'),
('BR113', 14, 'Choki Stik', 1750, 2000, 8, '16 May 2024, 9:20', NULL),
('BR114', 14, 'Roma Kelapa Cream', 1750, 2000, 8, '16 May 2024, 9:21', NULL),
('BR115', 14, 'Chochopie', 1750, 2000, 9, '16 May 2024, 9:21', NULL),
('BR116', 14, 'Trick', 900, 1000, 27, '16 May 2024, 9:22', NULL),
('BR117', 14, 'Kacang Garuda', 900, 1000, 20, '16 May 2024, 9:23', NULL),
('BR118', 14, 'Tolak Angin', 3250, 4000, 12, '16 May 2024, 9:23', NULL),
('BR119', 14, 'Larutan Serbuk', 1250, 3000, 28, '16 May 2024, 9:24', NULL),
('BR120', 14, 'Chiki Balls Besar', 6000, 7000, 3, '16 May 2024, 9:25', NULL),
('BR121', 14, 'Rin-Bee', 7000, 8000, 3, '16 May 2024, 9:26', NULL),
('BR122', 14, 'Qtella Tempe', 6000, 8000, 6, '16 May 2024, 9:27', '28 May 2024, 13:55'),
('BR123', 14, 'French Fries ', 7000, 8000, 2, '16 May 2024, 9:28', '6 June 2024, 11:20'),
('BR124', 14, 'Tic-tic Kecil', 1750, 2000, 2, '16 May 2024, 9:29', NULL),
('BR125', 14, 'Serena', 4500, 5000, 5, '16 May 2024, 9:29', '6 June 2024, 11:22'),
('BR126', 14, 'Ahh', 450, 500, 17, '16 May 2024, 9:32', NULL),
('BR127', 14, 'Toppo', 1750, 2000, 11, '16 May 2024, 9:34', NULL),
('BR128', 14, 'Oreo', 1800, 2000, 9, '16 May 2024, 9:35', NULL),
('BR129', 14, 'Good Time', 1750, 2000, 11, '16 May 2024, 9:35', NULL),
('BR130', 14, 'Mini Astor', 1750, 2000, 9, '16 May 2024, 9:36', '6 June 2024, 11:23'),
('BR131', 14, 'Pocky', 6800, 8000, 3, '16 May 2024, 9:37', NULL),
('BR132', 14, 'Malkist Crackers', 900, 1000, 19, '16 May 2024, 9:37', NULL),
('BR133', 14, 'Duosus', 1800, 3000, 2, '16 May 2024, 9:38', NULL),
('BR134', 14, 'Taro Besar', 5500, 7000, 12, '16 May 2024, 9:38', '16 May 2024, 9:47'),
('BR135', 14, 'Qtella Kecil', 1750, 2000, 3, '16 May 2024, 9:40', '6 June 2024, 11:18'),
('BR136', 14, 'Kusuka', 1800, 2000, 1, '16 May 2024, 9:40', NULL),
('BR137', 14, 'Twistko', 7000, 8000, 1, '16 May 2024, 9:41', NULL),
('BR138', 14, 'Sponge Oishi', 1800, 2000, 14, '16 May 2024, 9:41', NULL),
('BR139', 14, 'Chiki Balls Kecil', 1750, 2000, 0, '16 May 2024, 9:42', NULL),
('BR140', 14, 'Chitato Lite Kecil', 1750, 2000, 4, '16 May 2024, 9:43', '6 June 2024, 11:17'),
('BR141', 14, 'Walut', 875, 2000, 1, '16 May 2024, 9:43', NULL),
('BR142', 14, 'Sagonia', 1750, 2000, 5, '16 May 2024, 9:44', NULL),
('BR143', 14, 'Better', 1750, 2000, 10, '16 May 2024, 9:44', NULL),
('BR144', 14, 'Nori Seawed', 1750, 2000, 8, '16 May 2024, 9:44', NULL),
('BR145', 14, 'Gerry Snack Chiki', 1800, 3000, 1, '16 May 2024, 9:45', NULL),
('BR146', 14, 'Smax Ring', 4500, 5000, 3, '16 May 2024, 9:45', NULL),
('BR147', 14, 'Oishi Poppy Pop', 7000, 8000, 2, '16 May 2024, 9:47', NULL),
('BR148', 14, 'Imperial', 1800, 2000, 9, '16 May 2024, 9:48', NULL),
('BR149', 14, 'Larutan Kaleng', 6000, 8000, 23, '16 May 2024, 9:48', NULL),
('BR150', 14, 'Pocari Sweat', 6000, 7000, 0, '16 May 2024, 9:49', '6 June 2024, 11:16'),
('BR151', 14, 'UltraMilk 250ml', 6000, 7000, 1, '16 May 2024, 9:49', '16 May 2024, 9:51'),
('BR152', 14, 'Ades 600ml', 2458, 3000, 13, '16 May 2024, 9:51', NULL),
('BR153', 14, 'Cleo 550ml', 1708, 3000, 19, '16 May 2024, 9:52', '24 June 2024, 15:26'),
('BR154', 14, 'Cleo Mini', 875, 1500, 33, '16 May 2024, 9:53', '25 June 2024, 15:35'),
('BR155', 14, 'Nutriboost', 5500, 7000, 9, '16 May 2024, 9:54', NULL),
('BR156', 14, 'Yakult', 1533, 3000, 14, '16 May 2024, 9:54', NULL),
('BR157', 14, 'Pulpy Orange', 5583, 7000, 7, '16 May 2024, 9:55', '5 June 2024, 13:05'),
('BR158', 14, 'Freshtea Kecil Nusantara', 3166, 5000, 6, '16 May 2024, 9:56', NULL),
('BR159', 14, 'Cimory Freshmilk', 5500, 7000, 3, '16 May 2024, 9:57', NULL),
('BR160', 14, 'Cimory yoghurt', 7500, 9000, 5, '16 May 2024, 9:57', NULL),
('BR161', 14, 'Cimory Stik', 2500, 3000, 1, '16 May 2024, 9:58', NULL),
('BR162', 14, 'Kenzler Sosis/Bakso', 7500, 10000, 5, '16 May 2024, 9:58', NULL),
('BR163', 14, 'Bear Brand', 9500, 12000, 9, '16 May 2024, 9:59', NULL),
('BR164', 14, 'Teh Kotak', 3200, 5000, 3, '16 May 2024, 10:00', NULL),
('BR165', 14, 'Soda', 3333, 5000, 4, '16 May 2024, 10:00', NULL),
('BR166', 14, 'Coca Cola Botol Kecil', 3333, 5000, 10, '16 May 2024, 10:01', NULL),
('BR167', 14, 'Fanta botol Kecil', 3333, 5000, 2, '16 May 2024, 10:02', NULL),
('BR168', 13, 'Kapal Api Mix', 1250, 3000, 2, '16 May 2024, 10:02', '10 June 2024, 15:39'),
('BR169', 13, 'Luwak White Cofee Hot', 1200, 3000, 5, '16 May 2024, 10:03', '25 June 2024, 14:25'),
('BR170', 13, 'Indocafe Hot', 1200, 3000, 69, '16 May 2024, 10:04', '5 June 2024, 11:32'),
('BR171', 13, 'Energen', 1083, 3000, 31, '16 May 2024, 10:06', NULL),
('BR172', 13, 'ABC Susu', 1058, 3000, 19, '16 May 2024, 10:07', NULL),
('BR173', 13, 'Susu Frissian Flag Hot', 1350, 3000, 16, '16 May 2024, 10:08', '5 June 2024, 11:22'),
('BR174', 13, 'Goodday Hot', 1150, 3000, 42, '16 May 2024, 10:09', '5 June 2024, 11:26'),
('BR175', 13, 'Creamy Latte Hot', 1250, 3000, 6, '16 May 2024, 10:09', '5 June 2024, 11:24'),
('BR176', 13, 'Milo Hot', 1900, 3000, 45, '16 May 2024, 10:10', '5 June 2024, 11:27'),
('BR177', 14, 'Aqua Galon', 23000, 25000, 5, '16 May 2024, 10:10', '6 June 2024, 11:15'),
('BR178', 17, 'Ron 88', 30000, 40000, 8, '16 May 2024, 10:11', '6 June 2024, 11:14'),
('BR179', 15, 'Teh Daun Kelor', 25000, 30000, 1, '16 May 2024, 10:12', NULL),
('BR180', 15, 'Rendang Sapi', 89000, 99000, 3, '16 May 2024, 10:13', NULL),
('BR181', 15, 'Dendeng ', 81000, 90000, 0, '16 May 2024, 10:15', '6 June 2024, 11:13'),
('BR182', 14, 'Tokai', 1800, 3000, 47, '16 May 2024, 10:16', NULL),
('BR183', 14, 'Rinso Detergen', 4500, 5000, 8, '16 May 2024, 10:17', '6 June 2024, 11:14'),
('BR184', 14, 'Sunlight Jumbo', 15000, 18000, 3, '16 May 2024, 10:17', NULL),
('BR185', 14, 'Sabun Agung', 800, 1000, 10, '16 May 2024, 10:18', NULL),
('BR186', 0, 'Shampo Head &amp; Shoulder', 3328, 5000, 17, '16 May 2024, 10:18', NULL),
('BR187', 14, 'Shampo Head &amp; Shoulder', 3328, 5000, 17, '16 May 2024, 10:19', NULL),
('BR188', 14, 'Shampoo Sunsilk', 3328, 5000, 4, '16 May 2024, 10:20', NULL),
('BR189', 14, 'Shampo Pantene', 3328, 5000, 5, '16 May 2024, 10:21', NULL),
('BR190', 14, 'Mixagrif', 650, 1500, 4, '16 May 2024, 10:23', NULL),
('BR191', 14, 'Panadol Extra', 1250, 1500, 15, '16 May 2024, 10:24', NULL),
('BR192', 14, 'Bodrex', 425, 1000, 14, '16 May 2024, 10:25', NULL),
('BR193', 14, 'Decolgen', 500, 1000, 4, '16 May 2024, 10:26', NULL),
('BR194', 14, 'Pembalut', 400, 1000, 13, '16 May 2024, 10:26', NULL),
('BR195', 14, 'Tisue Paseo', 12000, 15000, 34, '16 May 2024, 10:27', NULL),
('BR196', 14, 'Downy', 4160, 5000, 12, '16 May 2024, 10:28', '6 June 2024, 11:12'),
('BR197', 14, 'Sikat Gigi Formula', 2750, 5000, 11, '16 May 2024, 10:29', NULL),
('BR198', 14, 'Pepsodent', 4400, 5000, 3, '16 May 2024, 10:29', '19 June 2024, 12:41'),
('BR199', 14, 'Lifebuoy Cair', 4500, 5000, 3, '16 May 2024, 10:30', '6 June 2024, 11:11'),
('BR200', 19, 'Kertas Fhoto', 1500, 2000, 17, '16 May 2024, 10:31', NULL),
('BR201', 16, 'Tinta Epson 664 ORI', 95000, 100000, 1, '28 May 2024, 13:46', NULL),
('BR202', 16, 'Tinta Epson 003 ORI', 95000, 100000, 3, '28 May 2024, 13:48', NULL),
('BR203', 14, 'Chitato Lite Besar', 9000, 10000, 3, '28 May 2024, 13:48', NULL),
('BR204', 14, 'Chitato Besar', 9000, 10000, 5, '28 May 2024, 13:50', NULL),
('BR205', 14, 'Chitato Mie Goreng Besar', 9000, 10000, 2, '28 May 2024, 13:51', '6 June 2024, 11:10'),
('BR206', 14, 'Piatos Besar', 9000, 10000, 5, '28 May 2024, 13:54', NULL),
('BR207', 13, 'Nutrisari', 1200, 3000, 37, '31 May 2024, 9:22', NULL),
('BR208', 13, 'Nutrisari Ice', 1200, 4000, 24, '31 May 2024, 9:23', NULL),
('BR209', 13, 'Susu Frissian Flag Ice', 1350, 4000, 10, '5 June 2024, 11:22', NULL),
('BR210', 13, 'Creamy Latte Ice', 1250, 4000, 10, '5 June 2024, 11:25', NULL),
('BR211', 13, 'Goodday Ice', 1150, 4000, 10, '5 June 2024, 11:26', NULL),
('BR212', 13, 'Milo Ice', 1900, 4000, 9, '5 June 2024, 11:27', NULL),
('BR213', 13, 'Luwak White Cofee Ice', 1200, 4000, 10, '5 June 2024, 11:29', '25 June 2024, 14:25'),
('BR214', 13, 'Indocafe Ice', 1200, 4000, 8, '5 June 2024, 11:32', NULL),
('BR215', 13, 'Es Kopi Susu Gula Aren (Less Sugar)', 6650, 15000, 7, '5 June 2024, 11:33', NULL),
('BR216', 13, 'Vietnam Drip Robusta Hot', 3050, 12000, 8, '5 June 2024, 11:34', '5 June 2024, 11:36'),
('BR217', 13, 'Vietnam Drip Robusta Ice', 3150, 14000, 5, '5 June 2024, 11:35', '5 June 2024, 11:40'),
('BR218', 13, 'Vietnam Drip Arabica Hot', 5650, 15000, 6, '5 June 2024, 11:36', NULL),
('BR219', 13, 'Vietnam Drip Arabica Ice', 5750, 17000, 5, '5 June 2024, 11:37', '5 June 2024, 11:40'),
('BR220', 13, 'V60 Arabica Hot', 6100, 15000, 5, '5 June 2024, 11:38', NULL),
('BR221', 13, 'V60 Arabica Ice', 6200, 17000, 5, '5 June 2024, 11:39', NULL),
('BR222', 13, 'V60 Robusta Hot', 3100, 12000, 10, '5 June 2024, 11:40', NULL),
('BR223', 13, 'V60 Robusta Ice', 3200, 14000, 5, '5 June 2024, 11:41', NULL),
('BR224', 13, 'Limo Cofee Shoot', 5900, 15000, 8, '5 June 2024, 11:41', NULL),
('BR225', 13, 'Expresso', 2350, 10000, 5, '5 June 2024, 11:42', NULL),
('BR226', 13, 'Tubruk Arabica', 5350, 12000, 4, '5 June 2024, 11:43', NULL),
('BR227', 13, 'Tubruk Robusta', 2350, 10000, 10, '5 June 2024, 11:44', NULL),
('BR228', 13, 'Caramel Cofeelatte Ice', 7050, 20000, 9, '5 June 2024, 11:45', NULL),
('BR229', 13, 'Coffelatte Ice', 4750, 18000, 10, '5 June 2024, 11:45', NULL),
('BR230', 15, 'L.A Bold', 34000, 37000, 0, '5 June 2024, 12:51', '6 June 2024, 11:09'),
('BR231', 14, 'Map Plastik Tali', 1833, 4000, 12, '5 June 2024, 12:55', NULL),
('BR232', 13, 'Cappucino Ice', 4750, 18000, 9, '5 June 2024, 13:43', NULL),
('BR233', 14, 'Nasi/ Gorengan &amp; Jus', 15000, 18000, 0, '5 June 2024, 15:04', '24 June 2024, 15:29'),
('BR234', 14, 'Nasi / Gorengan &amp; Jus', 25000, 28000, 0, '5 June 2024, 15:56', '24 June 2024, 15:24'),
('BR235', 16, 'Jus Markisa', 8000, 10000, 1, '5 June 2024, 16:13', NULL),
('BR236', 14, 'Nasi/ Gorengan &amp; Jus', 25000, 35000, 0, '5 June 2024, 16:15', NULL),
('BR237', 14, 'Nasi/ Gorengan &amp; Jus', 5000, 8000, 0, '5 June 2024, 16:17', NULL),
('BR238', 14, 'Nasi/ Gorengan &amp; Jus', 20000, 23000, 0, '5 June 2024, 16:20', NULL),
('BR239', 14, 'Nasi/ Gorengan &amp; Jus', 95000, 98000, 0, '5 June 2024, 19:54', '27 June 2024, 15:18'),
('BR240', 14, 'Nasi/ Gorengan &amp; Jus', 17000, 27000, 0, '5 June 2024, 19:56', NULL),
('BR241', 16, 'Jus Honje', 8000, 10000, 6, '5 June 2024, 19:59', '6 June 2024, 11:04'),
('BR242', 14, 'Nasi/ Gorengan &amp; Jus', 30000, 33000, 0, '6 June 2024, 15:43', NULL),
('BR243', 14, 'Snack', 187500, 227500, 0, '6 June 2024, 16:01', NULL),
('BR244', 14, 'Nasi/ Gorengan &amp; Jus', 12000, 22000, 0, '6 June 2024, 16:05', NULL),
('BR245', 14, 'Nasi/ Gorengan &amp; Jus', 20000, 30000, 0, '6 June 2024, 19:51', '25 June 2024, 15:56'),
('BR246', 0, 'Pulsa', 55000, 58000, 1, '6 June 2024, 20:09', NULL),
('BR247', 21, 'Pulsa', 55000, 58000, 0, '6 June 2024, 20:10', NULL),
('BR248', 14, 'Nasi/ Gorengan &amp; Jus', 18000, 21000, 0, '6 June 2024, 20:11', NULL),
('BR249', 14, 'Nasi/ Gorengan &amp; Jus', 18000, 28000, 0, '6 June 2024, 20:14', NULL),
('BR250', 14, 'Djangihe 100gr', 25000, 30000, 2, '6 June 2024, 20:23', NULL),
('BR251', 14, 'Papandayan Wine 200gr', 75000, 80000, 0, '6 June 2024, 20:30', NULL),
('BR252', 16, 'Jus Honje 1L', 30000, 35000, 3, '7 June 2024, 19:48', NULL),
('BR253', 14, 'Nasi/ Gorengan &amp; Jus', 10000, 13000, 0, '7 June 2024, 20:09', NULL),
('BR254', 14, 'Ratu Kriuk', 2000, 2500, 16, '7 June 2024, 20:13', NULL),
('BR255', 14, 'Kapal Api Mix Mentah', 1250, 2000, 41, '10 June 2024, 15:39', NULL),
('BR256', 14, 'Nasi/ Gorengan &amp; Jus', 15000, 25000, 0, '10 June 2024, 16:27', NULL),
('BR257', 14, 'Apel', 35000, 45000, 0, '10 June 2024, 16:32', NULL),
('BR258', 14, 'Nasi/ Gorengan &amp; Jus', 22000, 32000, 0, '10 June 2024, 16:46', '25 June 2024, 15:48'),
('BR259', 17, 'Snack', 39000, 59000, 0, '10 June 2024, 19:53', '26 June 2024, 14:45'),
('BR260', 14, 'Nasi/ Gorengan &amp; Jus', 16000, 26000, 0, '10 June 2024, 20:03', '26 June 2024, 15:48'),
('BR261', 14, 'Nasi/ Gorengan &amp; Jus', 8000, 11000, 0, '10 June 2024, 20:07', NULL),
('BR262', 14, 'Nasi/ Gorengan &amp; Jus', 12000, 15000, 0, '10 June 2024, 20:08', NULL),
('BR263', 14, 'Nasi/ Gorengan &amp; Jus', 17000, 20000, 0, '10 June 2024, 20:20', '21 June 2024, 15:40'),
('BR264', 14, 'Lap Microfibre', 157500, 172500, 0, '11 June 2024, 15:18', '21 June 2024, 15:36'),
('BR265', 14, 'Nasi/ Gorengan &amp; Jus', 14000, 17000, 10, '11 June 2024, 15:22', NULL),
('BR266', 14, 'Nasi/ Gorengan &amp; Jus', 5000, 8000, 0, '13 June 2024, 15:15', NULL),
('BR268', 14, 'Snack', 675000, 750000, 0, '14 June 2024, 14:57', '20 June 2024, 15:33'),
('BR270', 21, 'Pulsa', 155000, 158000, 0, '14 June 2024, 15:01', NULL),
('BR271', 15, 'Permen Tamarin', 7500, 10000, 0, '19 June 2024, 12:24', NULL),
('BR272', 15, 'Permen Kis', 7500, 10000, 0, '19 June 2024, 12:24', NULL),
('BR273', 15, 'Permen Mint Z', 6000, 9000, 0, '19 June 2024, 12:25', NULL),
('BR274', 15, 'Permen Kopiko', 11000, 14000, 0, '19 June 2024, 12:25', '25 June 2024, 9:04'),
('BR275', 14, 'Bonita', 1750, 2000, 22, '19 June 2024, 12:31', NULL),
('BR276', 14, 'Superstar Snaps', 1800, 2000, 10, '19 June 2024, 12:32', NULL),
('BR277', 14, 'Potabee', 9000, 10000, 5, '19 June 2024, 12:34', NULL),
('BR278', 14, 'Ovaltine', 2150, 3000, 9, '19 June 2024, 12:36', NULL),
('BR279', 14, 'Roma Kelapa', 1800, 2000, 10, '19 June 2024, 12:38', NULL),
('BR280', 14, 'Tolak Angin Batuk', 3600, 4500, 5, '19 June 2024, 12:41', NULL),
('BR281', 14, 'Freshtea Apel', 3200, 5000, 12, '21 June 2024, 13:25', '24 June 2024, 10:17'),
('BR282', 14, 'Gula Semut Aren 250gr', 15000, 20000, 1, '24 June 2024, 15:08', NULL),
('BR283', 21, 'Token PLN', 160000, 166000, 0, '24 June 2024, 15:11', NULL),
('BR284', 14, 'Potabee', 9000, 10000, 5, '26 June 2024, 8:46', NULL),
('BR285', 14, 'Mangkok Lampu', 282500, 317500, 0, '26 June 2024, 14:46', NULL),
('BR286', 14, 'Sprite Botol Kecil', 3200, 5000, 11, '27 June 2024, 15:03', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `id_nota` varchar(14) NOT NULL COMMENT 'TRXMMYYYY.0001',
  `id_user` int(11) NOT NULL,
  `id_pelanggan` varchar(6) DEFAULT NULL,
  `total_transaksi` int(11) NOT NULL,
  `status_nota` enum('Lunas','Hutang') DEFAULT NULL,
  `tgl_nota` date NOT NULL,
  `waktu_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id_nota`, `id_user`, `id_pelanggan`, `total_transaksi`, `status_nota`, `tgl_nota`, `waktu_data`) VALUES
('TRX012024.0001', 21, 'PW0017', 62000, 'Lunas', '2023-01-22', '2024-05-29 09:42:00'),
('TRX012024.0002', 21, 'PW0019', 59000, 'Hutang', '2023-01-29', '2024-05-29 09:42:00'),
('TRX012024.0003', 21, 'PW0008', 27000, 'Lunas', '2023-02-02', '2024-05-29 09:42:00'),
('TRX012024.0004', 21, 'PW0009', 50000, 'Lunas', '2024-04-08', '2024-05-29 09:42:00'),
('TRX012024.0005', 21, 'PW0019', 148000, 'Lunas', '2024-04-08', '2024-05-29 09:42:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(6) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `identitas` varchar(150) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `status_data` enum('AKTIF','TIDAK') DEFAULT NULL,
  `waktu_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `identitas`, `telepon`, `status_data`, `waktu_data`) VALUES
('PW0035', 'Roni Setiawan, SH', '158', '0816640224', 'AKTIF', '2024-05-29 09:58:54'),
('PW0037', 'Prilliana Susanty, S.Kom', '168', '081121111144', 'AKTIF', '2024-05-29 10:00:22'),
('PW0036', 'Fityan Aonillah, S.Hut, M.T., M.Sc', '164', '085319091900', 'AKTIF', '2024-05-29 09:59:43'),
('PW0008', 'Drs. Bangbang Suryana', '016', '0000', 'TIDAK', '2024-05-29 09:42:07'),
('PW0009', 'Ir. Joelistyana W, MM', '033', '082120336642', 'AKTIF', '2024-05-29 09:43:14'),
('PW0010', 'Guslatip, BE', '036', '000', 'AKTIF', '2024-05-29 09:43:51'),
('PW0011', 'Dewi Shintya A', '073', '081323214676', 'AKTIF', '2024-05-29 09:44:14'),
('PW0012', 'Firman Krisnawan, S.Sos., M.Si', '076', '08122425354', 'AKTIF', '2024-05-29 09:44:59'),
('PW0013', 'Ade Supriatna, S.Sos', '081', '081320328543', 'AKTIF', '2024-05-29 09:45:21'),
('PW0014', 'Alan T', '084', '000', 'AKTIF', '2024-05-29 09:45:37'),
('PW0015', 'H. Wawan, SE, M.Si', '087', '000', 'AKTIF', '2024-05-29 09:46:09'),
('PW0016', 'Hj. Puji Priyanti Utami Dewi', '093', '081221174759', 'AKTIF', '2024-05-29 09:46:36'),
('PW0017', 'Suryana', '100', '000', 'TIDAK', '2024-05-29 09:47:09'),
('PW0018', 'Yusa Yudhataka', '106', '081214828991', 'AKTIF', '2024-05-29 09:47:45'),
('PW0019', 'Dede Sutedi, S.IP', '107', '082133344910', 'AKTIF', '2024-05-29 09:48:18'),
('PW0020', 'Asep Gunadi', '114', '000', 'AKTIF', '2024-05-29 09:48:44'),
('PW0021', 'Ir. H. Endang Syahrudin, ST, MM', '117', '082127433765', 'AKTIF', '2024-05-29 09:51:49'),
('PW0022', 'Engkus', '129', '000', 'AKTIF', '2024-05-29 09:52:07'),
('PW0023', 'Deden Kurnia, SE, M.Si', '131', '000', 'AKTIF', '2024-05-29 09:52:49'),
('PW0024', 'Teguh Nugraha, S.T., MM', '134', '081320242899', 'AKTIF', '2024-05-29 09:53:16'),
('PW0025', 'Ujang Nana', '139', '000', 'AKTIF', '2024-05-29 09:53:33'),
('PW0026', 'Drs. H. Yusep Y, MM', '142', '000', 'AKTIF', '2024-05-29 09:54:08'),
('PW0027', 'Yosef Chevy Muharam, SE, MM', '146', '085323333131', 'AKTIF', '2024-05-29 09:54:45'),
('PW0028', 'Ai Nurhasanah, ST, MM', '148', '082118173692', 'AKTIF', '2024-05-29 09:55:11'),
('PW0029', 'Windi Rahmikawati, S.Sos', '149', '082216151489', 'AKTIF', '2024-05-29 09:55:39'),
('PW0030', 'Deni Prasetya, SH', '151', '000', 'AKTIF', '2024-05-29 09:56:08'),
('PW0031', 'Nenden Leli', '152', '000', 'AKTIF', '2024-05-29 09:56:22'),
('PW0032', 'Elis Lestari', '155', '000', 'AKTIF', '2024-05-29 09:56:49'),
('PW0033', 'Ade Hendra', '156', '085295417783', 'AKTIF', '2024-05-29 09:57:12'),
('PW0034', 'Arief Rakhman, S.IP', '157', '082316188500', 'AKTIF', '2024-05-29 09:57:44'),
('PW0038', 'Drs. H. Yono Kusyono, MPd', '169', '081312727270', 'AKTIF', '2024-05-29 10:01:04'),
('PW0039', 'Drs Aam Rahmat Selamat, MPd', '171', '081314825688', 'AKTIF', '2024-05-29 10:03:31'),
('PW0040', 'Yadi Mulyadi, S.IP', '172', '08112101060', 'AKTIF', '2024-05-29 10:04:07'),
('PW0041', 'Rosi Yunita, S.Si., ME', '173', '085222032309', 'AKTIF', '2024-05-29 10:04:40'),
('PW0042', 'Ai Ruhimat, ST, MM', '176', '082120003113', 'AKTIF', '2024-05-29 10:05:01'),
('PW0043', 'Lia Aulia, SET, MM', '177', '081321369877', 'AKTIF', '2024-05-29 10:05:31'),
('PW0044', 'H. Wawan R Efendy, SE, MM', '178', '081312804717', 'AKTIF', '2024-05-29 10:06:15'),
('PW0045', 'Drs Roni A Sahroni, MM', '184', '081222377786', 'AKTIF', '2024-05-29 10:06:41'),
('PW0046', 'Adi Abdullah, ST, MM', '187', '081320466818', 'AKTIF', '2024-05-29 10:07:32'),
('PW0047', 'Yogi Cahyawan, SE, MM', '189', '082119267935', 'AKTIF', '2024-05-29 10:08:21'),
('PW0048', 'Dani Yogaswara, SE, MM', '190', '085223316717', 'AKTIF', '2024-05-29 10:09:41'),
('PW0049', 'Ai Nenden Anita, M.Pd', '191', '082115050080', 'AKTIF', '2024-05-29 10:12:45'),
('PW0050', 'Yuliani, S.IP', '192', '085175069132', 'AKTIF', '2024-05-29 10:13:06'),
('PW0051', 'Ila Diana, SE', '193', '082120226066', 'AKTIF', '2024-05-29 10:13:37'),
('PW0052', 'Ade Nirwana', '194', '085223233423', 'AKTIF', '2024-05-29 10:13:56'),
('PW0053', 'Wendi Ramadan, SE', '195', '082119793218', 'AKTIF', '2024-05-29 10:14:32'),
('PW0054', 'Drs Rudi Sonjaya Saehuri, M.Pd', '197', '081323423643', 'AKTIF', '2024-05-29 10:15:09'),
('PW0055', 'H Amin Bunyamin, S.Sos', '198', '081213837972', 'AKTIF', '2024-05-29 10:15:32'),
('PW0056', 'Harry Ahadiat Wiradjaja, ST, MM', '199', '081220330388', 'AKTIF', '2024-05-29 10:16:01'),
('PW0057', 'H. Ecep Sukron Munir, SE, MM', '200', '081221186709', 'AKTIF', '2024-05-29 10:17:53'),
('PW0058', 'Dimas Arif Munawir, SE, MM', '202', '085221510911', 'AKTIF', '2024-05-29 10:18:47'),
('PW0059', 'Fajar Ruslan', '203', '082127920856', 'AKTIF', '2024-05-29 10:19:08'),
('PW0060', 'Engkus Kusnadi', '204', '085221978865', 'AKTIF', '2024-05-29 10:19:33'),
('PW0061', 'Asep Yudi', '205', '000', 'AKTIF', '2024-05-29 10:19:58'),
('PW0062', 'Andi Sutiandi', '206', '082315338876', 'AKTIF', '2024-05-29 10:20:38'),
('PW0063', 'Beni Sutrisno', '207', '082128991589', 'AKTIF', '2024-05-29 10:21:08'),
('PW0064', 'Dani Nurdiana, SE', '208', '085324444678', 'AKTIF', '2024-05-29 10:22:18'),
('PW0065', 'Lala Heryana, S.STP, M.Si', '211', '082116772797', 'AKTIF', '2024-05-29 10:25:12'),
('PW0066', 'Srie Yuniatun, SP, MP', '212', '082240031129', 'AKTIF', '2024-05-29 10:26:03'),
('PW0067', 'Andri Herdiana, S.IP', '213', '081320022930', 'AKTIF', '2024-05-29 10:26:41'),
('PW0068', 'Dedi Sonjaya', '214', '000', 'AKTIF', '2024-05-29 10:27:13'),
('PW0069', 'Ade Holiludin', '215', '000', 'AKTIF', '2024-05-29 10:27:35'),
('PW0070', 'Adam Nugraha, S.IP', '216', '082347372456', 'AKTIF', '2024-05-29 10:28:48'),
('PW0071', 'Dr. Ruby Azhara, S.STP, M.Si', '217', '081223160337', 'AKTIF', '2024-05-29 10:30:07'),
('PW0072', 'Miftahudin Suryana, S.IP', '218', '0811212258', 'AKTIF', '2024-05-29 10:30:38'),
('PW0073', 'Agung Nurbudiansyah, S.IP', '219', '000', 'AKTIF', '2024-05-29 10:31:48'),
('PW0074', 'Suherman, S.STP', '220', '082126991666', 'AKTIF', '2024-05-29 10:32:22'),
('PW0075', 'Qais Asegaf', '221', '000', 'AKTIF', '2024-05-29 10:32:42'),
('PW0076', 'Anita Rohmat, SP', '222', '082120492851', 'AKTIF', '2024-05-29 10:33:24'),
('PW0077', 'Aap Pathudin, S.IP', '224', '000', 'AKTIF', '2024-05-29 10:33:51'),
('PW0078', 'Sri Yulia, S.Sos, MM', '225', '081324711649', 'AKTIF', '2024-05-29 10:34:21'),
('PW0079', 'Yusuf Iskandar', '226', '082118545011', 'AKTIF', '2024-05-29 10:34:54'),
('PW0080', 'Irfan Faisal', '227', '000', 'AKTIF', '2024-05-29 10:35:20'),
('PW0081', 'Erwin Faisal Lesmana, S.Pd', '228', '081221478445', 'AKTIF', '2024-05-29 10:36:46'),
('PW0082', 'Rizki Muhibbudin', '229', '081357015400', 'AKTIF', '2024-05-29 10:37:24'),
('PW0083', 'Haries Nursyamsu, SH, MH', '230', '081312136663', 'AKTIF', '2024-05-29 10:38:26'),
('PW0084', 'Sena Adikrisna, SH', '231', '08112128699', 'AKTIF', '2024-05-29 10:40:29'),
('PW0085', 'Gian Jatnika Munggaran, S.Kom', '232', '085200064224', 'AKTIF', '2024-05-29 10:41:10'),
('PW0086', 'Supena', '233', '081214945315', 'AKTIF', '2024-05-29 10:42:02'),
('PW0087', 'Asep Wahyudin, S.IP', '234', '082317161719', 'AKTIF', '2024-05-29 10:42:35'),
('PW0088', 'Dede Yusuf ', '235', '08112311105', 'AKTIF', '2024-05-29 10:43:05'),
('PW0089', 'Anton Watoni, S.AP', '240', '085900220214', 'AKTIF', '2024-05-29 10:44:03'),
('PW0090', 'Vittriah, S.E., M.Ak', '241', '08128156281', 'AKTIF', '2024-05-29 10:44:32'),
('PW0091', 'Asep Yanto Risdiyanto, S.Pt., MM', '242', '0895346159911', 'AKTIF', '2024-05-29 10:46:37'),
('PW0092', 'Dzikri Miftahul Huda, S.AP', '243', '088218028612', 'AKTIF', '2024-05-29 10:48:49'),
('PW0093', 'Hj. Rd. Ane Rochmawaty, S.IP., S.T.P., MM', '244', '081320081895', 'AKTIF', '2024-05-29 10:50:13'),
('PW0094', 'Rohimah, S.Si', '245', '082316080030', 'AKTIF', '2024-05-29 10:50:32'),
('PW0095', 'Atep Dadi Sumardi, S.T., M.T', '246', '081221727101', 'AKTIF', '2024-05-29 10:51:20'),
('PW0096', 'Agi Nurhidayah, S.Si., M.T', '247', '081232111119', 'AKTIF', '2024-05-29 10:52:07'),
('PW0097', 'Eful Syaeful Uyun, S.T', '248', '081320447484', 'AKTIF', '2024-05-29 10:52:39'),
('PW0098', 'Ine Susyane, S.T', '249', '082120822851', 'AKTIF', '2024-05-29 10:53:18'),
('PW0099', 'Imat Rohimat, S.IP', '250', '081394020022', 'AKTIF', '2024-05-29 10:53:56'),
('PW0100', 'Dadan Sunandar, S.Si', '251', '085322991844', 'AKTIF', '2024-05-29 10:54:31'),
('PW0101', 'Nurul Hikmah, S.Stat', '252', '081320725551', 'AKTIF', '2024-05-29 10:55:18'),
('PW0102', 'Nurhayati, S.KM', '255', '082211806841', 'AKTIF', '2024-05-29 10:56:26'),
('PW0103', 'Dr. Ratih Tedjasukmana', '256', '081324692229', 'AKTIF', '2024-05-29 10:57:05'),
('PW0104', 'Kania Dewi Kinasih, SE', '257', '0895334828545', 'AKTIF', '2024-05-29 10:57:35'),
('PW0105', 'Intan Ayu Hardiyanti, SE', '258', '087742275648', 'AKTIF', '2024-05-29 10:58:03'),
('PW0106', 'Mona Febriyanti, S.Ak', '259', '082214153239', 'AKTIF', '2024-05-29 10:58:32'),
('PW0107', 'Rizal Muhamad Syahid, S.Sos, M.Si', '260', '089649833317', 'AKTIF', '2024-05-29 10:59:04'),
('PW0108', 'Asep Priyatin Saputra, S.STP., M.Si', '261', '000', 'AKTIF', '2024-05-29 11:00:03'),
('PW0109', 'Eka Surtika, S.IP', '262', '082214037796', 'AKTIF', '2024-05-29 11:00:44'),
('PW0110', 'Shinta Lestari, S.Tr. IP', '263', '000', 'AKTIF', '2024-05-29 11:01:21'),
('PW0111', 'Ratna Sari Aisyah, SE', '264', '081317171683', 'AKTIF', '2024-06-05 13:10:38'),
('PW0112', 'Tamu', '000', '000', 'AKTIF', '2024-06-05 14:13:52'),
('PW0113', 'Febi / IT PSDA', '000', '085161584626', 'AKTIF', '2024-06-05 14:15:23'),
('PW0114', 'Bidang PSDA', '-', '000', 'AKTIF', '2024-06-05 14:46:18'),
('PW0115', 'Bidang FISIK', '-', '000', 'AKTIF', '2024-06-05 14:46:33'),
('PW0116', 'Bidang LITBANG', '-', '00', 'AKTIF', '2024-06-05 15:33:52'),
('PW0117', 'Bidang PPE', '-', '00', 'AKTIF', '2024-06-05 16:10:37'),
('PW0118', 'UMUM / SEKBAN', '-', '000', 'AKTIF', '2024-06-05 19:51:29'),
('PW0119', 'UMUM / KEPALA', '-', '000', 'AKTIF', '2024-06-05 19:51:54'),
('PW0120', 'UMUM / MAMIN', '-', '000', 'AKTIF', '2024-06-05 19:52:37'),
('PW0121', 'UMUM / ATK', '-', '000', 'AKTIF', '2024-06-05 19:53:01'),
('PW0122', 'Bidang PPM', '-', '000', 'AKTIF', '2024-06-05 19:58:20'),
('PW0123', 'Bidang PEP', '-', '0', 'AKTIF', '2024-06-24 15:02:20'),
('PW0124', 'Nida Fauziyyah Sambas, S.Mat', '266', '082121635664', 'AKTIF', '2024-06-25 15:51:19'),
('PW0125', 'BAU / KEUANGAN', '-', '-', 'AKTIF', '2024-06-25 15:53:41'),
('PW0126', 'UMUM / LISTRIK', '-', '-', 'AKTIF', '2024-06-26 16:11:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_nota` varchar(14) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `bayar` int(11) NOT NULL,
  `waktu_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_nota`, `tgl_pembayaran`, `bayar`, `waktu_data`) VALUES
(1, 'TRX012024.0001', '2023-01-22', 62000, '2024-05-05 09:42:00'),
(2, 'TRX012024.0002', '2023-02-01', 50000, '2024-05-05 09:42:00'),
(3, 'TRX012024.0002', '2023-02-02', 9000, '2024-05-05 09:42:00'),
(4, 'TRX012024.0003', '2023-02-02', 27000, '2024-05-05 09:42:00'),
(5, 'TRX012024.0004', '2024-04-08', 50000, '2024-05-05 09:42:00'),
(6, 'TRX012024.0005', '2024-04-08', 148000, '2024-05-05 09:42:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(13) NOT NULL COMMENT 'PJMMYYYY.0001',
  `id_barang` varchar(7) NOT NULL,
  `harga_satuan_beli` int(11) DEFAULT NULL,
  `harga_satuan_jual` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_nota` varchar(14) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `jenis_bayar` varchar(10) DEFAULT NULL COMMENT 'Cash atau Credit',
  `jumlah_barang` int(11) NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  `waktu_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_barang`, `harga_satuan_beli`, `harga_satuan_jual`, `id_user`, `id_nota`, `diskon`, `jenis_bayar`, `jumlah_barang`, `total_penjualan`, `waktu_data`) VALUES
('PJ012024.0001', 'BR008', 26000, 27000, 21, 'TRX012024.0001', 0, 'cash', 1, 27000, '2024-05-29 09:42:00'),
('PJ012024.0002', 'BR010', 24200, 27000, 21, 'TRX012024.0001', 2000, 'cash', 1, 25000, '2024-05-29 09:42:00'),
('PJ012024.0003', 'BR027', 2050, 5000, 21, 'TRX012024.0001', 0, 'cash', 2, 10000, '2024-05-29 09:42:00'),
('PJ012024.0004', 'BR054', 12000, 17000, 21, 'TRX012024.0002', 0, 'cash', 2, 34000, '2024-05-29 09:42:00'),
('PJ012024.0005', 'BR080', 5000, 8000, 21, 'TRX012024.0002', 3000, 'cash', 5, 25000, '2024-05-29 09:42:00'),
('PJ012024.0006', 'BR010', 24200, 27000, 21, 'TRX012024.0003', 0, 'cash', 1, 27000, '2024-05-29 09:42:00'),
('PJ012024.0007', 'BR010', 24200, 27000, 21, 'TRX012024.0004', 2000, 'credit', 2, 50000, '2024-05-29 09:42:00'),
('PJ012024.0008', 'BR010', 24200, 27000, 21, 'TRX012024.0005', 0, 'credit', 2, 54000, '2024-05-29 09:42:00'),
('PJ012024.0009', 'BR008', 26000, 27000, 21, 'TRX012024.0005', 0, 'credit', 1, 27000, '2024-05-29 09:42:00'),
('PJ012024.0010', 'BR010', 24200, 27000, 21, 'TRX012024.0005', 2000, 'credit', 2, 50000, '2024-05-29 09:42:00'),
('PJ012024.0011', 'BR054', 12000, 17000, 21, 'TRX012024.0005', 0, 'credit', 1, 17000, '2024-05-29 09:42:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `restok_barang`
--

CREATE TABLE `restok_barang` (
  `id_getstok` varchar(255) NOT NULL,
  `id_nota` varchar(14) NOT NULL,
  `nota_restok` varchar(255) NOT NULL,
  `waktu_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(100) DEFAULT NULL,
  `status_satuan` enum('AKTIF','TIDAK') NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `status_satuan`, `tgl_input`) VALUES
(13, 'GLS', 'AKTIF', '2024-05-02 11:00:48'),
(14, 'PCS', 'AKTIF', '2024-05-02 11:00:51'),
(15, 'BKS', 'AKTIF', '2024-05-06 09:18:38'),
(16, 'BTL', 'AKTIF', '2024-05-06 09:18:41'),
(17, 'DUS', 'AKTIF', '2024-05-06 09:18:49'),
(18, 'RIM', 'AKTIF', '2024-05-06 09:18:52'),
(19, 'LBR', 'AKTIF', '2024-05-06 09:18:57'),
(20, '3pcs', 'AKTIF', '2024-05-16 09:17:30'),
(21, 'PAKET', 'AKTIF', '2024-06-06 20:10:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `email`, `alamat`, `gambar`) VALUES
(21, 'Admin', 'admin', '$2y$10$fLvksEst2t4.RBFjX4dr6eQodt5ftEWG.aQkTeKa5ET9wIVYBuNEa', '123@gmail.com', '123', 'Kabupaten Tasikmalaya Single Color Black Version.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_temp_penjualan`
--

CREATE TABLE `_temp_penjualan` (
  `id_temp` varchar(12) NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `waktu_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `_temp_restok`
--

CREATE TABLE `_temp_restok` (
  `id_temp_restok` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `waktu_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `restok_barang`
--
ALTER TABLE `restok_barang`
  ADD PRIMARY KEY (`id_getstok`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `_temp_penjualan`
--
ALTER TABLE `_temp_penjualan`
  ADD PRIMARY KEY (`id_temp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
