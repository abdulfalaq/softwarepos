/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 100119
Source Host           : localhost:3306
Source Database       : olive_kasir

Target Server Type    : MYSQL
Target Server Version : 100119
File Encoding         : 65001

Date: 2019-08-02 17:55:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for data_record_anggota
-- ----------------------------
DROP TABLE IF EXISTS `data_record_anggota`;
CREATE TABLE `data_record_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `kode_member` varchar(20) DEFAULT NULL,
  `kode_dokter` varchar(20) DEFAULT NULL,
  `kode_item` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_record_anggota
-- ----------------------------

-- ----------------------------
-- Table structure for data_rekam_medik
-- ----------------------------
DROP TABLE IF EXISTS `data_rekam_medik`;
CREATE TABLE `data_rekam_medik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `kode_member` varchar(20) DEFAULT NULL,
  `kode_dokter` varchar(20) DEFAULT NULL,
  `anamnesa` mediumtext,
  `diagnosa` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_rekam_medik
-- ----------------------------

-- ----------------------------
-- Table structure for opsi_transaksi_batal
-- ----------------------------
DROP TABLE IF EXISTS `opsi_transaksi_batal`;
CREATE TABLE `opsi_transaksi_batal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(25) DEFAULT NULL,
  `kode_reservasi` varchar(20) DEFAULT NULL,
  `kode_kasir` varchar(20) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `kode_member` varchar(20) DEFAULT NULL,
  `kode_periksa` varchar(20) DEFAULT NULL,
  `kode_dokter` varchar(20) DEFAULT NULL,
  `kode_terapis` varchar(20) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `jenis_item` varchar(20) DEFAULT NULL,
  `kode_item` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qty_poin` int(11) DEFAULT NULL,
  `hpp` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `poin_terpakai` int(11) DEFAULT NULL,
  `jenis_diskon` varchar(20) DEFAULT NULL,
  `diskon_persen` int(11) DEFAULT NULL,
  `diskon_rupiah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `ambil_paket` enum('Tidak','Ya') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of opsi_transaksi_batal
-- ----------------------------

-- ----------------------------
-- Table structure for opsi_transaksi_batal_temp
-- ----------------------------
DROP TABLE IF EXISTS `opsi_transaksi_batal_temp`;
CREATE TABLE `opsi_transaksi_batal_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(25) DEFAULT NULL,
  `kode_reservasi` varchar(20) DEFAULT NULL,
  `kode_kasir` varchar(20) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `kode_member` varchar(20) DEFAULT NULL,
  `kode_periksa` varchar(20) DEFAULT NULL,
  `kode_dokter` varchar(20) DEFAULT NULL,
  `kode_terapis` varchar(20) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `jenis_item` varchar(20) DEFAULT NULL,
  `kode_item` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qty_poin` int(11) DEFAULT NULL,
  `hpp` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `poin_terpakai` int(11) DEFAULT NULL,
  `jenis_diskon` varchar(20) DEFAULT NULL,
  `diskon_persen` int(11) DEFAULT NULL,
  `diskon_rupiah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `ambil_paket` enum('Ya','Tidak') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of opsi_transaksi_batal_temp
-- ----------------------------

-- ----------------------------
-- Table structure for opsi_transaksi_layanan
-- ----------------------------
DROP TABLE IF EXISTS `opsi_transaksi_layanan`;
CREATE TABLE `opsi_transaksi_layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(25) DEFAULT NULL,
  `kode_periksa` varchar(20) DEFAULT NULL,
  `kode_dokter` varchar(20) DEFAULT NULL,
  `kode_terapis` varchar(20) DEFAULT NULL,
  `jenis_item` varchar(20) DEFAULT NULL,
  `kode_item` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qty_poin` int(11) DEFAULT NULL,
  `hpp` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `poin_terpakai` int(11) DEFAULT NULL,
  `jenis_diskon` varchar(20) DEFAULT NULL,
  `diskon_persen` int(11) DEFAULT NULL,
  `diskon_rupiah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `ambil_paket` enum('Tidak','Ya') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of opsi_transaksi_layanan
-- ----------------------------

-- ----------------------------
-- Table structure for opsi_transaksi_layanan_temp
-- ----------------------------
DROP TABLE IF EXISTS `opsi_transaksi_layanan_temp`;
CREATE TABLE `opsi_transaksi_layanan_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(25) DEFAULT NULL,
  `kode_periksa` varchar(20) DEFAULT NULL,
  `kode_dokter` varchar(20) DEFAULT NULL,
  `kode_terapis` varchar(20) DEFAULT NULL,
  `jenis_item` varchar(20) DEFAULT NULL,
  `kode_item` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qty_poin` int(11) DEFAULT NULL,
  `hpp` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `poin_terpakai` int(11) DEFAULT NULL,
  `jenis_diskon` varchar(20) DEFAULT NULL,
  `diskon_persen` int(11) DEFAULT NULL,
  `diskon_rupiah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of opsi_transaksi_layanan_temp
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi_kasir
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_kasir`;
CREATE TABLE `transaksi_kasir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) DEFAULT NULL,
  `kode_kasir` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `petugas` varchar(20) DEFAULT NULL,
  `saldo_awal` int(11) DEFAULT NULL,
  `saldo_akhir` int(11) DEFAULT NULL,
  `saldo_sebenarnya` int(11) DEFAULT NULL,
  `nominal_penjualan` int(11) DEFAULT NULL,
  `selisih` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `validasi` varchar(20) DEFAULT '',
  `keterangan` mediumtext,
  `tanggal_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaksi_kasir
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi_layanan
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_layanan`;
CREATE TABLE `transaksi_layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(25) DEFAULT NULL,
  `kode_kasir` varchar(20) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `kode_member` varchar(20) DEFAULT NULL,
  `kode_layanan` varchar(20) DEFAULT NULL,
  `kategori_diskon` enum('promo','member','merchant') DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `jenis_diskon` enum('persen','rupiah') DEFAULT NULL,
  `diskon_persen` int(11) DEFAULT NULL,
  `diskon_rupiah` int(11) DEFAULT NULL,
  `total_layanan` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `dibayar` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `jenis_transaksi` enum('tunai','debit','kredit') DEFAULT NULL,
  `nama_bank` varchar(15) DEFAULT NULL,
  `nomor_rekening` varchar(20) DEFAULT NULL,
  `id_petugas` varchar(10) DEFAULT NULL,
  `jam_registrasi` time DEFAULT NULL,
  `jam_penjualan` time NOT NULL,
  `status` enum('selesai','verifikasi','proses') DEFAULT NULL,
  `status_layanan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaksi_layanan
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
