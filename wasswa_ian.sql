-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2026 at 11:25 AM
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
-- Database: `wasswa_ian`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_name`, `price`, `image`) VALUES
(13, 'Car Battery (12V)', 350000, 'images/car battery.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending',
  `bot_response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `country`, `message`, `created_at`, `status`, `bot_response`) VALUES
(1, 'ian', 'iw.iraguha@unik.ac.ug', NULL, 'i want a subaru wheel\r\n', '2026-04-13 16:47:59', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT 'General',
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `category`, `stock`) VALUES
(1, 'Ford Ranger', 'https://images.unsplash.com/photo-1494905998402-395d579af36f', '70000000', 'Cars', 5),
(2, 'Subaru Forester', 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c', '30000000', 'Cars', 10),
(3, 'Sport Motorcycle', 'https://images.unsplash.com/photo-1558981806-ec527fa84c39', '8000000', 'General', 90),
(4, 'Toyota Corolla', 'https://images.unsplash.com/photo-1493238792000-8113da705763', '18000000', 'cars', 2),
(5, 'BMW X5', 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d', '85000000', 'General', 42),
(6, 'Engine Block (Toyota)', 'images/engine block.jfif', '4500000', 'General', 32),
(7, 'Car Battery (12V)', 'images/car battery.jfif', '350000', 'General', 0),
(8, 'All-Season Tires (Set of 4)', 'images/tires.jfif', '900000', 'spare parts', 0),
(9, 'Oil Filter', 'images/oil filter.jfif', '80000', 'General', 0),
(10, 'Brake Pads (Front Set)', 'images/brake pads.jfif', '180000', 'General', 0),
(11, 'Spark Plugs (Set of 4)', 'images/spark plugs.jfif', '80000', 'General', 0),
(12, 'Radiator', 'images/radiators.jfif', '600000', 'General', 0),
(13, 'Shock Absorbers (Pair)', 'images/shock absorbers.jfif', '450000', 'General', 0),
(14, 'Motorcycle Chain Kit', 'images/chain kit.jfif', '150000', 'General', 76),
(15, 'Clutch Plate', 'images/clutch.jfif', '250000', 'General', 0),
(26, 'Spark Plugs (Set of 4)', 'images/spark plugs.jfif', '80000', 'General', 0),
(27, 'Radiator', 'images/radiators.jfif', '600000', 'General', 0),
(28, 'Shock Absorbers (Pair)', 'images/shock absorbers.jfif', '450000', 'General', 43),
(29, 'Motorcycle Chain Kit', 'images/chain kit.jfif', '150000', 'General', 87),
(30, 'Clutch Plate', 'images/clutch.jfif', '250000', 'General', 23),
(31, 'Category Init', 'images/placeholder.png', '0', 'Cars', 0),
(32, 'Category Init', 'images/placeholder.png', '0', 'Spare parts', 0),
(33, 'Tires', 'images/tire.jfif', '30000', 'Tires', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'user',
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `contact`) VALUES
(3, 'wasswa', '$2y$10$7sqwBbJS45N/4KzduN1qXeoSVrI/0AxXhjgwuIPvDbqnJoqGtMlbG', 'admin', 'jraguhaianoxics@gmail.com', '0771422965'),
(4, 'ian', '$2y$10$lA3uFYxAey6nWWqVPJCkM.CyPrErLDCHiDRiagXPqDQB5BqPuYWdu', 'user', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
