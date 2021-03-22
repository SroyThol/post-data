-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 07:55 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `postdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `photo` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=active,2=delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `price`, `photo`, `status`) VALUES
(1, 'rr', 0, '1615885223-828305.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_des`
--

CREATE TABLE `tbl_des` (
  `id` bigint(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `des` text NOT NULL,
  `photo` text NOT NULL,
  `od` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_des`
--

INSERT INTO `tbl_des` (`id`, `title`, `des`, `photo`, `od`, `status`, `menu_id`) VALUES
(1, 'dd', 'dd', '1', 1614451394, 1, 2),
(2, 'ddd', 'dd', '2', 1614831327, 1, 3),
(3, 'tt', 'tt', '3', 1614832314, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `od` int(11) NOT NULL,
  `photo` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `name`, `od`, `photo`, `status`) VALUES
(1, 'Koh kong', 1, '1614432591-059985.jpg', 1),
(2, 'Preah Sihanouk', 2, '1614432579-586242.jpg', 1),
(3, 'Kampot', 3, '1614432561-589326.jpg', 1),
(4, 'Phnom Pneh', 4, '1614432631-951971.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_des`
--
ALTER TABLE `tbl_des`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_des`
--
ALTER TABLE `tbl_des`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
