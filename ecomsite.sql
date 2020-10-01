-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2020 at 03:34 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(1100) NOT NULL,
  `email` varchar(1100) NOT NULL,
  `password` varchar(1100) NOT NULL,
  `type` varchar(1100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `type`, `date`, `status`) VALUES
(1, 'Divyanshu', 'admin@bilwg.com', 'qwerty', 'ADMIN', '2020-09-15 18:42:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(1100) NOT NULL,
  `other` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `other`, `status`) VALUES
(2, 'dsfdsf', 0, 1),
(3, 'test', 0, 1),
(4, 'ascsd', 0, 1),
(6, 'Divyanshu Sah', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `question` mediumtext NOT NULL,
  `answer` mediumtext NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `productid`, `question`, `answer`, `status`) VALUES
(2, 2, 'qwertyy', 'sdfdsfdsf', 1),
(3, 3, 'sdfdsfs', 'dfdsfdsf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  `text` varchar(1100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `userid`, `productid`, `star`, `text`, `status`) VALUES
(1, 2, 1, 5, 'tdsfgdfgdfd dfg dfgdf gdf', 1),
(2, 2, 1, 3, 'best', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `name` varchar(1100) NOT NULL,
  `email` varchar(1100) NOT NULL,
  `phone` varchar(1100) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city` varchar(1100) NOT NULL,
  `state` varchar(1100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `paymode` varchar(1100) NOT NULL,
  `userid` int(11) NOT NULL,
  `payed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `productid`, `name`, `email`, `phone`, `address1`, `address2`, `city`, `state`, `pincode`, `date`, `status`, `paymode`, `userid`, `payed`) VALUES
(1, 1, 'Divyanshu Sah', 'greatdivyanshu59@gmail.com', '9410335478', 'Address Line 1', 'Address Line 2', 'Bhimtal', 'Uttrakhand', 263136, '2020-09-18 13:28:19', 2, 'online', 2, 1),
(2, 2, 'Divyanshu Sah', 'greatdivyanshu59@gmail.com', '09410335478', 'Bhimtal Nainital Uttarakhand', 'tallital bhimtal', 'Bhimtal', 'Uttarakhand', 263136, '2020-09-20 17:43:30', 1, 'cod', 2, 0),
(4, 3, 'Divyanshu Sah', 'greatdivyanshu59@gmail.com', '09410335478', 'Bhimtal Nainital Uttarakhand', 'tallital bhimtal', 'Bhimtal', 'Uttarakhand', 263136, '2020-09-01 17:49:04', 0, 'online', 2, 0),
(5, 4, 'Divyanshu Sah', 'greatdivyanshu59@gmail.com', '09410335478', 'Bhimtal Nainital Uttarakhand', 'tallital bhimtal', 'Bhimtal', 'Uttarakhand', 263136, '2020-09-01 17:54:12', 1, 'cod', 2, 1),
(6, 1, 'Divyanshu Sah', 'greatdivyanshu59@gmail.com', '09410335478', 'Bhimtal Nainital Uttarakhand', 'tallital bhimtal', 'Bhimtal', 'Uttarakhand', 263136, '2020-09-20 19:19:43', 1, 'cod', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(1100) NOT NULL,
  `sdesc` longtext NOT NULL,
  `ldesc` longtext NOT NULL,
  `catid` int(11) NOT NULL,
  `features` longtext NOT NULL,
  `cost` int(11) NOT NULL,
  `photos` longtext NOT NULL,
  `isStock` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sdesc`, `ldesc`, `catid`, `features`, `cost`, `photos`, `isStock`, `status`) VALUES
(1, 'Test Product 1 test', 'This is Short Desciption', 'long', 2, 'One,Two,Three,Four', 100, 'https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,', 0, 1),
(2, 'asds', 'Shorteee', 'Longgeeee', 2, 'dfdsfsd,dsfdsfds,dsfdsfdsfsdf,dsfds', 100, 'https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,https://www.mageplaza.com/assets/img/extensions/product-labels.png,', 0, 1),
(3, 'Test Product 2 test', 'asdasdasdasdasdas', 'dasdasdasdasdasdasdasdasd', 2, 'asdasdasd', 12, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(1100) NOT NULL,
  `email` varchar(1100) NOT NULL,
  `password` varchar(1100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `time`, `status`) VALUES
(1, 'Divyanshu', 'greatdivyanshu59@gmail.com', 'qwerty', '2020-09-18 11:57:07', 1),
(2, 'Divyanshu', 'admin@bilwg.com', 'qwerty', '2020-09-18 11:57:10', 1),
(3, 'Divyanshu Sah', 'divyanshusah@bilwg.com', 'qwerty', '2020-09-19 17:31:43', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
