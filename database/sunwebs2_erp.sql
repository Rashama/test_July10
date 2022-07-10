-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2022 at 12:51 PM
-- Server version: 5.7.23-23
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunwebs2_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `response_steps`
--

CREATE TABLE `response_steps` (
  `id` int(11) NOT NULL,
  `survey_responseid` int(11) NOT NULL,
  `steps` int(11) NOT NULL,
  `idea1` text COLLATE utf8_unicode_ci NOT NULL,
  `idea2` text COLLATE utf8_unicode_ci NOT NULL,
  `idea3` text COLLATE utf8_unicode_ci NOT NULL,
  `idea4` text COLLATE utf8_unicode_ci,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_respones`
--

CREATE TABLE `survey_respones` (
  `id` int(11) NOT NULL,
  `response_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `response_steps`
--
ALTER TABLE `response_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_responseid` (`survey_responseid`);

--
-- Indexes for table `survey_respones`
--
ALTER TABLE `survey_respones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `response_steps`
--
ALTER TABLE `response_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_respones`
--
ALTER TABLE `survey_respones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `response_steps`
--
ALTER TABLE `response_steps`
  ADD CONSTRAINT `response_steps_ibfk_1` FOREIGN KEY (`survey_responseid`) REFERENCES `survey_respones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
