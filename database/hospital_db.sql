-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2017 at 06:40 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `kd_dokter` char(4) NOT NULL,
  `nm_dokter` varchar(100) NOT NULL,
  `jns_kelamin` varchar(13) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `sip` varchar(20) NOT NULL,
  `spesialisasi` varchar(100) NOT NULL,
  `bagi_hasil` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`kd_dokter`, `nm_dokter`, `jns_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `sip`, `spesialisasi`, `bagi_hasil`) VALUES
('D001', 'dr. Subarjo Sujono', 'Laki-laki', 'Yogyakarta', '1975-12-02', 'Jl. Janti, Karang Jambe 130, Yogyakarta', '081928282811', '0101010101', 'Umum', 10),
('D002', 'dr. Sulis Tiyowati', 'Laki-laki', 'Yogyakarta', '1975-01-12', 'Jl. Condong Catur, Yogyakarta', '081971717171', '1001010101010', 'Umum', 10),
('D003', 'dr. Prasetio Hadi, S.KG', 'Laki-laki', 'Tegal', '1980-12-01', 'Jl. Yogyakarta, 130', '081981818188', '2012/00000001', 'Gigi', 10),
('D004', 'dr. Marjoko Suhendra, S.KG', 'Laki-laki', 'Tegal', '1988-01-12', 'Jl. Raya Janti', '081921212333', '2001/101010102', 'Gigi', 10);

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(3) NOT NULL,
  `nama_modul` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `urutan` int(3) NOT NULL,
  `status` enum('admin','user') NOT NULL DEFAULT 'admin',
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `urutan`, `status`, `aktif`) VALUES
(1, 'Identitas Web', '?module=identitas', 20, 'admin', 'N'),
(2, 'Manajemen User', '?module=user', 1, 'admin', 'Y'),
(3, 'Manajemen Modul', '?module=modul', 2, 'admin', 'Y'),
(4, 'Menu Website', '?module=menu', 15, 'admin', 'N'),
(5, 'Kategori', '?module=kategori', 24, 'admin', 'N'),
(6, 'Berita', '?module=berita', 89, 'user', 'N'),
(7, 'Tag Berita', '?module=tag', 90, 'admin', 'N'),
(8, 'Penjualan Apotek', '?module=penjualan', 10, 'admin', 'Y'),
(9, 'Galeri Foto', '?module=galerifoto', 90, 'admin', 'N'),
(10, 'apa aja', '?module=agenda', 100, 'user', 'N'),
(11, 'Download', '?module=download', 11, 'admin', 'N'),
(12, 'Banner', '?module=banner', 12, 'admin', 'N'),
(13, 'Polling', '?module=polling', 13, 'admin', 'N'),
(14, 'Hubungi Kami', '?module=hubungi', 14, 'admin', 'N'),
(15, 'Halaman Statis', '?module=halamanstatis', 15, 'admin', 'N'),
(17, 'Templates', '?module=templates', 16, 'admin', 'N'),
(18, 'Video', '?module=video', 17, 'admin', 'N'),
(19, 'herry', '?module=herry', 18, 'admin', 'N'),
(20, 'Dokter', '?module=dokter', 4, 'admin', 'Y'),
(21, 'Tindakan', '?module=tindakan', 3, 'admin', 'Y'),
(22, 'Obat', '?module=obat', 5, 'admin', 'Y'),
(23, 'Registrasi Pasien', '?module=pendaftaran', 8, 'user', 'Y'),
(24, 'Pasien', '?module=pasien', 7, 'admin', 'Y'),
(25, 'Rawat Jalan', '?module=rawatjalan', 9, 'user', 'Y'),
(26, 'Back Up', '?module=backup', 10, 'admin', 'Y'),
(27, 'Laporan Rs', '?module=laporan', 10, 'admin', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `kd_obat` char(5) NOT NULL,
  `nm_obat` varchar(100) NOT NULL,
  `harga_modal` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kd_obat`, `nm_obat`, `harga_modal`, `harga_jual`, `stok`, `keterangan`) VALUES
('H0001', 'Akar Zaitun', 37000, 50000, 92, 'Obat Diabetes'),
('H0002', 'Habatusauda', 85000, 100000, 92, 'untuk kesehatans'),
('H0003', 'Air Zam Zam 1 Liter ', 26000, 40000, 9, 'air zam zam'),
('H0004', 'Alat Bekam 12 Cup', 58000, 70000, 9, 'alat bekam'),
('H0005', 'Bio Skin Car', 10000, 15000, 36, 'Skin car'),
('H0006', 'Bio Xamthone', 60000, 70000, 8, 'xamtone'),
('H0007', 'Buah Merah Papua (BMW) ', 55000, 90000, 10, 'buah merah'),
('H0008', 'Cabe Jawa HIU', 27000, 45000, 6, 'cabe jawa'),
('H0009', 'Cream Jerawat Anisa Dark Spot', 55000, 85000, 9, 'untuk jerawat'),
('H0010', 'Daun Sirsak HIU', 27000, 45000, 17, 'daun sirsak'),
('H0011', 'Diabetas Binasyifa', 27500, 50000, 21, 'obat diabetes'),
('H0012', 'Etawa Emas Original', 25000, 45000, 19, 'susu etawa'),
('H0013', 'FOREDI ', 165000, 200000, 6, 'obat kuat pria'),
('H0014', 'Gamat HIU', 45000, 75000, 9, 'gamat'),
('H0015', 'Gemuk Badan Binasyifa', 22000, 40000, 16, 'herbal gemuk badan'),
('H0016', 'Habasyi Oil 210 Kps', 50000, 89000, 18, 'Habatusauda'),
('H0017', 'Habasyi Oil 75 Kps', 24000, 42500, 19, 'habatusauda'),
('H0018', 'Habasyi Plus 120 Kapsul', 20000, 26500, 17, 'habatusauda plus mnyak zaitun'),
('H0019', 'Habasyi Plus 200 Kapsul', 30500, 42000, 19, 'habatusauda plus mnyak zaitun'),
('H0020', 'Herba Sambung Nyowo HIU', 27500, 45000, 10, 'sambung nyowo'),
('H0021', 'Herbal Oil Sambung Nyowo', 50000, 75000, 20, 'sambung nyowo'),
('H0022', 'Honey Moon', 39500, 70000, 18, 'rapet wanita'),
('H0023', 'Injoy Reflexology Sandal', 90000, 150000, 10, 'sandal refleksi'),
('H0024', 'Jadied Lambung', 15000, 25000, 10, 'untuk lambung'),
('H0025', 'Joss X HIU', 27000, 45000, 10, 'keperkasaan pria'),
('H0026', 'Joss V HIU', 27000, 45000, 10, 'keperkasaan wanita'),
('H0027', 'Kapsul Jati Belanda', 27000, 40000, 10, 'jati belanda'),
('H0028', 'Keladi Tikus Toga Nusantara', 29000, 55000, 10, 'tikus'),
('H0029', 'Klorofil K-Link', 67000, 150000, 10, 'k-link'),
('H0030', 'Koyo Anti Nyamuk', 8000, 15000, 50, 'anti nyamuk'),
('H0031', 'Lamandel ', 20500, 35000, 20, 'obat amandel'),
('H0032', 'Madu Batuk Al Wadey', 18000, 26000, 10, 'obat batuk'),
('H0033', 'Madu Mesir', 47000, 75000, 10, 'madu murni'),
('H0034', 'Madu Sambung Nyowo 100 ML', 24000, 35000, 10, 'sambung nyowo'),
('H0035', 'Madu Sambung Asmoro 100 ML', 24000, 35000, 10, 'sambung asmoro'),
('H0036', 'Nama Obat', 30000, 50000, 13, 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `nomor_rm` char(6) NOT NULL,
  `nm_pasien` varchar(100) NOT NULL,
  `no_identitas` varchar(40) NOT NULL,
  `jns_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `gol_darah` enum('A','B','AB','O') NOT NULL,
  `agama` enum('Islam','Kristen Katholik','Kristen Protestan','Budha','Hindu') NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `stts_nikah` enum('Belum Menikah','Sudah Menikah') NOT NULL,
  `pekerjaan` enum('Wiraswasta','Mahasiswa / Pelajar','Pegawai Negri Sipil','Pegawai Swasta') NOT NULL,
  `tgl_rekam` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`nomor_rm`, `nm_pasien`, `no_identitas`, `jns_kelamin`, `gol_darah`, `agama`, `tempat_lahir`, `tanggal_lahir`, `no_telepon`, `alamat`, `stts_nikah`, `pekerjaan`, `tgl_rekam`, `username`) VALUES
('RM0001', 'Taufik Hidayat', '2001/0000001', 'Laki-laki', 'A', 'Islam', 'Way Jepara', '1987-12-01', '081918181818', 'Jl. Yogyakarta, 130', '', '', '2013-12-01', ''),
('RM0002', 'Susi Susanti', '2011/10101010', 'Laki-laki', 'A', 'Islam', 'Yogyakarta', '1988-12-01', '081918181818', 'Jl. Pengangguran, Gg Sengon, 230', '', '', '2013-12-01', ''),
('RM0003', 'Waluyo Suroboyo', '2001/0000002', 'Laki-laki', 'A', 'Islam', 'Way Jepara', '1981-10-01', '0819112121', 'Jl. Yogyakarta, 130', '', '', '2013-12-01', 'P001'),
('RM0004', 'Yudiyono', '2011/10101013', 'Laki-laki', 'A', 'Islam', 'Magelang', '2013-12-01', '081921212333', 'Jl. Ringrud Selatan 24 Yogyakarta', '', '', '2013-12-01', ''),
('RM0005', 'Sardi Sudrajad', '029292929', 'Laki-laki', 'A', 'Islam', 'Lampung', '1985-12-05', '081918181818', 'Jl. Suhada, Margahayu, Labuan Ratu Satu, Lampung Timur', '', '', '2013-12-03', ''),
('RM0006', 'Yaulin Sulino', '01919191919', 'Laki-laki', 'AB', 'Islam', 'Way Jepara, Lampung', '1980-12-21', '08197817818', 'Jl. Labuhan Ratu baru, Lampung Timur', '', 'Wiraswasta', '2013-12-03', ''),
('RM0007', 'Eswanto', '2001-191919199', 'Laki-laki', 'O', 'Islam', 'Yogyakarta', '1978-02-12', '081911818818', 'Jl. Margayu, Way Jepara, Lampung Timur', '', 'Wiraswasta', '2013-12-03', ''),
('RM0008', 'Umi Rahayu', '2001-191919191', 'Perempuan', 'B', 'Islam', 'Sukadana', '1982-11-22', '081788882222', 'Jl. Sukadana Timur, Lampung Timur', '', 'Wiraswasta', '2013-12-03', ''),
('RM0009', 'M Sahmin', '2001-19191919', 'Laki-laki', 'AB', 'Islam', 'Way Jepara', '1977-03-15', '081928282828', 'Jl. Labuhan Ratu 1, Way Jepara, Lampung Timur', '', '', '2013-12-03', ''),
('RM0010', 'Nining Yuliani', '2001-01010101', 'Perempuan', 'A', 'Islam', 'Way Jepara, Lampung Timur', '1983-05-21', '0852212121', 'Jl. Labuhan Ratu 1, Way Jepara, Lampung Timur', '', '', '2013-12-03', ''),
('RM0011', 'Herry Prasetyo', '2001-110010101', 'Laki-laki', 'AB', 'Islam', 'Jakarta', '1988-12-08', '08571682901', 'Jl.P.Flores II No 73 RT 02/010 Aren Jaya, Perumnas III Bekasi Timur', 'Sudah Menikah', 'Pegawai Swasta', '2017-03-19', 'admin'),
('RM0013', 'Herry', '23412312', 'Laki-laki', 'A', 'Islam', 'Jakarta', '1988-12-08', '08571682901', 'bekasi', 'Belum Menikah', 'Wiraswasta', '2017-03-21', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `no_daftar` char(7) NOT NULL,
  `nomor_rm` char(6) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_janji` date NOT NULL,
  `jam_janji` time NOT NULL,
  `keluhan` varchar(100) NOT NULL,
  `kd_tindakan` char(4) NOT NULL,
  `nomor_antri` int(4) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`no_daftar`, `nomor_rm`, `tgl_daftar`, `tgl_janji`, `jam_janji`, `keluhan`, `kd_tindakan`, `nomor_antri`, `username`) VALUES
('0000003', 'RM0001', '2017-03-24', '2017-03-21', '00:12:00', 'Sakit Gigi', 'T025', 1, 'admin'),
('0000002', 'RM0010', '2017-03-21', '2017-03-19', '23:12:00', 'Sakit Gigi', 'T004', 2, 'admin'),
('0000001', 'RM0011', '2017-03-21', '2017-03-19', '14:12:00', 'Sakit Gigi', 'T004', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_penjualan` char(7) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `pelanggan` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `uang_bayar` int(12) NOT NULL,
  `kd_petugas` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `tgl_penjualan`, `pelanggan`, `keterangan`, `uang_bayar`, `kd_petugas`) VALUES
('JL00001', '2014-01-08', 'Pelanggan', 'dengan Resep Obat', 400000, 'P001'),
('JL00002', '2014-01-09', 'Pelanggan', 'dengan Resep Obat', 300000, 'P001'),
('JL00003', '2014-01-10', 'Pelanggan', 'dengan Resep Obat', 250000, 'P001'),
('JL00004', '2014-01-11', 'Pelanggan', 'dengan Resep Obat', 200000, 'P001'),
('JL00005', '2014-01-11', 'Pelanggan', 'dengan Resep Obat', 250000, 'P001'),
('JL00006', '2014-01-20', 'Pelanggan', 'dengan Resep Obat', 260000, 'P001'),
('JL00007', '2014-01-21', 'Pelanggan', 'dengan Resep Obat', 150000, 'P001'),
('JL00008', '2014-02-08', 'Pasien', 'Pengobatan Herbal', 200000, 'P001');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_item`
--

CREATE TABLE `penjualan_item` (
  `no_penjualan` char(7) NOT NULL,
  `kd_obat` char(5) NOT NULL,
  `harga_modal` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `jumlah` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_item`
--

INSERT INTO `penjualan_item` (`no_penjualan`, `kd_obat`, `harga_modal`, `harga_jual`, `jumlah`) VALUES
('JL00001', 'H0001', 37000, 50000, 2),
('JL00001', 'H0002', 85000, 100000, 3),
('JL00002', 'H0013', 165000, 200000, 1),
('JL00002', 'H0022', 39500, 70000, 1),
('JL00003', 'H0005', 10000, 15000, 4),
('JL00003', 'H0010', 27000, 45000, 1),
('JL00003', 'H0017', 24000, 42500, 1),
('JL00003', 'H0018', 20000, 26500, 3),
('JL00004', 'H0013', 165000, 200000, 1),
('JL00005', 'H0011', 27500, 50000, 4),
('JL00005', 'H0012', 25000, 45000, 1),
('JL00006', 'H0015', 22000, 40000, 4),
('JL00006', 'H0002', 85000, 100000, 1),
('JL00007', 'H0001', 37000, 50000, 1),
('JL00007', 'H0002', 85000, 100000, 1),
('JL00008', 'H0001', 37000, 50000, 1),
('JL00008', 'H0002', 85000, 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `kd_tindakan` char(4) NOT NULL,
  `nm_tindakan` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`kd_tindakan`, `nm_tindakan`, `harga`) VALUES
('T001', 'KONSULTASI / PREMEDIKASI ', 55000),
('T002', 'SCALLING - Pembersihan Karang Gigi - Sedikit', 175000),
('T003', 'SCALLING - Pembersihan Karang Gigi - Sedang', 200000),
('T004', 'SCALLING - Pembersihan Karang Gigi - Banyak', 250000),
('T005', 'PENAMBALAN - Penambalan Sementara', 100000),
('T006', 'PENAMBALAN - Preparasi (Sterilisiasi Saluran Akar)', 125000),
('T007', 'PENAMBALAN - Bongkar Tambalan (Open Bur)', 100000),
('T008', 'PENAMBALAN - Pengisian Saluran Akar', 150000),
('T009', 'PENAMBALAN - Tambal Amalgam', 150000),
('T010', 'PENAMBALAN - Tambal Puji (GIC) - Anak', 175000),
('T011', 'PENAMBALAN - Tambal Puji (GIC) - Dewasa', 200000),
('T012', 'PENAMBALAN - Tambal Sinar (Composite) - Kecil', 175000),
('T013', 'PENAMBALAN - Tambal Sinar (Composite) - Sedang', 200000),
('T014', 'PENAMBALAN - Tambal Sinar (Composite) - Besar', 250000),
('T015', 'PENAMBALAN - Tambal Sinar (Composite) - Selubung/Dibentuk', 300000),
('T016', 'PENAMBALAN - Pengisian Saluran Akar + Tambal Puji', 300000),
('T017', 'PENAMBALAN - Pengisian Saluran Akar + Tambal Sinar', 350000),
('T018', 'PENAMBALAN - Pengisian Saluran Akar + Tambal Metode Sandwich', 400000),
('T019', 'PENAMBALAN - Pasak', 150000),
('T020', 'PENAMBALAN - Inlay/Onlay dari Bahan Metal + Cetak', 1000000),
('T021', 'PENAMBALAN - Inlay/Onlay dari Bahan Metal Porselin + Cetak', 1500000),
('T022', 'PENCABUTAN GIGI - Gigi Susu dg Anestesi Chlor Ethyl (Tanpa Suntik)', 100000),
('T023', 'PENCABUTAN GIGI - Gigi Susu dg Anestesi PH Cain (Dengan Suntik)', 125000),
('T024', 'PENCABUTAN GIGI - Gigi Dewasa (Sisa Akar / Akar Satu)', 150000),
('T025', 'PENCABUTAN GIGI - Gigi Dewasa (Lebih dari Satu Akar)', 200000),
('T026', 'PENCABUTAN GIGI - Gigi Dewasa dg Faktor Penyulit (Komplikasi)', 400000);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_penjualan`
--

CREATE TABLE `tmp_penjualan` (
  `id` int(10) NOT NULL,
  `kd_obat` char(5) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `kd_petugas` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_rawat`
--

CREATE TABLE `tmp_rawat` (
  `id` int(10) NOT NULL,
  `kd_tindakan` char(4) NOT NULL,
  `harga` int(12) NOT NULL,
  `kd_dokter` char(4) NOT NULL,
  `bagi_hasil_dokter` int(4) NOT NULL,
  `kd_petugas` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `level`, `blokir`, `id_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@gmail.com', 'admin', 'N', 'a4ce3are6feupgqcnjiu2d9ap3'),
('anindita', 'e10adc3949ba59abbe56e057f20f883e', 'Anindita Sri Wahyuni', 'anindita@gmail.com', 'user', 'N', '7ml9mqome3ngd2u3qbfmgvnkv3'),
('tyook88', '202cb962ac59075b964b07152d234b70', 'Herry Prasetyo', 'herry_prasetyo@hotmail.com', 'user', 'Y', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`kd_dokter`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kd_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`nomor_rm`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`no_daftar`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_penjualan`);

--
-- Indexes for table `penjualan_item`
--
ALTER TABLE `penjualan_item`
  ADD KEY `nomor_penjualan_tamu` (`no_penjualan`,`kd_obat`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`kd_tindakan`);

--
-- Indexes for table `tmp_penjualan`
--
ALTER TABLE `tmp_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_rawat`
--
ALTER TABLE `tmp_rawat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tmp_penjualan`
--
ALTER TABLE `tmp_penjualan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tmp_rawat`
--
ALTER TABLE `tmp_rawat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
