-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 31, 2023 at 06:32 PM
-- Server version: 10.6.11-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weather`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_weather`
--

CREATE TABLE `api_weather` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `city_id` int(11) NOT NULL,
  `weather` varchar(40) DEFAULT NULL,
  `temp` int(11) NOT NULL,
  `humidity` int(11) DEFAULT NULL,
  `pressure` int(11) DEFAULT NULL,
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `api_weather`
--

INSERT INTO `api_weather` (`id`, `created_at`, `city_id`, `weather`, `temp`, `humidity`, `pressure`, `day_id`) VALUES
(1, '2023-01-29 13:28:49', 1, 'cloudy', 16, 50, 1000, 1),
(2, '2023-01-29 13:28:49', 1, 'sunny', 20, 50, 1000, 1),
(3, '2023-01-29 13:28:49', 1, 'rainning', 30, 50, 1000, 2),
(4, '2023-01-29 14:19:16', 4, 'Clouds', 4, 87, 1028, 2),
(5, '2023-01-29 14:31:25', 4, 'Clouds', 4, 87, 1028, 2),
(6, '2023-01-31 17:47:01', 4, 'Clouds', 10, 66, 1031, 3);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lon` decimal(10,7) NOT NULL,
  `name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `lat`, `lon`, `name`) VALUES
(1, '23.3300000', '34.3100000', 'Pau'),
(2, '51.5073219', '-0.1276474', 'londre'),
(4, '43.3030044', '-0.3905556', 'billere');

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`id`, `date`) VALUES
(1, '2023-01-28'),
(2, '2023-01-29'),
(3, '2023-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `local_weather`
--

CREATE TABLE `local_weather` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `city_id` int(11) NOT NULL,
  `temp` int(11) NOT NULL,
  `humidity` int(11) NOT NULL,
  `pressure` int(11) NOT NULL,
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `local_weather`
--

INSERT INTO `local_weather` (`id`, `created_at`, `city_id`, `temp`, `humidity`, `pressure`, `day_id`) VALUES
(1, '2023-01-29 13:28:49', 1, 15, 32, 3123, 1),
(2, '2023-01-29 13:28:49', 1, 10, 35, 1000, 1),
(3, '2023-01-29 13:28:49', 1, 23, 43, 212, 2);

-- --------------------------------------------------------

--
-- Table structure for table `weather_relation`
--

CREATE TABLE `weather_relation` (
  `id` int(11) NOT NULL,
  `local_weather_id` int(11) NOT NULL,
  `api_weather_id` int(11) DEFAULT NULL,
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weather_relation`
--

INSERT INTO `weather_relation` (`id`, `local_weather_id`, `api_weather_id`, `day_id`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_weather`
--
ALTER TABLE `api_weather`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local_weather`
--
ALTER TABLE `local_weather`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `weather_relation`
--
ALTER TABLE `weather_relation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `local_weather_id` (`local_weather_id`,`api_weather_id`),
  ADD KEY `api_weather_id` (`api_weather_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_weather`
--
ALTER TABLE `api_weather`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `local_weather`
--
ALTER TABLE `local_weather`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `weather_relation`
--
ALTER TABLE `weather_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_weather`
--
ALTER TABLE `api_weather`
  ADD CONSTRAINT `api_weather_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `api_weather_ibfk_2` FOREIGN KEY (`day_id`) REFERENCES `day` (`id`);

--
-- Constraints for table `local_weather`
--
ALTER TABLE `local_weather`
  ADD CONSTRAINT `local_weather_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `local_weather_ibfk_2` FOREIGN KEY (`day_id`) REFERENCES `day` (`id`);

--
-- Constraints for table `weather_relation`
--
ALTER TABLE `weather_relation`
  ADD CONSTRAINT `weather_relation_ibfk_1` FOREIGN KEY (`local_weather_id`) REFERENCES `local_weather` (`id`),
  ADD CONSTRAINT `weather_relation_ibfk_2` FOREIGN KEY (`api_weather_id`) REFERENCES `api_weather` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
