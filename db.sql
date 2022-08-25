-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2022 at 10:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtc`
--

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `country` varchar(70) NOT NULL,
  `town` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumbnail` varchar(150) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `number_of_bedrooms` varchar(10) NOT NULL,
  `number_of_bathrooms` varchar(10) NOT NULL,
  `price` float NOT NULL,
  `type` enum('sale','rent') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `property_type_id`, `country`, `town`, `description`, `address`, `image`, `thumbnail`, `latitude`, `longitude`, `number_of_bedrooms`, `number_of_bathrooms`, `price`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'India', 'Mumbai', 'Property', 'Virar(west)', 'assets/images/property1.jpg', 'assets/images/property1.jpg', '22.226', '85.1254', '1', '3', 25000, 'sale', '2022-08-24 13:22:59', '2022-08-24 18:41:27'),
(2, 2, 'India', 'pune', 'Property', 'Virar(west)', 'assets/images/property1.jpg', 'assets/images/property1.jpg', '22.226', '85.1254', '2', '3', 1000, 'sale', '2022-08-24 13:22:59', '2022-08-24 19:01:31'),
(3, 3, 'India', 'Pali', 'Property', 'Virar(west)', 'assets/images/property1.jpg', 'assets/images/property1.jpg', '22.226', '85.1254', '3', '3', 5000, 'sale', '2022-08-24 13:22:59', '2022-08-24 19:01:34'),
(4, 4, 'India', 'jodhpur', 'Property', 'Virar(west)', 'assets/images/property1.jpg', 'assets/images/property1.jpg', '22.226', '85.1254', '3', '3', 2000, 'rent', '2022-08-24 13:22:59', '2022-08-24 19:03:12'),
(5, 5, 'India', 'japur', 'Property', 'Virar(west)', 'assets/images/property1.jpg', 'assets/images/property1.jpg', '22.226', '85.1254', '4', '3', 15000, 'sale', '2022-08-24 13:22:59', '2022-08-24 19:01:55'),
(6, 9, 'india', 'mumbai', 'description test', 'H8 Virar(west)', '20220824224854.png', '20220824224854.png', '33.444', '55.677', '2', '1', 2000, 'sale', '2022-08-24 20:48:54', '2022-08-24 20:48:54'),
(7, 10, 'india', 'mumbai', 'description test', 'H8 Virar(west)', 'assets/images/20220824224946.png', 'assets/images/20220824224946.png', '33.444', '55.677', '2', '1', 2000, 'sale', '2022-08-24 20:49:46', '2022-08-24 20:49:46'),
(8, 11, 'india', 'mumbai', 'description test', 'H8 Virar(west)', 'assets/images/20220824225540.png', 'assets/images/20220824225540.png', '33.444', '55.677', '2', '1', 2000, 'sale', '2022-08-24 20:55:40', '2022-08-24 20:55:40'),
(9, 12, 'india', 'mumbai', 'description test', 'H8 Virar(west)', 'assets/images/20220825062224.png', 'assets/images/20220825062225.png', '33.444', '55.677', '2', '1', 2000, 'sale', '2022-08-25 04:22:25', '2022-08-25 04:22:25'),
(10, 13, 'india', 'mumbai', 'description test', 'H8 Virar(west)', 'assets/images/20220825062314.png', 'assets/images/20220825062314.png', '33.444', '55.677', '2', '1', 2000, 'sale', '2022-08-25 04:23:14', '2022-08-25 04:23:14'),
(11, 14, 'india', 'mumbai', 'description test', 'H8 Virar(west)', 'assets/images/20220825062601.png', 'assets/images/20220825062601.png', '33.444', '55.677', '2', '1', 2000, 'sale', '2022-08-25 04:26:02', '2022-08-25 04:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `property_type`
--

CREATE TABLE `property_type` (
  `id` int(11) NOT NULL,
  `property_type` text NOT NULL,
  `property_description` mediumtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`id`, `property_type`, `property_description`, `created_at`, `updated_at`) VALUES
(1, 'Title test1Title test1Title test1Title test1Title test1Title test1Title test1', 'The property is well maintained. There is a lift in the building and there is a pipe gas connection. There are sufficient arrangements of water storage for a family of 4 for 3 days. The property is very good.\r\nGet a 2 BHK apartment for rent in Virar East for families now, without any brokerage. This 975 sqft. home is on the 6th floor & comes with ample car parking facility. This home faces the North East direction.', '2022-08-24 19:31:04', '2022-08-24 20:31:06'),
(2, 'Title 2', 'The property is well maintained. There is a lift in the building and there is a pipe gas connection. There are sufficient arrangements of water storage for a family of 4 for 3 days. The property is very good.\r\nGet a 2 BHK apartment for rent in Virar East for families now, without any brokerage. This 975 sqft. home is on the 6th floor & comes with ample car parking facility. This home faces the North East direction.', '2022-08-24 19:31:04', '2022-08-24 20:31:06'),
(3, 'Title test1Title test1Title test1Title test1Title test1Title test1Title test1', 'The property is well maintained. There is a lift in the building and there is a pipe gas connection. There are sufficient arrangements of water storage for a family of 4 for 3 days. The property is very good.\r\nGet a 2 BHK apartment for rent in Virar East for families now, without any brokerage. This 975 sqft. home is on the 6th floor & comes with ample car parking facility. This home faces the North East direction.', '2022-08-24 19:31:04', '2022-08-24 20:31:06'),
(4, 'Title test1Title test1Title test1Title test1Title test1Title test1Title test1', 'The property is well maintained. There is a lift in the building and there is a pipe gas connection. There are sufficient arrangements of water storage for a family of 4 for 3 days. The property is very good.\r\nGet a 2 BHK apartment for rent in Virar East for families now, without any brokerage. This 975 sqft. home is on the 6th floor & comes with ample car parking facility. This home faces the North East direction.', '2022-08-24 19:31:04', '2022-08-24 20:31:06'),
(5, 'Title test1Title test1Title test1Title test1Title test1Title test1Title test1', 'The property is well maintained. There is a lift in the building and there is a pipe gas connection. There are sufficient arrangements of water storage for a family of 4 for 3 days. The property is very good.\r\nGet a 2 BHK apartment for rent in Virar East for families now, without any brokerage. This 975 sqft. home is on the 6th floor & comes with ample car parking facility. This home faces the North East direction.', '2022-08-24 19:31:04', '2022-08-24 20:31:06'),
(6, 'plot', 'property descriptipon', '2022-08-25 02:16:11', '2022-08-25 02:16:11'),
(7, 'plot', 'property descriptipon', '2022-08-25 02:16:22', '2022-08-25 02:16:22'),
(8, 'plot', 'property descriptipon', '2022-08-25 02:16:24', '2022-08-25 02:16:24'),
(9, 'plot', 'property descriptipon', '2022-08-25 02:18:54', '2022-08-25 02:18:54'),
(10, 'plot', 'property descriptipon', '2022-08-25 02:19:46', '2022-08-25 02:19:46'),
(11, 'plot', 'property descriptipon', '2022-08-25 02:25:40', '2022-08-25 02:25:40'),
(12, 'plot', 'property descriptipon', '2022-08-25 09:52:25', '2022-08-25 09:52:25'),
(13, 'plot', 'property descriptipon', '2022-08-25 09:53:14', '2022-08-25 09:53:14'),
(14, 'plot', 'property descriptipon', '2022-08-25 09:56:01', '2022-08-25 09:56:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_type_id` (`property_type_id`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
