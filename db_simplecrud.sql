-- --------------------------------------------------------
-- Database: db_simplecrud
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `db_simplecrud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `db_simplecrud`;

-- --------------------------------------------------------
-- Tabel: tb_karyawan (tanpa kolom provinsi)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_karyawan` (
  `id_karyawan` INT(11) NOT NULL AUTO_INCREMENT,
  `nik` VARCHAR(20) NOT NULL DEFAULT '',
  `nama_karyawan` VARCHAR(200) NOT NULL DEFAULT '',
  `jabatan` CHAR(10) NOT NULL DEFAULT '',
  `alamat` TEXT NOT NULL,
  `kategori` MEDIUMINT(3) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `telp` CHAR(20) NOT NULL DEFAULT '',
  `status_karyawan` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: tb_jabatan
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_jabatan` (
  `kode_jabatan` CHAR(10) NOT NULL,
  `nama_jabatan` CHAR(100) NOT NULL,
  `deskripsi` TEXT NULL,
  `level_jabatan` INT(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`kode_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data dummy tb_jabatan
INSERT INTO `tb_jabatan` (`kode_jabatan`, `nama_jabatan`, `deskripsi`, `level_jabatan`) VALUES
('Mgr', 'Manager', 'Mengatur seluruh operasional perusahaan', 1),
('Spv', 'Supervisor', 'Mengawasi pekerjaan staf di bawahnya', 2),
('HRD', 'Human Resource Department', 'Mengelola data karyawan dan administrasi kepegawaian', 2),
('Adm', 'Admin', 'Menginput dan mengelola data dalam sistem', 3),
('Ksr', 'Kasir', 'Melakukan transaksi dan pencatatan keuangan', 3),
('KDV', 'Kepala Divisi', 'Memimpin dan mengkoordinasi satu divisi', 2),
('SKF', 'Staf Keuangan', 'Mengelola pencatatan dan laporan keuangan', 3),
('SIT', 'Staf IT (Information Technology)', 'Menangani sistem aplikasi dan jaringan', 3),
('Opr', 'Operator', 'Menjalankan tugas operasional harian', 4),
('KYU', 'Karyawan Umum', 'Membantu tugas harian sesuai arahan', 4);

-- --------------------------------------------------------
-- Tabel: tb_kategori
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_kategori` (
  `id_kategori` SMALLINT(3) NOT NULL AUTO_INCREMENT,
  `nama_kategori` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data dummy tb_kategori
INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'IT'),
(2, 'Administrasi'),
(3, 'Keuangan'),
(4, 'Produksi'),
(5, 'Marketing'),
(6, 'Customer Service'),
(7, 'Support'),
(8, 'R&D'),
(9, 'HR');
