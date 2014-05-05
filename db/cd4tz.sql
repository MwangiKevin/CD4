-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2014 at 10:36 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cd4tz`
--
CREATE DATABASE IF NOT EXISTS `cd4tz` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cd4tz`;

-- --------------------------------------------------------

--
-- Table structure for table `assay`
--

CREATE TABLE IF NOT EXISTS `assay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `calibur_upload`
--

CREATE TABLE IF NOT EXISTS `calibur_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institution` varchar(30) DEFAULT NULL,
  `director` varchar(30) DEFAULT NULL,
  `operator` varchar(30) DEFAULT NULL,
  `cytometer` varchar(30) DEFAULT NULL,
  `cytometer_serial_number` varchar(20) DEFAULT NULL,
  `sw_version` varchar(40) DEFAULT NULL,
  `sample_name` varchar(30) DEFAULT NULL,
  `sample_id` varchar(20) DEFAULT NULL,
  `case_number` varchar(20) DEFAULT NULL,
  `age` float(6,2) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `facility_id` int(20) DEFAULT NULL,
  `panel_name` varchar(20) DEFAULT NULL,
  `date_analyzed` date DEFAULT NULL,
  `lab_report_file_name` varchar(30) DEFAULT NULL,
  `physicians_report_file_name` varchar(30) DEFAULT NULL,
  `ref_range` varchar(20) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `CD3CD4CD45TruCFCS_fileN_name` varchar(40) DEFAULT NULL,
  `CD3CD4CD45TruC_lot_id` int(30) DEFAULT NULL,
  `CD3CD4CD45TruC_error_codes` int(10) DEFAULT NULL,
  `CD3CD4CD45TruCCD3_lymph` float(10,2) DEFAULT NULL,
  `CD3CD4CD45TruCCD3_abs_cnt` float(10,2) DEFAULT NULL,
  `CD3CD4CD45TruCCD3CD4_lymph` float(10,2) DEFAULT NULL,
  `CD3CD4CD45TruCCD3CD4_abs_cnt` float(10,2) DEFAULT NULL,
  `CD3CD4CD45TruCCD45_abs_cnt` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sample_id` (`sample_id`,`case_number`,`facility_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cd4_test`
--

CREATE TABLE IF NOT EXISTS `cd4_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd4_count` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL COMMENT 'pk to equipment',
  `facility_equipment_id` int(11) NOT NULL COMMENT 'FK to facility_equipment',
  `facility_id` int(11) NOT NULL COMMENT 'FK to facility',
  `result_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid` int(11) NOT NULL DEFAULT '1' COMMENT '1 for true 0 for false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `commodity`
--

CREATE TABLE IF NOT EXISTS `commodity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fcdrr_id` int(11) NOT NULL COMMENT 'FK to fcdrr',
  `beginning_bal` int(11) NOT NULL,
  `received_qty` int(11) NOT NULL,
  `lot_code` varchar(250) NOT NULL,
  `qty_used` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `adjustment_plus` int(11) NOT NULL,
  `adjustment_minus` int(11) NOT NULL,
  `end_bal` int(11) NOT NULL,
  `requested` int(11) NOT NULL,
  `reagent_id` int(11) NOT NULL COMMENT 'FK to reagents',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='FCDRR reagents and other commodities' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `commodity_temp`
--

CREATE TABLE IF NOT EXISTS `commodity_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fcdrr_id` int(11) NOT NULL COMMENT 'FK to fcdrrtemp',
  `beginning_bal` int(11) NOT NULL,
  `received_qty` int(11) NOT NULL,
  `lot_code` varchar(250) NOT NULL,
  `qty_used` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `adjustment_plus` int(11) NOT NULL,
  `adjustment_minus` int(11) NOT NULL,
  `end_bal` int(11) NOT NULL,
  `requested` int(11) NOT NULL,
  `reagent_id` int(11) NOT NULL COMMENT 'FK to reagents',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='FCDRR reagents and other commodities' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `county`
--

CREATE TABLE IF NOT EXISTS `county` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `provinceid` int(11) NOT NULL COMMENT 'FK to province',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Counties' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `region_id` int(11) NOT NULL COMMENT 'FK to region',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `region_id` (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=171 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`, `region_id`, `status`) VALUES
(1, 'Arumeru', 1, 1),
(2, 'Arusha City', 1, 1),
(3, 'Arusha District', 1, 1),
(4, 'Karatu', 1, 1),
(5, 'Longido', 1, 1),
(6, 'Monduli', 1, 1),
(7, 'Ngorongoro', 1, 1),
(8, 'Ilala', 2, 1),
(9, 'Kinondoni', 2, 1),
(10, 'Temeke', 2, 1),
(11, 'Bahi', 3, 1),
(12, 'Chamwino', 3, 1),
(13, 'Chemba', 3, 1),
(14, 'Dodoma', 3, 1),
(15, 'Kondoa', 3, 1),
(16, 'Kongwa', 3, 1),
(17, 'Mpwapwa', 3, 1),
(18, 'Bukombe', 4, 1),
(19, 'Chato', 4, 1),
(20, 'Geita', 4, 1),
(21, 'Mbongwe', 4, 1),
(22, 'Nyang''hwale', 4, 1),
(23, 'Iringa District', 5, 1),
(24, 'Iringa Municipal', 5, 1),
(25, 'Kilolo', 5, 1),
(26, 'Biharamulo', 6, 1),
(27, 'Bukoba District', 6, 1),
(28, 'Bukoba Municipal', 6, 1),
(29, 'Karagwe', 6, 1),
(30, 'Kyerwa', 6, 1),
(31, 'Missenyi', 6, 1),
(32, 'Muleba', 6, 1),
(33, 'Ngara', 6, 1),
(34, 'Micheweni', 7, 1),
(35, 'Wete', 7, 1),
(36, 'Kaskazini A', 8, 1),
(37, 'Kaskazini B', 8, 1),
(38, 'Mlele', 9, 1),
(39, 'Mufindi', 5, 1),
(40, 'Mafinga', 5, 1),
(41, 'Mpanda', 9, 1),
(42, 'Mpanda', 9, 1),
(43, 'Buhigwe', 10, 1),
(44, 'Kakonko', 10, 1),
(45, 'Kasulu District', 10, 1),
(46, 'Kasulu Town', 10, 1),
(47, 'Kibondo', 10, 1),
(48, 'Kigoma District', 10, 1),
(49, 'Kigoma-Ujiji', 10, 1),
(50, 'Uvinza', 10, 1),
(51, 'Hai', 11, 1),
(52, 'Moshi District', 11, 1),
(53, 'Moshi Municipal', 11, 1),
(54, 'Mwanga', 11, 1),
(55, 'Rombo', 11, 1),
(56, 'Same ', 11, 1),
(57, 'Siha', 11, 1),
(58, 'Chake Chake', 12, 1),
(59, 'Mkoani', 12, 1),
(60, 'Kati', 13, 1),
(61, 'Kusini', 13, 1),
(62, 'Kilwa', 14, 1),
(63, 'Lindi District', 14, 1),
(64, 'Lindi Municipal', 14, 1),
(65, 'Liwale', 14, 1),
(66, 'Nachingwea', 14, 1),
(67, 'Ruangwa', 14, 1),
(68, 'Babati Town', 15, 1),
(69, 'Babati District', 15, 1),
(70, 'Hanang', 15, 1),
(71, 'Kiteto', 15, 1),
(72, 'Mbulu', 15, 1),
(73, 'Simanjiro', 15, 1),
(74, 'Bunda', 16, 1),
(75, 'Butiama', 16, 1),
(76, 'Musoma District', 16, 1),
(77, 'Musoma Municipa', 16, 1),
(78, 'Rorya', 16, 1),
(79, 'Serengeti', 16, 1),
(80, 'Tarime', 16, 1),
(81, 'Chunya', 17, 1),
(82, 'Ileje', 17, 1),
(83, 'Kyela', 17, 1),
(84, 'Mbarali', 17, 1),
(85, 'Mbeya City', 17, 1),
(86, 'Mbeya District', 17, 1),
(87, 'Mbozi', 17, 1),
(88, 'Momba', 17, 1),
(89, 'Rungwe', 17, 1),
(90, 'Tunduma', 17, 1),
(91, 'Magharibi', 18, 1),
(92, 'Mjini', 18, 1),
(93, 'Gairo', 19, 1),
(94, 'Kilombero', 19, 1),
(95, 'Kilosa', 19, 1),
(96, 'Morogoro District', 19, 1),
(97, 'Morogoro Municipal', 19, 1),
(98, 'Mvomero', 19, 1),
(99, 'Ulanga', 19, 1),
(100, 'Masasi District', 20, 1),
(101, 'Masasi Town', 20, 1),
(102, 'Mtwara District', 20, 1),
(103, 'Mtwara Municipal', 20, 1),
(104, 'Nanyumbu', 20, 1),
(105, 'Newala', 20, 1),
(106, 'Tandahimba', 20, 1),
(107, 'Ilemela', 21, 1),
(108, 'Kwimba', 21, 1),
(109, 'Magu', 21, 1),
(110, 'Misungwi', 21, 1),
(111, 'Nyamagana', 21, 1),
(112, 'Sengerema', 21, 1),
(113, 'Ukerewe', 21, 1),
(114, 'Ludewa', 22, 1),
(115, 'Makambako Town', 22, 1),
(116, 'Makete', 22, 1),
(117, 'Njombe District', 22, 1),
(118, 'Njombe Town', 22, 1),
(119, 'Wanging''ombe', 22, 1),
(120, 'Bagamoyo', 23, 1),
(121, 'Kibaha District', 23, 1),
(122, 'Kibaha Town', 23, 1),
(123, 'Kisarawe', 23, 1),
(124, 'Mafia', 23, 1),
(125, 'Mkuranga', 23, 1),
(126, 'Rufiji', 23, 1),
(127, 'Kalambo', 24, 1),
(128, 'Nkasi', 24, 1),
(129, 'Sumbawanga District', 24, 1),
(130, 'Sumbawanga Municipal', 24, 1),
(131, 'Mbinga', 25, 1),
(132, 'Songea District', 25, 1),
(133, 'Songea Municipal', 25, 1),
(134, 'Tunduru', 25, 1),
(135, 'Namtumbo', 25, 1),
(136, 'Nyasa', 25, 1),
(137, 'Kahama Town', 26, 1),
(138, 'Kahama District', 26, 1),
(139, 'Kishapu', 26, 1),
(140, 'Shinyanga District', 26, 1),
(141, 'Shinyanga Municipal', 26, 1),
(142, 'Bariadi', 27, 1),
(143, 'Busega', 27, 1),
(144, 'Itilima', 27, 1),
(145, 'Maswa', 27, 1),
(146, 'Meatu', 27, 1),
(147, 'Ikungi', 28, 1),
(148, 'Iramba', 28, 1),
(149, 'Manyoni', 28, 1),
(150, 'Mkalama', 28, 1),
(151, 'Singida District ', 28, 1),
(152, 'Singida Municipal', 28, 1),
(153, 'Igunga', 29, 1),
(154, 'Kaliua', 29, 1),
(155, 'Nzega', 29, 1),
(156, 'Sikonge', 29, 1),
(157, 'Tabora Municipal', 29, 1),
(158, 'Urambo', 29, 1),
(159, 'Uyui', 29, 1),
(160, 'Handeni District ', 30, 1),
(161, 'Handeni Town', 30, 1),
(162, 'Kilindi', 30, 1),
(163, 'Korogwe Town', 30, 1),
(164, 'Korogwe District', 30, 1),
(165, 'Lushoto', 30, 1),
(166, 'Muheza', 30, 1),
(167, 'Mkinga', 30, 1),
(168, 'Pangani', 30, 1),
(169, 'Tanga City', 30, 1),
(170, 'Mwanza City', 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `district_user`
--

CREATE TABLE IF NOT EXISTS `district_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'FK to user',
  `district_id` int(11) NOT NULL COMMENT 'FK to district',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='district and user mapping table' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `district_user`
--

INSERT INTO `district_user` (`id`, `user_id`, `district_id`) VALUES
(1, 4, 109),
(2, 7, 89);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `category` int(11) NOT NULL COMMENT 'FK to equipmentcategory',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Equipments' AUTO_INCREMENT=22 ;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `description`, `category`, `status`) VALUES
(1, 'BD Facs Count', 1, 0),
(2, 'BD Facs Calibur', 1, 0),
(3, 'Partec Cyflow', 1, 1),
(4, 'Alere PIMA', 1, 1),
(5, 'Beckman Coulter Ac-T CP5', 2, 0),
(6, 'NK Celltac F 8222', 2, 1),
(7, 'NK Celltac F 6400', 2, 0),
(8, 'Beckman Coulter Ac-T Diff II', 2, 0),
(9, 'Sysmex', 2, 0),
(10, 'BTS 310/305', 3, 0),
(11, 'BTS 330/370', 3, 0),
(12, 'Eurolyser', 3, 0),
(13, 'Humalyzer 2000/3000', 3, 0),
(14, 'Humastar 180', 3, 0),
(15, 'Metrolab', 3, 0),
(16, 'Jr', 3, 0),
(21, 'dasdasd', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_category`
--

CREATE TABLE IF NOT EXISTS `equipment_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Equpment categories' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `equipment_category`
--

INSERT INTO `equipment_category` (`id`, `description`, `flag`) VALUES
(1, 'CD4 Equipment', 1),
(2, 'Hematology (FBC) Equipment', 0),
(3, 'Chemistry Equipment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_status`
--

CREATE TABLE IF NOT EXISTS `equipment_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Equipment Status' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `equipment_status`
--

INSERT INTO `equipment_status` (`id`, `description`) VALUES
(1, 'Functional'),
(2, 'Disfunctional'),
(3, 'Obsolete');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE IF NOT EXISTS `facility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `district_id` int(11) DEFAULT NULL COMMENT 'FK to districts',
  `email` varchar(250) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `rollout_status` int(11) NOT NULL DEFAULT '1',
  `rollout_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `district_id` (`district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Facilities' AUTO_INCREMENT=41 ;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`id`, `name`, `district_id`, `email`, `phone`, `rollout_status`, `rollout_date`) VALUES
(1, 'Kisesa', 109, '', '', 5, NULL),
(2, 'Nasa', 109, '', '', 1, NULL),
(3, 'Nyanguge', 109, '', '', 4, NULL),
(4, 'Mkula', 109, '', '', 1, NULL),
(5, 'Misasi', 110, '', '', 1, NULL),
(6, 'Bukumbi', 110, '', '', 2, NULL),
(7, 'Makongoro', 170, '', '', 5, NULL),
(8, 'Kwediboma', 162, '', '', 5, NULL),
(9, 'Tunguli', 162, '', '', 5, NULL),
(10, 'Kibirashi', 162, '', '', 5, NULL),
(11, 'Songe', 162, '', '', 5, NULL),
(12, 'Bulwa', 166, '', '', 5, NULL),
(13, 'Mkuzi', 166, '', '', 5, NULL),
(14, 'Mnazi', 165, '', '', 5, NULL),
(15, 'Kangagai', 165, '', '', 5, NULL),
(16, 'Kwai', 165, '', '', 5, NULL),
(17, 'Soni', 165, '', '', 5, NULL),
(18, 'Makambako', 117, '', '', 5, NULL),
(19, 'Kidugala', 117, '', '', 5, NULL),
(20, 'Mtwango', 117, '', '', 5, NULL),
(21, '514 KJ', 117, '', '', 5, NULL),
(22, 'Nzihi', 23, '', '', 5, NULL),
(23, 'Isman', 23, '', '', 5, NULL),
(24, 'Idodo', 23, '', '', 5, NULL),
(25, 'Migoli', 23, '', '', 5, NULL),
(26, 'Mgololo', 39, '', '', 5, NULL),
(27, 'Kassanga', 39, '', '', 5, NULL),
(28, 'Igawilo', 85, '', '', 5, NULL),
(29, 'Ruanda', 85, '', '', 5, NULL),
(30, 'Iyunga', 85, '', '', 5, NULL),
(31, 'Ipinda', 83, '', '', 5, NULL),
(32, 'Ngonga', 83, '', '', 5, NULL),
(33, 'Matema', 83, '', '', 5, NULL),
(34, 'Masukulu', 89, '', '', 5, NULL),
(35, 'Mwakaleli', 89, '', '', 5, NULL),
(36, 'Igoma', 86, '', '', 5, NULL),
(37, 'Inyala', 86, '', '', 5, NULL),
(38, 'Mikindani', 103, '', '', 5, NULL),
(39, 'Likombe', 103, '', '', 5, NULL),
(40, 'Mkunya', 105, '', '', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facility_equipment`
--

CREATE TABLE IF NOT EXISTS `facility_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'FK to equipmentstatus',
  `deactivation_reason` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_removed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Equipment mapped to facilities' AUTO_INCREMENT=44 ;

--
-- Dumping data for table `facility_equipment`
--

INSERT INTO `facility_equipment` (`id`, `facility_id`, `equipment_id`, `status`, `deactivation_reason`, `date_added`, `date_removed`) VALUES
(1, 1, 4, 1, '', '2013-08-25 12:44:23', NULL),
(2, 2, 4, 1, '', '2013-08-25 12:44:23', NULL),
(3, 3, 4, 1, '', '2013-08-25 12:44:23', NULL),
(4, 4, 4, 1, '', '2013-09-25 12:44:23', NULL),
(5, 5, 4, 1, '', '2013-09-25 12:44:23', NULL),
(6, 6, 4, 1, '', '2013-10-25 12:44:23', '2014-04-25 15:44:23'),
(7, 7, 4, 1, '', '2013-10-25 12:44:23', '2014-01-25 15:44:23'),
(8, 8, 4, 1, '', '2013-10-25 12:44:23', NULL),
(9, 9, 4, 1, '', '2013-10-25 12:44:23', NULL),
(10, 10, 4, 1, '', '2013-10-25 12:44:23', NULL),
(11, 11, 4, 1, '', '2013-11-25 12:44:23', NULL),
(12, 12, 4, 1, '', '2013-11-25 12:44:23', NULL),
(13, 13, 4, 1, '', '2013-11-25 12:44:23', NULL),
(14, 14, 4, 1, '', '2013-11-25 12:44:23', '2014-04-25 15:44:23'),
(15, 15, 4, 1, '', '2013-11-25 12:44:23', NULL),
(16, 16, 4, 1, '', '2013-11-25 12:44:23', NULL),
(17, 17, 4, 1, '', '2013-11-25 12:44:23', NULL),
(18, 18, 4, 1, '', '2013-12-25 12:44:23', NULL),
(19, 19, 4, 1, '', '2013-12-25 12:44:23', NULL),
(20, 20, 4, 1, '', '2013-12-25 12:44:23', NULL),
(21, 21, 4, 1, '', '2013-12-25 12:44:23', NULL),
(22, 22, 4, 1, '', '2014-01-25 12:44:23', NULL),
(23, 23, 4, 1, '', '2014-01-25 12:44:23', NULL),
(24, 24, 4, 1, '', '2014-01-25 12:44:23', NULL),
(25, 25, 4, 1, '', '2014-02-25 12:44:23', NULL),
(26, 26, 4, 1, '', '2014-03-25 12:44:23', NULL),
(27, 27, 4, 1, '', '2014-04-25 12:44:23', NULL),
(28, 28, 4, 1, '', '2014-04-25 12:44:23', NULL),
(29, 29, 4, 1, '', '2014-04-25 12:44:23', NULL),
(30, 30, 4, 1, '', '2014-04-25 12:44:23', NULL),
(31, 31, 4, 1, '', '2014-05-25 12:44:23', NULL),
(32, 32, 4, 1, '', '2014-05-25 12:44:23', NULL),
(33, 33, 4, 1, '', '2014-05-25 12:44:23', NULL),
(34, 34, 4, 1, '', '2014-05-25 12:44:23', NULL),
(35, 35, 4, 1, '', '2014-06-25 12:44:23', NULL),
(36, 36, 4, 1, '', '2014-06-25 12:44:23', NULL),
(37, 37, 4, 1, '', '2014-06-25 12:44:23', NULL),
(38, 38, 4, 1, '', '2014-06-25 12:44:23', NULL),
(39, 39, 4, 1, '', '2014-07-25 12:44:23', NULL),
(40, 40, 4, 1, '', '2014-08-25 12:44:23', NULL),
(41, 16, 1, 1, '', '2014-02-13 10:13:11', NULL),
(42, 0, 0, 1, '', '2014-02-14 13:10:59', NULL),
(43, 0, 0, 1, '', '2014-02-18 08:27:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facility_pima`
--

CREATE TABLE IF NOT EXISTS `facility_pima` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_equipment_id` int(11) NOT NULL COMMENT 'FK to facility_equipment',
  `serial_num` varchar(30) NOT NULL,
  `ctc_id_no` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `facility_equipment_id` (`facility_equipment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `facility_pima`
--

INSERT INTO `facility_pima` (`id`, `facility_equipment_id`, `serial_num`, `ctc_id_no`) VALUES
(1, 1, 'PIMA-D-002540', '19020400'),
(2, 2, 'PIMA-D-002340', '19020103'),
(3, 3, 'PIMA-D-002148', '19020107'),
(4, 4, 'PIMA-D-002362', '19020200'),
(5, 5, 'PIMA-D-002682', '19070201'),
(6, 6, 'PIMA-D-002300', '19070100'),
(7, 7, 'PIMA-D-002546', '19030800'),
(8, 8, 'PIMA-D-002288', '4070101'),
(9, 9, 'PIMA-D-002696', '4070102'),
(10, 10, 'PIMA-D-003691', ''),
(11, 11, 'PIMA-D-003005', '4070100'),
(12, 12, 'PIMA-D-003183', '4030101'),
(13, 13, 'PIMA-D-001965', '4030103'),
(14, 14, 'PIMA-D-001942', '4010104'),
(15, 15, 'PIMA-D-002745', '4010109'),
(16, 16, 'PIMA-D-002728', '4010108'),
(17, 17, 'PIMA-D-002291', '4010106'),
(18, 18, 'PIMA-D-001911', '11030201'),
(19, 19, 'PIMA-D-003097', '11030305'),
(20, 20, 'PIMA-D-003116', '11030303'),
(21, 21, '', '11030500'),
(22, 22, 'PIMA-D-003082', '11060108'),
(23, 23, 'PIMA-D-001905', '11060102'),
(24, 24, 'PIMA-D-003118', '11060103'),
(25, 25, 'PIMA-D-001499', '11060104'),
(26, 26, 'PIMA-D-003089', '11050203'),
(27, 27, 'PIMA-D-001805', '11050204'),
(28, 28, 'PIMA-D-003105', '12070203'),
(29, 29, 'PIMA-D-003060', '12070201'),
(30, 30, 'PIMA-D-002438', '12070207'),
(31, 31, 'PIMA-D-001504', '12030101'),
(32, 32, 'PIMA-D-001814', '12030104'),
(33, 33, 'PIMA-D-002563', '12030200'),
(34, 34, 'PIMA-D-001900', '12040104'),
(35, 35, 'PIMA-D-001873', '12040101'),
(36, 36, 'PIMA-D-001495', '12020104'),
(37, 37, 'PIMA-D-001823', '12020103'),
(38, 38, 'PIMA-D-002368', '9040102'),
(39, 39, 'PIMA-D-002750', '9040101'),
(40, 40, 'PIMA-D-001852', '9020102');

-- --------------------------------------------------------

--
-- Table structure for table `facility_type`
--

CREATE TABLE IF NOT EXISTS `facility_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initials` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Facility Types' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `facility_user`
--

CREATE TABLE IF NOT EXISTS `facility_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'FK to user',
  `facility_id` int(11) NOT NULL COMMENT 'FK to facility',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='facility and user mapping table' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `facility_user`
--

INSERT INTO `facility_user` (`id`, `user_id`, `facility_id`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fcdrr`
--

CREATE TABLE IF NOT EXISTS `fcdrr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` varchar(10) NOT NULL COMMENT 'FK to facility',
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `calibur_tests_adults` int(11) NOT NULL,
  `calibur_tests_pead` int(11) NOT NULL,
  `caliburs` int(11) NOT NULL,
  `count_tests_adults` int(11) NOT NULL,
  `count_tests_pead` int(11) NOT NULL,
  `counts` int(11) NOT NULL,
  `cyflow_tests_adults` int(11) NOT NULL,
  `cyflow_tests_pead` int(11) NOT NULL,
  `cyflows` int(11) NOT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `upload_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fcdrr_temp`
--

CREATE TABLE IF NOT EXISTS `fcdrr_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` varchar(10) NOT NULL COMMENT 'FK to facility',
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `calibur_tests_adults` int(11) NOT NULL,
  `calibur_tests_pead` int(11) NOT NULL,
  `caliburs` int(11) NOT NULL,
  `count_tests_adults` int(11) NOT NULL,
  `count_tests_pead` int(11) NOT NULL,
  `counts` int(11) NOT NULL,
  `cyflow_tests_adults` int(11) NOT NULL,
  `cyflow_tests_pead` int(11) NOT NULL,
  `cyflows` int(11) NOT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `today` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Partners' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`id`, `name`, `phone`, `email`) VALUES
(1, 'ICAP', '', ''),
(2, 'THPS', '', ''),
(3, 'TUNAJALI', '', ''),
(4, 'DOD', '', ''),
(5, 'EGPAF', '', ''),
(6, 'CSSC', '', ''),
(7, 'AIDS RELIEF', '', ''),
(8, 'MDH', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `partner_regions`
--

CREATE TABLE IF NOT EXISTS `partner_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL COMMENT 'FK to partner',
  `region_id` int(11) NOT NULL COMMENT 'FK to region',
  PRIMARY KEY (`id`),
  KEY `partner_id` (`partner_id`),
  KEY `region_id` (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Mapping to partners and regions' AUTO_INCREMENT=30 ;

--
-- Dumping data for table `partner_regions`
--

INSERT INTO `partner_regions` (`id`, `partner_id`, `region_id`) VALUES
(1, 1, 6),
(2, 1, 10),
(3, 1, 23),
(4, 1, 7),
(5, 1, 12),
(6, 1, 18),
(7, 1, 13),
(8, 1, 8),
(9, 2, 20),
(10, 3, 3),
(11, 3, 28),
(12, 3, 19),
(13, 3, 5),
(14, 3, 22),
(15, 4, 17),
(16, 4, 24),
(17, 4, 25),
(18, 5, 11),
(19, 5, 1),
(20, 5, 29),
(21, 5, 26),
(22, 5, 14),
(23, 6, 21),
(24, 7, 27),
(25, 7, 4),
(26, 7, 15),
(27, 7, 30),
(28, 7, 16),
(29, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `partner_user`
--

CREATE TABLE IF NOT EXISTS `partner_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'FK to user',
  `partner_id` int(11) NOT NULL COMMENT 'FK to partner',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='partner and user mapping table' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `partner_user`
--

INSERT INTO `partner_user` (`id`, `user_id`, `partner_id`) VALUES
(1, 2, 6),
(2, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_log`
--

CREATE TABLE IF NOT EXISTS `password_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'FK to user',
  `password` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `password_log`
--

INSERT INTO `password_log` (`id`, `user_id`, `password`, `date_created`) VALUES
(1, 1, '7eadb0236f5e1f4c6c9040e3c9d55605', '2013-12-27 14:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `pima_error`
--

CREATE TABLE IF NOT EXISTS `pima_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error_code` varchar(75) DEFAULT NULL,
  `error_detail` varchar(50) NOT NULL,
  `pima_error_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `pima_error`
--

INSERT INTO `pima_error` (`id`, `error_code`, `error_detail`, `pima_error_type`) VALUES
(1, '201', 'Volume ', 1),
(2, '210', 'Device Application ', 2),
(3, '200 ', 'Test Aborted ', 1),
(4, '203 ', 'Expiry date ', 1),
(5, '300-399 ', 'Electronic Errors ', 2),
(6, '810', 'Channel Filling ', 1),
(7, '820', 'Focus Chanel', 2),
(8, '830', 'Exposure Time ', 1),
(9, '840', 'Focus Range ', 1),
(10, '850', 'Exposure postion ', 1),
(11, '860', 'Reagent Control ', 1),
(12, '870', 'Corrspondence control ', 2),
(13, '880', 'Cell Movement control ', 1),
(14, '890', 'Focus control- large objects ', 2),
(15, '910', 'Image ', 1),
(16, '920', 'Plausability ', 1),
(17, '930', 'Homogeneity ', 2),
(18, '940', 'Gating ', 1),
(19, '206 ', 'Manual Abort', 1),
(20, '825', 'Focus Control ', 2),
(21, '202 ', 'Test Not Finished', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pima_error_type`
--

CREATE TABLE IF NOT EXISTS `pima_error_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) NOT NULL,
  `action` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pima_error_type`
--

INSERT INTO `pima_error_type` (`id`, `description`, `action`) VALUES
(1, 'User Error', ''),
(2, 'Device Error', '');

-- --------------------------------------------------------

--
-- Table structure for table `pima_failed_upload_devices`
--

CREATE TABLE IF NOT EXISTS `pima_failed_upload_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_num` text NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'FK to user',
  `equipment_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL COMMENT 'FK to status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pima_test`
--

CREATE TABLE IF NOT EXISTS `pima_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd4_test_id` int(11) NOT NULL COMMENT 'FK_to cd4_test',
  `device_test_id` int(11) NOT NULL COMMENT 'Generated by the pima device',
  `pima_upload_id` int(11) NOT NULL COMMENT 'FK to pima Upload',
  `assay_id` int(11) NOT NULL,
  `sample_code` varchar(100) NOT NULL,
  `error_id` int(11) NOT NULL,
  `cd4_count` int(11) NOT NULL,
  `result_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `operator` varchar(100) NOT NULL,
  `barcode` int(11) NOT NULL,
  `expiry_date` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `device` int(11) NOT NULL,
  `reagent` int(11) NOT NULL,
  `software_version` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pima Test uploads' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pima_test_pass_fail`
--

CREATE TABLE IF NOT EXISTS `pima_test_pass_fail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL,
  `Description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pima_test_pass_fail`
--

INSERT INTO `pima_test_pass_fail` (`id`, `status`, `Description`) VALUES
(1, 'pass', ''),
(2, 'fail', ''),
(3, '', 'null'),
(4, 'manual', ''),
(5, 'overruled', '');

-- --------------------------------------------------------

--
-- Table structure for table `pima_upload`
--

CREATE TABLE IF NOT EXISTS `pima_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `facility_pima_id` varchar(100) NOT NULL COMMENT 'FK to facility pima',
  `uploaded_by` int(11) NOT NULL COMMENT 'FK to user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pima uploads' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reagent`
--

CREATE TABLE IF NOT EXISTS `reagent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL COMMENT 'FK to reagentcategory',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reagent_category`
--

CREATE TABLE IF NOT EXISTS `reagent_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `equipment_id` int(11) NOT NULL COMMENT 'Implied FK to equipment. 0 for common reagents',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reagent_category`
--

INSERT INTO `reagent_category` (`id`, `name`, `equipment_id`) VALUES
(1, 'FACS Count Reagents and Consumables', 1),
(2, 'FACS Calibur Reagents and Consumables', 2),
(3, 'Cyflow Partec Reagents and Consumables', 3),
(4, 'PIMA Reagents and Consumables', 4),
(5, 'Common Reagents and consumables', 0);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='regions' AUTO_INCREMENT=31 ;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `name`, `status`) VALUES
(1, 'Arusha', 1),
(2, 'Dar es Salaam', 1),
(3, 'Dodoma', 1),
(4, 'Geita', 1),
(5, 'Iringa', 1),
(6, 'Kagera', 1),
(7, 'Pemba North', 1),
(8, 'Zanzibar North', 1),
(9, 'Katavi', 1),
(10, 'Kigoma', 1),
(11, 'Kilimanjaro', 1),
(12, 'Pemba South', 1),
(13, 'Zanzibar Central And South', 1),
(14, 'Lindi', 1),
(15, 'Manyara', 1),
(16, 'Mara', 1),
(17, 'Mbeya', 1),
(18, 'Zanzibar West (Urban)', 1),
(19, 'Morogoro', 1),
(20, 'Mtwara', 1),
(21, 'Mwanza', 1),
(22, 'Njombe', 1),
(23, 'Pwani', 1),
(24, 'Rukwa', 1),
(25, 'Ruvuma', 1),
(26, 'Shinyanga', 1),
(27, 'Simiyu', 1),
(28, 'Singida', 1),
(29, 'Tabora', 1),
(30, 'Tanga', 1);

-- --------------------------------------------------------

--
-- Table structure for table `region_user`
--

CREATE TABLE IF NOT EXISTS `region_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'FK to user',
  `region_id` int(11) NOT NULL COMMENT 'FK to region',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='region and user mapping table' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `region_user`
--

INSERT INTO `region_user` (`id`, `user_id`, `region_id`) VALUES
(1, 3, 21);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `desc`) VALUES
(1, 'Active'),
(2, 'Flagged'),
(3, 'Deactivated'),
(4, 'Removed'),
(5, 'Pending Activation');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_group_id` int(11) NOT NULL COMMENT 'FK to usergroup',
  `user_access_level_id` int(11) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `activation_clause` varchar(800) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `user_group_id`, `user_access_level_id`, `phone`, `email`, `status`, `activation_clause`) VALUES
(1, 'system', 'ee6b03e4aa0421a38ca4d4706d5eaee8', 'SYSTEM', 7, 2, '98342-91823', 'mm@kjhda.com', 1, ''),
(2, 'partner', '12a268551d669a483ab7b05171d9f2ec', 'Test Partner', 3, 3, '3123-4234', 'testpartner@cd4.co.tz', 1, ''),
(3, 'region', '12a268551d669a483ab7b05171d9f2ec', 'Test Region', 9, 3, '31234-4234', 'region@poc.com', 1, ''),
(4, 'district', '12a268551d669a483ab7b05171d9f2ec', 'Test District', 8, 3, '31234-4234', 'region@poc.com', 1, ''),
(5, 'facility', '12a268551d669a483ab7b05171d9f2ec', 'Test Facility', 6, 3, '31234-4234', 'region@poc.com', 1, ''),
(6, 'admin', 'ee6b03e4aa0421a38ca4d4706d5eaee8', 'Test Admin', 2, 2, '0723016811', 'mm@kjhda.com', 1, ''),
(7, 'district1', '12a268551d669a483ab7b05171d9f2ec', 'Test District', 8, 3, '31234-4234', 'region@poc.com', 1, ''),
(8, 'partner1', '12a268551d669a483ab7b05171d9f2ec', 'Test Partner', 3, 3, '3123-4234', 'testpartner@cd4.co.tz', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` tinyint(3) unsigned DEFAULT NULL,
  `access_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sess_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=98 ;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `user`, `access_type`, `timestamp`, `ip_address`, `agent`, `sess_data`) VALUES
(1, NULL, 'denied', '2014-02-05 09:50:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"c06154d001ce12bab171d4f3488a5899","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391593823,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0}'),
(2, 6, 'login', '2014-02-05 09:53:53', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"c06154d001ce12bab171d4f3488a5899","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391593835,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(3, 6, 'logout', '2014-02-05 10:03:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"b620715e6c9fc5d383e7023b3b9846d3","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391594612,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(4, 2, 'login', '2014-02-05 10:03:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"e74575010769c48dc871824bed284513","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391594612,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(5, 2, 'logout', '2014-02-05 10:04:21', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"e74575010769c48dc871824bed284513","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391594661,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":"6","partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(6, 6, 'login', '2014-02-05 10:04:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"feeb3224e685bb5be1676882c9d72c7e","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391594661,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(7, 6, 'logout', '2014-02-05 10:06:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"feeb3224e685bb5be1676882c9d72c7e","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391594783,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(8, 2, 'login', '2014-02-05 10:06:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"997dfda2bc8481920efb2cbcadb0e26a","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391594783,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(9, 2, 'logout', '2014-02-05 10:08:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"997dfda2bc8481920efb2cbcadb0e26a","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391594928,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(10, 6, 'denied', '2014-02-05 10:08:56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"81d3fe1bd2596ebc514479e1f77e95c0","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391594928,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0}'),
(11, 6, 'login', '2014-02-05 10:09:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"81d3fe1bd2596ebc514479e1f77e95c0","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391594936,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(12, 6, 'logout', '2014-02-05 10:13:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"81d3fe1bd2596ebc514479e1f77e95c0","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391595217,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(13, 2, 'login', '2014-02-05 10:13:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a69811f4c8f063b399d868be860b2533","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391595217,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(14, 2, 'logout', '2014-02-05 10:15:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a69811f4c8f063b399d868be860b2533","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391595340,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(15, 6, 'login', '2014-02-05 10:15:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"d1f35682162f093c5f6f448a6b5f495b","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391595340,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(16, 6, 'logout', '2014-02-05 10:31:18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"d1f35682162f093c5f6f448a6b5f495b","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391596278,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(17, 2, 'login', '2014-02-05 10:31:25', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"bec33286902ec12413067d5ee089c38e","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391596278,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(18, 2, 'logout', '2014-02-05 10:43:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"bec33286902ec12413067d5ee089c38e","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391596996,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(19, 2, 'login', '2014-02-05 10:43:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"e5f8e74ffe82a1ccf1c9625f349bcf21","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391596996,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(20, 2, 'logout', '2014-02-05 10:43:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"e5f8e74ffe82a1ccf1c9625f349bcf21","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391597009,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(21, 4, 'login', '2014-02-05 10:43:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"10f6d48976472bb3dc604d1ee2caeb98","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391597009,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"district_attempt":0,"id":"4","username":"district","name":"Test District","user_group_id":"8","user_access_level_id":"3","phone":"31234-4234","email":"region@poc.com","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"District Coordinator","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"109","user_filter_name":"Magu"}]}'),
(22, 4, 'logout', '2014-02-05 10:50:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"10f6d48976472bb3dc604d1ee2caeb98","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391597445,"user_data":"","filter_used":"Yearly","date_filter_start":"2013-01-01","date_filter_stop":"2013-12-31","filter_desc":"The Year 2013","user_filter_used":0,"district_attempt":0,"id":"4","username":"district","name":"Test District","user_group_id":"8","user_access_level_id":"3","phone":"31234-4234","email":"region@poc.com","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"District Coordinator","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"109","user_filter_name":"Magu"}]}'),
(23, 6, 'login', '2014-02-05 10:50:57', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"456466e6655211ea0f52e3b7d3a525a0","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391597445,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(24, 6, 'logout', '2014-02-05 10:54:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"456466e6655211ea0f52e3b7d3a525a0","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391597651,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(25, 2, 'login', '2014-02-05 10:54:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a9606e66bd2f0fe9702656d7211f5447","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391597651,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(26, 2, 'logout', '2014-02-05 11:28:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"dfa15aab12e4fd08b9c9fddb675a3fa6","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391599715,"user_data":"","filter_used":"Periodic","date_filter_start":"2014-02-1","date_filter_stop":"2014-02-05","filter_desc":"This Month","user_filter_used":"6","partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(27, 6, 'denied', '2014-02-05 11:28:41', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"22f50a7ed30d1a563b0970f850cba0de","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391599715,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0}'),
(28, 6, 'login', '2014-02-05 11:28:46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"22f50a7ed30d1a563b0970f850cba0de","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391599721,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(29, 6, 'logout', '2014-02-05 11:35:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"22f50a7ed30d1a563b0970f850cba0de","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391600105,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(30, 2, 'login', '2014-02-05 11:35:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"acfb41f3ec3ceb4f4df55407012305f8","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391600105,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(31, 2, 'logout', '2014-02-05 11:49:53', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"b112fb9fbad701573a58754ad8c07ce7","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391600993,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(32, 6, 'login', '2014-02-05 11:50:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"95c07749a11bf236b1df48463feaebad","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391600993,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(33, 6, 'logout', '2014-02-05 11:51:59', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"95c07749a11bf236b1df48463feaebad","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391601119,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(34, 2, 'login', '2014-02-05 11:52:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"3ce6217914c427cb81e24e7146bf5140","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391601119,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(35, 6, 'login', '2014-02-05 11:56:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', '{"session_id":"2fa622e290efeae0f588b1e796db4f0a","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko\\/20100101 Firefox\\/26.0","last_activity":1391601388,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(36, 6, 'login', '2014-02-05 21:53:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"c4e575065b4b0cadf05042315eb23fda","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391637184,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-05","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(37, 2, 'login', '2014-02-06 05:46:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"00319bc39a453631787e61b08004b3b4","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391665578,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(38, 2, 'logout', '2014-02-06 05:47:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"00319bc39a453631787e61b08004b3b4","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391665646,"user_data":"","filter_used":"Periodic","date_filter_start":"2014-02-1","date_filter_stop":"2014-02-06","filter_desc":"This Month","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(39, 6, 'login', '2014-02-06 05:48:02', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"f17a502b5b5fff6525649e71e6128cba","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391665646,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(40, 2, 'login', '2014-02-06 05:51:52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', '{"session_id":"bac0c5e2ee9ef0744dd5d21da740b2ee","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko\\/20100101 Firefox\\/26.0","last_activity":1391665904,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(41, 6, 'logout', '2014-02-06 08:41:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"992504580ce4176643337b01e35aeac7","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391676075,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(42, 2, 'login', '2014-02-06 08:41:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"44b9e4664893aebaa41eea72d0658dc3","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391676075,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"this Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(43, 2, 'logout', '2014-02-06 08:44:39', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"44b9e4664893aebaa41eea72d0658dc3","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391676279,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"this Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(44, 6, 'login', '2014-02-06 08:44:46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"f7eaa14e50c0738e498284b53900a6c9","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391676280,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"98342-91823","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(45, 6, 'logout', '2014-02-06 12:34:06', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"5a198921b458f8fde64ff78271faa3c2","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391690046,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(46, 2, 'login', '2014-02-06 12:34:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"6e083f39dd5159063fdb949365d531c0","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391690046,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(47, 2, 'logout', '2014-02-06 13:16:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"c8a0382598187e8735fa2c1644287b0c","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391692561,"user_data":"","filter_used":"All","date_filter_start":"2012-01-01","date_filter_stop":"2014-02-06","filter_desc":"All Results","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(48, 6, 'login', '2014-02-06 13:16:09', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"6fdf707af81a898ee53c8f232b71c84e","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391692561,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(49, 2, 'login', '2014-02-06 13:48:02', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', '{"session_id":"1d83a81046695623c8d60b9fd8ea983a","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko\\/20100101 Firefox\\/26.0","last_activity":1391694462,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-06","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(50, 2, 'login', '2014-02-07 08:08:25', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"df98b95a869055a74582681aea70a2a8","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391760489,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-07","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(51, 2, 'logout', '2014-02-07 08:44:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"cf57c332c1f133fdcd642a4ce6b749ce","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391762651,"user_data":"","filter_used":"All","date_filter_start":"2012-01-01","date_filter_stop":"2014-02-07","filter_desc":"All Results","user_filter_used":"6","partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(52, 2, 'login', '2014-02-07 08:44:38', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"ba2b93ae566e8653a6ab4ae4f1cb688c","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391762651,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-07","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(53, 2, 'logout', '2014-02-07 08:44:41', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"ba2b93ae566e8653a6ab4ae4f1cb688c","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391762681,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-07","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(54, 6, 'login', '2014-02-07 08:44:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"fe4a34388ddb76cdfc9a97df81da20b6","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391762681,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-07","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(55, 6, 'logout', '2014-02-07 09:12:09', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"8e8e9be495e3ad536677e1476d709d09","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391764329,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-07","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(56, 6, 'login', '2014-02-07 09:12:33', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"7e7f82245b877dec038c98b16a44c564","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391764329,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-07","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}');
INSERT INTO `userlog` (`id`, `user`, `access_type`, `timestamp`, `ip_address`, `agent`, `sess_data`) VALUES
(57, 2, 'login', '2014-02-07 09:17:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', '{"session_id":"3189a51521d887340cb1988c35ca719d","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko\\/20100101 Firefox\\/26.0","last_activity":1391764588,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-07","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(58, 2, 'login', '2014-02-07 19:31:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"7922bcba396314e95213e3e0cff48195","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391801457,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-07","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(59, 2, 'denied', '2014-02-09 04:45:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"18cd0762419f076ad7722fd1a432bd7b","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391921111,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-09","filter_desc":"This Year","user_filter_used":0,"partner_attempt":1}'),
(60, 2, 'login', '2014-02-09 04:45:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"18cd0762419f076ad7722fd1a432bd7b","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391921121,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-09","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(61, 2, 'logout', '2014-02-09 05:31:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"18cd0762419f076ad7722fd1a432bd7b","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391923902,"user_data":"","filter_used":"Yearly","date_filter_start":"2012-01-01","date_filter_stop":"2012-12-31","filter_desc":"The Year 2012","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(62, 6, 'denied', '2014-02-09 05:31:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"e786a3b866834a0d21e09812cedb58e5","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391923902,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-09","filter_desc":"This Year","user_filter_used":0}'),
(63, 6, 'login', '2014-02-09 05:31:57', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"e786a3b866834a0d21e09812cedb58e5","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1391923909,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-09","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(64, 2, 'login', '2014-02-10 08:02:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"c51c76e31f89db8bc6b8a3e805533cfa","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392019351,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-10","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(65, 2, 'logout', '2014-02-10 09:05:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"e96eb8c303e218ef996e86f13bc6038c","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392023107,"user_data":"","filter_used":"All","date_filter_start":"2012-01-01","date_filter_stop":"2014-02-10","filter_desc":"All Results","user_filter_used":"6","partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(66, 6, 'login', '2014-02-10 09:05:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"8552e0ebecd0aec6f4e62337369865a6","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392023108,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-10","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(67, 6, 'denied', '2014-02-12 07:05:53', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a7e264e4f08109e9fa10340313e4313e","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392188746,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-12","filter_desc":"This Year","user_filter_used":0}'),
(68, 6, 'login', '2014-02-12 07:06:02', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a7e264e4f08109e9fa10340313e4313e","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392188753,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-12","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(69, 6, 'logout', '2014-02-12 07:48:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"33d7418bb6636b0f97571daf215bb181","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392191303,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-12","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(70, 0, 'logout', '2014-02-12 07:48:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"7dad89c3623b6288db25481f26390c5c","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392191303,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-12","filter_desc":"This Year","user_filter_used":0}'),
(71, 2, 'login', '2014-02-12 07:48:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"5301ab8b61e160f968c53924ac7271a2","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392191303,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-12","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(72, 2, 'logout', '2014-02-12 08:44:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"75bf4adf8d3cfa8f82a3c80e216bfb92","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392194656,"user_data":"","filter_used":"All","date_filter_start":"2012-01-01","date_filter_stop":"2014-02-12","filter_desc":"All Results","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(73, 6, 'login', '2014-02-12 08:44:25', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a6970b1ab924072131b55af290d1dc26","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392194656,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-12","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(74, 6, 'login', '2014-02-12 08:50:21', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', '{"session_id":"d97b2bf6223bde8d3f325970eae09a13","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko\\/20100101 Firefox\\/26.0","last_activity":1392195014,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-12","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(75, 6, 'login', '2014-02-12 13:51:02', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', '{"session_id":"35e59e2d6de400a53e23fc1203bb9ac5","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko\\/20100101 Firefox\\/26.0","last_activity":1392213054,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-12","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(76, 6, 'login', '2014-02-13 08:25:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"24f379412fe16d6a7b001c4b86582e0b","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392279914,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-13","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(77, 2, 'login', '2014-02-14 07:20:06', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a8be0230975472133cf91e4c4c3270fa","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392362406,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(78, 2, 'logout', '2014-02-14 07:20:10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a8be0230975472133cf91e4c4c3270fa","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392362410,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(79, 6, 'login', '2014-02-14 07:20:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"dc3410dcbc3375824ac59c5ff1b463f7","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392362410,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(80, 6, 'logout', '2014-02-14 07:20:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"dc3410dcbc3375824ac59c5ff1b463f7","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392362426,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(81, 6, 'login', '2014-02-14 07:20:31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"95b89bc5d932f1f7f480a7841a2369c0","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392362426,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(82, 6, 'logout', '2014-02-14 07:43:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"65586440ef2561f143c8100b3108e20c","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392363780,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(83, 6, 'login', '2014-02-14 07:43:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a7092c0385020035b20bcfcdeddbfc4f","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392363780,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(84, 6, 'logout', '2014-02-14 08:01:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"c43fca5581acb98c1be9fc91de1c5c1d","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392364909,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(85, 2, 'login', '2014-02-14 08:02:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"44d8b2661cc6e8e63513041ac4e2a6f9","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392364909,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(86, 6, 'login', '2014-02-14 11:43:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"8bfb6401d19373e1d54cab8c51458fbd","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392378219,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(87, 6, 'logout', '2014-02-14 12:04:46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"6fe618e9ac1ce62653d623565a579626","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392379486,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(88, 6, 'login', '2014-02-14 12:21:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"1cfd0676ad3669aacf1cce7180470a9c","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392380472,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-14","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(89, 6, 'login', '2014-02-17 13:05:56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"a893e787b2af06f0164886f5044f3ef3","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392642352,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-17","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(90, 6, 'login', '2014-02-18 08:27:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"7d97a5ffc615db5700097d73ac5e082c","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392712020,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-18","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(91, 6, 'logout', '2014-02-18 08:27:59', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"7d97a5ffc615db5700097d73ac5e082c","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392712079,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-18","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(92, 2, 'login', '2014-02-18 08:28:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"c9ca59dc7e256259e705e43d9f4ba0b9","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392712079,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-18","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(93, 2, 'login', '2014-02-18 11:26:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"56b608deb858dbd04692555493fa4136","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392722765,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-18","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(94, 2, 'login', '2014-02-19 06:30:22', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"19d3f0acf575eefb99f680cdc7434034","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392791419,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-19","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(95, 2, 'logout', '2014-02-19 08:26:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"b8a30bf2bbe1251937e5ce22d4bbec9d","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392798372,"user_data":"","filter_used":"All","date_filter_start":"2012-01-01","date_filter_stop":"2014-02-19","filter_desc":"All Results","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}'),
(96, 6, 'login', '2014-02-19 08:26:17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '{"session_id":"28c33c46e1152e61a14282d0a2f99031","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/32.0.1700.107 Safari\\/537.36","last_activity":1392798372,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-19","filter_desc":"This Year","user_filter_used":0,"admin_attempt":0,"id":"6","username":"admin","name":"Test Admin","user_group_id":"2","user_access_level_id":"2","phone":"0723016811","email":"mm@kjhda.com","status":"1","activation_clause":"","indicator":"Admin","date_created":null,"user_group":"Admin","authentication_level":"2","login_status":true,"user_filter":null}'),
(97, 2, 'login', '2014-02-19 08:47:41', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0', '{"session_id":"aec36abfe450802243619eaf74bdf873","ip_address":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko\\/20100101 Firefox\\/26.0","last_activity":1392799661,"user_data":"","filter_used":"Default","date_filter_start":"2014-01-01","date_filter_stop":"2014-02-19","filter_desc":"This Year","user_filter_used":0,"partner_attempt":0,"id":"2","username":"partner","name":"Test Partner","user_group_id":"3","user_access_level_id":"3","phone":"3123-4234","email":"testpartner@cd4.co.tz","status":"1","activation_clause":"","indicator":"User","date_created":null,"user_group":"Partner","authentication_level":"2","login_status":true,"user_filter":[{"user_filter_id":"6","user_filter_name":"CSSC"}]}');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_level`
--

CREATE TABLE IF NOT EXISTS `user_access_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_access_level`
--

INSERT INTO `user_access_level` (`id`, `description`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'User'),
(4, 'Temp');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `name`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Partner'),
(4, 'NACP'),
(5, 'Device Manufacturer'),
(6, 'Facility'),
(7, 'System'),
(8, 'District Coordinator'),
(9, 'Regional Coordinator');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE IF NOT EXISTS `user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id`, `description`) VALUES
(1, 'active'),
(2, 'pending activation'),
(3, 'locked'),
(4, 'Password Reset'),
(5, 'Removed');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facility`
--
ALTER TABLE `facility`
  ADD CONSTRAINT `district_id` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facility_pima`
--
ALTER TABLE `facility_pima`
  ADD CONSTRAINT `facility_equipment_id` FOREIGN KEY (`facility_equipment_id`) REFERENCES `facility_equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `partner_regions`
--
ALTER TABLE `partner_regions`
  ADD CONSTRAINT `partner` FOREIGN KEY (`partner_id`) REFERENCES `partner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partner_regions_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
