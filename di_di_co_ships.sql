-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2020 at 04:16 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `di_di_co_ships`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` longtext NOT NULL,
  `dateAdded` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `dateAdded`, `dateModified`, `status`) VALUES
(23, 'test', 'test des', '2020-01-14 20:18:03', '2020-01-14 20:18:03', 1),
(24, 'test5', 'test', '2020-01-14 20:18:26', '2020-01-14 20:18:26', 1),
(25, 'test 6', 'test', '2020-01-14 20:19:45', '2020-01-14 20:19:45', 1),
(26, 'test 7', 'test description', '2020-01-14 20:21:23', '2020-01-14 20:21:23', 1),
(27, 'test8', 'test description', '2020-01-14 20:21:50', '2020-01-14 20:21:50', 1),
(28, 'test 9', 'test', '2020-01-14 20:27:27', '2020-01-14 20:27:27', 1),
(30, 'dish', 'test', '2020-01-15 04:07:30', '2020-01-15 04:07:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `weight` float NOT NULL,
  `weightUnit` varchar(30) NOT NULL,
  `width` float NOT NULL,
  `widthUnit` varchar(30) NOT NULL,
  `height` float NOT NULL,
  `heightUnit` varchar(30) NOT NULL,
  `length` float NOT NULL,
  `lengthUnit` varchar(30) NOT NULL,
  `dateAdded` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `weight`, `weightUnit`, `width`, `widthUnit`, `height`, `heightUnit`, `length`, `lengthUnit`, `dateAdded`, `dateModified`, `status`) VALUES
(23, 23, 2, 'cm', 4, 'cm', 5, 'm', 3, 'kg', '2020-01-14 20:18:03', '2020-01-14 20:18:03', 1),
(24, 24, 2, 'gram', 4, 'cm', 5, 'cm', 3, 'cm', '2020-01-14 20:18:26', '2020-01-14 20:18:26', 1),
(25, 25, 2, 'gram', 5, 'cm', 6, 'gram', 3, 'cm', '2020-01-14 20:19:45', '2020-01-14 20:19:45', 1),
(26, 26, 8, 'kg', 10, 'gram', 11, 'm', 9, 'cm', '2020-01-14 20:21:23', '2020-01-14 20:21:23', 1),
(27, 27, 5, 'gram', 7, 'cm', 8, 'm', 6, 'cm', '2020-01-14 20:21:50', '2020-01-14 20:21:50', 1),
(28, 28, 2, 'kg', 1, 'm', 3, 'cm', 3, 'cm', '2020-01-14 20:27:27', '2020-01-14 20:27:27', 1),
(30, 30, 10, 'gram', 4, 'cm', 5, 'm', 3, 'cm', '2020-01-15 04:07:30', '2020-01-15 04:07:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dateAdded` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `slug`, `name`, `dateAdded`, `dateModified`, `status`) VALUES
(1, 'cm', 'centimeter', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'kg', 'kilogram', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'm', 'meter', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'gram', 'gram', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
