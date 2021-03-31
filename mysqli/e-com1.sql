-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 03:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-com`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `head` varchar(20) NOT NULL,
  `sub_head` varchar(50) NOT NULL,
  `para` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `button_set` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `head`, `sub_head`, `para`, `img`, `button_set`) VALUES
(31, 'New Launching Produc', '99% Discount', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim', 'images/Banner/598039smartphone-1894723_1920.jpg', 7),
(32, 'New Launching Produc', '99% Discount', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad', 'images/Banner/650338iphone-410311_1280.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(2, 'Furniture', 1),
(7, 'computer', 1),
(23, 'TOY', 0),
(24, 'MEN', 0),
(25, 'WOMEN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `comment`, `added_on`) VALUES
(6, 'sounak', 'sounak9999@gmail.com', 'No subject', 'i have no massage for you.', '2020-10-30 19:04:42'),
(7, 'sounak', 'sounak9999@gmail.com', 'no subject', 'NO massages', '2020-10-31 02:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `title` varchar(40) NOT NULL,
  `first_address` text NOT NULL,
  `last_address` text NOT NULL,
  `zip` int(11) NOT NULL,
  `country` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `phone` int(11) NOT NULL,
  `mobile` int(11) NOT NULL,
  `fax` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `order_status` int(11) NOT NULL,
  `txnid` varchar(20) NOT NULL,
  `mihpayid` varchar(20) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `first_name`, `last_name`, `email`, `title`, `first_address`, `last_address`, `zip`, `country`, `state`, `phone`, `mobile`, `fax`, `payment_type`, `total_price`, `order_status`, `txnid`, `mihpayid`, `payment_status`, `added_on`) VALUES
(47, 4, 'robi', 'ss', 'sdfsfsdf@gmail.com', 'SOUNAK', 'shyampur', '', 239422, '-- Country --', '', 238782939, 0, 0, 'COD', 612, 2, '', '', 'pending', '2020-10-30 04:49:40'),
(48, 7, 'Ram', 'MS', 'Ram@gmail.com', '', 'Howrah', '', 717127, '-- Country --', '', 2147483647, 0, 0, 'COD', 2038.98, 5, '', '', 'pending', '2020-10-30 04:59:47'),
(50, 4, 'Robi', 'Day', 'Robi@gmail.com', '', 'Howrah', '', 711822, 'India', 'WB', 2147483647, 0, 0, 'COD', 24476.9, 3, '', '', 'pending', '2020-11-01 05:02:20'),
(51, 4, 'Robi', 'SS', 'SS@gmail.com', '', 'Howrah', '', 238892, '-- Country --', '', 932093284, 0, 0, 'COD', 1152.6, 5, '', '', 'pending', '2020-11-01 05:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(8, 47, 25, 2, 300),
(9, 48, 24, 1, 1999),
(11, 50, 27, 3, 7999),
(12, 51, 26, 1, 230),
(14, 52, 27, 3, 7999);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_description` varchar(2000) NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `best_seller` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `description`, `short_description`, `meta_title`, `meta_desc`, `meta_keyword`, `best_seller`, `status`) VALUES
(17, 7, 'Table', 2000, 12, 100, 'images/product/956747shirts-on-table.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'Lorem ipsum dolor sit amet,', '', '', '', 1, 1),
(21, 2, 'T-SHIRT', 100, 99, 100, 'images/product/335523kids-t-shirt.jpg', '', '', '', '', '', 1, 1),
(23, 2, 'T-SHIRT', 2000, 100, 0, 'images/product/272824red-t-shirt.jpg', '', '', '', '', '', 0, 1),
(24, 2, 'T-SHIRT', 2000, 1999, 140, 'images/product/473695bright-purple-t-shirt.jpg', '', '', '', '', '', 0, 1),
(25, 2, 'Product', 344, 300, 100, 'images/product/853698white-t-shirt-with-colored-edges.jpg', '', '', '', '', '', 1, 1),
(26, 7, 'Product', 244, 230, 100, 'images/product/425858androgynous-person-waving-trans-pride-flag-portrait.jpg', '', '', '', '', '', 0, 1),
(27, 7, 'Realme', 8000, 7999, 100, 'images/product/919097smartphone-1894723_1920.jpg', '', '', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `added_on`) VALUES
(4, 'Robi', 'Robi@gmail.com', '55555', '2020-10-26 07:31:51'),
(5, 'admin', 'admin@gmail.com', 'admin', '2020-10-26 07:32:28'),
(7, 'Ram', 'Ram@gmail.com', 'Ram', '2020-10-30 04:57:24'),
(8, 'Sourav', 'Sourav@gmai.com', 'sourav', '2020-11-01 05:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
