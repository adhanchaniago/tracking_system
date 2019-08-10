-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2017 at 02:49 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_tracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailtrack`
--

CREATE TABLE IF NOT EXISTS `detailtrack` (
`iddetail` int(5) NOT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idtrack` int(5) DEFAULT NULL,
  `po_number` char(15) DEFAULT NULL,
  `noresi` varchar(30) DEFAULT NULL,
  `item` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` char(30) DEFAULT NULL,
  `iduser` int(5) DEFAULT NULL,
  `remarks` text,
  `vehicle` varchar(30) DEFAULT NULL,
  `driver` varchar(30) DEFAULT NULL,
  `stts_kirim` enum('0','1') DEFAULT '0' COMMENT '0= diterima, 1= dikirim'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbltrack`
--

CREATE TABLE IF NOT EXISTS `tbltrack` (
`idtrack` int(5) NOT NULL,
  `tglpost` datetime DEFAULT NULL,
  `nomor_po` varchar(15) DEFAULT NULL,
  `noref` varchar(30) DEFAULT NULL,
  `tujuan` char(20) DEFAULT NULL,
  `site` char(20) DEFAULT NULL,
  `status` enum('1','2','3') DEFAULT NULL COMMENT '1= Proses pengiriman, 2= Diterima, 3=Nota Balik (Completed)',
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
`iduser` int(5) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('1','2') DEFAULT NULL,
  `kode_site` char(10) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`iduser`, `nama`, `username`, `password`, `level`, `kode_site`, `keterangan`) VALUES
(1, 'HO', 'HO', '762097f801698400e2bb434de53f5548', '1', 'HO', 'PT SRIWIJAYA PALM OIL INDONESIA'),
(2, 'KPE', 'KPE', 'e1877468cfe53060b1dd8182eb109af8', '1', 'KPE', 'KEBUN KUALA PUNTIAN'),
(3, 'HOCSL', 'HOCLS', '4689d2419460b7a5ecb8399069334426', '1', 'HOCLS', 'PT CIPTA LESTARI SAWIT'),
(4, 'PMW', 'PMW', '2fa797740860f8733945a27364176468', '1', 'PMW', 'PKS MAJATRA'),
(5, 'BAE', 'BAE', '331a647fc5fdf691e554fd2509f9333f', '1', 'BAE', 'KEBUN BUDIASIH'),
(6, 'BRE', 'BRE', '08e52482c9ba605332f3c1e8bcaeff54', '1', 'BRE', 'KEBUN BUMI REJO'),
(7, 'PRE', 'PRE', 'b5b5e39daf5d0276f82a41981da481e4', '1', 'PRE', 'KEBUN PULAU RIMAU'),
(8, 'MWE', 'MWE', '9e5d7bfb847ec8fae682e5cc84d07312', '1', 'MWE', 'KEBUN MAJATRA WONOSARI'),
(9, 'HOPMI', 'HOPMI', 'a6e27cf5f72414eacefb26d8f94a66cd', '1', 'HOPMI', 'PT PERKINDO MAKMUR'),
(10, 'PMP', 'PMP', '43685d6f3f3ecb76cf69fc95c4563620', '1', 'PMP', 'KEBUN PERKINDO MAKMUR PLASMA'),
(11, 'PMI', 'PMI', '0b41dcce326d068cfdc231046071285e', '1', 'PMI', 'KEBUN PERKINDO MAKMUR INTI'),
(12, 'PIP', 'PIP', 'b2332aa78d83be6ba6d2993d5c7ec69d', '1', 'PIP', 'KEBUN PERKINDO MAKMUR INTI 2'),
(13, 'SCE', 'SCE', '7a00393ac1c039082dde880d65be8de5', '1', 'SCE', 'KEBUN SECONDONG'),
(14, 'SYE', 'SYE', 'f191b02378fd857d1b3a6d1f9ed6f477', '1', 'SYE', 'KEBUN SUNGAI BIYUKU'),
(15, 'SCP', 'SCP', '573ac492eee87fb299b4faed28837dac', '1', 'SCP', 'KEBUN SECONDONG PLASMA'),
(16, 'SYP', 'SYP', '1b8ec51336ad096b0d7a6ef5d9568300', '1', 'SYP', 'KEBUN SUNGAI BIYUKU PLASMA'),
(17, 'HOPSD', 'HOPSD', '249b3b2416795495982708b61f341308', '1', 'HOPSD', 'PT PERSADA SAWIT MAS'),
(18, 'SBE', 'SBE', 'd41d8cd98f00b204e9800998ecf8427e', '1', 'SBE', 'KEBUN SUNGAI BAUNG'),
(19, 'SRE', 'SRE', '3306355466c96499ca0010606b40f3d4', '1', 'SRE', 'KEBUN SUNGAI RADEN'),
(20, 'BBE', 'BBE', 'aa3dce24f92c438d533b12f083028b64', '1', 'BBE', 'KEBUN BUKIT BATU'),
(21, 'HOSAM', 'HOSAM', 'e2cc043b312d5cfca7dcc350d3d3913b', '1', 'HOSAM', 'PT SAMSELATAN AGRO MANDIRI LESTARI'),
(22, 'PSR', 'PSR', '2fcafb512581055e4ff8e623492ce4ac', '1', 'PSR', 'PKS SUNGAI RADEN'),
(23, 'MTE', 'MTE', '86b24e1f2bb8c076ce9ac610b08b90ff', '1', 'MTE', 'KEBUN MARGA TANI'),
(24, 'RAE', 'RAE', 'b21cf56025bcfee410ef33b7336beb1a', '1', 'RAE', 'KEBUN RENGAS ABAND'),
(25, 'PDE', 'PDE', '64f5b3b215f1b21f8425e8890807daab', '1', 'PDE', 'KEBUN PANGKALAN DAMAI'),
(26, 'PGS', 'PGS', '00452a019cdb096d20145b491474b037', '1', 'PGS', 'PKS GASING'),
(27, 'Jembatan Ampera', 'ampera', 'd208939eda92b98e1ec6bb81e771983c', '1', 'AMPERA', 'Jembatan Ampera');

-- --------------------------------------------------------

--
-- Table structure for table `temptable`
--

CREATE TABLE IF NOT EXISTS `temptable` (
`idtemp` int(5) NOT NULL,
  `itembarang` varchar(100) DEFAULT NULL,
  `jumlah_item` int(10) DEFAULT NULL,
  `satuan` char(30) DEFAULT NULL,
  `ket` text,
  `iduser` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailtrack`
--
ALTER TABLE `detailtrack`
 ADD PRIMARY KEY (`iddetail`);

--
-- Indexes for table `tbltrack`
--
ALTER TABLE `tbltrack`
 ADD PRIMARY KEY (`idtrack`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
 ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `temptable`
--
ALTER TABLE `temptable`
 ADD PRIMARY KEY (`idtemp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailtrack`
--
ALTER TABLE `detailtrack`
MODIFY `iddetail` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbltrack`
--
ALTER TABLE `tbltrack`
MODIFY `idtrack` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
MODIFY `iduser` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `temptable`
--
ALTER TABLE `temptable`
MODIFY `idtemp` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
