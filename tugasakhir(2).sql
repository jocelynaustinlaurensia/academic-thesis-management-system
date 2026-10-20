-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2025 at 06:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugasakhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` char(2) NOT NULL,
  `admin_USER` char(30) NOT NULL,
  `admin_PASS` char(255) NOT NULL,
  `admin_NAMA` varchar(255) NOT NULL,
  `admin_NPM` varchar(20) NOT NULL,
  `admin_KELAS` varchar(50) NOT NULL,
  `admin_FOTO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_USER`, `admin_PASS`, `admin_NAMA`, `admin_NPM`, `admin_KELAS`, `admin_FOTO`) VALUES
('11', 'paes@yahoo.com', '123', 'Jocelyn Austin Laurensia', '825240044', 'SI B', 'pas foto.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `berita_ID` int(11) NOT NULL,
  `admin_ID` char(2) NOT NULL,
  `kategori_ID` char(4) NOT NULL,
  `penulis_ID` char(4) NOT NULL,
  `berita_JUDUL` varchar(255) NOT NULL,
  `berita_ISI` text NOT NULL,
  `berita_GAMBAR` text NOT NULL,
  `berita_TANGGAL` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`berita_ID`, `admin_ID`, `kategori_ID`, `penulis_ID`, `berita_JUDUL`, `berita_ISI`, `berita_GAMBAR`, `berita_TANGGAL`) VALUES
(1, '', 'TEK', 'ED01', 'Peluncuran Smartphone X Terbaru Guncang Pasar Gadget Indonesia', 'Perusahaan teknologi raksasa baru saja merilis seri smartphone andalan mereka di Jakarta hari ini. Dengan fitur kamera berbasis AI dan baterai tahan 2 hari, ponsel ini diprediksi akan menjadi primadona baru bagi kaum milenial. Pre-order sudah dibuka mulai besok dengan harga yang sangat kompetitif', 'buku.webp', '2025-12-08'),
(2, '', 'EKO', 'KTRB', 'Timnas Indonesia Siap Tempur Hadapi Laga Final Piala Asia', 'Skuad Garuda terus mematangkan persiapan menjelang laga krusial akhir pekan ini. Pelatih kepala menegaskan bahwa seluruh pemain dalam kondisi prima dan siap memberikan yang terbaik untuk merah putih. Dukungan suporter dipastikan akan membanjiri stadion utama.', 'cooking.jpg', '2025-12-03'),
(3, '', 'siko', 'EKO1', 'Apa itu kesehatan mental?', 'Kesehatan mental sangat penting', '12-2711683485.webp', '2025-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `bimbinganskripsi`
--

CREATE TABLE `bimbinganskripsi` (
  `iD` int(11) NOT NULL,
  `dosen_NIDN` char(10) NOT NULL,
  `mhs_NPM` int(11) NOT NULL,
  `bimbingan_TGL` date NOT NULL,
  `bimbingan_ISI` text NOT NULL,
  `bimbingan_DOKUMEN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bimbinganskripsi`
--

INSERT INTO `bimbinganskripsi` (`iD`, `dosen_NIDN`, `mhs_NPM`, `bimbingan_TGL`, `bimbingan_ISI`, `bimbingan_DOKUMEN`) VALUES
(1, '1321083294', 825240044, '2025-11-01', '123', '825240044_Jocelyn_Query Pertemuan 10.pdf'),
(2, '0099436586', 825240044, '2025-12-01', 'Konsultasi BAB 1: Revisi pada bagian Latar Belakang Masalah dan penajaman Rumusan Masalah agar lebih spesifik', '825240044_Jocelyn_Query Pertemuan 14.pdf'),
(3, '847597682', 825240117, '2025-12-01', 'Konsultasi BAB 1: Revisi pada bagian Latar Belakang Masalah dan penajaman Rumusan Masalah agar lebih spesifik', '825240044_Jocelyn_Query Pertemuan 9.pdf'),
(4, '1321083294', 825240100, '2025-12-08', 'Konsultasi Bab 3 (Metodologi). Diskusi mengenai teknik pengambilan sampel dan validasi instrumen kuesioner sebelum sebar data', 'Modul PJJ IPS Kelas 9-050221.pdf'),
(5, '0099436586', 825240044, '2025-12-09', 'Konsultasi Bab 2', '');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `dosen_NIDN` char(10) NOT NULL,
  `dosen_NIK` char(8) NOT NULL,
  `dosen_Nama` varchar(30) NOT NULL,
  `dosen_Ket` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`dosen_NIDN`, `dosen_NIK`, `dosen_Nama`, `dosen_Ket`) VALUES
('0099436586', '76859323', 'Dewi Sari Wijoyo, S.E., M.Si.', 'Dosen tetap Fakultas Psikologi'),
('1321083294', '76548932', 'Agustin Palupi, S.E., Ak.', 'Dosen pengampu mata kuliah Manajemen Proyek TI'),
('847597682', '68329342', 'Aan Marlinah, S.E., M. Ak. Aku', 'Dosen pembimbing skripsi mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_ID` char(4) NOT NULL,
  `kategori_NAMA` char(30) NOT NULL,
  `kategori_KET` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_ID`, `kategori_NAMA`, `kategori_KET`) VALUES
('EKO', 'Ekonomi', 'Update pasar saham, nilai tukar rupiah, perbankan, dan dunia usaha'),
('POL', 'Politik', 'Berita seputar kebijakan pemerintah, pemilu, partai politik, dan isu parlemen terkini'),
('siko', 'psikologi', 'mental kesehatan manusia'),
('TEK', 'Teknologi', 'Ulasan gadget terbaru, perkembangan startup, aplikasi, dan sains');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `mhs_NPM` int(9) NOT NULL,
  `mhs_Nama` char(40) NOT NULL,
  `mhs_Alamat` varchar(100) NOT NULL,
  `mhs_DOB` date NOT NULL,
  `mhs_Ket` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`mhs_NPM`, `mhs_Nama`, `mhs_Alamat`, `mhs_DOB`, `mhs_Ket`) VALUES
(825240044, 'Jocelyn', 'Jl. Citra 8', '2006-10-24', 'Mahasiswa Angkatan 2024'),
(825240100, 'Jane', 'Jl. Taman Palem Lestari', '2006-08-01', 'Mahasiswa Cumlaude'),
(825240117, 'Jonathan Patrick', 'Jl. Citra 7', '2025-11-01', 'Mahasiswa angkatan 1990');

-- --------------------------------------------------------

--
-- Table structure for table `penasihat`
--

CREATE TABLE `penasihat` (
  `mhs_NPM` int(9) NOT NULL,
  `dosen_NIDN` char(10) NOT NULL,
  `penasihat_FILE` char(60) NOT NULL,
  `penasihat_KET` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penasihat`
--

INSERT INTO `penasihat` (`mhs_NPM`, `dosen_NIDN`, `penasihat_FILE`, `penasihat_KET`) VALUES
(82524, '847597682', 'el nido.jpg', 'tes123'),
(825190001, '0099436586', '', 'engga'),
(825240044, '1321083294', '', 'iya'),
(825240100, '1321083294', '', 'apakah'),
(82524, 'Cari NIDN', '', 'iyaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `penulis_ID` char(4) NOT NULL,
  `penulis_NAMA` text NOT NULL,
  `penulis_EMAIL` text NOT NULL,
  `penulis_FOTO` text NOT NULL,
  `penulis_BIO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`penulis_ID`, `penulis_NAMA`, `penulis_EMAIL`, `penulis_FOTO`, `penulis_BIO`) VALUES
('ED01', 'Budi Santosa', 'budi.santosa@portalberita.com', 'image.png', 'Jurnalis senior dengan pengalaman lebih dari 10 tahun meliput isu politik dan hukum nasional. Menjunjung tinggi integritas dan fakta.'),
('EKO1', 'Jocelyn', 'jocelyn@berita.com', 'fried rice.jpg', 'Seorang penulis '),
('KTRB', 'Dimas Pratama', 'dimas.travel@portalberita.com', 'anak.jpg', 'Penulis lepas yang hobi traveling dan kuliner. Berbagi cerita seru dari berbagai pelosok nusantara'),
('TEK1', 'Sarah Andini', 'sarah.tech@portalberita.com', '1200px-Raymond_Westerling.jpg', 'Pengamat teknologi dan gadget enthusiast. Suka mengulas smartphone terbaru dan tren startup digital di Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `pesertaskripsi`
--

CREATE TABLE `pesertaskripsi` (
  `mhs_NPM` int(9) NOT NULL,
  `peserta_SEMT` char(6) NOT NULL,
  `peserta_THAKD` char(9) NOT NULL,
  `peserta_TGLDAFTAR` date NOT NULL,
  `peserta_JUDUL` char(80) NOT NULL,
  `peserta_DESKRIPSI` text NOT NULL,
  `peserta_DOKUMEN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesertaskripsi`
--

INSERT INTO `pesertaskripsi` (`mhs_NPM`, `peserta_SEMT`, `peserta_THAKD`, `peserta_TGLDAFTAR`, `peserta_JUDUL`, `peserta_DESKRIPSI`, `peserta_DOKUMEN`) VALUES
(82524, 'Genap', '2023-2024', '2025-11-29', 'bbbbbb', '', ''),
(82524, 'Genap', '2023-2024', '2025-11-29', 'bbbbbb', '', ''),
(825190001, 'Genap', '2024-2025', '2025-11-22', 'apa yang dimaksud', '', ''),
(825240117, 'Ganjil', '2025-2026', '2025-12-04', 'Rancang Bangun Sistem Informasi Penjualan Berbasis Web pada Toko Elektronik \"Maj', 'Saat ini, Toko Elektronik \"Maju Jaya\" masih melakukan proses penjualan dan pencatatan stok barang secara manual menggunakan buku besar. Hal ini sering menyebabkan kesalahan dalam perhitungan stok dan lambatnya pelayanan kepada pelanggan.', 'hutan.webp'),
(825240100, 'Genap', '2027-2028', '2025-12-06', 'Pengembangan Content Management System (CMS) untuk Pengelolaan Redaksi Berita On', 'Penelitian ini berfokus pada pengembangan aplikasi CMS yang memudahkan tim redaksi dalam mengelola konten', 'cagar.jpg'),
(825240044, 'Genap', '2021-2022', '2025-12-02', 'apa itu sql?', 'sql adalah structured query language', 'atlet-angkat-besi.webp');

-- --------------------------------------------------------

--
-- Table structure for table `ujianskripsi`
--

CREATE TABLE `ujianskripsi` (
  `id` int(11) NOT NULL,
  `bimbingan_ID` int(11) NOT NULL,
  `ujian_TGL` date NOT NULL,
  `ujian_WAKTU` datetime NOT NULL,
  `ujian_FOTO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujianskripsi`
--

INSERT INTO `ujianskripsi` (`id`, `bimbingan_ID`, `ujian_TGL`, `ujian_WAKTU`, `ujian_FOTO`) VALUES
(4, 0, '2025-11-22', '2025-11-22 10:30:00', 'pict.jpg'),
(7, 3, '2025-12-01', '2025-12-01 10:00:00', 'hujan.jpg'),
(8, 4, '2025-12-06', '2025-12-06 11:00:00', 'kumpulan-virtual-background-zoom-untuk-meeting-formal-hingga-aesthetic-dan-kocak-20210916013227.jpg'),
(10, 5, '2025-12-14', '2025-12-14 10:00:00', 'coconut.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`berita_ID`);

--
-- Indexes for table `bimbinganskripsi`
--
ALTER TABLE `bimbinganskripsi`
  ADD PRIMARY KEY (`iD`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`dosen_NIDN`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_ID`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`penulis_ID`);

--
-- Indexes for table `ujianskripsi`
--
ALTER TABLE `ujianskripsi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `berita_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bimbinganskripsi`
--
ALTER TABLE `bimbinganskripsi`
  MODIFY `iD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ujianskripsi`
--
ALTER TABLE `ujianskripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
