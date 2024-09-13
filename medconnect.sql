-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 28, 2024 at 01:23 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u252291822_medcon`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(256) DEFAULT NULL,
  `datepicker` varchar(256) DEFAULT NULL,
  `time` varchar(256) DEFAULT NULL,
  `department` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `datepicker`, `time`, `department`) VALUES
(92, 'Test', '12345', '', '', '', NULL),
(93, 'laurel.elliot1@gmail.com', '12345', '', '', '', NULL),
(94, 'Admin', '12345', '', '', '', NULL),
(95, 'admin', '61616', '', '', '', NULL),
(96, 'Test1', '112233', '', '', '', NULL),
(97, 'Mndfckk', '5656667', '', '', '', NULL),
(98, 'phil.daviex@gmail.com', '123456789', '', '', '', NULL),
(99, 'pinar.kavaz@neu.edu.tr', 'QTYC5497', '', '', '', NULL),
(100, 'pinar.kavaz@neu.edu.tr', 'QTYC5497', '', '', '', NULL),
(101, 'Laurel Elliot', 'laurel.elliot1@gmail.com', '+44 7520 632242', 'Wed Apr 10 2024', '09:30am', 'oncology'),
(102, 'Laurel Diaz', 'laurel.diaz565@gmail.com', '+44 7520 632242', 'Wed Apr 17 2024', '02:00pm', 'gynecology'),
(103, 'Jesse Eti', 'etijesse@gmail.com', '+44 7520 632242', 'Tue Apr 16 2024', '12:30pm', 'cardiology'),
(104, 'Chinecherem ', '20204016@std.neu.edu.tr', '+90 533 875 64 72', 'Fri Apr 19 2024', '09:30am', 'oncology'),
(105, 'Jesse Eti', '20206004@std.neu.edu.tr', '+44 7520 632242', 'Thu Apr 11 2024', '03:00pm', 'gynecology'),
(106, 'Laurel Elliot', 'laurel.elliot1@gmail.com', '+44 7520 632242', 'Thu Apr 11 2024', '12:30pm', 'neurology'),
(107, 'Ericka Phillips ', 'ericka.philips9@gmail.com', '+254748027365', 'Mon May 06 2024', '09:30am', 'Cardiology'),
(108, 'Ganna Pola', 'ganna.pola@neu.edu.tr', '05338732384', 'Thu Jun 27 2024', '02:00pm', 'Neurology');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
