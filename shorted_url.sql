-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2018 at 11:51 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urlshortner`
--

-- --------------------------------------------------------

--
-- Table structure for table `shorted_url`
--

CREATE TABLE `shorted_url` (
  `url_id` int(11) NOT NULL,
  `long_url` varchar(225) NOT NULL,
  `short_url` varchar(225) NOT NULL,
  `long_url_hit_count` varchar(225) NOT NULL DEFAULT '0',
  `short_url_hit_count` varchar(225) NOT NULL DEFAULT '0',
  `crt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shorted_url`
--

INSERT INTO `shorted_url` (`url_id`, `long_url`, `short_url`, `long_url_hit_count`, `short_url_hit_count`, `crt_date`) VALUES
(1, 'https://gist.github.com/', 'https://goo.gl/pYs6m', '21', '2', '2018-01-12 06:01:59'),
(2, 'https://www.shiksha.com/', 'https://goo.gl/iG989o', '1', '2', '2018-01-15 10:31:42'),
(3, 'http://testserver.logisticsjunction.com/', 'http://url.cn/rnfrr1', '4', '7', '2018-01-17 01:12:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shorted_url`
--
ALTER TABLE `shorted_url`
  ADD PRIMARY KEY (`url_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shorted_url`
--
ALTER TABLE `shorted_url`
  MODIFY `url_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
