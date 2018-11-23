-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2018 at 05:42 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskmanager_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL,
  `clickURL` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `notifSeen` tinyint(1) NOT NULL DEFAULT '0',
  `notifRead` tinyint(4) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taskcategories`
--

CREATE TABLE `taskcategories` (
  `id` int(11) UNSIGNED NOT NULL,
  `teamID` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskcategories`
--

INSERT INTO `taskcategories` (`id`, `teamID`, `name`, `description`) VALUES
(1, 1, 'Development', 'All development related stuff...'),
(2, 1, 'Bugs', 'All bugs here...');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `teamID` int(11) UNSIGNED NOT NULL,
  `assignerID` int(11) UNSIGNED NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoryID` int(11) UNSIGNED DEFAULT NULL,
  `taskHeading` varchar(255) NOT NULL,
  `taskDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `teamID`, `assignerID`, `timestamp`, `categoryID`, `taskHeading`, `taskDescription`) VALUES
(1, 1, 1, '2018-06-17 22:00:11', 1, 'Create new function', 'You must do <b>this</b> and <i>that</i>...'),
(2, 1, 15, '2018-06-20 21:54:51', 2, 'Make this website better', 'Seriously... you can do better.');

-- --------------------------------------------------------

--
-- Table structure for table `taskstatuses`
--

CREATE TABLE `taskstatuses` (
  `id` int(11) UNSIGNED NOT NULL,
  `taskID` int(11) UNSIGNED NOT NULL,
  `statusID` int(11) UNSIGNED NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` int(11) UNSIGNED NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskstatuses`
--

INSERT INTO `taskstatuses` (`id`, `taskID`, `statusID`, `timestamp`, `userID`, `active`) VALUES
(1, 1, 1, '2018-06-17 22:08:51', 15, 0),
(2, 1, 2, '2018-06-17 22:08:51', 1, 1),
(3, 1, 3, '2018-06-20 21:49:43', 15, 0),
(4, 2, 2, '2018-06-20 21:55:29', 15, 1),
(5, 2, 1, '2018-06-20 21:55:59', 1, 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teaminfo`
--

INSERT INTO `teaminfo` (`id`, `teamName`, `teamDescription`, `teamImageUrl`, `dateCreated`) VALUES
(1, 'Go4 Software', 'Sofware development team out of bloemfontein', NULL, '2018-04-18 18:51:48'),
(2, 'Topsure', 'Insurance broker team out of bloemfontein', NULL, '2018-04-18 18:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `teamstatuses`
--

CREATE TABLE `teamstatuses` (
  `id` int(11) UNSIGNED NOT NULL,
  `teamID` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teamstatuses`
--

INSERT INTO `teamstatuses` (`id`, `teamID`, `name`, `description`) VALUES
(1, 1, 'Assigned', 'Assigned to user'),
(2, 1, 'Completed', 'Completed by user'),
(3, 1, 'Backlog', 'These tasks are not important right now.');

-- --------------------------------------------------------

--
-- Table structure for table `teamusers`
--

CREATE TABLE `teamusers` (
  `id` int(11) UNSIGNED NOT NULL,
  `teamId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `role` enum('owner','admin','member') NOT NULL DEFAULT 'member'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teamusers`
--

INSERT INTO `teamusers` (`id`, `teamId`, `userId`, `role`) VALUES
(1, 1, 1, 'owner'),
(2, 1, 15, 'member'),
(3, 2, 1, 'admin'),
(4, 2, 16, 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `userpasswords`
--

CREATE TABLE `userpasswords` (
  `id` int(11) UNSIGNED NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `userID` int(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Indexes for table `taskcategories`
--
ALTER TABLE `taskcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taskstatuses`
--
ALTER TABLE `taskstatuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teaminfo`
--
ALTER TABLE `teaminfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teamstatuses`
--
ALTER TABLE `teamstatuses`
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
-- AUTO_INCREMENT for table `taskcategories`
--
ALTER TABLE `taskcategories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `taskstatuses`
--
ALTER TABLE `taskstatuses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `teaminfo`
--
ALTER TABLE `teaminfo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teamstatuses`
--
ALTER TABLE `teamstatuses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
