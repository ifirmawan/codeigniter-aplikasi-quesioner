-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2017 at 06:23 AM
-- Server version: 5.5.56
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `st3_quisioner`
--

-- --------------------------------------------------------

--
-- Table structure for table `qs_groups`
--

CREATE TABLE `qs_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qs_groups`
--

INSERT INTO `qs_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(3, 'instruktur', ''),
(4, 'pakar', ''),
(5, 'peserta', '');

-- --------------------------------------------------------

--
-- Table structure for table `qs_isi_tanggapan`
--

CREATE TABLE `qs_isi_tanggapan` (
  `id` bigint(20) NOT NULL,
  `tanggapan_id` bigint(20) DEFAULT NULL,
  `opsi_id` bigint(20) NOT NULL,
  `isi_tanggapan` text NOT NULL,
  `komentar_tanggapan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qs_isi_tanggapan`
--

INSERT INTO `qs_isi_tanggapan` (`id`, `tanggapan_id`, `opsi_id`, `isi_tanggapan`, `komentar_tanggapan`) VALUES
(75, 20, 66, 'Ya', NULL),
(76, 20, 69, 'Ya', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qs_kuesioner`
--

CREATE TABLE `qs_kuesioner` (
  `kues_id` bigint(20) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `waktu_acara` varchar(255) DEFAULT NULL,
  `nama_acara` varchar(255) DEFAULT NULL,
  `materi_acara` varchar(225) DEFAULT NULL,
  `instruktur_acara` varchar(125) DEFAULT NULL,
  `ruang_acara` varchar(225) DEFAULT NULL,
  `kapasitas_acara` int(50) DEFAULT NULL,
  `judul_kuesioner` varchar(225) NOT NULL,
  `deskripsi_kuesioner` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `terbit_pada` varchar(125) DEFAULT NULL,
  `status_kuesioner` enum('konsep','terbit','tutup') DEFAULT 'konsep',
  `tautan_kuesioner` text,
  `jenis_kuesioner` enum('acara','kuliah','survey') DEFAULT 'survey'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qs_kuesioner`
--

INSERT INTO `qs_kuesioner` (`kues_id`, `user_id`, `waktu_acara`, `nama_acara`, `materi_acara`, `instruktur_acara`, `ruang_acara`, `kapasitas_acara`, `judul_kuesioner`, `deskripsi_kuesioner`, `dibuat_pada`, `terbit_pada`, `status_kuesioner`, `tautan_kuesioner`, `jenis_kuesioner`) VALUES
(11, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Usability Dions ST3 Telkom', 'Pengujian dan pengukuran sistem informasi Dion\'s ST3 Telkom Purwokerto', '2017-08-20 10:57:22', NULL, 'konsep', NULL, 'survey'),
(12, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Usability sistem e-learning ST3 Telkom', 'Kuesioner pelayanan E-learning ST3 Telkom', '2017-08-22 10:11:30', '1505127471', 'terbit', 'http://surveyukdist3telkom.com/index.php/formulir/index/aH2AkGVlZWlkZ2VufA%3D%3D', 'survey');

-- --------------------------------------------------------

--
-- Table structure for table `qs_login_attempts`
--

CREATE TABLE `qs_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qs_opsi_kuesioner`
--

CREATE TABLE `qs_opsi_kuesioner` (
  `opsi_id` bigint(20) NOT NULL,
  `pertanyaan` text NOT NULL,
  `petunjuk_pertanyaan` varchar(255) DEFAULT NULL,
  `jenis_opsi` enum('teks','level','check','radio','dropdown','deskriptif') DEFAULT NULL,
  `opsi_wajib` enum('ya','tidak') DEFAULT 'tidak',
  `induk_opsi` bigint(20) DEFAULT NULL,
  `kues_id` bigint(20) NOT NULL,
  `kalimat_opsi` text NOT NULL,
  `opsi_jawaban` enum('0','1') NOT NULL,
  `group_id` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qs_opsi_kuesioner`
--

INSERT INTO `qs_opsi_kuesioner` (`opsi_id`, `pertanyaan`, `petunjuk_pertanyaan`, `jenis_opsi`, `opsi_wajib`, `induk_opsi`, `kues_id`, `kalimat_opsi`, `opsi_jawaban`, `group_id`) VALUES
(64, 'Kemudahan untuk masuk sistem?', 'jawaban singkat dan jelas', 'level', 'ya', NULL, 11, '', '0', 5),
(65, 'Apakah navigasi sangat mudah ?', 'hanya satu jawaban', 'radio', 'ya', NULL, 12, '', '0', 5),
(66, '', NULL, NULL, 'tidak', 65, 12, 'Ya', '0', NULL),
(67, '', NULL, NULL, 'tidak', 65, 12, 'Tidak', '0', NULL),
(68, 'Apakah Upload hasil mudah?', 'hanya satu jawaban', 'radio', 'ya', NULL, 12, '', '0', 5),
(69, '', NULL, NULL, 'tidak', 68, 12, 'Ya', '0', NULL),
(70, '', NULL, NULL, 'tidak', 68, 12, 'Tidak', '0', NULL),
(71, 'Apakah muskar ganteng?', 'jawaban singkat dan jelas', 'level', 'ya', NULL, 11, '', '0', 4);

-- --------------------------------------------------------

--
-- Table structure for table `qs_peserta`
--

CREATE TABLE `qs_peserta` (
  `peserta_id` bigint(20) NOT NULL,
  `nama_peserta` varchar(255) DEFAULT NULL,
  `email_peserta` varchar(225) NOT NULL,
  `bergabung_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `menaggapi_sejumlah` int(25) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `nomer_identitas` int(255) DEFAULT NULL,
  `group_id` mediumint(8) UNSIGNED DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qs_peserta`
--

INSERT INTO `qs_peserta` (`peserta_id`, `nama_peserta`, `email_peserta`, `bergabung_pada`, `menaggapi_sejumlah`, `user_id`, `nomer_identitas`, `group_id`) VALUES
(17, 'muskar', '14101050@st3telkom.ac.id', '2017-09-11 10:59:01', NULL, 7, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `qs_tanggapan_kuesioner`
--

CREATE TABLE `qs_tanggapan_kuesioner` (
  `tanggapan_id` bigint(20) NOT NULL,
  `peserta_id` bigint(20) NOT NULL,
  `kues_id` bigint(20) NOT NULL,
  `tanggapan_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `submit_pada` int(125) DEFAULT NULL,
  `jumlah_tanggapan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qs_tanggapan_kuesioner`
--

INSERT INTO `qs_tanggapan_kuesioner` (`tanggapan_id`, `peserta_id`, `kues_id`, `tanggapan_pada`, `submit_pada`, `jumlah_tanggapan`) VALUES
(20, 17, 12, '2017-09-11 10:58:35', 1505127515, 2);

-- --------------------------------------------------------

--
-- Table structure for table `qs_users`
--

CREATE TABLE `qs_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(125) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `real_name` varchar(225) DEFAULT NULL,
  `personal_address` text,
  `personal_phone` varchar(20) DEFAULT NULL,
  `born` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qs_users`
--

INSERT INTO `qs_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `real_name`, `personal_address`, `personal_phone`, `born`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1505127461, 1, 'Administrator', 'ADMIN', '0', ''),
(2, '127.0.0.1', 'fatoni', '$2y$08$8mOvgctqDo40zWioif8ste4Nw.yI3ZedT6Hp5l00FI4c.QTSyPYIK', NULL, '14102021@st3telkom.ac.id', NULL, NULL, NULL, NULL, 1502061970, 1502063066, 1, 'Ahmad fatoni', NULL, NULL, ''),
(3, '127.0.0.1', 'iwan', '$2y$08$70JNkGAnI0K9IypoFXK8c.cZ0Oy5YmcIeg7Aibv1HVCAxzxpsn9I.', NULL, 'firmawaneiwan@gmail.com', NULL, 'ixDPh-98ezrUFJzfjAgNq.b793853691ad16b683', 1502963966, NULL, 1502280103, 1502712972, 1, 'Iwan firmawan', NULL, NULL, ''),
(4, '127.0.0.1', 'Ibnu', '$2y$08$SmySRGpY4I0XOaQ8hMDaDuJqkunV2cGJGfd.jdEYVDeUBaFmy4jW.', NULL, 'ibnu@gmail.com', '42534974', NULL, NULL, NULL, 1502709136, NULL, 1, 'Ibnu sinoe', NULL, NULL, ''),
(5, '127.0.0.1', 'imam', '$2y$08$2TZgY.JN.ml5BavZdH5RcOjO1q9ltVY3KE3GaTxGD24R8KRA/FiOu', NULL, 'imam@gmail.com', '861034425', NULL, NULL, NULL, 1502716964, 1502716975, 1, 'imam', NULL, NULL, ''),
(6, '127.0.0.1', 'udin', '$2y$08$qVarZHAbG/uMA4CiR2OO5ORv8QKmn7AhLtQQ3ZwCM6TqJgtHlrdY.', NULL, 'udin@gmail.com', '1898594451', NULL, NULL, NULL, 1502723157, 1502846589, 1, 'udin', NULL, NULL, ''),
(7, '36.73.31.149', 'muskar', '$2y$08$lTMInjDKOf4tt79vsvvPou.KKatV/rufYsJg6ABJuiJ8fDInBR98.', NULL, '14101050@st3telkom.ac.id', NULL, NULL, NULL, NULL, 1505127541, 1505127573, 1, 'muskar', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `qs_users_groups`
--

CREATE TABLE `qs_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qs_users_groups`
--

INSERT INTO `qs_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 3, 1),
(5, 4, 4),
(6, 5, 4),
(7, 6, 4),
(8, 7, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qs_groups`
--
ALTER TABLE `qs_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qs_isi_tanggapan`
--
ALTER TABLE `qs_isi_tanggapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qs_id` (`opsi_id`),
  ADD KEY `respons_id` (`tanggapan_id`);

--
-- Indexes for table `qs_kuesioner`
--
ALTER TABLE `qs_kuesioner`
  ADD PRIMARY KEY (`kues_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `qs_login_attempts`
--
ALTER TABLE `qs_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qs_opsi_kuesioner`
--
ALTER TABLE `qs_opsi_kuesioner`
  ADD PRIMARY KEY (`opsi_id`),
  ADD KEY `topic_id` (`kues_id`);

--
-- Indexes for table `qs_peserta`
--
ALTER TABLE `qs_peserta`
  ADD PRIMARY KEY (`peserta_id`);

--
-- Indexes for table `qs_tanggapan_kuesioner`
--
ALTER TABLE `qs_tanggapan_kuesioner`
  ADD PRIMARY KEY (`tanggapan_id`),
  ADD KEY `participant_id` (`peserta_id`),
  ADD KEY `topic_id` (`kues_id`);

--
-- Indexes for table `qs_users`
--
ALTER TABLE `qs_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qs_users_groups`
--
ALTER TABLE `qs_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qs_groups`
--
ALTER TABLE `qs_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `qs_isi_tanggapan`
--
ALTER TABLE `qs_isi_tanggapan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `qs_kuesioner`
--
ALTER TABLE `qs_kuesioner`
  MODIFY `kues_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `qs_login_attempts`
--
ALTER TABLE `qs_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qs_opsi_kuesioner`
--
ALTER TABLE `qs_opsi_kuesioner`
  MODIFY `opsi_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `qs_peserta`
--
ALTER TABLE `qs_peserta`
  MODIFY `peserta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `qs_tanggapan_kuesioner`
--
ALTER TABLE `qs_tanggapan_kuesioner`
  MODIFY `tanggapan_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `qs_users`
--
ALTER TABLE `qs_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `qs_users_groups`
--
ALTER TABLE `qs_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `qs_isi_tanggapan`
--
ALTER TABLE `qs_isi_tanggapan`
  ADD CONSTRAINT `qs_isi_tanggapan_ibfk_1` FOREIGN KEY (`tanggapan_id`) REFERENCES `qs_tanggapan_kuesioner` (`tanggapan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qs_isi_tanggapan_ibfk_2` FOREIGN KEY (`opsi_id`) REFERENCES `qs_opsi_kuesioner` (`opsi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qs_opsi_kuesioner`
--
ALTER TABLE `qs_opsi_kuesioner`
  ADD CONSTRAINT `qs_opsi_kuesioner_ibfk_1` FOREIGN KEY (`kues_id`) REFERENCES `qs_kuesioner` (`kues_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qs_tanggapan_kuesioner`
--
ALTER TABLE `qs_tanggapan_kuesioner`
  ADD CONSTRAINT `qs_tanggapan_kuesioner_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `qs_peserta` (`peserta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qs_tanggapan_kuesioner_ibfk_2` FOREIGN KEY (`kues_id`) REFERENCES `qs_kuesioner` (`kues_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
