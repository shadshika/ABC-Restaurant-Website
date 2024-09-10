-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 05:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abc_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `no` tinyint(5) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`no`, `username`, `password`) VALUES
(1, 'shadshu', 'shadshu1234');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'YOGANATHAN SHADSHIKA', 'shadshi@gmail.com', '0772634603', 'Accept my request', '2024-08-31 15:36:39'),
(2, 'mathan', 'mathan@gmail.com', '0774612331', 'Hi, Im mathan accept my request', '2024-09-01 03:57:22'),
(3, 'YOGANATHAN SHADSHIKA', 'shadshi@gmail.com', '0772634603', 'hi', '2024-09-01 03:57:56'),
(5, 'Srikantha', 'srikantha@gmail.com', '0774562137', 'Please contact me', '2024-09-01 13:13:29'),
(6, 'Pathmanathan Kandeepan', 'kandee@gmail.com', '0774532689', 'Please contact me', '2024-09-01 14:34:06'),
(7, 'Pathmanathan Paheerathan', 'pahee@gmail.com', '077145984', 'Accept my request', '2024-09-02 05:35:10'),
(9, 'Pathmanathan Paheerathan', 'pahee@gmail.com', '0772634603', 'hi', '2024-09-03 13:19:20'),
(12, 'kishon', 'kishon@gmail.com', '0774562137', 'hi ', '2024-09-06 12:07:19'),
(13, 'soji', 'soji@gmail.com', '0774562137', 'hi', '2024-09-06 15:41:54'),
(14, 'nanathan', 'nanthan@gmail.com', '077145984', 'Accept my request', '2024-09-06 15:43:25'),
(15, 'tharani', 'tharu@gmail.com', '0701743487', 'hi', '2024-09-09 05:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `email`, `password`, `phone`, `address`, `created_at`) VALUES
(10, 'pahee', 'pahee@gmail.com', '$2y$10$PjQscgqqbKuZGvCv8zQS/eCN1CLgkcKhYJNa84QYr9XXhp7LItF7q', '077145984', 'Trincon\r\n', '2024-09-04 03:43:27'),
(11, 'kandee', 'kandee@gmail.com', '$2y$10$ALniYkfveeJiuvgtBm5k2.rDHuXvSjyNsUELS1.yE4ek4yIAsJrB6', '0772634603', 'jaffna\r\n\r\n', '2024-09-04 03:43:59'),
(12, 'srikantha', 'srikantha@gmail.com', '$2y$10$GRUM/bRIpzHb2hZfJTzvq.gt.VYnLPxrU6zG00un7vylvoqBV.mSq', '0774562137', 'trinco', '2024-09-04 03:44:28'),
(13, 'yoganathan', 'yog@gamil.com', '$2y$10$BtNsX37LoHGqEgT/ReSdvul3cJDFarQNDPf85yva6efW2U1VPaJ9W', '0772634603', 'trinco', '2024-09-04 03:45:16'),
(15, 'sri', 'sri@gmail.com', '$2y$10$EAc8e3LM8vSyhvwMrPZppurTJgyXYVnU2fnrF9dOOr9t77pvwXnDS', '0774562137', 'jaffna', '2024-09-04 03:45:58'),
(16, 'nive', 'nive@gmail.com', '$2y$10$WKZf0rJvOertgUrCUKIACuZsqjA7IyxN5oKydLX9NZZJ3s3y88oU2', '0772634603', 'Trinco', '2024-09-06 12:12:28'),
(17, 'nanthan', 'nanthan@gmail.com', '$2y$10$sbBDLr4kS/LYDcIsMsf6wu5BJfMZpyDCZ3Sh6c7QrUFaMBJpxJWXW', '0774532689', 'Trino, Nithiyapuri,Main street', '2024-09-06 15:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `image_path`) VALUES
(5, 'Outdoor Seating', 'Outdoor Seating.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `people` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `date`, `time`, `people`, `created_at`) VALUES
(26, 'Tharmi', 'tharmila9746@gmail.com', '2024-09-10', '06:58:00', 2, '2024-09-08 17:36:05'),
(29, 'Thishangar', 'yoganathanthishangar@gmail.com', '2024-09-09', '06:45:00', 10, '2024-09-09 01:15:17'),
(30, 'Tharmila', 'tharmila9746@gmail.com', '2024-09-10', '06:48:00', 3, '2024-09-09 01:17:38'),
(31, 'shadshika', 'shadshikashadshika@gmail.com', '2024-09-10', '06:48:00', 2, '2024-09-09 01:20:16'),
(32, 'Thushanth', 'prabathushanth23@gmail.com', '2024-09-09', '06:53:00', 1002, '2024-09-09 01:22:58'),
(33, 'Shadshi', 'shadshikashadshika@gmail.com', '2024-10-19', '11:13:00', 123, '2024-09-09 05:41:56'),
(34, 'Shadshi', 'shadshikashadshika@gmail.com', '2024-10-26', '11:16:00', 23, '2024-09-09 05:43:14'),
(35, 'Thishangar yoganathan', 'yoganathanthishangar@gmail.com', '2024-09-20', '11:18:00', 2, '2024-09-09 05:44:45'),
(36, 'YOGANATHAN SHADSHIKA', 'shadshikashadshika@gmail.com', '2024-09-26', '11:26:00', 4, '2024-09-09 05:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `image_path`) VALUES
(1, 'Delivery', 'Delivery.png'),
(3, 'Catering', 'Catering Services.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(18, 'pahee', 'pahee@gmail.com', '$2y$10$8YWvGBAgH.hnP1P9SkYPiORroDxSuNXrjfz9ojAisDUw0aBRxhGBq', '2024-09-04 03:53:50'),
(19, 'prashanthi', 'prashanthi@gmail.com', '$2y$10$GAr55gOTFtugb0S.I1HYxeJzMOiYho0RjQVvmbo0thsCOIPyZv5Yq', '2024-09-04 03:54:32'),
(20, 'nive', 'nive@gmail.com', '$2y$10$YJnTHqtmMyosHiGGS1sLBuWtBOp3OzgUpMTr/rCwC.Hi14iUMlJO2', '2024-09-06 12:11:48'),
(21, 'pooja', 'pooja@gmail.com', '$2y$10$u8ZJ8PkYTypsRkVfCQ9GCeeFZe27pmZMFGH/l4pPY4O.5pN2YN3Ai', '2024-09-06 15:04:17'),
(22, 'thanu thanusiya', 'thanu@gmail.com', '$2y$10$M98qkvyXj8ttdWaI5/PfHu5R/oC/vZpsQ1A0o7l2Z6f24FeqwMNz6', '2024-09-06 15:32:05'),
(23, 'aby', 'aby@gmail.com', '$2y$10$8s9ddXwPHkIj2KxQ.pOUruuXboak0uJ6j0eE.ZSOBOwhpua8tKY/O', '2024-09-06 15:32:57'),
(24, 'nanthan', 'nanthan@gmail.com', '$2y$10$c7gTt2ckVp3MT7wuwXuJde/sjuwkymTPx3cyA/f/n0RP0onhHELC.', '2024-09-06 15:44:19'),
(25, 'neethan', 'neethan@gmail.com', '$2y$10$byv0w7yGps3D4NUafbY/F.LHIaBpzPVzxIz2DsLqkRD.tdF3YWkra', '2024-09-06 16:12:53'),
(26, 'tharani', 'tharu@gmail.com', '$2y$10$XRjUkBeQEPbZVhKCN5SAqOVaZTYwiUT4v816KZRgUcEfo8TSZmip6', '2024-09-09 05:51:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `no` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
