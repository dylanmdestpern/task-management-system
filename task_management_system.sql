-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2018 at 01:35 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `teaminfo`
--

CREATE TABLE `teaminfo` (
  `id` int(11) UNSIGNED NOT NULL,
  `teamName` varchar(16) NOT NULL,
  `teamDescription` varchar(64) DEFAULT NULL,
  `teamImageUrl` varchar(64) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teaminfo`
--

INSERT INTO `teaminfo` (`id`, `teamName`, `teamDescription`, `teamImageUrl`, `dateCreated`) VALUES
(1, 'Go4 Software', 'Sofware development team out of bloemfontein', NULL, '2018-04-18 18:51:48'),
(2, 'Topsure', 'Insurance broker team out of bloemfontein', NULL, '2018-04-18 18:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `teamusers`
--

CREATE TABLE `teamusers` (
  `id` int(11) UNSIGNED NOT NULL,
  `teamId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teamusers`
--

INSERT INTO `teamusers` (`id`, `teamId`, `userId`) VALUES
(1, 1, 1),
(2, 1, 15),
(3, 2, 1),
(4, 2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `userpasswords`
--

CREATE TABLE `userpasswords` (
  `id` int(11) UNSIGNED NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `userID` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userpasswords`
--

INSERT INTO `userpasswords` (`id`, `password`, `userID`) VALUES
(4, '$2y$10$Kit5tweq0WM2CiqDyuLEqenLru/VN1gYN0l9oTXJcB.G/SP6ZP2R.', 15),
(5, '$2y$10$J9kKc1GSApyxR/Hf7xzqfuvsmJcTTd1TC9C55xeufhKLo0t5WiAyq', 1),
(6, '$2y$10$aYE49LZdBsbG7y2H0fd6cOsm0U8DlY0XUF84DNB0.RSsSD2xxkJfq', 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `user_role` enum('admin','user') DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `first_name`, `last_name`, `user_role`, `active`) VALUES
(1, 'dylan', 'dylan@go4software.co.za', 'Dylan', 'de St Pern', 'admin', 1),
(15, 'dylanmdestpern', 'dylanmdestpern@gmail.com', 'Dylan', 'de St Pern', 'user', 1),
(16, 'dylanmdestpern2', 'dylann@gmail.com', 'Dylan', 'de St Pern', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teaminfo`
--
ALTER TABLE `teaminfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teamusers`
--
ALTER TABLE `teamusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userpasswords`
--
ALTER TABLE `userpasswords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teaminfo`
--
ALTER TABLE `teaminfo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teamusers`
--
ALTER TABLE `teamusers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userpasswords`
--
ALTER TABLE `userpasswords`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
