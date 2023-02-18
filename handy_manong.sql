-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2023 at 05:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handy_manong`
--

-- --------------------------------------------------------

--
-- Table structure for table `messaging`
--

CREATE TABLE `messaging` (
  `id` int(128) NOT NULL,
  `user_id` int(128) DEFAULT NULL,
  `msg_content` varchar(128) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp(),
  `task_id` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finder`
--

CREATE TABLE `tbl_finder` (
  `finder_id` int(128) NOT NULL,
  `finder_name` varchar(128) NOT NULL,
  `finder_email` varchar(128) NOT NULL,
  `finder_password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_finder`
--

INSERT INTO `tbl_finder` (`finder_id`, `finder_name`, `finder_email`, `finder_password`) VALUES
(1, 'Myk', 'caipower09@gmail.com', '$2y$10$KW.8tCEPy.w6SwHh/03Mq.JzOsLHV2Rqg9M6s1YSXI2yh1q31T.HC'),
(2, 'Myk', 'rapidstrike13@gmail.com', '$2y$10$jTufZC60BR9fpeGYQrTev.oV/cMOOzX4fLXyqRti6d5sQ71yV45ma'),
(3, 'Test Finder', 'mali@gmail.com', '$2y$10$Cf57wNZGQpiV2iy.4VrMX.DkX9.0cvGkq0nUcW8MQseeUMpzHc83O');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_provider`
--

CREATE TABLE `tbl_provider` (
  `id` int(128) NOT NULL,
  `prov_firstname` varchar(128) NOT NULL,
  `prov_lastname` varchar(128) NOT NULL,
  `prov_bio` varchar(128) NOT NULL DEFAULT 'No bio.',
  `prov_category` varchar(128) NOT NULL,
  `prov_password` varchar(128) NOT NULL,
  `prov_email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_provider`
--

INSERT INTO `tbl_provider` (`id`, `prov_firstname`, `prov_lastname`, `prov_bio`, `prov_category`, `prov_password`, `prov_email`) VALUES
(2, 'test', 'Burgos', 'No bio.', 'Carpenter', '$2y$10$2zkffBwll4.Yp4EPK1H4RO2EO6VTQe4enxxqktcRRrhnO20rV9Lq.', 'escalamykkenneth@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `id` int(128) NOT NULL,
  `task_finder` varchar(128) NOT NULL,
  `task_category` varchar(128) NOT NULL,
  `task_status` varchar(128) NOT NULL DEFAULT 'Pending',
  `task_desc` varchar(128) NOT NULL,
  `task_provider` int(128) DEFAULT NULL,
  `task_date` date NOT NULL DEFAULT current_timestamp(),
  `task_location` varchar(128) NOT NULL,
  `task_title` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`id`, `task_finder`, `task_category`, `task_status`, `task_desc`, `task_provider`, `task_date`, `task_location`, `task_title`) VALUES
(1, '1', 'Carpenter', 'Pending', 'I need help with my staircase\r\n\r\nHeres my contact info\r\n09123123994', NULL, '2023-02-12', 'Cabcaben', 'Need help stair project'),
(2, '1', 'Electrician', 'Pending', 'Need help with our breaker\r\n\r\nHere\'s my contact email\r\ntest@gmail.com', NULL, '2023-02-12', 'Tesda', 'House wirings help'),
(3, '3', 'Carpenter,Plumber', 'Pending', 'Need help with my drain\r\n\r\nContact details\r\n901231234\r\nmali@gmail.com\r\n\r\nSalary\r\n$300-$400', NULL, '2023-02-16', 'Mariveles', 'Help with plumbing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messaging`
--
ALTER TABLE `messaging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_finder`
--
ALTER TABLE `tbl_finder`
  ADD PRIMARY KEY (`finder_id`);

--
-- Indexes for table `tbl_provider`
--
ALTER TABLE `tbl_provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messaging`
--
ALTER TABLE `messaging`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_finder`
--
ALTER TABLE `tbl_finder`
  MODIFY `finder_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_provider`
--
ALTER TABLE `tbl_provider`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
