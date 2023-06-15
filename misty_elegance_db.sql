-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2020 at 08:48 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `misty_elegance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `bed_id` int(5) NOT NULL,
  `bed_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id(nic)` varchar(20) NOT NULL,
  `cus_fname` varchar(200) NOT NULL,
  `cus_lname` varchar(200) NOT NULL,
  `cus_dob` date NOT NULL,
  `cus_tel` varchar(20) NOT NULL,
  `cus_email` varchar(200) NOT NULL,
  `cus_status` tinyint(1) NOT NULL,
  `cus_country` varchar(100) NOT NULL,
  `cus_gender` varchar(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cus_login`
--

CREATE TABLE `cus_login` (
  `cus_id(nic)` varchar(20) NOT NULL,
  `cus_username` varchar(50) NOT NULL,
  `cus_pw` text NOT NULL,
  `cus_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `desig_id` int(5) NOT NULL,
  `desig_Title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`desig_id`, `desig_Title`) VALUES
(1, 'Owner'),
(2, 'Manager'),
(3, 'receptionist'),
(4, 'chef'),
(5, 'House keeper'),
(6, 'waiters');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(5) NOT NULL,
  `emp_email` varchar(200) NOT NULL,
  `emp_fname` varchar(200) NOT NULL,
  `emp_lname` varchar(200) NOT NULL,
  `emp_address` text NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_nic` varchar(20) NOT NULL,
  `emp_Tel` varchar(12) NOT NULL,
  `emp_gender` varchar(10) NOT NULL,
  `desig_id` int(5) NOT NULL,
  `emp_image` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_email`, `emp_fname`, `emp_lname`, `emp_address`, `emp_dob`, `emp_nic`, `emp_Tel`, `emp_gender`, `desig_id`, `emp_image`, `is_deleted`) VALUES
(1, 'sandaruwani@gmail.com', 'Sandaruwani', 'Wijesuriya', 'No 472/101, Suriya mw, Koswatte, Battaramulla.', '1996-07-14', '966960760V', '0766538726', 'Female', 1, '1.jpg', 0),
(2, 'aminda@yahoo.com', 'Aminda', 'Devashini', 'Piliyandala rd, Maharagama', '1996-05-22', '966965765V', '0711111111', 'Female', 2, '', 0),
(3, 'abc@gmail.com', 'ab', 'abc', 'cndbcufavjkjsbv adf', '1990-03-21', '12637484848v', '23764725439', 'Female', 4, '', 0),
(4, 'cde@yahoo.com', 'cd', 'cde', 'djnvjajdijoisdc', '2001-02-25', '2634398724837v', '23865236501', 'male', 5, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_and_ratings`
--

CREATE TABLE `feedback_and_ratings` (
  `feedback_id` int(5) NOT NULL,
  `cus_id(nic)` varchar(20) NOT NULL,
  `pkg_id` int(5) NOT NULL,
  `rating` int(1) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(5) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `food_cat_id` int(5) NOT NULL,
  `food_price` int(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_cat`
--

CREATE TABLE `food_cat` (
  `food_cat_id` int(5) NOT NULL,
  `food_cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_reservation`
--

CREATE TABLE `food_reservation` (
  `food_res_id` int(5) NOT NULL,
  `food_id` int(5) NOT NULL,
  `price` int(11) NOT NULL,
  `res_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` int(5) NOT NULL,
  `module_name` varchar(200) NOT NULL,
  `module_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `module_icon`) VALUES
(1, 'rest. & room service', 'fa-cutlery'),
(2, 'reservation', 'fa-calendar'),
(3, 'user', 'fa-user'),
(4, 'payment', 'fa-money'),
(5, 'package', 'fa-suitcase'),
(6, 'room', 'fa-hospital-o'),
(7, 'customer', 'fa-users'),
(8, 'employee', 'fa-gears'),
(9, 'feedback', 'fa-comments'),
(10, 'report', 'fa-book');

-- --------------------------------------------------------

--
-- Table structure for table `module_designation`
--

CREATE TABLE `module_designation` (
  `mod_desig_id` int(5) NOT NULL,
  `desig_id` int(5) NOT NULL,
  `module_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_designation`
--

INSERT INTO `module_designation` (`mod_desig_id`, `desig_id`, `module_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 2, 1),
(12, 2, 2),
(13, 2, 4),
(14, 2, 5),
(15, 2, 6),
(16, 2, 7),
(17, 2, 8),
(18, 2, 9),
(19, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `pkg_id` int(5) NOT NULL,
  `pkg_name` varchar(200) NOT NULL,
  `pkg_cat_id` int(5) NOT NULL,
  `no_of_adults` int(2) NOT NULL,
  `no_of_children` int(2) NOT NULL,
  `rate_per_night` int(5) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `discount_rate` int(3) NOT NULL,
  `discount_from` date NOT NULL,
  `discount_until` date NOT NULL,
  `bed_id` int(5) NOT NULL,
  `pkg_des` text NOT NULL,
  `no_of_bed` int(2) NOT NULL,
  `size_of_rooms` int(4) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_cat`
--

CREATE TABLE `package_cat` (
  `pkg_cat_id` int(5) NOT NULL,
  `pkg_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(5) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` int(5) NOT NULL,
  `payement_time` time NOT NULL,
  `res_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `res_id` int(5) NOT NULL,
  `res_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `leaving_date` date NOT NULL,
  `no_of_adults` int(2) NOT NULL,
  `no_of_children` int(2) NOT NULL,
  `cus_id(nic)` varchar(20) NOT NULL,
  `res_status` tinyint(1) NOT NULL,
  `room_id` int(5) NOT NULL,
  `res_amount` int(5) NOT NULL,
  `full_payment_amount` int(5) DEFAULT NULL,
  `is_cancelled_by` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(5) NOT NULL,
  `room_no` varchar(5) NOT NULL,
  `room_status` tinyint(1) NOT NULL,
  `pkg_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_pw` text NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `emp_id` int(5) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pw`, `user_status`, `emp_id`, `is_deleted`) VALUES
(1, 'sandaruwani', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1, 0),
(2, 'aminda', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 2, 0),
(3, 'aaa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 3, 1),
(4, 'bb', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`bed_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id(nic)`),
  ADD UNIQUE KEY `cus_id(nic)` (`cus_id(nic)`),
  ADD UNIQUE KEY `cus_email` (`cus_email`);

--
-- Indexes for table `cus_login`
--
ALTER TABLE `cus_login`
  ADD PRIMARY KEY (`cus_id(nic)`),
  ADD UNIQUE KEY `Cus_username` (`cus_username`),
  ADD UNIQUE KEY `Cus_username_2` (`cus_username`),
  ADD UNIQUE KEY `Cus_username_3` (`cus_username`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`desig_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_email` (`emp_email`),
  ADD KEY `Emp_NIC` (`emp_nic`),
  ADD KEY `Desig_id` (`desig_id`);

--
-- Indexes for table `feedback_and_ratings`
--
ALTER TABLE `feedback_and_ratings`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `cus_id` (`cus_id(nic)`),
  ADD KEY `pkg_id` (`pkg_id`),
  ADD KEY `pkg_id_2` (`pkg_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `food_cat`
--
ALTER TABLE `food_cat`
  ADD PRIMARY KEY (`food_cat_id`);

--
-- Indexes for table `food_reservation`
--
ALTER TABLE `food_reservation`
  ADD PRIMARY KEY (`food_res_id`),
  ADD KEY `res_id` (`res_id`),
  ADD KEY `res_id_2` (`res_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `module_designation`
--
ALTER TABLE `module_designation`
  ADD PRIMARY KEY (`mod_desig_id`),
  ADD KEY `Desig_id` (`desig_id`),
  ADD KEY `Module_id` (`module_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`pkg_id`),
  ADD KEY `pkg_cat_id` (`pkg_cat_id`),
  ADD KEY `bed_id` (`bed_id`);

--
-- Indexes for table `package_cat`
--
ALTER TABLE `package_cat`
  ADD PRIMARY KEY (`pkg_cat_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `cus_id(nic)` (`cus_id(nic)`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `is_cancelled_by` (`is_cancelled_by`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `pkg_id` (`pkg_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `Emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `bed_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `desig_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `feedback_and_ratings`
--
ALTER TABLE `feedback_and_ratings`
  MODIFY `feedback_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `food_cat`
--
ALTER TABLE `food_cat`
  MODIFY `food_cat_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `food_reservation`
--
ALTER TABLE `food_reservation`
  MODIFY `food_res_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `module_designation`
--
ALTER TABLE `module_designation`
  MODIFY `mod_desig_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `package_cat`
--
ALTER TABLE `package_cat`
  MODIFY `pkg_cat_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `res_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`cus_id(nic)`) REFERENCES `feedback_and_ratings` (`cus_id(nic)`);

--
-- Constraints for table `cus_login`
--
ALTER TABLE `cus_login`
  ADD CONSTRAINT `cus_login_ibfk_1` FOREIGN KEY (`cus_id(nic)`) REFERENCES `customer` (`cus_id(nic)`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`desig_id`) REFERENCES `designation` (`Desig_id`);

--
-- Constraints for table `feedback_and_ratings`
--
ALTER TABLE `feedback_and_ratings`
  ADD CONSTRAINT `feedback_and_ratings_ibfk_1` FOREIGN KEY (`cus_id(nic)`) REFERENCES `customer` (`cus_id(nic)`),
  ADD CONSTRAINT `feedback_and_ratings_ibfk_2` FOREIGN KEY (`pkg_id`) REFERENCES `packages` (`pkg_id`);

--
-- Constraints for table `food_reservation`
--
ALTER TABLE `food_reservation`
  ADD CONSTRAINT `food_reservation_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`),
  ADD CONSTRAINT `food_reservation_ibfk_2` FOREIGN KEY (`res_id`) REFERENCES `reservation` (`res_id`);

--
-- Constraints for table `module_designation`
--
ALTER TABLE `module_designation`
  ADD CONSTRAINT `module_designation_ibfk_1` FOREIGN KEY (`desig_id`) REFERENCES `designation` (`desig_id`),
  ADD CONSTRAINT `module_designation_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`Module_id`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`pkg_cat_id`) REFERENCES `package_cat` (`pkg_cat_id`),
  ADD CONSTRAINT `packages_ibfk_2` FOREIGN KEY (`bed_id`) REFERENCES `bed` (`bed_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `reservation` (`res_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`cus_id(nic)`) REFERENCES `customer` (`cus_id(nic)`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`is_cancelled_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`pkg_id`) REFERENCES `packages` (`pkg_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
