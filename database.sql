-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2019 at 05:13 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u429721638_nfq`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `lastname` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `name`, `lastname`, `password`) VALUES
(1, 'tortonas', 'Valentinas', 'Kasteckis', 'testavimas'),
(2, 'antanas', 'Antanas', 'Kerbedis', 'gdasgdafd'),
(3, 'oleg', 'Oleg', 'Surajev', 'hshdfgd'),
(4, 'kgell0', 'Kandy', 'Gell', '4R1isusZ'),
(5, 'athirwell1', 'Abigael', 'Thirwell', 'Z4Ppodo'),
(6, 'dodo2', 'Dayna', 'Odo', 'wMsIJ1Pwx'),
(7, 'ebetje3', 'Eartha', 'Betje', 'YuAP0a02FJ'),
(8, 'tmcjury4', 'Tamarah', 'McJury', 'PremdPZmmAS'),
(9, 'loaker5', 'Lily', 'Oaker', 'AMxaQPj3Negt'),
(10, 'bcoughlin6', 'Bendite', 'Coughlin', 'Vy2PIWi'),
(11, 'hammer7', 'Ham', 'Ammer', '7JXv1xxSGN8'),
(12, 'dkopfer8', 'Doro', 'Kopfer', 'B1ndv9'),
(13, 'bjendas9', 'Baryram', 'Jendas', 'LK1v0c'),
(14, 'fyukhnina', 'Finn', 'Yukhnin', 'LR6LX5'),
(15, 'rpartnerb', 'Reagan', 'Partner', 'Eglfk9F7toH'),
(16, 'hdyterc', 'Hinze', 'Dyter', 'NDnquT'),
(17, 'jshaeferd', 'Jase', 'Shaefer', '1cKzkr9G'),
(18, 'cciceroe', 'Chancey', 'Cicero', 'Csx1geT1til'),
(19, 'ggainsfordf', 'Garvey', 'Gainsford', 'ABot9M1XEimB'),
(20, 'acastanaresg', 'Angeline', 'Castanares', 'DIhJLZo'),
(21, 'pjosephh', 'Pandora', 'Joseph', 'wuOWlL'),
(22, 'cbooleri', 'Corette', 'Booler', 'Dfpa94'),
(23, 'jkonkej', 'Jamison', 'Konke', 'apuxyHJrNK'),
(24, 'djoustk', 'Donaugh', 'Joust', 'htmwOtTQtW4D'),
(25, 'mwhitlandl', 'Marcela', 'Whitland', 'M63HcLdA'),
(26, 'gpostonm', 'Glenine', 'Poston', 'gMxra25'),
(27, 'shelinn', 'Si', 'Helin', 'OJXpCYgZp'),
(28, 'schiddyo', 'Sydel', 'Chiddy', 'DyT47Zl1s'),
(29, 'bhowsegop', 'Bernadette', 'Howsego', 'JciaX0Ke'),
(30, 'cwhyattq', 'Christyna', 'Whyatt', '6S9V6QQ'),
(31, 'grapellir', 'Gunar', 'Rapelli', '6L4jQNSYI'),
(32, 'hcardenosas', 'Hildy', 'Cardenosa', '97Ulcd53MCS'),
(33, 'tpetriellot', 'Tomasina', 'Petriello', 'Ry1G92'),
(34, 'wmacveyu', 'Whittaker', 'Macvey', 'ROyducDFB'),
(35, 'molleyv', 'Marion', 'Olley', 'dXcu38'),
(36, 'dwashingtonw', 'Drake', 'Washington', 'id0jS56'),
(37, 'amarkx', 'Alisun', 'Mark', 'Vr23ijwL6KuU'),
(38, 'lbaldungy', 'Lyle', 'Baldung', '3dg8hPqZ'),
(39, 'mhamlynz', 'Meryl', 'Hamlyn', 't9QfeyJi'),
(40, 'tgillon10', 'Trueman', 'Gillon', '3Fjhsws'),
(41, 'dtwidle11', 'Daisie', 'Twidle', 'sO8bn5PQa'),
(42, 'aprall12', 'Agace', 'Prall', 'E6Xllh5'),
(43, 'zfallen13', 'Zara', 'Fallen', 'Qdd0PmgcB'),
(44, 'jculley14', 'Jesselyn', 'Culley', 'E6hkkG7lbN8Z'),
(45, 'fedgeon15', 'Flinn', 'Edgeon', 'sfiFBJ'),
(46, 'bfrensche16', 'Benita', 'Frensche', 'S6GVxcJq'),
(47, 'bsmithend17', 'Beret', 'Smithend', 'XSWeDC4'),
(48, 'cchisolm18', 'Carin', 'Chisolm', 'Gz0DTh'),
(49, 'ftapping19', 'Faber', 'Tapping', 'AdtsSCPbsJB'),
(50, 'hjellings1a', 'Henderson', 'Jellings', '4NqhuUQpn'),
(51, 'afeatherstonehaugh1b', 'Arlie', 'Featherstonehaugh', 'uey1AZ'),
(52, 'dsebrook1c', 'Dorris', 'Sebrook', 'sbOrWOXW'),
(53, 'evizor1d', 'Elsinore', 'Vizor', 'wVfyR2C'),
(54, 'lthaller1e', 'Lyell', 'Thaller', 'HXzy2lh6Y'),
(55, 'aworswick1f', 'Arnold', 'Worswick', 'X8t8Qs'),
(56, 'mmaylour1g', 'Maude', 'Maylour', 'IITnAwAOqrP'),
(57, 'rguinnane1h', 'Ralph', 'Guinnane', 'CATkfv6EKp'),
(58, 'pmclewd1i', 'Port', 'McLewd', 'Cwclg4'),
(59, 'etift1j', 'Erma', 'Tift', 'g4TIQ672mCOl'),
(60, 'cbuttrum1k', 'Coreen', 'Buttrum', 'qo1TXD'),
(61, 'aolifard1l', 'Ashia', 'Olifard', 'ND8cNZ7lnD8m'),
(62, 'kgarred1m', 'Katie', 'Garred', 'OERD0b'),
(63, 'nterron1n', 'Nathaniel', 'Terron', 'iWPfvkcv'),
(64, 'cioselevich1o', 'Cornelius', 'Ioselevich', '7j3NtRSemn'),
(65, 'dmatuszinski1p', 'Dani', 'Matuszinski', 'qHqhSRevvWj'),
(66, 'ikloisner1q', 'Ignacius', 'Kloisner', '1RCw0lPGzT'),
(67, 'jconnett1r', 'Jeffry', 'Connett', 'rMpN0ZUj'),
(68, 'gphlippi1s', 'Georgette', 'Phlippi', '5QPziFm'),
(69, 'cbowen1t', 'Cedric', 'Bowen', 'aSXc9g'),
(70, 'sranson1u', 'Stefania', 'Ranson', '66flQfjeIK5F'),
(71, 'dcampana1v', 'Desiree', 'Campana', 'TJWIx2F4p'),
(72, 'llesarr1w', 'Lawry', 'Le Sarr', 'GdoDVmd'),
(73, 'dkalker1x', 'Domini', 'Kalker', 'MDbhQIJ'),
(74, 'gblacklidge1y', 'Geoffry', 'Blacklidge', 'qawSvwE7iEr4'),
(75, 'ldewsnap1z', 'Lenora', 'Dewsnap', 'wRJnJSrj2myc'),
(76, 'dprowse20', 'Dory', 'Prowse', 'bT6wOXcv'),
(77, 'crosell21', 'Clareta', 'Rosell', 'VoQHsDI8d'),
(78, 'eetches22', 'Emelina', 'Etches', 'YzU56gER'),
(79, 'gsnary23', 'Gilbertina', 'Snary', '3xrQAQn'),
(80, 'sgrist24', 'Staci', 'Grist', 'XCBQ2nZfRu'),
(81, 'gpetkov25', 'Gale', 'Petkov', 'aP4Lb5JBfs'),
(82, 'dbinding26', 'Dionysus', 'Binding', 'GSpFWtotyXS'),
(83, 'atodman27', 'Al', 'Todman', 'tNyBLXdxrBk'),
(84, 'volennane28', 'Vilma', 'O\'Lennane', 'FK7ls0'),
(85, 'adockery29', 'Alverta', 'Dockery', 'xjuqxlkD'),
(86, 'bvairow2a', 'Betta', 'Vairow', 'keblGMCq'),
(87, 'wbogays2b', 'Waylon', 'Bogays', 'Yf7h0V'),
(88, 'balexandre2c', 'Brittney', 'Alexandre', 'CtbDUBh86Gg'),
(89, 'mmattiassi2d', 'Minna', 'Mattiassi', 'GaI2YIRjgUB'),
(90, 'istrothers2e', 'Idaline', 'Strothers', 'aorhpNX1icoR'),
(91, 'rcornuau2f', 'Riobard', 'Cornuau', 'NIS79lOq'),
(92, 'omackison2g', 'Octavius', 'Mackison', 'MF0WKskcVu'),
(93, 'ddjurisic2h', 'Dorice', 'Djurisic', '8wJi5jhN'),
(94, 'aelton2i', 'Aveline', 'Elton', 'eQAvsMp9uOPF'),
(95, 'apaschke2j', 'Adrea', 'Paschke', 'ijo5p465'),
(96, 'gmawer2k', 'Gavra', 'Mawer', 'l9MK70'),
(97, 'jgush2l', 'Joelynn', 'Gush', 'zeo30632n'),
(98, 'hsherlaw2m', 'Hyman', 'Sherlaw', 'gcDpzLVGs'),
(99, 'crobet2n', 'Chev', 'Robet', 'n3J3xeUmD4uJ'),
(100, 'tdancer2o', 'Tandie', 'Dancer', '19q9P8VB8Fq'),
(101, 'arentoll2p', 'Anallese', 'Rentoll', 'HQdpIfG2'),
(102, 'hraffon2q', 'Haskel', 'Raffon', 'FuJK8nO2'),
(103, 'ivaggs2r', 'Ingemar', 'Vaggs', 'LhhwLI'),
(104, 'dgsfd5s74', 'Abdul', 'Habibi', 'JoDwD11'),
(105, 'tortonas1', 'Laurynas', 'Burovas', 'test'),
(106, 'jeron420', 'Jerony', 'Smith', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `specialists`
--

CREATE TABLE `specialists` (
  `id` int(11) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `lastname` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialists`
--

INSERT INTO `specialists` (`id`, `username`, `name`, `lastname`, `password`) VALUES
(1, 'admin', 'Best', 'Administrator', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `estimatedTime` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `serviced` int(11) NOT NULL,
  `visitStarted` datetime DEFAULT NULL,
  `visitEnded` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `estimatedTime`, `client_id`, `serviced`, `visitStarted`, `visitEnded`) VALUES
(11, '10', 2, 1, '2019-09-21 15:14:12', '2019-09-21 15:18:18'),
(12, '20', 3, 1, '2019-09-21 15:24:12', '2019-09-21 15:28:18'),
(13, '20', 14, 1, '2019-09-21 15:34:12', '2019-09-21 15:38:18'),
(14, '10', 1, 1, '2019-09-21 15:44:12', '2019-09-21 16:00:00'),
(15, '20', 2, 1, '2019-09-22 16:00:00', '2019-09-22 16:15:00'),
(16, '2', 4, 1, '2019-09-22 09:00:00', '2019-09-22 09:15:00'),
(17, '2', 6, 1, '2019-09-22 09:00:00', '2019-09-22 09:15:00'),
(18, '5', 8, 1, '2019-09-22 09:00:00', '2019-09-22 09:15:00'),
(20, '4', 9, 1, '2019-09-22 11:00:00', '2019-09-22 11:15:00'),
(21, '5', 10, 1, '2019-09-22 11:00:00', '2019-09-22 11:15:00'),
(23, '4', 11, 1, '2019-09-22 12:00:00', '2019-09-22 12:15:00'),
(24, '5', 12, 1, '2019-09-22 12:00:00', '2019-09-22 12:15:00'),
(26, '2', 104, 1, '2019-09-22 13:00:00', '2019-09-22 13:15:00'),
(29, '5', 1, 1, '2019-09-22 16:00:00', '2019-09-22 16:15:00'),
(31, '4', 2, 0, NULL, NULL),
(32, '3', 1, 0, NULL, NULL),
(33, '6', 3, 0, NULL, NULL),
(34, '1', 4, 0, NULL, NULL),
(35, '3', 5, 0, NULL, NULL),
(36, '8', 6, 0, NULL, NULL),
(37, '1', 7, 0, NULL, NULL),
(38, '2', 8, 0, NULL, NULL),
(39, '2', 9, 0, NULL, NULL),
(40, '6', 10, 0, NULL, NULL),
(42, '60', 106, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialists`
--
ALTER TABLE `specialists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visits_fk0` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `specialists`
--
ALTER TABLE `specialists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_fk0` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
