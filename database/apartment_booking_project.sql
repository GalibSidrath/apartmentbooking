-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 11:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment_booking_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'prity', 'prity@gmail.com', '$2y$10$Y6E87MKKDuYi7Z3lQnqBduGE1sm6zuerPd8GvL6Ti20GvMR6p/jbq'),
(3, 'abdmgalib', 'galib@gmail.com', '$2y$10$KsA8iWuXKtI8CEMyPF8ykOOQupo3zXh.St8h67FiL1qvrMNZaJ4Sy');

-- --------------------------------------------------------

--
-- Table structure for table `apartment_details`
--

CREATE TABLE `apartment_details` (
  `id` int(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `total_room_number` int(255) NOT NULL,
  `total_bedroom_number` int(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `image_link` varchar(255) NOT NULL,
  `full_address` text NOT NULL,
  `booking_status` varchar(10) NOT NULL,
  `booked_by` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment_details`
--

INSERT INTO `apartment_details` (`id`, `size`, `total_room_number`, `total_bedroom_number`, `division`, `district`, `image_link`, `full_address`, `booking_status`, `booked_by`, `contact_number`) VALUES
(1, '1170.20', 6, 3, 'Chittagong', 'Chattogram', 'https://images.pexels.com/photos/271816/pexels-photo-271816.jpeg', '212/256 Nijhum Surovi Height, Kushumbagh R/A, Khulshi, Chittagong', 'available', '', '01518784990'),
(2, '1250', 7, 4, 'Dhaka', 'Dhaka', 'https://images.pexels.com/photos/275484/pexels-photo-275484.jpeg', 'Road : 130 House :28, Dhaka 1212', 'booked', 'abdmgalib', '01518784990'),
(4, '1250', 6, 3, 'Chittagong', 'Chattogram', 'https://images.pexels.com/photos/271816/pexels-photo-271816.jpeg', 'a dummy address', 'available', '', '01518784990'),
(5, '1350', 6, 3, 'Chittagong', 'Chattogram', 'https://images.pexels.com/photos/681331/pexels-photo-681331.jpeg', 'a dummy address', 'available', '', '0181514095'),
(6, '1170.20', 7, 7, 'Chittagong', 'Chattogram', 'https://images.pexels.com/photos/275484/pexels-photo-275484.jpeg', 'a dummy address', 'booked', 'abdmgalib', '01518784990'),
(8, '1350', 6, 3, 'Chittagong', 'Chattogram', 'https://images.pexels.com/photos/681331/pexels-photo-681331.jpeg', 'a dummy address', 'available', '', '0181514095'),
(9, '1170.20', 6, 3, 'Chittagong', 'Chattogram', 'https://images.pexels.com/photos/271816/pexels-photo-271816.jpeg', '212/256 Nijhum Surovi Height, Kushumbagh R/A, Khulshi, Chittagong', 'available', '', '01518784990'),
(10, '1170.20', 6, 3, 'Chittagong', 'Chattogram', 'https://images.pexels.com/photos/271816/pexels-photo-271816.jpeg', '212/256 Nijhum Surovi Height, Kushumbagh R/A, Khulshi, Chittagong', 'available', '', '01518784990');

-- --------------------------------------------------------

--
-- Table structure for table `contact_message`
--

CREATE TABLE `contact_message` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_message`
--

INSERT INTO `contact_message` (`id`, `email`, `message`) VALUES
(1, 'indrajit@gmail.com', 'this a testing message...'),
(2, 'indrajit@gmail.com', 'this a testing message...'),
(3, 'indrajit@gmail.com', 'this a testing message...');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `division`, `district`) VALUES
(1, 'abdmgalib', 'abdmgalib2001@gmail.com', '$2y$10$yAH4x1aoySRSE85HDpyDje5v/NbdA5zYqeSt4g2ercjiW9SDSSZwy', 'Chittagong', 'Chattogram'),
(2, 'abdmgalib', 'galib@gmail.com', '$2y$10$ASFPyW1CQnXAYDNng4wchO0NmEgfqZryD7NhxwWq.a/6KhMycRfae', 'Chittagong', 'Chattogram');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartment_details`
--
ALTER TABLE `apartment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_message`
--
ALTER TABLE `contact_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `apartment_details`
--
ALTER TABLE `apartment_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_message`
--
ALTER TABLE `contact_message`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
