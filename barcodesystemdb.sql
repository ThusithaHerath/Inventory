-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 11, 2021 at 06:02 PM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barcodesystemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `thcategory`
--

CREATE TABLE `thcategory` (
  `cid` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cstatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thinstitution`
--

CREATE TABLE `thinstitution` (
  `iid` int(11) NOT NULL,
  `iname` varchar(50) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `istatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thlocation`
--

CREATE TABLE `thlocation` (
  `lid` int(11) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lstatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thproducts`
--

CREATE TABLE `thproducts` (
  `product_id` int(11) NOT NULL,
  `product_barcodenumber` varchar(20) NOT NULL,
  `product_category` varchar(11) NOT NULL,
  `product_subcategory` int(11) NOT NULL,
  `product_institution` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `warpnumber` int(10) NOT NULL,
  `product_letter` varchar(10) NOT NULL,
  `cost` float NOT NULL,
  `price` float NOT NULL,
  `profit` float NOT NULL,
  `onhand_qty` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `qty_sold` int(10) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pstatus` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thsubcategory`
--

CREATE TABLE `thsubcategory` (
  `sid` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sstatus` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thusers`
--

CREATE TABLE `thusers` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `branch` int(11) NOT NULL,
  `admintype` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `admin` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `subcategory` varchar(20) NOT NULL,
  `institution` varchar(20) NOT NULL,
  `products` varchar(20) NOT NULL,
  `invoice` varchar(20) NOT NULL,
  `reports` varchar(20) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thusers`
--

INSERT INTO `thusers` (`user_id`, `user_name`, `user_email`, `user_pass`, `branch`, `admintype`, `location`, `admin`, `category`, `subcategory`, `institution`, `products`, `invoice`, `reports`, `joining_date`, `status`) VALUES
(1, 'sahan', 'sahan@gmail.com', '$2y$10$xUM0yon/kvTnMsvoXnPOrugIlShJYem4LvBeDRboyvwgcQEzCUffG', 0, 'Administration', '', 'True', 'True', 'True', 'True', 'True', '', 'True', '2021-01-06 15:55:31', 'Publish');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `thcategory`
--
ALTER TABLE `thcategory`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `thinstitution`
--
ALTER TABLE `thinstitution`
  ADD PRIMARY KEY (`iid`);

--
-- Indexes for table `thlocation`
--
ALTER TABLE `thlocation`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `thproducts`
--
ALTER TABLE `thproducts`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `thsubcategory`
--
ALTER TABLE `thsubcategory`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `thusers`
--
ALTER TABLE `thusers`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `thcategory`
--
ALTER TABLE `thcategory`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thinstitution`
--
ALTER TABLE `thinstitution`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thlocation`
--
ALTER TABLE `thlocation`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thsubcategory`
--
ALTER TABLE `thsubcategory`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thusers`
--
ALTER TABLE `thusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
