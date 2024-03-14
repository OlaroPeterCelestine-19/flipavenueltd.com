-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 09:16 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flipavenueltd`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `payment_status` varchar(200) NOT NULL,
  `payment_reference` varchar(200) NOT NULL,
  `payment_date` varchar(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_phone` varchar(200) NOT NULL,
  `customer_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `pid`, `amount`, `currency`, `payment_status`, `payment_reference`, `payment_date`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`) VALUES
(2, 9, '90000', 'UGX', 'Pending', '623355072', '2024-03-14', 'Oguti David', 'osp123ug@gmail.com', '256772727716', 'Wandegeya'),
(3, 9, '90000', 'UGX', 'Pending', '1562257467', '2024-03-14', 'Oguti David', 'osp123ug@gmail.com', '256704487563', 'Wandegeya');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `pid`, `photo`) VALUES
(4, 7, 'http://localhost/flipavenueltd.com/uploads/7637588017699.jpg'),
(5, 7, 'http://localhost/flipavenueltd.com/uploads/7870912776842.jpg'),
(6, 7, 'http://localhost/flipavenueltd.com/uploads/3419978758899.jpg'),
(7, 7, 'http://localhost/flipavenueltd.com/uploads/3814260338775.jpg'),
(8, 9, 'http://localhost/flipavenueltd.com/uploads/1863699913477.jpg'),
(9, 9, 'http://localhost/flipavenueltd.com/uploads/9972019851031.jpg'),
(10, 8, 'http://localhost/flipavenueltd.com/uploads/8097381628992.jpg'),
(11, 8, 'http://localhost/flipavenueltd.com/uploads/8312946397555.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(200) NOT NULL,
  `pprice` varchar(200) NOT NULL,
  `ppic` varchar(200) NOT NULL,
  `pqnty` int(11) NOT NULL,
  `pdesc` text NOT NULL,
  `pdate` varchar(200) NOT NULL,
  `pstatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pprice`, `ppic`, `pqnty`, `pdesc`, `pdate`, `pstatus`) VALUES
(8, 'Shoes', '70000', 'http://localhost/flipavenueltd.com/uploads/5114514212511.jpg', 90, '<p>Describe about the product Here...</p>\r\n', '2024-03-14', 'Available'),
(9, 'Shoes', '90000', 'http://localhost/flipavenueltd.com/uploads/9089730019150.jpg', 78, '<p>Describe about the product Here...</p>\r\n', '2024-03-14', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` bigint(20) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `account_status` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `date_registered` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fullname`, `email`, `phone`, `password`, `account_status`, `gender`, `role`, `date_registered`) VALUES
(1, 'osp', 'osp123ug@gmail.com', '0704487563', 'bd8da86331934bc695d34a103a42beb18d072dd6', 'active', 'male', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_id` (`payment_id`,`pid`,`amount`,`payment_status`,`payment_reference`,`payment_date`,`customer_name`,`customer_email`,`customer_phone`),
  ADD KEY `currency` (`currency`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `photo_id` (`photo_id`,`photo`,`pid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pid` (`pid`,`pname`,`pprice`,`ppic`,`pqnty`),
  ADD KEY `pdate` (`pdate`,`pstatus`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `userid` (`userid`,`fullname`,`email`,`phone`,`password`,`account_status`,`gender`,`role`,`date_registered`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
