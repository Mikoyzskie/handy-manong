-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 08:18 AM
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
  `task_id` int(128) NOT NULL,
  `user_type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messaging`
--

INSERT INTO `messaging` (`id`, `user_id`, `msg_content`, `timestamp`, `task_id`, `user_type`) VALUES
(1, 1, 'test', '2023-02-27', 8, 'finder'),
(2, 1, 'test', '2023-02-27', 1, 'finder'),
(3, 2, 'test', '2023-02-27', 1, 'provider'),
(4, 3, 'hello', '2023-02-28', 1, 'provider'),
(5, 3, 'hello', '2023-02-28', 1, 'provider');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(128) NOT NULL,
  `task_id` int(128) NOT NULL,
  `prov_id` int(128) NOT NULL,
  `status` varchar(128) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `task_id`, `prov_id`, `status`) VALUES
(1, 4, 2, 'Pending'),
(2, 1, 2, 'Assigned'),
(3, 1, 3, 'Assigned'),
(4, 3, 2, 'Pending'),
(5, 10, 2, 'Pending'),
(6, 11, 2, 'Assigned');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finder`
--

CREATE TABLE `tbl_finder` (
  `finder_id` int(128) NOT NULL,
  `finder_name` varchar(128) NOT NULL,
  `finder_email` varchar(128) NOT NULL,
  `finder_password` varchar(128) NOT NULL,
  `avatar` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_finder`
--

INSERT INTO `tbl_finder` (`finder_id`, `finder_name`, `finder_email`, `finder_password`, `avatar`) VALUES
(1, 'Myk', 'caipower09@gmail.com', '$2y$10$KW.8tCEPy.w6SwHh/03Mq.JzOsLHV2Rqg9M6s1YSXI2yh1q31T.HC', 'team-1.jpg'),
(2, 'Myk', 'rapidstrike13@gmail.com', '$2y$10$jTufZC60BR9fpeGYQrTev.oV/cMOOzX4fLXyqRti6d5sQ71yV45ma', NULL),
(3, 'Test Finder', 'mali@gmail.com', '$2y$10$Cf57wNZGQpiV2iy.4VrMX.DkX9.0cvGkq0nUcW8MQseeUMpzHc83O', NULL),
(4, 'Mark', 'markescala69@gmail.com', '$2y$10$ih8LcoCIKS3oDG9G7vG3/ua1xn2pPTGyZJDMKQd4P9ZPc8MEE0xJi', NULL);

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
  `prov_email` varchar(128) NOT NULL,
  `avatar` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_provider`
--

INSERT INTO `tbl_provider` (`id`, `prov_firstname`, `prov_lastname`, `prov_bio`, `prov_category`, `prov_password`, `prov_email`, `avatar`) VALUES
(2, 'test', 'Burgos', 'No bio.', 'Carpenter', '$2y$10$2zkffBwll4.Yp4EPK1H4RO2EO6VTQe4enxxqktcRRrhnO20rV9Lq.', 'escalamykkenneth@gmail.com', 'team-1.jpg'),
(3, 'Liza', 'Soberano', 'No bio.', 'Carpenter', '$2y$10$1/xT9k84KBDfhhIGxiyWle9ErrX7XiHGpXCpSVkN1vjLeCtwCz9UG', 'liza@gmail.com', NULL);

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
(1, '1', 'Carpenter', 'Assigned', 'I need help with my staircase\r\n\r\nHeres my contact info\r\n09123123994', 3, '2023-02-12', 'Cabcaben', 'Need help stair project'),
(2, '1', 'Electrician', 'Pending', 'Need help with our breaker\r\n\r\nHere\'s my contact email\r\ntest@gmail.com', NULL, '2023-02-12', 'Tesda', 'House wirings help'),
(3, '3', 'Carpenter,Plumber', 'Pending', 'Need help with my drain\r\n\r\nContact details\r\n901231234\r\nmali@gmail.com\r\n\r\nSalary\r\n$300-$400', NULL, '2023-02-16', 'Mariveles', 'Help with plumbing'),
(4, '4', 'Carpenter,Electrician,Welder,Midwife', 'Pending', 'My lights are turning off automatically\r\n\r\nSalary\r\n$500-$600\r\n\r\nContact Details\r\n091234578\r\nmark69@gmail.com', NULL, '2023-02-18', 'Mariveles', 'Need Help with light bulb'),
(5, '1', 'Driver', 'Pending', 'sample 1', NULL, '2023-02-19', 'sample 1', 'sample 1'),
(6, '1', 'Glass Worker', 'Pending', 'sample 2', NULL, '2023-02-19', 'sample 2', 'sample 2'),
(7, '1', 'Welder', 'Pending', 'sample 3', NULL, '2023-02-19', 'sample 3', 'sample 3'),
(8, '1', 'Driver', 'Pending', 'sample 3', NULL, '2023-02-19', 'sample 3', 'sample 3'),
(11, '1', 'Carpenter', 'Assigned', 'new test', 2, '2023-03-02', 'new test', 'test new '),
(12, '1', 'Carpenter', 'Pending', 'carpenter', NULL, '2023-03-03', 'carpenter', 'carpenter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messaging`
--
ALTER TABLE `messaging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
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
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_finder`
--
ALTER TABLE `tbl_finder`
  MODIFY `finder_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_provider`
--
ALTER TABLE `tbl_provider`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
