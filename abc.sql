-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: abc_mysql
-- Generation Time: Apr 16, 2020 at 04:03 PM
-- Server version: 5.7.27
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abc`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `order_id`, `quantity`, `created_at`) VALUES
(1, 1, 'l3OpFmmsPW', 3, '2020-04-06 09:59:14'),
(3, 2, 'Q8Hz2jQC6i', 90, '2020-04-06 10:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `file_path`, `created_at`) VALUES
(1, 1, 'https://via.placeholder.com/150x80', '2020-04-05 13:09:30'),
(2, 1, 'https://via.placeholder.com/150x80', '2020-04-05 13:09:30'),
(3, 1, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:30'),
(4, 2, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:30'),
(5, 2, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:30'),
(6, 2, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:30'),
(7, 3, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:30'),
(8, 3, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:30'),
(9, 3, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:30'),
(10, 4, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:30'),
(11, 4, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:37'),
(12, 4, 'https://via.placeholder.com/150x80', '2020-04-05 13:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `shipping_option` enum('pick_up','ups') DEFAULT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `total_cost` decimal(6,2) DEFAULT '0.00',
  `previous_balance` decimal(6,2) NOT NULL DEFAULT '0.00',
  `available_balance` decimal(6,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipping_option`, `status`, `total_cost`, `previous_balance`, `available_balance`, `created_at`) VALUES
('Q8Hz2jQC6i', 1, NULL, 'pending', '0.00', '0.00', '0.00', '2020-04-06 09:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `average_rating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `unit`, `average_rating`, `created_at`) VALUES
(1, 'Apple', '', '0.30', NULL, '3.6', '2020-04-05 13:06:32'),
(2, 'Beer', '', '2.00', NULL, '3.5', '2020-04-05 13:06:32'),
(3, 'Water', '', '1.00', 'Bottle', '3.9', '2020-04-05 13:07:11'),
(4, 'Chees', '', '3.74', 'Kg', '3.0', '2020-04-05 13:07:11');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `value` decimal(2,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `product_id`, `user_id`, `value`) VALUES
(1, 1, 1, '4.0'),
(2, 2, 1, '3.0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` text NOT NULL,
  `balance` decimal(6,2) NOT NULL DEFAULT '100.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `balance`, `created_at`) VALUES
(1, 'ibukunajimoti@gmail.com', '$2y$10$HbbBczjvbx0Jy8oFnZkvg.b5rMp1u2AL4xSmeSxFa/IhgGJbnPQ1S', '100.00', '2020-04-06 09:59:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
