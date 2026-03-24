-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2026 at 09:19 AM
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
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
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
  `price` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`) VALUES
(1, 'Ford Ranger', 'https://images.unsplash.com/photo-1494905998402-395d579af36f', 'UGX 70,000,000'),
(2, 'Subaru Forester', 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c', 'UGX 30,000,000'),
(3, 'Sport Motorcycle', 'https://images.unsplash.com/photo-1558981806-ec527fa84c39', 'UGX 8,000,000'),
(4, 'Toyota Corolla', 'https://images.unsplash.com/photo-1493238792000-8113da705763', 'UGX 18,000,000'),
(5, 'BMW X5', 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d', 'UGX 85,000,000'),
(6, 'Engine Block (Toyota)', 'images/engine block.jfif', 'UGX 4,500,000'),
(7, 'Car Battery (12V)', 'images/car battery.jfif', 'UGX 350,000'),
(8, 'All-Season Tires (Set of 4)', 'images/tires.jfif', 'UGX 900,000'),
(9, 'Oil Filter', 'images/oil filter.jfif', 'UGX 50,000'),
(10, 'Brake Pads (Front Set)', 'images/brake pads.jfif', 'UGX 180,000'),
(11, 'Spark Plugs (Set of 4)', 'images/spark plugs.jfif', 'UGX 80,000'),
(12, 'Radiator', 'images/radiators.jfif', 'UGX 600,000'),
(13, 'Shock Absorbers (Pair)', 'images/shock absorbers.jfif', 'UGX 450,000'),
(14, 'Motorcycle Chain Kit', 'images/chain kit.jfif', 'UGX 150,000'),
(15, 'Clutch Plate', 'images/clutch.jfif', 'UGX 250,000'),
(26, 'Spark Plugs (Set of 4)', 'images/spark plugs.jfif', 'UGX 80,000'),
(27, 'Radiator', 'images/radiators.jfif', 'UGX 600,000'),
(28, 'Shock Absorbers (Pair)', 'images/shock absorbers.jfif', 'UGX 450,000'),
(29, 'Motorcycle Chain Kit', 'images/chain kit.jfif', 'UGX 150,000'),
(30, 'Clutch Plate', 'images/clutch.jfif', 'UGX 250,000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'wasswa', '112233');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
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
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
