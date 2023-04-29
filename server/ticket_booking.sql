-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2023 at 11:14 PM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `id` int NOT NULL COMMENT 'coach_id',
  `train_id` int NOT NULL,
  `coach_no` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`id`, `train_id`, `coach_no`, `timestamp`) VALUES
(1, 12226, '1', '2023-04-27 04:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int NOT NULL COMMENT 'seat_id',
  `coach_id` int NOT NULL,
  `seat_no` varchar(5) NOT NULL,
  `class` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` enum('FALSE','TRUE') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'FALSE' COMMENT 'FALSE -> "Not Booked",',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `coach_id`, `seat_no`, `class`, `status`, `timestamp`) VALUES
(1, 1, 'A1', NULL, 'FALSE', '2023-04-27 04:10:17'),
(2, 1, 'A2', NULL, 'FALSE', '2023-04-27 04:10:17'),
(3, 1, 'A3', NULL, 'FALSE', '2023-04-27 04:10:17'),
(4, 1, 'A4', NULL, 'FALSE', '2023-04-27 04:10:17'),
(5, 1, 'A5', NULL, 'FALSE', '2023-04-27 04:10:17'),
(6, 1, 'A6', NULL, 'FALSE', '2023-04-27 04:10:17'),
(7, 1, 'A7', NULL, 'FALSE', '2023-04-27 04:10:17'),
(8, 1, 'A8', NULL, 'FALSE', '2023-04-27 04:10:17'),
(9, 1, 'A9', NULL, 'FALSE', '2023-04-27 04:10:17'),
(10, 1, 'A10', NULL, 'FALSE', '2023-04-27 04:10:17'),
(11, 1, 'A11', NULL, 'FALSE', '2023-04-27 04:10:17'),
(12, 1, 'A12', NULL, 'FALSE', '2023-04-27 04:10:17'),
(13, 1, 'A13', NULL, 'FALSE', '2023-04-27 04:10:17'),
(14, 1, 'A14', NULL, 'FALSE', '2023-04-27 04:10:17'),
(15, 1, 'A15', NULL, 'FALSE', '2023-04-27 04:10:17'),
(16, 1, 'A16', NULL, 'FALSE', '2023-04-27 04:10:17'),
(17, 1, 'A17', NULL, 'FALSE', '2023-04-27 04:10:17'),
(18, 1, 'A18', NULL, 'FALSE', '2023-04-27 04:10:17'),
(19, 1, 'A19', NULL, 'FALSE', '2023-04-27 04:10:17'),
(20, 1, 'A20', NULL, 'FALSE', '2023-04-27 04:10:17'),
(21, 1, 'A21', NULL, 'FALSE', '2023-04-27 04:10:17'),
(22, 1, 'A22', NULL, 'FALSE', '2023-04-27 04:10:17'),
(23, 1, 'A23', NULL, 'FALSE', '2023-04-27 04:10:17'),
(24, 1, 'A24', NULL, 'FALSE', '2023-04-27 04:10:17'),
(25, 1, 'A25', NULL, 'FALSE', '2023-04-27 04:10:17'),
(26, 1, 'A26', NULL, 'FALSE', '2023-04-27 04:10:17'),
(27, 1, 'A27', NULL, 'FALSE', '2023-04-27 04:10:17'),
(28, 1, 'A28', NULL, 'FALSE', '2023-04-27 04:10:17'),
(29, 1, 'A29', NULL, 'FALSE', '2023-04-27 04:10:17'),
(30, 1, 'A30', NULL, 'FALSE', '2023-04-27 04:10:17'),
(31, 1, 'A31', NULL, 'FALSE', '2023-04-27 04:10:17'),
(32, 1, 'A32', NULL, 'FALSE', '2023-04-27 04:10:17'),
(33, 1, 'A33', NULL, 'FALSE', '2023-04-27 04:10:17'),
(34, 1, 'A34', NULL, 'FALSE', '2023-04-27 04:10:17'),
(35, 1, 'A35', NULL, 'FALSE', '2023-04-27 04:10:17'),
(36, 1, 'A36', NULL, 'FALSE', '2023-04-27 04:10:17'),
(37, 1, 'A37', NULL, 'FALSE', '2023-04-27 04:10:17'),
(38, 1, 'A38', NULL, 'FALSE', '2023-04-27 04:10:17'),
(39, 1, 'A39', NULL, 'FALSE', '2023-04-27 04:10:17'),
(40, 1, 'A40', NULL, 'FALSE', '2023-04-27 04:10:17'),
(41, 1, 'A41', NULL, 'FALSE', '2023-04-27 04:10:17'),
(42, 1, 'A42', NULL, 'FALSE', '2023-04-27 04:10:17'),
(43, 1, 'A43', NULL, 'FALSE', '2023-04-27 04:10:17'),
(44, 1, 'A44', NULL, 'FALSE', '2023-04-27 04:10:17'),
(45, 1, 'A45', NULL, 'FALSE', '2023-04-27 04:10:17'),
(46, 1, 'A46', NULL, 'FALSE', '2023-04-27 04:10:17'),
(47, 1, 'A47', NULL, 'FALSE', '2023-04-27 04:10:17'),
(48, 1, 'A48', NULL, 'FALSE', '2023-04-27 04:10:17'),
(49, 1, 'A49', NULL, 'FALSE', '2023-04-27 04:10:17'),
(50, 1, 'A50', NULL, 'FALSE', '2023-04-27 04:10:17'),
(51, 1, 'A51', NULL, 'FALSE', '2023-04-27 04:10:17'),
(52, 1, 'A52', NULL, 'FALSE', '2023-04-27 04:10:17'),
(53, 1, 'A53', NULL, 'FALSE', '2023-04-27 04:10:17'),
(54, 1, 'A54', NULL, 'FALSE', '2023-04-27 04:10:17'),
(55, 1, 'A55', NULL, 'FALSE', '2023-04-27 04:10:17'),
(56, 1, 'A56', NULL, 'FALSE', '2023-04-27 04:10:17'),
(57, 1, 'A57', NULL, 'FALSE', '2023-04-27 04:10:17'),
(58, 1, 'A58', NULL, 'FALSE', '2023-04-27 04:10:17'),
(59, 1, 'A59', NULL, 'FALSE', '2023-04-27 04:10:17'),
(60, 1, 'A60', NULL, 'FALSE', '2023-04-27 04:10:17'),
(61, 1, 'A61', NULL, 'FALSE', '2023-04-27 04:10:17'),
(62, 1, 'A62', NULL, 'FALSE', '2023-04-27 04:10:17'),
(63, 1, 'A63', NULL, 'FALSE', '2023-04-27 04:10:17'),
(64, 1, 'A64', NULL, 'FALSE', '2023-04-27 04:10:17'),
(65, 1, 'A65', NULL, 'FALSE', '2023-04-27 04:10:17'),
(66, 1, 'A66', NULL, 'FALSE', '2023-04-27 04:10:17'),
(67, 1, 'A67', NULL, 'FALSE', '2023-04-27 04:10:17'),
(68, 1, 'A68', NULL, 'FALSE', '2023-04-27 04:10:17'),
(69, 1, 'A69', NULL, 'FALSE', '2023-04-27 04:10:17'),
(70, 1, 'A70', NULL, 'FALSE', '2023-04-27 04:10:17'),
(71, 1, 'A71', NULL, 'FALSE', '2023-04-27 04:10:17'),
(72, 1, 'A72', NULL, 'FALSE', '2023-04-27 04:10:17'),
(73, 1, 'A73', NULL, 'FALSE', '2023-04-27 04:10:17'),
(74, 1, 'A74', NULL, 'FALSE', '2023-04-27 04:10:17'),
(75, 1, 'A75', NULL, 'FALSE', '2023-04-27 04:10:17'),
(76, 1, 'A76', NULL, 'FALSE', '2023-04-27 04:10:17'),
(77, 1, 'A77', NULL, 'FALSE', '2023-04-27 04:10:17'),
(78, 1, 'A78', NULL, 'FALSE', '2023-04-27 04:10:17'),
(79, 1, 'A79', NULL, 'FALSE', '2023-04-27 04:10:17'),
(80, 1, 'A80', NULL, 'FALSE', '2023-04-27 04:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `tickets_booked`
--

CREATE TABLE `tickets_booked` (
  `id` int NOT NULL COMMENT 'booking_id',
  `person_id` int NOT NULL,
  `coach_id` int NOT NULL,
  `seat_id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int NOT NULL COMMENT 'person_id',
  `name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `name`, `timestamp`) VALUES
(1, 'person_1', '2023-04-27 04:03:43'),
(2, 'person_2', '2023-04-27 04:03:43'),
(3, 'person_3', '2023-04-27 04:03:43'),
(4, 'person_4', '2023-04-27 04:03:43'),
(5, 'person_5', '2023-04-27 04:03:43'),
(6, 'person_6', '2023-04-27 04:03:43'),
(7, 'person_7', '2023-04-27 04:03:43'),
(8, 'person_8', '2023-04-27 04:03:43'),
(9, 'person_9', '2023-04-27 04:03:43'),
(10, 'person_10', '2023-04-27 04:03:43'),
(11, 'person_11', '2023-04-27 04:03:43'),
(12, 'person_12', '2023-04-27 04:03:43'),
(13, 'person_13', '2023-04-27 04:03:43'),
(14, 'person_14', '2023-04-27 04:03:43'),
(15, 'person_15', '2023-04-27 04:03:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`id`),
  ADD KEY `train_id` (`train_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- Indexes for table `tickets_booked`
--
ALTER TABLE `tickets_booked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'coach_id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'seat_id', AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tickets_booked`
--
ALTER TABLE `tickets_booked`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'booking_id';

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'person_id', AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `FK_COACH_ID` FOREIGN KEY (`coach_id`) REFERENCES `coach` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
