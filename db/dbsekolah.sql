CREATE TABLE IF NOT EXISTS `absen` (
`a_id` int(6) NOT NULL,
  `a_id_siswa` int(6) NOT NULL,
  `a_id_tahun` int(3) NOT NULL,
  `a_sakit` int(2) NOT NULL DEFAULT '0',
  `a_izin` int(2) NOT NULL DEFAULT '0',
  `a_alpha` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`a_id`, `a_id_siswa`, `a_id_tahun`, `a_sakit`, `a_izin`, `a_alpha`) VALUES
(1, 1, 1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`u_id` int(2) NOT NULL,
  `u_uname` varchar(50) NOT NULL,
  `u_pass` varchar(50) NOT NULL,
  `level` char(5) NOT NULL DEFAULT 'admin',
  `u_nama` varchar(100) NOT NULL,
  `u_tglLahir` date NOT NULL,
  `u_jk` varchar(10) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_level` int(1) NOT NULL DEFAULT '2',
  `nonaktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`u_id`, `u_uname`, `u_pass`, `level`, `u_nama`, `u_tglLahir`, `u_jk`, `u_email`, `u_level`, `nonaktif`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Suendri', '1981-01-01', 'Laki-Laki', 'cs@gosoftware.web.id', 1, 'N'),
(2, 'Manager', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'Faiz El Muhammadi', '1985-01-01', 'Laki-Laki', 'faiz.elmuhammadi@yahoo.com', 2, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
`g_id` int(6) NOT NULL,
  `g_nip` varchar(50) NOT NULL,
  `u_uname` varchar(50) NOT NULL,
  `u_pass` varchar(100) DEFAULT NULL,
  `level` char(4) NOT NULL DEFAULT 'guru',
  `u_nama` varchar(100) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `g_tmp_lhr` varchar(100) DEFAULT NULL,
  `g_tgl_lhr` date DEFAULT NULL,
  `g_jk` varchar(25) DEFAULT NULL,
  `g_alamat` varchar(100) DEFAULT NULL,
  `g_agama` varchar(15) DEFAULT NULL,
  `g_status` varchar(50) DEFAULT NULL,
  `nonaktif` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`g_id`, `g_nip`, `u_uname`, `u_pass`, `level`, `u_nama`, `u_email`, `g_tmp_lhr`, `g_tgl_lhr`, `g_jk`, `g_alamat`, `g_agama`, `g_status`, `nonaktif`) VALUES
(1, '2013001', '2013001', 'bff030594cd09ce531297feac0327b3f', 'guru', 'Fifi Syafrina', '', 'Kisaran', '1980-12-12', 'Perempuan', 'Kisaran', 'Islam', 'PNS', 'N'),
(2, '20130002', '20130002', NULL, 'guru', 'Nurul Ulfa', '', 'Kisaran', '1990-12-12', 'Perempuan', 'Kisaran', 'Islam', 'PNS', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE IF NOT EXISTS `hari` (
`h_id` int(1) NOT NULL,
  `h_nama` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`h_id`, `h_nama`) VALUES
(1, 'Minggu'),
(2, 'Senin'),
(3, 'Selasa'),
(4, 'Rabu'),
(5, 'Kamis'),
(6, 'Jumat'),
(7, 'Sabtu');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
`j_id` int(6) NOT NULL,
  `j_id_thn` int(3) NOT NULL,
  `j_kd_kls` varchar(20) NOT NULL,
  `j_kd_mapel` varchar(20) NOT NULL,
  `j_id_guru` varchar(100) NOT NULL,
  `j_hari` varchar(20) NOT NULL DEFAULT 'Minggu',
  `j_jam` varchar(50) NOT NULL DEFAULT '7:30-8:20'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`j_id`, `j_id_thn`, `j_kd_kls`, `j_kd_mapel`, `j_id_guru`, `j_hari`, `j_jam`) VALUES
(1, 1, 'X1', 'BIX', '1', '2', '07:30-09:00'),
(2, 1, 'X1', 'MTKX', '2', '2', '09:00-11:30');

-- --------------------------------------------------------

--
-- Table structure for table `kalender`
--

CREATE TABLE IF NOT EXISTS `kalender` (
`k_id` int(6) NOT NULL,
  `k_t_id` int(3) NOT NULL,
  `k_mulai` date NOT NULL,
  `k_selesai` date NOT NULL,
  `k_ket` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kalender`
--

INSERT INTO `kalender` (`k_id`, `k_t_id`, `k_mulai`, `k_selesai`, `k_ket`) VALUES
(1, 1, '2013-12-01', '2013-12-31', 'Les Sore Kelas XII Setiap hari Senin-Jumat'),
(2, 1, '2014-01-01', '2014-01-31', 'Ujian Akhir Semester');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
`k_id` int(3) NOT NULL,
  `k_kd` varchar(20) NOT NULL,
  `k_nm` varchar(50) NOT NULL,
  `k_wali` varchar(100) DEFAULT NULL,
  `k_nonaktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`k_id`, `k_kd`, `k_nm`, `k_wali`, `k_nonaktif`) VALUES
(1, 'X1', 'X 1', 'Fifi Syafrina', 'N'),
(2, 'X2', 'X 2', 'Nurul Ulfa', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
`m_id` int(6) NOT NULL,
  `m_kode` varchar(20) NOT NULL,
  `m_nama` varchar(100) NOT NULL,
  `m_nonaktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`m_id`, `m_kode`, `m_nama`, `m_nonaktif`) VALUES
(1, 'BIX', 'Bahasa Indonesia X', 'N'),
(2, 'MTKX', 'Matematika X', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
`n_id` int(6) NOT NULL,
  `n_nis` varchar(50) NOT NULL,
  `n_id_thn` int(3) NOT NULL,
  `n_id_jadwal` varchar(20) NOT NULL,
  `n_harian` int(3) DEFAULT NULL,
  `n_tugas` int(3) DEFAULT NULL,
  `n_uts` int(3) DEFAULT NULL,
  `n_uas` int(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`n_id`, `n_nis`, `n_id_thn`, `n_id_jadwal`, `n_harian`, `n_tugas`, `n_uts`, `n_uas`) VALUES
(1, '13001', 1, '1', 80, 95, 85, 95),
(2, '13001', 1, '1', 80, 95, 95, 95);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
`p_id` int(3) NOT NULL,
  `p_nip` varchar(50) DEFAULT NULL,
  `p_nama` varchar(100) DEFAULT NULL,
  `p_tmp_lhr` varchar(100) DEFAULT NULL,
  `p_tgl_lhr` date DEFAULT NULL,
  `p_jk` varchar(25) DEFAULT NULL,
  `p_alamat` varchar(100) DEFAULT NULL,
  `p_agama` varchar(15) DEFAULT NULL,
  `p_status` varchar(50) DEFAULT NULL,
  `nonaktif` enum('y','N') DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`p_id`, `p_nip`, `p_nama`, `p_tmp_lhr`, `p_tgl_lhr`, `p_jk`, `p_alamat`, `p_agama`, `p_status`, `nonaktif`) VALUES
(1, '20139001', 'Suendri', 'Kisaran', '1980-12-12', 'Laki-laki', 'Kisaran', 'Islam', 'PNS', 'N'),
(2, '20139002', 'Chintya Ramadhani', 'Kisaran', '1980-12-12', 'Perempuan', 'Kisaran', 'Islam', 'PNS', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
`p_id` int(11) NOT NULL,
  `p_uname` varchar(100) NOT NULL,
  `p_image_small` varchar(100) NOT NULL,
  `p_image_middle` varchar(100) NOT NULL,
  `p_image_default` varchar(100) NOT NULL,
  `p_tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_profil` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`p_id`, `p_uname`, `p_image_small`, `p_image_middle`, `p_image_default`, `p_tgl`, `p_profil`) VALUES
(1, 'admin', '35x35_admin_19751587.jpg', '100x100_admin_19751587.jpg', 'admin_19751587.jpg', '2014-09-07 06:58:22', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
`s_id` int(6) NOT NULL,
  `s_nis` varchar(10) NOT NULL,
  `u_uname` varchar(50) NOT NULL,
  `u_pass` varchar(50) DEFAULT NULL,
  `level` char(5) NOT NULL DEFAULT 'siswa',
  `u_nama` varchar(100) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `s_tmp_lahir` varchar(100) DEFAULT NULL,
  `s_tgl_lhr` date DEFAULT NULL,
  `s_jk` varchar(10) DEFAULT NULL,
  `s_nm_ortu` varchar(100) DEFAULT NULL,
  `s_pek_ortu` varchar(100) DEFAULT NULL,
  `s_alamat` varchar(100) DEFAULT NULL,
  `s_agama` varchar(15) DEFAULT NULL,
  `s_gdarah` varchar(3) DEFAULT NULL,
  `s_thn_masuk` int(5) NOT NULL DEFAULT '0',
  `s_kd_kls` varchar(20) NOT NULL,
  `nonaktif` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`s_id`, `s_nis`, `u_uname`, `u_pass`, `level`, `u_nama`, `u_email`, `s_tmp_lahir`, `s_tgl_lhr`, `s_jk`, `s_nm_ortu`, `s_pek_ortu`, `s_alamat`, `s_agama`, `s_gdarah`, `s_thn_masuk`, `s_kd_kls`, `nonaktif`) VALUES
(1, '13001', '13001', 'c0eab2dce3fc614a18251fb483e71dee', 'siswa', 'Faiz El Muhammadi', '', 'Kisaran', '2009-12-12', 'Laki-laki', 'Suendri', 'Guru', 'Kisaran', 'Islam', 'O', 2013, 'X1', 'N'),
(2, '13002', '13002', 'dc1f1e86d49bb24cdec5c39d3f59143b', 'siswa', 'Claura Fi El Hafizah', '', 'Kisaran', '1990-12-12', 'Perempuan', 'Fifi Syafrina', 'Swasta', 'Kisaran', 'Islam', 'O', 2013, 'X2', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE IF NOT EXISTS `tahun` (
`t_id` int(3) NOT NULL,
  `t_nm` varchar(15) NOT NULL,
  `t_jn` varchar(15) NOT NULL,
  `t_nonaktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`t_id`, `t_nm`, `t_jn`, `t_nonaktif`) VALUES
(1, '2012/2013', 'Ganjil', 'N'),
(2, '2012/2013', 'Genap', 'N'),
(3, '2013/2014', 'Ganjil', 'Y');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_users`
--
CREATE TABLE IF NOT EXISTS `view_users` (
`u_uname` varchar(50)
,`u_pass` varchar(100)
,`level` char(5)
,`u_nama` varchar(100)
);
-- --------------------------------------------------------

--
-- Structure for view `view_users`
--
DROP TABLE IF EXISTS `view_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_users` AS select `admin`.`u_uname` AS `u_uname`,`admin`.`u_pass` AS `u_pass`,`admin`.`level` AS `level`,`admin`.`u_nama` AS `u_nama` from `admin` where (`admin`.`nonaktif` = 'N') union all select `guru`.`u_uname` AS `u_uname`,`guru`.`u_pass` AS `u_pass`,`guru`.`level` AS `level`,`guru`.`u_nama` AS `u_nama` from `guru` where (`guru`.`nonaktif` = 'N') union all select `siswa`.`u_uname` AS `u_uname`,`siswa`.`u_pass` AS `u_pass`,`siswa`.`level` AS `level`,`siswa`.`u_nama` AS `u_nama` from `siswa` where (`siswa`.`nonaktif` = 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
 ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
 ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
 ADD PRIMARY KEY (`j_id`);

--
-- Indexes for table `kalender`
--
ALTER TABLE `kalender`
 ADD PRIMARY KEY (`k_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`k_id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
 ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
 ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
 ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
 ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
MODIFY `a_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `u_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
MODIFY `g_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
MODIFY `h_id` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
MODIFY `j_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kalender`
--
ALTER TABLE `kalender`
MODIFY `k_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
MODIFY `k_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
MODIFY `m_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
MODIFY `n_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
MODIFY `p_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
MODIFY `s_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
MODIFY `t_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;