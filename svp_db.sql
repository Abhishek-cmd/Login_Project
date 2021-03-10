-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 05:55 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `svp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_session`
--

CREATE TABLE `ci_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_session`
--

INSERT INTO `ci_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('q1d4ikrr6qovl2stldg9sscm58hj069o', '127.0.0.1', 1614320010, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343331393735323b),
('05o5f1k9gf7qdvch5ota6mud3bk54hs2', '127.0.0.1', 1615040437, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631353034303230313b),
('1qh36c18akbro21ur2lib0uinvse0s7d', '127.0.0.1', 1615351895, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631353335313839353b);

-- --------------------------------------------------------

--
-- Table structure for table `emp_details`
--

CREATE TABLE `emp_details` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_on` varchar(200) NOT NULL,
  `updated_on` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_details`
--

INSERT INTO `emp_details` (`id`, `name`, `salary`, `status`, `created_on`, `updated_on`) VALUES
(1, 'rammm', '500', '1', '', '2021-02-18 10:59:23'),
(2, 'shyam', '6000', '1', '', ''),
(3, 'tejas', '80009', '1', '', '2021-02-18 11:24:30'),
(4, 'ankita', '5666', '1', '', '2021-02-18 10:42:39'),
(5, 'teju', '7890', '1', '', ''),
(6, 'ghfhg', '464654', '1', '', ''),
(9, 'dalviii', '54555', '1', '', '2021-02-18 10:41:27'),
(10, 'Sanket', '10000000', '1', '2021-02-18 11:01:40', '2021-02-18 11:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `emp_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `status` enum('1','0','','') NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`emp_id`, `first_name`, `last_name`, `email`, `contact_no`, `password`, `status`, `created_on`, `updated_on`) VALUES
(1, 'Abhi', 'Dalvi', 'abhidalvi30@gmail.com', '8149167341', '123', '1', '2021-02-18 07:30:23', '0000-00-00 00:00:00'),
(2, 'dummy', 'dummy', 'dummy@gmail.com', '9260549793', 'e10adc3949ba59abbe56e057f20f883e', '1', '2021-02-18 10:04:54', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_session`
--
ALTER TABLE `ci_session`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `emp_details`
--
ALTER TABLE `emp_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_details`
--
ALTER TABLE `emp_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
