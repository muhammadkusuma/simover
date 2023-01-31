-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2018 at 06:48 PM
-- Server version: 5.5.46-0+deb8u1
-- PHP Version: 5.6.36-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_simover`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_hardware`
--

CREATE TABLE IF NOT EXISTS `t_hardware` (
`no` int(100) NOT NULL,
  `ip_server` varchar(15) NOT NULL,
  `cpu_perc` float NOT NULL,
  `ram_tot` int(10) NOT NULL,
  `ram_avail` int(10) NOT NULL,
  `ram_used` int(15) NOT NULL,
  `ram_perc` float NOT NULL,
  `disk_tot` int(10) NOT NULL,
  `disk_avail` int(10) NOT NULL,
  `disk_used` int(11) NOT NULL,
  `disk_perc` float NOT NULL,
  `uptime` varchar(40) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_hardware`
--

INSERT INTO `t_hardware` (`no`, `ip_server`, `cpu_perc`, `ram_tot`, `ram_avail`, `ram_used`, `ram_perc`, `disk_tot`, `disk_avail`, `disk_used`, `disk_perc`, `uptime`, `date`) VALUES
(1, '192.168.1.254', 0, 511992, 375260, 136732, 26.7059, 9717280, 8249676, 950948, 9.78615, '0 Days - 0 Hours - 24 Mins - 8 Secs', '2018-07-29 05:28:16'),
(2, '192.168.1.254', 0, 511992, 375260, 136732, 26.7059, 9717280, 8249692, 950932, 9.78599, '0 Days - 0 Hours - 24 Mins - 23 Secs', '2018-07-29 05:28:31'),
(3, '192.168.1.254', 0, 511992, 375260, 136732, 26.7059, 9717280, 8249692, 950932, 9.78599, '0 Days - 0 Hours - 24 Mins - 38 Secs', '2018-07-29 05:28:46'),
(4, '192.168.1.254', 0, 511992, 375252, 136740, 26.7074, 9717280, 8249692, 950932, 9.78599, '0 Days - 0 Hours - 24 Mins - 53 Secs', '2018-07-29 05:29:01'),
(5, '192.168.1.254', 0, 511992, 375256, 136736, 26.7067, 9717280, 8249692, 950932, 9.78599, '0 Days - 0 Hours - 25 Mins - 8 Secs', '2018-07-29 05:29:16'),
(6, '192.168.1.254', 0, 511992, 375256, 136736, 26.7067, 9717280, 8249688, 950948, 9.78615, '0 Days - 0 Hours - 25 Mins - 23 Secs', '2018-07-29 05:29:31'),
(7, '192.168.1.254', 0, 511992, 375256, 136736, 26.7067, 9717280, 8249676, 950948, 9.78615, '0 Days - 0 Hours - 25 Mins - 38 Secs', '2018-07-29 05:29:46'),
(8, '192.168.1.254', 0, 511992, 375256, 136736, 26.7067, 9717280, 8249676, 950948, 9.78615, '0 Days - 0 Hours - 25 Mins - 53 Secs', '2018-07-29 05:30:01'),
(9, '192.168.1.254', 0, 511992, 375248, 136744, 26.7082, 9717280, 8249684, 950940, 9.78607, '0 Days - 0 Hours - 26 Mins - 8 Secs', '2018-07-29 05:30:16'),
(10, '192.168.1.254', 0, 511992, 375248, 136744, 26.7082, 9717280, 8249684, 950940, 9.78607, '0 Days - 0 Hours - 26 Mins - 23 Secs', '2018-07-29 05:30:31'),
(11, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249684, 950952, 9.7862, '0 Days - 0 Hours - 26 Mins - 38 Secs', '2018-07-29 05:30:46'),
(12, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249668, 950956, 9.78624, '0 Days - 0 Hours - 26 Mins - 52 Secs', '2018-07-29 05:31:01'),
(13, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249668, 950956, 9.78624, '0 Days - 0 Hours - 27 Mins - 7 Secs', '2018-07-29 05:31:16'),
(14, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249668, 950956, 9.78624, '0 Days - 0 Hours - 27 Mins - 22 Secs', '2018-07-29 05:31:31'),
(15, '192.168.1.254', 0, 511992, 375116, 136876, 26.734, 9717280, 8249676, 950948, 9.78615, '0 Days - 0 Hours - 27 Mins - 37 Secs', '2018-07-29 05:31:46'),
(16, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249676, 950948, 9.78615, '0 Days - 0 Hours - 27 Mins - 52 Secs', '2018-07-29 05:32:01'),
(17, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249664, 950960, 9.78628, '0 Days - 0 Hours - 28 Mins - 7 Secs', '2018-07-29 05:32:16'),
(18, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249660, 950964, 9.78632, '0 Days - 0 Hours - 28 Mins - 22 Secs', '2018-07-29 05:32:31'),
(19, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249660, 950964, 9.78632, '0 Days - 0 Hours - 28 Mins - 37 Secs', '2018-07-29 05:32:46'),
(20, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249660, 950964, 9.78632, '0 Days - 0 Hours - 28 Mins - 52 Secs', '2018-07-29 05:33:01'),
(21, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249668, 950956, 9.78624, '0 Days - 0 Hours - 29 Mins - 7 Secs', '2018-07-29 05:33:16'),
(22, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249668, 950956, 9.78624, '0 Days - 0 Hours - 29 Mins - 22 Secs', '2018-07-29 05:33:31'),
(23, '192.168.1.254', 0, 511992, 375124, 136868, 26.7324, 9717280, 8249656, 950968, 9.78636, '0 Days - 0 Hours - 29 Mins - 37 Secs', '2018-07-29 05:33:46'),
(24, '192.168.1.254', 0, 511992, 374212, 137780, 26.9106, 9717280, 8249652, 950972, 9.7864, '0 Days - 5 Hours - 12 Mins - 53 Secs', '2018-07-29 10:17:01'),
(25, '192.168.1.254', 0, 511992, 374212, 137780, 26.9106, 9717280, 8249652, 950972, 9.7864, '0 Days - 5 Hours - 13 Mins - 7 Secs', '2018-07-29 10:17:16'),
(26, '192.168.1.254', 0, 511992, 374172, 137820, 26.9184, 9717280, 8249640, 950984, 9.78652, '0 Days - 5 Hours - 13 Mins - 23 Secs', '2018-07-29 10:17:31'),
(27, '192.168.1.254', 0, 511992, 374180, 137812, 26.9168, 9717280, 8249648, 950976, 9.78644, '0 Days - 5 Hours - 13 Mins - 37 Secs', '2018-07-29 10:17:46'),
(28, '192.168.1.254', 0, 511992, 374180, 137812, 26.9168, 9717280, 8249648, 950976, 9.78644, '0 Days - 5 Hours - 13 Mins - 53 Secs', '2018-07-29 10:18:01'),
(29, '192.168.1.254', 0, 511992, 374172, 137820, 26.9184, 9717280, 8249648, 950976, 9.78644, '0 Days - 5 Hours - 14 Mins - 8 Secs', '2018-07-29 10:18:16'),
(30, '192.168.1.254', 0, 511992, 374204, 137788, 26.9121, 9717280, 8249644, 950980, 9.78648, '0 Days - 5 Hours - 14 Mins - 23 Secs', '2018-07-29 10:18:31'),
(31, '192.168.1.254', 0, 511992, 374164, 137828, 26.92, 9717280, 8249644, 950980, 9.78648, '0 Days - 5 Hours - 14 Mins - 38 Secs', '2018-07-29 10:18:46'),
(32, '192.168.1.254', 0, 511992, 274236, 237756, 46.4374, 9717280, 8305052, 895572, 9.21628, '0 Days - 5 Hours - 34 Mins - 31 Secs', '2018-07-29 10:38:39'),
(33, '192.168.1.254', 0, 511992, 274128, 237864, 46.4585, 9717280, 8305032, 895592, 9.21649, '0 Days - 5 Hours - 44 Mins - 5 Secs', '2018-07-29 10:48:13'),
(34, '192.168.1.254', 0, 511992, 273940, 238052, 46.4953, 9717280, 8305040, 895584, 9.21641, '0 Days - 6 Hours - 44 Mins - 50 Secs', '2018-07-29 11:48:58'),
(35, '192.168.1.254', 0, 511992, 273940, 238052, 46.4953, 9717280, 8305028, 895596, 9.21653, '0 Days - 6 Hours - 56 Mins - 32 Secs', '2018-07-30 12:00:40'),
(36, '192.168.1.254', 0, 511992, 273780, 238212, 46.5265, 9717280, 8305032, 895592, 9.21649, '0 Days - 7 Hours - 13 Mins - 49 Secs', '2018-07-30 12:17:57'),
(37, '192.168.1.254', 0, 511992, 273788, 238204, 46.5249, 9717280, 8305020, 895604, 9.21661, '0 Days - 7 Hours - 17 Mins - 48 Secs', '2018-07-30 12:21:56'),
(38, '192.168.1.254', 0, 511992, 274156, 237836, 46.4531, 9717280, 8305028, 895596, 9.21653, '0 Days - 7 Hours - 33 Mins - 36 Secs', '2018-07-30 12:37:45'),
(39, '192.168.1.254', 0, 511992, 273476, 238516, 46.5859, 9717280, 8305028, 895596, 9.21653, '0 Days - 7 Hours - 36 Mins - 19 Secs', '2018-07-30 12:40:27'),
(40, '192.168.1.254', 0, 511992, 375368, 136624, 26.6848, 9717280, 8304836, 895788, 9.21851, '0 Days - 0 Hours - 31 Mins - 12 Secs', '2018-08-02 12:29:38'),
(41, '192.168.1.254', 0, 511992, 375476, 136516, 26.6637, 9717280, 8304828, 895796, 9.21859, '0 Days - 0 Hours - 31 Mins - 55 Secs', '2018-08-02 12:30:22'),
(42, '192.168.1.254', 0, 511992, 385684, 126308, 24.6699, 9717280, 8304836, 895788, 9.21851, '0 Days - 0 Hours - 36 Mins - 38 Secs', '2018-08-02 12:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `t_notif`
--

CREATE TABLE IF NOT EXISTS `t_notif` (
`comment_id` int(11) NOT NULL,
  `comment_subject` varchar(250) NOT NULL,
  `comment_text` text NOT NULL,
  `warning` int(1) NOT NULL,
  `comment_status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_notif`
--

INSERT INTO `t_notif` (`comment_id`, `comment_subject`, `comment_text`, `warning`, `comment_status`, `date`) VALUES
(1, 'Server OFF', 'WARNING! Server Utama OFF Pada 2018-07-30 12:21:02am', 1, 1, '2018-07-30 12:21:02'),
(2, 'Server ON', 'Server Utama ON Kembali Pada 2018-07-30 12:21:56am', 0, 1, '2018-07-30 12:21:56'),
(3, 'Service SSH OFF', 'WARNING! Service SSH OFF Pada 2018-07-30 12:37:45am', 1, 1, '2018-07-30 12:37:45'),
(4, 'Service SSH ON', 'Service SSH ON Kembali Pada 2018-07-30 12:40:27am', 0, 1, '2018-07-30 12:40:27'),
(5, 'Service Bengkalis OFF', 'WARNING! UPTUP Bengkalis OFF Pada 2018-07-30 01:03:56am', 1, 1, '2018-07-30 01:03:56'),
(6, 'UPTUP Bengkalis ON', 'UPTUP Bengkalis ON Kembali Pada 2018-07-30 01:05:30am', 0, 1, '2018-07-30 01:05:30'),
(7, 'Server OFF', 'WARNING! Server Utama OFF Pada 2018-08-02 12:28:28pm', 1, 1, '2018-08-02 12:28:28'),
(8, 'Server ON', 'Server Utama ON Kembali Pada 2018-08-02 12:29:38pm', 0, 1, '2018-08-02 12:29:38'),
(9, 'Service SSH OFF', 'WARNING! Service SSH OFF Pada 2018-08-02 12:30:22pm', 1, 1, '2018-08-02 12:30:22'),
(10, 'Service APACE OFF', 'WARNING! Service APACE OFF Pada 2018-08-02 12:35:05pm', 1, 1, '2018-08-02 12:35:05'),
(11, 'Service HTTP OFF', 'WARNING! Service HTTP OFF Pada 2018-08-02 12:35:05pm', 1, 1, '2018-08-02 12:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `t_server`
--

CREATE TABLE IF NOT EXISTS `t_server` (
  `ip_server` varchar(15) NOT NULL,
  `hostname` varchar(40) NOT NULL,
  `community` varchar(40) NOT NULL,
  `n_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_server`
--

INSERT INTO `t_server` (`ip_server`, `hostname`, `community`, `n_status`) VALUES
('192.168.1.254', 'Server Utama', 'simover', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_service`
--

CREATE TABLE IF NOT EXISTS `t_service` (
`id_service` int(5) NOT NULL,
  `ip_server` varchar(15) NOT NULL,
  `service_name` varchar(20) NOT NULL,
  `port` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_service`
--

INSERT INTO `t_service` (`id_service`, `ip_server`, `service_name`, `port`, `status`) VALUES
(16, '192.168.1.254', 'SSH', 22, 0),
(20, '192.168.1.254', 'APACE', 80, 0),
(21, '192.168.1.254', 'BIND', 111, 1),
(22, '192.168.1.254', 'FTP', 21, 1),
(23, '192.168.1.254', 'HTTP', 80, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_telegram`
--

CREATE TABLE IF NOT EXISTS `t_telegram` (
  `tele_id` int(10) NOT NULL,
  `tele_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_telegram`
--

INSERT INTO `t_telegram` (`tele_id`, `tele_name`) VALUES
(556431880, 'Riat');

-- --------------------------------------------------------

--
-- Table structure for table `t_uptup`
--

CREATE TABLE IF NOT EXISTS `t_uptup` (
`id_uptup` int(5) NOT NULL,
  `ip_uptup` varchar(15) NOT NULL,
  `h_uptup` varchar(40) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_uptup`
--

INSERT INTO `t_uptup` (`id_uptup`, `ip_uptup`, `h_uptup`, `status`) VALUES
(1, '192.168.1.10', 'Bengkalis', 1),
(3, '192.168.1.20', 'SIAK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
`id_user` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `w_login` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `w_login`) VALUES
(1, 'admin', 'riat', '2018-04-27 20:45:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_hardware`
--
ALTER TABLE `t_hardware`
 ADD PRIMARY KEY (`no`);

--
-- Indexes for table `t_notif`
--
ALTER TABLE `t_notif`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `t_service`
--
ALTER TABLE `t_service`
 ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `t_uptup`
--
ALTER TABLE `t_uptup`
 ADD PRIMARY KEY (`id_uptup`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_hardware`
--
ALTER TABLE `t_hardware`
MODIFY `no` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `t_notif`
--
ALTER TABLE `t_notif`
MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `t_service`
--
ALTER TABLE `t_service`
MODIFY `id_service` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `t_uptup`
--
ALTER TABLE `t_uptup`
MODIFY `id_uptup` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
