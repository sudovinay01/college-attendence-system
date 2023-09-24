-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2019 at 09:22 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinaykumar`
--
CREATE DATABASE IF NOT EXISTS `vinaykumar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `vinaykumar`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `name`) VALUES
('admin', '$2y$10$aUFYN2WjUInvGIY8Mk8Adu0xDSNZ3EILaWOuKzXS9V/JXiqxtGF36', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attend`
--

CREATE TABLE `attend` (
  `no` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `period` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `sub` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `no` int(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'on',
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`no`, `id`, `status`, `name`, `username`, `password`, `branch`) VALUES
(1, '16RJ1A05C8', 'on', 'maheshwaram Vinay Kumar', 'vinaykumar', '$2y$10$7prT0ai1pfhAajQI6vtzHutIK5pzTeR..uDU3hUUCs7ogK03simty', 'cse'),
(2, '16RJ1A05J0', 'on', 'yeshwanth', 'yeshwanth', '$2y$10$tC/XXwvhpzjzUfMdFYFVPOEnE4r2vOmtZxd3G7ct4dymOyxYSPdqC', 'has'),
(3, '16RJ1A05F0', 'on', 'anji', 'anji', '$2y$10$.Zh.N0cGKwaWzFtoaLzFOexN/OkFK4w8DD.1iSGeDd0qBgZFA0VRS', 'ece'),
(4, '16RJ1A05H1', 'on', 'tejesh', 'tejesh', '$2y$10$ZNaWjqwUavgVvr3cdCn0yeAya7GHrGtHmSTeWLiqluUpfFCAJp3GK', 'civil'),
(5, '16RJ1A05H7', 'on', 'p Vinay', 'vinay', '$2y$10$M8Z5IW0uM/ud/6/M816roO0zilOkt2amS2jo5G7jHNumz1aGy0iFu', 'has'),
(6, '16RJ1A05G7', 'on', 'abhishek', 'abhishek', '$2y$10$RWQKIA3J3qrHtpJZX/Zd/eGZhyPT7t2nq0cCVsBZavTJqVEONNAMK', 'cse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `attend`
--
ALTER TABLE `attend`
  ADD UNIQUE KEY `id` (`no`,`name`,`class`,`period`,`time`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
