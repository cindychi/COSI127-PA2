-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 12:49 AM
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
-- Database: `cosi127_pa1.2`
--

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE `award` (
  `mpid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `award_name` varchar(255) NOT NULL,
  `award_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `award`
--

INSERT INTO `award` (`mpid`, `pid`, `award_name`, `award_year`) VALUES
(1, 1, 'Academy Award for Best Actor', 1973),
(2, 2, 'Academy Award for Best Actor', 2016),
(3, 3, 'Academy Award for Best Actress', 2009);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `mpid` int(11) NOT NULL,
  `genre_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`mpid`, `genre_name`) VALUES
(1, 'Crime'),
(2, 'Sci-Fi'),
(3, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `uemail` varchar(255) NOT NULL,
  `mpid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`uemail`, `mpid`) VALUES
('user1@example.com', 1),
('user1@example.com', 2),
('user2@example.com', 3),
('user3@example.com', 1),
('user3@example.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `mpid` int(11) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`mpid`, `zip`, `city`, `country`) VALUES
(1, '10001', 'New York City', 'USA'),
(2, '90001', 'Los Angeles', 'USA'),
(3, '90210', 'Beverly Hills', 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `motionpicture`
--

CREATE TABLE `motionpicture` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `production` varchar(255) DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motionpicture`
--

INSERT INTO `motionpicture` (`id`, `name`, `rating`, `production`, `budget`) VALUES
(1, 'The Godfather', 9.2, 'Paramount Pictures', 6000000.00),
(2, 'Inception', 8.9, 'Warner Bros.', 160000000.00),
(3, 'Titanic', 8, '20th Century Fox', 200000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `mpid` int(11) NOT NULL,
  `boxoffice_collection` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`mpid`, `boxoffice_collection`) VALUES
(1, 1342456789.00),
(2, 825532764.00),
(3, 218746394.00);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `nationality`, `dob`, `gender`) VALUES
(1, 'Marlon Brando', 'American', '1924-04-03', 'M'),
(2, 'Leonardo DiCaprio', 'American', '1974-11-11', 'M'),
(3, 'Kate Winslet', 'British', '1975-10-05', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `mpid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`mpid`, `pid`, `role_name`) VALUES
(1, 1, 'Actor'),
(2, 2, 'director'),
(3, 3, 'producer');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `mpid` int(11) NOT NULL,
  `season_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`mpid`, `season_count`) VALUES
(1, 8),
(2, 6),
(3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `age`) VALUES
('user1@example.com', 'John Doe', 25),
('user2@example.com', 'Jane Smith', 30),
('user3@example.com', 'Michael Johnson', 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`mpid`,`pid`,`award_name`,`award_year`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`mpid`,`genre_name`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`uemail`,`mpid`),
  ADD KEY `mpid` (`mpid`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`mpid`,`zip`);

--
-- Indexes for table `motionpicture`
--
ALTER TABLE `motionpicture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mpid`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`mpid`,`pid`,`role_name`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`mpid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `award`
--
ALTER TABLE `award`
  ADD CONSTRAINT `award_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`),
  ADD CONSTRAINT `award_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `people` (`id`);

--
-- Constraints for table `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`uemail`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`);

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`);

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`),
  ADD CONSTRAINT `role_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `people` (`id`);

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
