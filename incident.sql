-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 04:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incident`
--

-- --------------------------------------------------------

--
-- Table structure for table `incident_report`
--

CREATE TABLE `incident_report` (
  `id` int(200) NOT NULL,
  `date` varchar(100) NOT NULL,
  `Issue_Start` varchar(100) NOT NULL,
  `Issue_End` varchar(100) NOT NULL,
  `Issue_Total` varchar(100) NOT NULL,
  `Issue_Case` varchar(200) NOT NULL,
  `Resolve_Cause` varchar(200) NOT NULL,
  `Service_name` varchar(200) NOT NULL DEFAULT '-',
  `Category` varchar(20) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Remark` varchar(200) NOT NULL,
  `ผู้รับเรื่อง` varchar(20) NOT NULL,
  `system` varchar(100) NOT NULL,
  `service_group` varchar(100) NOT NULL,
  `difference` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `incident_report`
--

INSERT INTO `incident_report` (`id`, `date`, `Issue_Start`, `Issue_End`, `Issue_Total`, `Issue_Case`, `Resolve_Cause`, `Service_name`, `Category`, `State`, `Remark`, `ผู้รับเรื่อง`, `system`, `service_group`, `difference`) VALUES
(1, '2024-01-14', '14-01-2024 : 12:00', '16-01-2024 : 12:00', '48:00', 'asdasd', 'asdasdas', '-', 'Database', 'Plan', 'dasdasdas', 'จักรรินทร์', 'test', '-', ''),
(2, '2024-01-15', '15-01-2024 : 12:00', '16-01-2024 : 12:00', '24:00', 'asdas', 'dasdasda', '-', 'Database', 'Plan', 'asdasdas', 'นุจรีย์', 'test', '-', ''),
(3, '2024-01-15', '15-01-2024 : 12:00', '16-01-2024 : 12:00', '24:00', 'test', 'test', 'MOL - 12CALL CASH CARD', 'App', 'Plan', 'test', 'จักรรินทร์', 'Boonterm', 'Other', ''),
(4, '2024-01-17', '17-01-2024 : 12:00', '18-01-2024 : 12:00', '24:00', 'asdasd', 'asdasdasdasd', '-', 'Network', 'Plan', 'asdasdasd', 'นุจรีย์', 'Cenpay', '-', ''),
(6, '2024-01-17', '17-01-2024 : 12:00', '18-01-2024 : 12:00', '24:00', 'asdas', 'dasdasd', '-', 'Database', 'Plan', 'asdasdasd', 'จักรรินทร์', 'Ams/Dms', '-', ''),
(7, '2024-01-17', '17-01-2024 : 12:00', '18-01-2024 : 12:00', '24:00', 'asdasd', 'asdasdasd', '-', 'App', 'Plan', 'asdasdasdas', 'จักรรินทร์', 'Ams/Dms', '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `service_name`
--

CREATE TABLE `service_name` (
  `id` int(100) NOT NULL,
  `name_service` varchar(100) NOT NULL,
  `service_group` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_name`
--

INSERT INTO `service_name` (`id`, `name_service`, `service_group`) VALUES
(2, 'AIS', 'Mobile Top up'),
(3, 'DTAC', 'Mobile Top up'),
(4, 'TRUE MOVE', 'Mobile Top up'),
(5, 'TRUE MONEY', 'Other'),
(6, 'TRUE LIFE', 'Other'),
(7, 'HUTCH', 'Other'),
(8, '@CASH', 'Other'),
(9, 'ASURA CARD', 'Other'),
(10, 'DARK STORY CARD', 'Other'),
(12, 'LUNA CARD', 'Other'),
(13, 'ONENET', 'Other'),
(14, 'SILVER CARD', 'Other'),
(16, 'SAMART WIP', 'Other'),
(18, 'HATARI', 'Other'),
(19, 'AIS-GSM', 'Other'),
(20, 'TOT TELEPHONE', 'Other'),
(21, 'FIRST CHOICE', 'Other'),
(22, 'TESCO CREDIT CARD', 'Other'),
(23, 'TESTCO PERSONAL LOAN', 'Other'),
(24, 'AEON', 'Other'),
(25, 'CITIBANK CREDIT CARD', 'Other'),
(26, 'CAT MY', 'Mobile Top up'),
(27, 'MEA', 'Other'),
(28, 'THOOKDEE', 'Other'),
(29, 'ONEFONE', 'Other'),
(30, 'TOT Pre Paid', 'Other'),
(31, 'TRUE MONEY E-PIN', 'Other'),
(32, 'WINNER', 'Other'),
(33, 'TOLLD 5IN1', 'Other'),
(34, 'DAILY FORTUNE', 'Other'),
(35, 'HELLO LEGAL', 'Other'),
(36, 'I-MOBILE 3GX', 'Mobile Top up'),
(37, 'FORTUNE2', 'Other'),
(38, 'UT-TA-KARN', 'Other'),
(39, 'TAROT CARD', 'Other'),
(40, 'TOT WIFI', 'Other'),
(41, 'MAGIC NUMBER', 'Other'),
(42, 'FENG SHUI', 'Other'),
(44, 'DONATE1', 'Other'),
(45, 'DONATE2', 'Other'),
(46, 'DONATE3', 'Other'),
(47, 'BILL CAT', 'Other'),
(48, 'QUICKCASH', 'Other'),
(49, 'POWERBUY', 'Other'),
(50, 'KRUNGSRI GE CC', 'Other'),
(51, 'HOMEPRO', 'Other'),
(52, 'DREAM LOAN', 'Other'),
(53, 'CENTRAL CREDIT CARD', 'Other'),
(54, 'CITI READY CREDIT', 'Other'),
(55, 'ROBINSON VISA CARD', 'Other'),
(56, 'GE PERSONAL CREDIT', 'Other'),
(57, 'CITI ADVANCE', 'Other'),
(58, 'DINERS CLUB', 'Other'),
(59, 'KTC', 'Other'),
(60, 'UOB', 'Other'),
(61, 'AMANAH LEASING', 'Other'),
(62, 'NISSAN LEASING', 'Other'),
(63, 'TOYOTA LEASING', 'Other'),
(64, 'PRUDENTIAL', 'Other'),
(65, 'BANGKOK INSURANCE', 'Other'),
(66, 'RVP', 'Other'),
(67, 'THAI LIFE', 'Other'),
(68, 'MUANG THAI LIFE', 'Other'),
(69, 'ING LIFE', 'Other'),
(70, 'CIGNA INSURANCE', 'Other'),
(71, 'CHAOPHAYA INSURANCE', 'Other'),
(72, 'TOLLD 7IN1', 'Other'),
(73, '3BB-WIFI', 'Other'),
(74, 'CONDOM', 'Other'),
(75, 'LOTTERY', 'Other'),
(76, 'WATER', 'Other'),
(77, 'MOL - A CASH', 'Other'),
(78, 'MOL - COOKIE', 'Other'),
(79, 'MOL - D CARD', 'Other'),
(80, 'MOL - G CASH', 'Other'),
(81, 'MOL - GARENA SHELL', 'Other'),
(82, 'MOL - JAM CARD', 'Other'),
(83, 'MOL - SNS PLUS', 'Other'),
(84, 'MOL - WINNER', 'Other'),
(85, 'MOL POINT', 'Other'),
(86, 'COIN EXCHANGE', 'Other'),
(87, 'NAM MON', 'Other'),
(88, 'MOL - GAMEINDY', 'Other'),
(89, 'MOL - N CASH', 'Other'),
(90, 'CTH BILL', 'Other'),
(91, 'MOL - CUBI CARD', 'Other'),
(92, 'MOL - DIGI CASH', 'Other'),
(93, 'MOL - ENMO', 'Other'),
(94, 'MOL - FACEBOOK CARD', 'Other'),
(95, 'MOL - FUN CASH', 'Other'),
(96, 'MOL - G CARD', 'Other'),
(97, 'MOL - ONENET CARD', 'Other'),
(98, 'MOL - RAN CARD', 'Other'),
(99, 'MOL - VPLAY GOLD', 'Other'),
(100, 'MOL - MCOINS CARD', 'Other'),
(101, 'MOL - STEAM WALLET', 'Other'),
(102, 'MAGIC NUMBER 2', 'Other'),
(103, 'MOL - THOOKDEE', 'Other'),
(106, 'MOL - FACEBOOK GAME CARD', 'Other'),
(107, 'TRUE WIFI', 'Other'),
(108, 'MOR LUCK', 'Other'),
(109, 'LUCKY LOTTO', 'Other'),
(110, 'MOL - 12CALL CASH CARD', 'Other'),
(111, 'TRUE TMX - PEA', 'Other'),
(112, 'TRUE TMX - MEA', 'Other'),
(113, 'TRUE TMX - MWA', 'Other'),
(114, 'VENDING', 'Other'),
(115, 'MONEY TRANSFER', 'Money Transfer'),
(116, 'MOL - LINE CARD', 'Other'),
(117, 'APSARA', 'Other'),
(118, 'SAWASDEE', 'Other'),
(119, 'TOT 3G', 'Mobile Top up'),
(120, 'AIR NET', 'Other'),
(121, 'AIS PACKAGE', 'Other'),
(122, 'AIS MCASH', 'Other'),
(123, 'MOL - BOYAA', 'Other'),
(124, 'MAGIC BOX', 'Other'),
(125, 'TRUE BILL - MEA', 'Other'),
(126, 'TRUE BILL - MWA', 'Other'),
(127, 'TRUE BILL - PEA', 'Other'),
(128, 'TRUE BILL - TRUE INTERNET', 'Other'),
(129, 'TRUE BILL - TRUE VISION', 'Other'),
(130, 'TRUE BILL - TRUE POSTPAID', 'Other'),
(131, 'MOL - ZEST CARD', 'Other'),
(132, 'TUNE PAB', 'Other'),
(133, 'MYANMAR FRIEND', 'Other'),
(134, 'KHMER FRIEND', 'Other'),
(135, '3THEP', 'Other'),
(136, 'HOROMSN', 'Other'),
(137, 'FORTH STORE', 'Other'),
(138, 'CTH PSI', 'Other'),
(139, 'CTH EVERYWHERE', 'Other'),
(140, 'TRUE BILL - PWA', 'Other'),
(141, 'SCB CREDIT CARD', 'Other'),
(142, 'KBANK CREDIT CARD', 'Other'),
(143, 'TISCO', 'Other'),
(144, 'KIATNAKIN', 'Other'),
(145, 'GH BANK', 'Other'),
(146, 'AIA', 'Other'),
(147, 'MISTINE', 'Other'),
(148, 'MOL - STEAM WALLET 2', 'Other'),
(149, 'MOL - TOP ELEVEN', 'Other'),
(150, 'MOL - HOLLYWOOD MOVIE', 'Other'),
(151, 'MOL - EX CASH', 'Other'),
(152, 'ELECTRONICS SOURCE', 'Other'),
(153, 'WEIGHT SCALE', 'Other'),
(154, 'E-COMMERCE', 'Other'),
(155, 'AIMSTAR', 'Other'),
(156, 'SAWASDEE SHOP', 'Other'),
(157, 'OIL', 'Other'),
(158, 'DTAC PACKAGE', 'Other'),
(159, 'MOL - DOT ARENA', 'Other'),
(160, 'KBANK BATCH FILE', 'Money Transfer'),
(161, 'SCB BATCH FILE', 'Money Transfer'),
(162, 'BBL BATCH FILE', 'Money Transfer'),
(163, 'KTB ONLINE', 'Money Transfer'),
(164, 'MY WORLD', 'Mobile Top up'),
(165, 'WHITE SPACE', 'Mobile Top up'),
(166, 'KBANK ONLINE(KTB)', 'Money Transfer'),
(167, 'SCB ONLINE(KTB)', 'Money Transfer'),
(169, 'TMB ONLINE', 'Money Transfer'),
(171, 'UOB ONLINE', 'Money Transfer'),
(173, 'GSB ONLINE(KTB)', 'Money Transfer'),
(174, 'TN ONLINE', 'Money Transfer'),
(175, 'PACKAGE CASH VOICE', 'Other'),
(176, 'PACKAGE CASH DATA', 'Other'),
(177, 'PACKAGE CASH SMART', 'Other'),
(178, 'PACKAGE MAIN VOICE', 'Other'),
(179, 'PACKAGE MAIN DATA', 'Other'),
(180, 'PACKAGE MAIN SMART', 'Other'),
(181, 'ADD CREDIT PAYMENT', 'Other'),
(182, 'M PASS', 'Other'),
(183, 'OPER 168', 'Mobile Top up'),
(184, 'BE WALLET', 'Other'),
(185, 'A PLAY', 'Other'),
(186, 'DEEP POCKET', 'Other'),
(187, 'KUMPAI', 'Other'),
(188, 'LOCKER', 'Other'),
(189, 'KBANK ONLINE', 'Money Transfer'),
(190, 'DTAC POSTPAID', 'Other'),
(191, 'TRAFFIC FINE', 'Other'),
(192, 'TV DIRECT', 'Other'),
(193, 'DONATE4', 'Other'),
(194, 'FSMART ECOM', 'Other'),
(195, '123 SERVICE', 'Other'),
(196, 'LINE PAY', 'Other'),
(197, 'MOL - BATTLE NET', 'Other'),
(198, 'MOL - IFLIX', 'Other'),
(199, 'SCB ONLINE', 'Money Transfer'),
(200, 'BEMALL', 'Other'),
(201, 'SSO', 'Other'),
(202, 'DIRECT PEA', 'Other'),
(203, 'LINE STICKER', 'Other'),
(205, 'MOL - JOOK', 'Other'),
(206, 'MOL ? PUBGA', 'Other'),
(207, 'MOL - VIU', 'Other'),
(208, 'BAY ONLINE', 'Money Transfer'),
(209, 'PREPAID METER', 'Other'),
(210, 'TOT POSTPAID', 'Other'),
(211, 'HOME PHONE INTERNET', 'Other'),
(212, 'BEIN SPORT', 'Other'),
(213, 'SELL SIM AIS', 'Other'),
(214, 'NSF', 'Other'),
(215, 'MUSIC DOWNLOAD', 'Other'),
(216, 'BT LOAN', 'Other'),
(217, 'GSB LOAN', 'Other'),
(218, 'GSB ONLINE', 'Money Transfer'),
(219, 'COFFEE', 'Other'),
(220, 'BMTA', 'Other'),
(221, 'GMM MUSIC', 'Other'),
(222, 'BAAC LOTTO', 'Other'),
(223, 'BAAC ONLINE', 'Money Transfer'),
(224, 'SELL SIM DTAC', 'Other'),
(225, 'AIRPAY', 'Other'),
(226, 'AXA INSURANCE', 'Other'),
(227, 'GMM ARTIST GREETING', 'Other'),
(228, 'MINGALAR MUSIC', 'Other'),
(229, 'COVID-19', 'Other'),
(232, 'CHILLPAY', 'Other'),
(233, 'HORO SOCIETY', 'Other'),
(234, 'MYANMAR TOPUP', 'Mobile Top up'),
(239, 'COMPULSORY INSURANCE', 'Other'),
(240, 'TQM BILL PAYMENT', 'Other'),
(241, 'TQM FLU', 'Other'),
(243, 'TQM 3 SICK', 'Other'),
(244, 'TQM COVID', 'Other'),
(245, 'ATM TRANSFER', 'Money Transfer'),
(247, 'LOCKER MULTI', 'Other'),
(248, 'TQM PA', 'Other'),
(249, 'SABUY MONEY', 'Other'),
(250, 'ATM PROMPTPAY', 'Other'),
(251, 'ATM KBANK', 'Money Transfer'),
(256, 'EASY PASS', 'Other'),
(257, 'CIMB ONLINE', 'Money Transfer'),
(258, 'GMM STAR IDOL', 'Other'),
(260, 'ATM SCB', 'Money Transfer'),
(261, 'TOPUP RABBIT CARD', 'Other'),
(262, 'BBL ONLINE', 'Money Transfer'),
(263, 'COFFEE MULTI', 'Other'),
(264, 'RENNY LOTTERY', 'Other'),
(265, 'SHOPEE BILL', 'Other'),
(266, 'MEA ONLINE', 'Other'),
(268, 'FSMART GW - MWA', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `table_level`
--

CREATE TABLE `table_level` (
  `id` int(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_level`
--

INSERT INTO `table_level` (`id`, `level`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `table_name`
--

CREATE TABLE `table_name` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sername` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_name`
--

INSERT INTO `table_name` (`id`, `name`, `sername`, `username`, `password`, `level`) VALUES
(1, 'จักรรินทร์', '', '', '', ''),
(2, 'นักศึกษาฝีกงาน', '', '', '', ''),
(3, 'นุจรีย์', '', '', '', ''),
(4, 'พีรพงศ์', '', '', '', ''),
(5, 'วิจิตร', '', '', '', ''),
(6, 'วิชิต', '', '', '', ''),
(7, 'วีรยุทธ', '', '', '', ''),
(8, 'วุฒิไกร', '1', '1', '', ''),
(9, 'สุทัศน์', '', '', '', ''),
(10, 'อนุชา', '', '', '', ''),
(15, 'พุฒทชาติ', '', '', '', ''),
(17, 'Admin', 'IT', 'admin', 'admin', 'Admin'),
(18, 'User', 'IT', 'user', 'user', 'User'),
(29, 'เซฟ', 'หน้าหี', 'test01', '1111', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `table_state`
--

CREATE TABLE `table_state` (
  `id` int(100) NOT NULL,
  `state_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_state`
--

INSERT INTO `table_state` (`id`, `state_name`) VALUES
(1, 'Plan'),
(2, 'UnPlan');

-- --------------------------------------------------------

--
-- Table structure for table `table_system`
--

CREATE TABLE `table_system` (
  `id` int(100) NOT NULL,
  `system_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_system`
--

INSERT INTO `table_system` (`id`, `system_name`) VALUES
(1, 'Ams/Dms'),
(2, 'Bewallet'),
(3, 'Boonterm'),
(4, 'Cenpay'),
(5, 'Loan');

-- --------------------------------------------------------

--
-- Table structure for table `type_case`
--

CREATE TABLE `type_case` (
  `id` int(100) NOT NULL,
  `type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type_case`
--

INSERT INTO `type_case` (`id`, `type_name`) VALUES
(1, 'App'),
(2, 'Database'),
(3, 'Electric'),
(4, 'Network'),
(5, 'Server'),
(6, 'Firewall');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incident_report`
--
ALTER TABLE `incident_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_name`
--
ALTER TABLE `service_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_level`
--
ALTER TABLE `table_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_name`
--
ALTER TABLE `table_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_state`
--
ALTER TABLE `table_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_system`
--
ALTER TABLE `table_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_case`
--
ALTER TABLE `type_case`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incident_report`
--
ALTER TABLE `incident_report`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_name`
--
ALTER TABLE `service_name`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `table_level`
--
ALTER TABLE `table_level`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table_name`
--
ALTER TABLE `table_name`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `table_state`
--
ALTER TABLE `table_state`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `table_system`
--
ALTER TABLE `table_system`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `type_case`
--
ALTER TABLE `type_case`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
