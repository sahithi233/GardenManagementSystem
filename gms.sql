-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2024 at 06:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `asset` text NOT NULL,
  `supervisor` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset`, `supervisor`, `quantity`, `status`) VALUES
(9, 'pesticides', 'pavani', 46, 'approved'),
(20, 'pesticides', 'Elamaran', 23, 'approved'),
(24, 'Mowers', 'pavani', 68, 'approved'),
(26, 'scissors', 'sas', 4, 'approved'),
(27, 'spray', 'pavani', 50, 'approved'),
(29, 'Mowers', 'nisha', 63, ''),
(30, 'METALS', 'bhavana', 10, ''),
(31, 'scissors', 'sas', 4, 'approved'),
(32, 'scissors', 'pavani', 10, 'approved'),
(34, 'scissors', 'sah', 11, 'approved'),
(35, 'scissors', 'pavani', 10, 'approved'),
(36, 'scissors', 'pavani', 10, 'approved'),
(38, 'pesticides', 'pavani', 10, 'pending'),
(39, 'pesticides', 'pavani', 16, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `iii` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `task` text NOT NULL,
  `worker` varchar(20) NOT NULL,
  `supervisor` text NOT NULL,
  `manager` text NOT NULL,
  `date` date NOT NULL,
  `status` text NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `end_date` date NOT NULL DEFAULT current_timestamp(),
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`iii`, `job_id`, `task`, `worker`, `supervisor`, `manager`, `date`, `status`, `start_time`, `end_time`, `end_date`, `rating`) VALUES
(1, 91945, 'cleaning', 'radha', 'Elamaran', '', '0000-00-00', 'completed', '15:57:00', '10:17:11', '0000-00-00', 0),
(2, 91945, 'cleaning', 'leyla', 'Elamaran', '', '0000-00-00', 'completed', '15:57:00', '10:17:11', '0000-00-00', 0),
(3, 20499, 'cleaning', 'radha', 'Elamaran', '', '0000-00-00', 'completed', '15:57:00', '11:28:57', '0000-00-00', 0),
(4, 20499, 'cleaning', 'leyla', 'Elamaran', '', '2023-12-02', 'completed', '15:57:00', '11:28:57', '2023-12-05', 0),
(5, 88450, 'cleaning', 'radha', 'sas', '', '2023-12-05', 'completed', '15:57:00', '15:48:48', '2023-12-07', 5),
(6, 88450, 'cleaning', 'leyla', 'sas', '', '2023-12-05', 'completed', '15:57:00', '15:48:48', '2023-12-07', 5),
(7, 59538, 'cleaning', 'radha', 'pavani', '', '2023-11-03', 'completed', '15:57:00', '10:18:31', '2023-11-09', 0),
(8, 59538, 'cleaning', 'leyla', 'sah', '', '0000-00-00', 'completed', '15:57:00', '10:18:31', '2023-12-26', 0),
(9, 59538, 'cleaning', 'sara', 'pavani', '', '0000-00-00', 'completed', '15:57:00', '10:18:31', '2023-12-29', 0),
(10, 52447, 'Cleaning', 'karthik', 'pavani', 'surya', '2023-11-27', 'completed', '12:42:00', '16:05:16', '2023-12-07', 4),
(11, 52447, 'Cleaning', 'leyla', 'Elamaran', 'surya', '2023-11-27', 'completed', '12:42:00', '16:05:16', '2023-12-28', 4),
(12, 52447, 'Cleaning', 'lakshmi', 'pavani', 'surya', '2023-11-27', 'completed', '12:42:00', '16:05:16', '2023-12-31', 4),
(13, 21204, 'cleaning', 'radha', 'pavani', 'surya', '0000-00-00', 'completed', '15:57:00', '11:17:35', '0000-00-00', 0),
(14, 21204, 'cleaning', 'leyla', 'sas', 'surya', '0000-00-00', 'completed', '15:57:00', '11:17:35', '0000-00-00', 0),
(15, 21204, 'cleaning', 'sara', 'pavani', 'surya', '0000-00-00', 'completed', '15:57:00', '11:04:01', '0000-00-00', 4),
(16, 61400, 'cleaning', 'karthik', 'pavani', 'surya', '2023-12-09', 'completed', '14:32:00', '14:32:10', '2023-12-11', 4),
(17, 14557, 'watering', 'lakshmi', 'pavani', 'surya', '2023-12-12', 'completed', '12:51:00', '10:36:27', '0000-00-00', 0),
(18, 14557, 'watering', 'karthik', 'pavani', 'surya', '2023-12-12', 'completed', '12:51:00', '10:36:27', '0000-00-00', 0),
(19, 14557, 'watering', 'radha', 'pavani', 'surya', '2023-12-12', 'completed', '12:51:00', '10:36:27', '0000-00-00', 0),
(20, 20022, 'Watering', 'leyla', 'Elamaran', 'Elamaran', '2023-12-14', 'pending', '10:20:00', '00:00:00', '0000-00-00', 0),
(21, 20022, 'Watering', 'karthik', 'pavani', 'Elamaran', '2023-12-14', 'completed', '10:20:00', '11:14:04', '0000-00-00', 5),
(22, 92544, 'Maintenance', 'karthik', 'pavani', 'Elamaran', '2023-12-14', 'completed', '10:50:00', '07:14:42', '2023-12-18', 4),
(23, 92544, 'Maintenance', 'leyla', 'sas', 'Elamaran', '2023-12-14', 'completed', '10:50:00', '07:14:42', '2023-12-27', 0),
(24, 50825, 'Cutting', 'karthik', 'pavani', 'surya', '2023-12-15', 'completed', '14:59:00', '14:59:23', '0000-00-00', 4),
(25, 82968, 'Maintenance', 'sara', 'pavani', 'Elamaran', '2023-12-18', 'pending', '11:13:00', '00:00:00', '0000-00-00', 0),
(26, 82968, 'Maintenance', 'karthik', 'pavani', 'Elamaran', '2023-12-18', 'completed', '11:13:00', '11:15:11', '0000-00-00', 5),
(27, 82968, 'Maintenance', 'radha', 'pavani', 'Elamaran', '2023-12-18', 'pending', '11:13:00', '00:00:00', '0000-00-00', 0),
(28, 82968, 'Maintenance', 'lakshmi', 'pavani', 'Elamaran', '2023-12-25', 'completed', '11:13:00', '11:15:43', '0000-00-00', 5),
(29, 53555, 'Watering', 'sara', 'pavani', '', '2023-12-28', 'upcoming', '09:35:00', '00:00:00', '2023-12-28', 0),
(30, 94732, 'Maintenance', 'karthik', 'pavani', '', '2023-12-28', 'pending', '09:40:00', '10:44:32', '2023-12-28', 3),
(31, 94732, 'Maintenance', 'radha', 'pavani', '', '2023-12-28', 'pending', '09:40:00', '09:58:38', '2023-12-28', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `supervisor` text NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `supervisor`, `message`) VALUES
(1, '', 'clean the location'),
(2, 'pavani', 'clean the location'),
(3, '', 'clean the location'),
(4, '', 'clean the location'),
(5, '', 'clean the location'),
(6, '', 'clean the location'),
(7, '', 'clean the location'),
(8, '', 'clean the location'),
(9, '', 'clean the location'),
(10, 'Elamaran', 'clean the location'),
(11, 'sas', 'clean the location'),
(12, 'bhavana', 'clean the location'),
(13, 'Elamaran', 'planting to be done'),
(14, 'sas', 'planting to be done'),
(15, 'bhavana', 'planting to be done'),
(16, 'Elamaran', 'water all plants'),
(17, 'Elamaran', 'water all plants'),
(18, 'bhavana', 'clean the location'),
(19, 'Elamaran', 'clean the location'),
(20, 'pavani', 'hello'),
(21, 'Elamaran', 'hello'),
(22, 'Elamaran', 'hello'),
(23, 'Elamaran', 'hello'),
(24, 'sah', 'welcome'),
(26, 'Elamaran', 'work is incompete'),
(27, 'Elamaran', 'Complete The Work flow'),
(28, 'sah', 'come here rn');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(11) NOT NULL,
  `place_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `place_name`) VALUES
(1, 'location 1'),
(2, 'location 2'),
(13, 'Location 3'),
(14, 'Location 4'),
(15, 'Location 5'),
(16, 'location 6'),
(17, 'Location 7');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `Supervisor` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `timestamp` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `job_id`, `Supervisor`, `rating`, `timestamp`) VALUES
(1, 52447, 'radha', 3, '09:28:55'),
(2, 21204, 'radha', 4, '11:17:35'),
(4, 88450, 'leyla', 3, '13:46:45'),
(6, 21204, 'radha', 4, '13:50:24'),
(7, 21204, 'radha', 4, '14:44:37'),
(8, 14557, 'lakshmi', 4, '10:36:27'),
(9, 0, 'radhaa', 3, '10:39:31'),
(10, 1, 'radhaa', 3, '10:39:47'),
(11, 0, 'pavani', 3, '11:21:10'),
(12, 52447, 'pavani', 3, '11:21:40'),
(13, 21204, 'pavani', 4, '11:23:52'),
(14, 21204, 'pavani', 3, '11:26:12'),
(15, 61400, 'pavani', 4, '11:34:59'),
(16, 14557, 'pavani', 5, '11:39:56'),
(17, 50825, 'pavani', 5, '15:00:49'),
(18, 20022, 'pavani', 1, '10:54:31'),
(19, 82968, 'pavani', 4, '11:37:31'),
(20, 92544, 'pavani', 4, '11:39:35'),
(21, 20022, 'pavani', 4, '11:42:09'),
(22, 92544, 'pavani', 3, '11:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `task_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `task_name`) VALUES
(1, 'Cleaning'),
(2, 'Maintenance'),
(3, 'Planting'),
(4, 'Watering'),
(5, 'Topiary');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `manager` text NOT NULL,
  `name` varchar(40) NOT NULL,
  `location` varchar(40) NOT NULL,
  `workers` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `manager`, `name`, `location`, `workers`) VALUES
(9, '', 'pavani', 'location 6', 'lakshmi'),
(10, '', 'pavani', 'Location 4', 'karthik'),
(12, '', 'sah', 'location 1', 'sas'),
(13, '', 'sah', 'location 1', 'lakshmi'),
(14, '', 'sah', 'location 1', 'leyla'),
(17, 'surya', 'pavani', 'location 6', 'sara'),
(18, 'surya', 'pavani', 'location 6', 'radha'),
(19, 'surya', 'sas', 'Location 3', 'radhaa'),
(20, 'surya', 'sas', 'Location 3', 'lakshmi'),
(21, 'surya', 'sas', 'Location 3', 'sara'),
(22, 'surya', 'sas', 'Location 3', 'sas'),
(28, 'surya', 'nisha', 'Location 3', 'lakshmi'),
(29, 'surya', 'nisha', 'Location 3', 'sara'),
(30, 'surya', 'nisha', 'Location 3', 'radhaa'),
(31, 'surya', 'nisha', 'location 2', 'sara'),
(32, 'surya', 'nisha', 'location 2', 'sas'),
(33, 'surya', 'nisha', 'location 2', 'lakshmi'),
(34, 'surya', 'nisha', 'location 2', 'radhaa'),
(35, '', 'pavani', 'location 1', 'sara'),
(36, '', 'pavani', 'location 1', 'radha'),
(39, '', 'sah', 'location 2', 'john'),
(40, 'surya', 'nisha', 'location 2', 'David'),
(41, 'surya', 'nisha', 'location 2', 'bharath'),
(42, 'surya', 'Elamaran', 'Location 7', 'IndraSena');

-- --------------------------------------------------------

--
-- Table structure for table `tool`
--

CREATE TABLE `tool` (
  `tool_id` int(11) NOT NULL,
  `tool_name` text NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tool`
--

INSERT INTO `tool` (`tool_id`, `tool_name`, `quantity`) VALUES
(1, 'Scissors', 20),
(2, 'Sprinklers', 10),
(3, 'Mowers', 79),
(5, 'spray', 114),
(7, 'pesticides', 111),
(9, 'Leveler', 90),
(10, 'MachineLearning', 100),
(11, 'METALS', 70);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `role` text NOT NULL,
  `name` text NOT NULL,
  `dob` text NOT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL COMMENT 'active/deactive',
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Username`, `Password`, `role`, `name`, `dob`, `mobile_no`, `status`, `rating`) VALUES
(1, 'admin', '123', 'Admin', 'admin', '1997-11-16', '9876543210', 'Active', NULL),
(2, 'pavani', '123', 'Supervisor', 'pavani', '2016-02-11', '739676075', 'Active', 4),
(3, 'Manager', '123', 'Manager', 'Elamaran', '2014-02-07', '9856223144', 'Active', NULL),
(4, '', '', 'Worker', 'sara', '1996-01-01', '4236587453', 'Deactive', 4),
(5, '', '', 'Worker', 'radha', '1999-06-16', '9586321426', 'Active', 3),
(6, 'sah', '123', 'Supervisor', 'sah', '1997-11-09', '7396635719', 'Active', NULL),
(7, 'nisha', '123', 'Supervisor', 'nisha', '2020-06-24', '125225633', 'Active', NULL),
(8, 'sas', '123', 'Supervisor', 'sas', '0000-00-00', '7396635719', 'Deactive', 4),
(10, 'bha', '123', 'Supervisor', 'bhavana', '2020-03-05', '7396790780', 'Deactive', NULL),
(13, 'akshaya', '123', 'Supervisor\n', 'akshaya', '02-03-2004', '7396635719', 'Active', NULL),
(17, '123', '12345', 'Supervisor', 'madhan', '12-12-1212', '9809809809', 'Active', 4),
(20, '', '', 'Worker', 'lakshmi', '2023-05-11', '7387675698', 'Active', NULL),
(21, '', '123', 'Worker', 'sas', '2023-11-04', '0630251663', 'Active', 4),
(25, '', '123', 'Worker', 'leyla', '2023-11-15', '0739663571', 'Active', 5),
(26, '', '123', 'Worker', 'john', '2023-11-01', '7396635715', 'Active', NULL),
(27, '', '123', 'Worker', 'karthik', '3221-03-02', '6302516635', 'Active', 3),
(35, 'David', '12345', 'Worker', 'David', '21-02-1998', '9787765467', 'Active', NULL),
(36, 'Raj123', '12345', 'Manager', 'Raj', '2023-11-08', '38989631', 'Active', NULL),
(37, '', '', 'Worker', 'bharath', '', '9491922653', 'Active', NULL),
(38, 'swathi', '123', 'Worker', 'swathi', '2023-12-08', '01234567890', 'Active', NULL),
(39, 'Indra', '12345', 'Worker', 'IndraSena', '2003-03-02', '8989898989', 'Active', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`iii`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `tool`
--
ALTER TABLE `tool`
  ADD PRIMARY KEY (`tool_id`),
  ADD UNIQUE KEY `tool_name` (`tool_name`) USING HASH;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `iii` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tool`
--
ALTER TABLE `tool`
  MODIFY `tool_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
