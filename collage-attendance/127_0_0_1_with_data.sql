-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2019 at 07:38 PM
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
-- Table structure for table `--`
--

CREATE TABLE `--` (
  `no` int(11) NOT NULL,
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Dumping data for table `attend`
--

INSERT INTO `attend` (`no`, `name`, `class`, `period`, `time`, `sub`) VALUES
('1', 'maheshwaram Vinay Kumar', 'cse-1-a', '2019-10-14-1', '04:48:11pm', '1'),
('1', 'maheshwaram Vinay Kumar', 'cse-1-a', '2019-10-14-2', '07:13:07pm', '2'),
('1', 'maheshwaram Vinay Kumar', 'cse-1-a', '2019-10-14-3', '07:13:41pm', '3');

-- --------------------------------------------------------

--
-- Table structure for table `cse-1-a`
--

CREATE TABLE `cse-1-a` (
  `no` int(11) NOT NULL,
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'on',
  `2019-10-14-1` int(11) NOT NULL DEFAULT '1',
  `2019-10-14-2` int(11) NOT NULL DEFAULT '1',
  `2019-10-14-3` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cse-1-a`
--

INSERT INTO `cse-1-a` (`no`, `id`, `name`, `username`, `password`, `status`, `2019-10-14-1`, `2019-10-14-2`, `2019-10-14-3`) VALUES
(1, '13RJ1A0501', '  A MOUNIKA DEVI', '13RJ1A0501', '$2y$10$Iq2YrigrpMFB36fXIx8TvO5H7Sa/LSY03zxCZCec0m5/Ho4L7wBKK', 'on', 0, 0, 1),
(2, '13RJ1A0502', ' ABDUL RAHEEM KHAN', '13RJ1A0502', '$2y$10$2VbTsoMhSolng2zuxGxpruOQ/VihRhV/oShi27msMhs4r0TLoQ.MK', 'on', 1, 0, 1),
(3, '13RJ1A0503', 'ADAVELLI SAIKIRAN', '13RJ1A0503', '$2y$10$ZaWqbMwmMdZUe9MExC//We3klemnstQMff3ZiCDYQwpDs0wmVQEpu', 'on', 1, 1, 1),
(4, '13RJ1A0504', 'AKKINAPALLY  ARAVIND SAI', '13RJ1A0504', '$2y$10$VshnhUlbJrx5zlDLIdfmfuTPbxTQNJfkyRv/7cYvA7lGhCrfC6jLi', 'on', 1, 1, 1),
(5, '13RJ1A0505', 'ALAVALA SIVALINGA REDDY', '13RJ1A0505', '$2y$10$/7O46xF3H710ySntx7i.3.rmBEUjKSiKwoIjxXC5xXSd1DO0v6Qn2', 'on', 1, 1, 1),
(6, '13RJ1A0506', 'ALLA VAMSI', '13RJ1A0506', '$2y$10$yWSNiLUBsdkVD5Gi4DU2aOfFCSv.84YX.yM8r6T3tGezVPYQypJC6', 'on', 1, 1, 1),
(7, '13RJ1A0507', 'ANUGU SANDHYA', '13RJ1A0507', '$2y$10$WtCTiqTX6M/m47cVbsB0kef3esPgIWS9j22xP77qfTXY4gF8x4j8G', 'on', 1, 1, 1),
(8, '13RJ1A0508', 'B SRIKAR REDDY', '13RJ1A0508', '$2y$10$JX792b/7LBlTBumW5VGLI.eYd93S3kMRPsAOzs2S4j4jOrN/hLA8K', 'on', 1, 1, 1),
(9, '13RJ1A0509', 'B SURESH', '13RJ1A0509', '$2y$10$xt2OmLwgxkYzxgahDN9O/.axdeSVMWEWN5h60MlmoGy17PemT72pK', 'on', 1, 1, 1),
(10, '13RJ1A0510', 'BADDAM SARALA', '13RJ1A0510', '$2y$10$n4EB61erXav6VEsmynZVIuCxyZWL8Ir5Eqe0O/HhZnnu2Z79WyzIi', 'on', 1, 1, 1),
(11, '13RJ1A0511', 'BASIREDDY BHASKAR REDDY', '13RJ1A0511', '$2y$10$1AGySg.dpecXQoY.883F4O5GGbd20hKAVjSpplqrUHrjFceEtApa6', 'on', 1, 1, 1),
(12, '13RJ1A0512', ' BOPPA RAMAKRISHNA', '13RJ1A0512', '$2y$10$61.aX4AO8LycRrOcStXm1u19oW5jKz3f4fmkASBbYv1t/hUbSYXv.', 'on', 1, 1, 1),
(13, '13RJ1A0513', 'BORE MOUNIKA', '13RJ1A0513', '$2y$10$mkjrLcFbqWNbDUA0YcjgE.MyF1/oI4B/XK1rZywuyJr9KgtX36E9y', 'on', 1, 1, 1),
(14, '13RJ1A0514', 'D BALA MAHESHWAR', '13RJ1A0514', '$2y$10$ZLag0pOx0OueL7wWaVdZb.lfF4TYFGuiOXu4ki3rwmML9xWkus4Eq', 'on', 1, 1, 1),
(15, '13RJ1A0515', 'D MANOJ', '13RJ1A0515', '$2y$10$dk9V3mA/0SuXiBhCgxeEY.RWHkL18njTmZbzZEW/fNdqCCeWryC.O', 'on', 1, 1, 1),
(16, '13RJ1A0516', ' DHOMA LAXMI BHAVANI', '13RJ1A0516', '$2y$10$jKkYeWn5puHL4VslKX0Iv.xzsR2iFoRZpjj71aFTscgIlt42nmmDu', 'on', 1, 1, 1),
(17, '13RJ1A0517', 'DUDDELA SHIVASHANKAR', '13RJ1A0517', '$2y$10$6deGgJ5C3YBIkoyYD3HBEeX.jpXdAJaU1YGjUmgwUejhT5yjBU4cS', 'on', 1, 1, 1),
(18, '13RJ1A0518', 'GADDAM SREEJA', '13RJ1A0518', '$2y$10$HAKFq/dBfF22vK2tFeS3feghxwHqNry6kWjVdkwuF6Z9z9dIIq1m6', 'on', 1, 1, 1),
(19, '13RJ1A0519', 'GADDAMEEDI MANEESHWAR', '13RJ1A0519', '$2y$10$R3m58IM3SmS6I8YXQtYz7ukJ1oA3uE/38Luc2Evc9exroWgbSzYTW', 'on', 1, 1, 1),
(20, '13RJ1A0520', 'GANDHASIRI VIJAYA LAXMI', '13RJ1A0520', '$2y$10$ECNtBEh872TMO.J2.fLmXO/fCKtziEbL.n5BYFmIwbu.Q8yF17lsu', 'on', 1, 1, 1),
(21, '13RJ1A0521', 'GANTA MANJUSHA', '13RJ1A0521', '$2y$10$XObo37nzGVX0qeiKzcIe9e4vECE3k19olojWZEqz0p8y6vG8rCjue', 'on', 1, 1, 1),
(22, '13RJ1A0522', 'GELLU SRAVANI', '13RJ1A0522', '$2y$10$Ls9oLJSalQQ3ZwrKkaCNtObFunxwSQn6PIJ5QwQ4lVvTYQgPbRG/6', 'on', 1, 1, 1),
(23, '13RJ1A0523', 'GONUGUNTLA HARISH', '13RJ1A0523', '$2y$10$Gkx13fI9F4zdqBOsCa08eeuZHz/bpRmMO/eOyscozG8/lw1ut4fK.', 'on', 1, 1, 1),
(24, '13RJ1A0524', 'GUMMADI AKHIL GOUD', '13RJ1A0524', '$2y$10$6/J8O1QJK58WPPjqFGExgubBoAlghiSQpcxcBLwIHm03K6Tuln0SK', 'on', 1, 1, 1),
(25, '13RJ1A0525', 'GUMMADI SRAVYA REDDY', '13RJ1A0525', '$2y$10$3PTsIBUYJsUpvN80H2Jsmuf0TEbd6ofMMFeF9c3evIkNdN6z9CO/u', 'on', 1, 1, 1),
(26, '13RJ1A0526', 'J ACHYUTH', '13RJ1A0526', '$2y$10$aJwe2QJJ2Fksg2yETp1j1u2Kdowy.CQLoacqfj355TtZi3yGWgr1e', 'on', 1, 1, 1),
(27, '13RJ1A0527', 'JAIDI RAJESHWARI', '13RJ1A0527', '$2y$10$2IZr9c147NTtVOT4AU8WiOhIpDpODVHTuZWHd9BRiXp1/C2QjTJ0m', 'on', 1, 1, 1),
(28, '13RJ1A0528', 'KAMBHAM SREEVIDYA', '13RJ1A0528', '$2y$10$bp4nWjsyCBZfcw1mwfNZl.0MHqgjP7EOu9vi1b2nqZvM8X1h8e8Xq', 'on', 1, 1, 1),
(29, '13RJ1A0529', 'KAMMALA SRILATHA', '13RJ1A0529', '$2y$10$CyLyuHX8ek2GfIKIXTAkduFxu2FnX8USDED6j2TZ30Honh3Rz5wti', 'on', 1, 1, 1),
(30, '13RJ1A0530', 'KANDHI SUPRIYA', '13RJ1A0530', '$2y$10$cRUbOC8ZK/P3roEpvW9h3.hKq51j8IScuA6mkpq0RjeLdJ7OKwq.W', 'on', 1, 1, 1),
(31, '13RJ1A0531', 'KANDULA ANIL KUMAR', '13RJ1A0531', '$2y$10$PlzByfaqsRP9waH8/jrhS.GuZM06QfrsDrToGIBeYtzUKjAGU2mfe', 'on', 1, 1, 1),
(32, '13RJ1A0532', 'KARRI LAKSHMI SATYA VANI', '13RJ1A0532', '$2y$10$9iSalFblI1zfbdXm7EwqfeHldnPGBM8cjMvsOE3c/Khl/Ja6uMgVO', 'on', 1, 1, 1),
(33, '13RJ1A0533', 'KARRI SAI PREMANTH', '13RJ1A0533', '$2y$10$/2U4etiQubbeI.L2pKzp8.CRGSYOr7ywGeGREc9WqbnBTBHZSYYWi', 'on', 1, 1, 1),
(34, '13RJ1A0534', 'KASTHURI SOUMYA', '13RJ1A0534', '$2y$10$ZhEAoNzFbgc8.Dy40IfLOOyF.ogvuar0Uz.PePdHgOadCLYaQ2Tk2', 'on', 1, 1, 1),
(35, '13RJ1A0535', 'KASULA SAI REKHA', '13RJ1A0535', '$2y$10$0SfOwCoUZRx.dVZK5Y9YZuUO.fRbn51ldpouVg/57RpMjT..tIn8i', 'on', 1, 1, 1),
(36, '13RJ1A0536', 'KATIKA MANISHA', '13RJ1A0536', '$2y$10$ddgeWxBzkh0R.D6ckGHuMugxTIiC.71tZd5WEBQu4cohc586w9QmW', 'on', 1, 1, 1),
(37, '13RJ1A0537', 'KODUMURI SANDEEP', '13RJ1A0537', '$2y$10$HGurQ.vT/4xu6xp5qIUquuLPMcUloLSn.6elrQcNqWEllqS/IJtJ6', 'on', 1, 1, 1),
(38, '13RJ1A0538', 'KOLKOORI NARASIMULU', '13RJ1A0538', '$2y$10$JfIXI0i4myy7NgENFyHNNOKm3EqEHlEDpB.ibQxbAuyu6NvoEaKx2', 'on', 1, 1, 1),
(39, '13RJ1A0539', 'KOMURAVELLI VENKAT NAGESH', '13RJ1A0539', '$2y$10$f21j2.Ak55orZg1ifVkk3eZjxkNSIeixtsY/wlLyok/1K2S2P9n3y', 'on', 1, 1, 1),
(40, '13RJ1A0540', 'KORLAGUNTA AKHIL', '13RJ1A0540', '$2y$10$f0NKkaeUbX2K.UbgoZbNWeVMDJ142/UNuTytRJzevGUMnVaTELQCa', 'on', 1, 1, 1),
(41, '13RJ1A0541', 'KOTE ROHAN', '13RJ1A0541', '$2y$10$UMuoggmchD5XOpEjAGuLMOX1SQvQQrxvf6W1pWAnMaggZM/WSHmJu', 'on', 1, 1, 1),
(42, '13RJ1A0542', 'KUKKUNOORU BHANU PRAKASH REDDY', '13RJ1A0542', '$2y$10$g9Gnqrj4fNg4z6WABj6GIO1JtghAqC6OwgavlOOFC1qKe2/UQV2Mm', 'on', 1, 1, 1),
(43, '13RJ1A0543', 'KUNTA VIVEK', '13RJ1A0543', '$2y$10$W8RpkNjzyI1qbhEt5e07EOphvlbF8dwiFyhq7BVVH0S/m7SXlbDYW', 'on', 1, 1, 1),
(44, '13RJ1A0544', 'KUPPIREDDY NAVEENREDDY', '13RJ1A0544', '$2y$10$fwfkjNOVJic.RU4YekCm/eM/VBjuxlItGRyOdnR0kLJngfVag4x8G', 'on', 1, 1, 1),
(45, '13RJ1A0545', 'LAKKA SAI ESWAR REDDY', '13RJ1A0545', '$2y$10$DMJsNrgNMAPRGSNpHG85s.A.Y7iWyb/ueFkMh34nSjEsCYxg1lMq6', 'on', 1, 1, 1),
(46, '13RJ1A0546', 'LINGAREDDYG ARI ABHILASH', '13RJ1A0546', '$2y$10$pQttZHYJBK4YFABnMWs6ne.GoQwAB.eeTS22hUkM/803arh8Y6QqS', 'on', 1, 1, 1),
(47, '13RJ1A0547', 'M AMULYA REDDY', '13RJ1A0547', '$2y$10$5aiBLkk8ZxfmZRsoUlnOnOUjjtyqU3I7MO2um/dWdGqVNQ3j1FH3i', 'on', 1, 1, 1),
(48, '13RJ1A0548', 'M CHAITANYA', '13RJ1A0548', '$2y$10$bLDbpnDgXp9Bkmcv05kTl.jAgUcwTh1nPw.Qr6QZk690euV6RHwHK', 'on', 1, 1, 1),
(49, '13RJ1A0549', 'M PAVAN KUMAR', '13RJ1A0549', '$2y$10$z5bYxUmk5q6rgL8r7P1xtOtmLK5GusMdK/wWPc/hagoB/xqgFnSaa', 'on', 1, 1, 1),
(50, '13RJ1A0550', 'M SAINATH', '13RJ1A0550', '$2y$10$bWXnirAO35lWOYoGjrAZOOZcrvmOVcJubyv0hTja77tOr9ehIDCtO', 'on', 1, 1, 1),
(51, '13RJ1A0551', 'M SNEHA', '13RJ1A0551', '$2y$10$PKeAE7zxTb39ppBhdYC3HuRmER08UqxRds/.k10jKij2cWN6E4AVG', 'on', 1, 1, 1),
(52, '13RJ1A0552', 'MADISHETTY SHANMUKHA', '13RJ1A0552', '$2y$10$wLyeqsu/JvFQv3f8rdzmRujHehQfsgbxZ/wr/c9MKdZGVtVizs.5q', 'on', 1, 1, 1),
(53, '13RJ1A0553', 'MAGHAM VENKATA PARDHA MANO', '13RJ1A0553', '$2y$10$cSpxgIFgUom5aAI191nbsO/GoU62SEZYwQnO.sD/WJ8LaN5o4.0ri', 'on', 1, 1, 1),
(54, '13RJ1A0554', 'MANEESHA NARAHARI', '13RJ1A0554', '$2y$10$ZIbXymk9ITRekrINm1UfUef8mnGamHfms/3FcPmmciJ1A95A5gK4e', 'on', 1, 1, 1),
(55, '13RJ1A0555', 'MATLAPUDI SHILPA', '13RJ1A0555', '$2y$10$/w29gmXgBDRZXUxMkEGi..K00fqDvpzakjkhK1Un7PaFHUaRs2siG', 'on', 1, 1, 1),
(56, '13RJ1A0556', 'MEGHA RAWAT', '13RJ1A0556', '$2y$10$UzY/E2VV41l3Wwaj39dHpuU5kkYbj3F.1pfNBSzwjzXD3gkCJ2xpu', 'on', 1, 1, 1),
(57, '13RJ1A0557', 'MODDADA JAI BHARGAVI', '13RJ1A0557', '$2y$10$wWGXBQ.ZxdUcQX14jIknKeVGyc211vnxcs/TfCr.OcTstnuXpwvIm', 'on', 1, 0, 1),
(58, '13RJ1A0558', 'MUTCHAKARLA RAMESH', '13RJ1A0558', '$2y$10$mu.JF5W9dH7EzjIucgiC3eTY6YhbCPsmclAkUgz1ACjQwyhkU0iWS', 'on', 1, 1, 1),
(59, '13RJ1A0559', 'NALLA VIDYASAGAR', '13RJ1A0559', '$2y$10$kIZdnwlowtIy5dRm362cOebG7RlTJjqWPYaV0grbIKbX7wLFfPmmu', 'on', 1, 1, 1),
(60, '13RJ1A0560', 'NANDI VAMSHI', '13RJ1A0560', '$2y$10$KgYLNoew4rz8wxpSYySbFOGKkuniwhOE/DDD6gZ0WPrkPhgQGe/9y', 'on', 1, 1, 1),
(61, '1', '111', '1', '$2y$10$HLs/DPo8b58DeMl/I1fln.kx6XgMm67Zo51Sh4Fma21PX0rH/2Xxe', 'off', 1, 1, 1),
(62, '2', '2', '2', '$2y$10$gyJ190YvZYlBOy0KQl6IGOfYrn.9iwcQEyLR7U0h.8ogYPGeUGv8u', 'on', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cse-2-b`
--

CREATE TABLE `cse-2-b` (
  `no` int(11) NOT NULL,
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'on'
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
(6, '16RJ1A05G7', 'on', 'abhishek', 'abhishek', '$2y$10$RWQKIA3J3qrHtpJZX/Zd/eGZhyPT7t2nq0cCVsBZavTJqVEONNAMK', 'cse'),
(8, '11', 'on', '11', '11', '$2y$10$io7.vhnuILWRo.5t62fzQuNOQ8WR8zv/HqzgM2OQgN7gDRJgXJTEi', 'cse'),
(9, '2', 'on', '2', '2', '$2y$10$EJR/sdmtLJsBKRwha9ZLFOaRaUsVcFjkoKUvnoJN03QQgHsx2KWBu', 'has'),
(11, '111', 'on', 'xs', 'dsd', '$2y$10$gsphSjk3lrN.FxZ8i0X3i.RMfblT0UZY4qhoSd/pcyN8REahiwCf2', 'cse'),
(13, '1', 'on', '111', '1', '$2y$10$4ekUpkptUAmmccC5wXIi7.Pe2Q72IUejd8ly8YP8wgI7OMEvs7A3O', 'cse'),
(15, '13RJ1A0502', 'on', ' ABDUL RAHEEM KHAN', '13RJ1A0502', '$2y$10$4rgGT5Rl4oLr72lXCFCRwepAGAlFfmysjNWMRIbv/Ct5/xTuL6ZOC', 'civil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `--`
--
ALTER TABLE `--`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
-- Indexes for table `cse-1-a`
--
ALTER TABLE `cse-1-a`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cse-2-b`
--
ALTER TABLE `cse-2-b`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
-- AUTO_INCREMENT for table `--`
--
ALTER TABLE `--`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cse-1-a`
--
ALTER TABLE `cse-1-a`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `cse-2-b`
--
ALTER TABLE `cse-2-b`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
