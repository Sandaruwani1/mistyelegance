-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2021 at 05:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`bed_id`, `bed_type`) VALUES
(1, 'single'),
(2, 'Double'),
(3, 'Queen Size(Large Double)'),
(4, 'king Size(Extra Large Double)');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` varchar(20) NOT NULL,
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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_fname`, `cus_lname`, `cus_dob`, `cus_tel`, `cus_email`, `cus_status`, `cus_country`, `cus_gender`, `is_deleted`) VALUES
('099879760V', 'premaliee', 'wijeweera', '1961-09-06', '0773505135', 'premaliw@yahoo.com', 1, 'Sri Lanka', 'Female', 0),
('111111111111', 'Fleur', 'Smith', '1996-08-14', '0112222222', 'fleur@mailinator.com', 1, 'Canada', 'Male', 0),
('123123123123', 'Lilly', 'Buffy', '1997-02-24', '9615784787', 'Lilly@gmail.com', 1, 'Australia', 'Female', 0),
('123451234512345', 'Christian', 'Hadassah', '1987-07-09', '0774505145', 'daqequxulu@mailinator.com', 1, 'Spain', 'Male', 0),
('123456789012', 'Jared', 'Palmer', '1972-04-18', '0773405125', 'jared@mailinator.com', 1, 'Jamaica', 'Male', 1),
('265467887635', 'ranidu', 'Lankage', '1993-02-27', '0112789320', 'ranidu@yahoomail.com', 1, 'Sri lanka', 'Male', 0),
('456738987624', 'Justina', 'Randall', '1975-03-09', '0112345678', 'justina@mailinator.com', 1, 'England', 'Male', 1),
('491234567890', 'Amethyst', 'Fiona', '1979-09-10', '4456789034', 'dideridyce@mailinator.com', 1, 'germen', 'Female', 0),
('567567483984', 'Anjolie', 'Duncan', '1986-06-27', '1234567890', 'Anjolie@mailinator.com', 1, 'Australia', 'Female', 0),
('967840726V', 'Navoda', 'Perera', '1996-12-05', '0712152167', 'navoda@gmail.com', 1, 'Sri Lanka', 'Female', 0),
('967876547V', 'Kasuni', 'wijesekara', '1988-03-24', '7789876534', 'kasuni@gmail.com', 1, 'Sri Lanka', 'Female', 0),
('967887765V', 'Chamathka', 'Hewapathirana', '1996-10-03', '0717876543', 'chami@gmai.com', 1, 'Sri Lanka', 'Female', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cus_login`
--

CREATE TABLE `cus_login` (
  `cus_id` varchar(20) NOT NULL,
  `cus_username` varchar(50) NOT NULL,
  `cus_pw` text NOT NULL,
  `cus_status` tinyint(1) NOT NULL,
  `cus_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cus_login`
--

INSERT INTO `cus_login` (`cus_id`, `cus_username`, `cus_pw`, `cus_status`, `cus_image`) VALUES
('099879760V', 'premalie', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1, NULL),
('111111111111', 'fleur', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '111111111111.jpg');

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
  `emp_tel` varchar(12) NOT NULL,
  `emp_gender` varchar(10) NOT NULL,
  `desig_id` int(5) NOT NULL,
  `emp_image` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_email`, `emp_fname`, `emp_lname`, `emp_address`, `emp_dob`, `emp_nic`, `emp_tel`, `emp_gender`, `desig_id`, `emp_image`, `is_deleted`) VALUES
(1, 'sandaruwani@gmail.com', 'Sandaruwani', 'Wijesuriya', 'No 472/101, Suriya mw, Koswatte, Battaramulla.', '1996-07-14', '966960760V', '0766538726', 'Female', 1, '1.jpg', 0),
(2, 'aminda@yahoo.com', 'Aminda', 'Devashini', 'Piliyandala rd, Maharagama', '1996-05-22', '966965765V', '0711111111', 'Female', 2, '', 0),
(5, 'Hiruni@gmail.com', 'Hiruni', 'Dayawansa', 'sajxjbasbhxsbhxvvgs', '2002-05-29', '960345345V', '0112345567', 'Female', 3, '', 1),
(6, 'hyka@mailinator.com', 'Emerson', 'Ethan', 'Voluptas omnis eu do', '2001-04-04', '123123123121', '9090909090', 'Male', 6, '', 0),
(7, 'fonuho@mailinator.com', 'Saraa', 'pereraa', 'Mollit sit ipsum qu\"\"\"\"\"\"\"\"\"\"\"', '1992-01-06', '928373673V', '01123456765', 'Female', 3, '7.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_and_ratings`
--

CREATE TABLE `feedback_and_ratings` (
  `feedback_id` int(5) NOT NULL,
  `cus_id` varchar(20) NOT NULL,
  `pkg_id` int(5) NOT NULL,
  `rating` int(1) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_and_ratings`
--

INSERT INTO `feedback_and_ratings` (`feedback_id`, `cus_id`, `pkg_id`, `rating`, `feedback`) VALUES
(12, '111111111111', 1, 4, 'dtgrt'),
(19, '111111111111', 2, 4, 'good');

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

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_cat_id`, `food_price`, `is_deleted`) VALUES
(1, 'Rice', 1, 100, 0),
(2, 'String Hoppers', 1, 50, 0),
(3, 'Koththu', 1, 350, 0),
(4, 'koththu', 1, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_cat`
--

CREATE TABLE `food_cat` (
  `food_cat_id` int(5) NOT NULL,
  `food_cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_cat`
--

INSERT INTO `food_cat` (`food_cat_id`, `food_cat_name`) VALUES
(1, 'Sri Lankan'),
(2, 'Italian'),
(3, 'Beverages'),
(4, 'Liquor');

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

--
-- Dumping data for table `food_reservation`
--

INSERT INTO `food_reservation` (`food_res_id`, `food_id`, `price`, `res_id`) VALUES
(1, 3, 350, 18),
(2, 1, 100, 18),
(3, 1, 300, 18);

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
  `is_deleted` tinyint(1) NOT NULL,
  `services` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`pkg_id`, `pkg_name`, `pkg_cat_id`, `no_of_adults`, `no_of_children`, `rate_per_night`, `discount`, `discount_rate`, `discount_from`, `discount_until`, `bed_id`, `pkg_des`, `no_of_bed`, `size_of_rooms`, `is_deleted`, `services`) VALUES
(1, 'Deluxe Double Room with Balcony', 2, 2, 1, 42, '', 0, '0000-00-00', '0000-00-00', 3, 'This double room has a balcony.\r\nIn your private bathroom:\r\nFree toiletries\r\nBidet\r\nToilet\r\nBath or shower\r\nTowels\r\nHairdryer\r\nAdditional toilet\r\nToilet paper', 1, 50, 0, 'Upper floors accessible by stairs only\r\nLinen\r\nExtra long beds (> 2 metres)\r\nSoundproofing\r\nPrivate entrance\r\nIroning facilities\r\nIron\r\nFan\r\nCleaning products\r\nDesk\r\nSeating Area\r\nDining area\r\nBalcony\r\nOutdoor furniture\r\nOutdoor dining area\r\nSocket near the bed\r\nClothes rack\r\nWake-up service'),
(2, 'Deluxe Triple Room', 3, 3, 2, 65, '59', 10, '2021-01-28', '2021-02-01', 2, 'Garden view\r\nMountain view', 2, 50, 0, 'Upper floors accessible by stairs only\r\nLinen\r\nExtra long beds (> 2 metres)\r\nSoundproofing\r\nPrivate entrance\r\nIroning facilities\r\nIron\r\nFan\r\nCleaning products\r\nDesk\r\nSeating Area\r\nDining area\r\nBalcony\r\nOutdoor furniture\r\nOutdoor dining area\r\nSocket near the bed\r\nClothes rack\r\nWake-up service'),
(3, 'Deluxe Family Room', 4, 2, 2, 88, '0', 0, '0000-00-00', '0000-00-00', 4, 'Garden view\r\nMountain view', 2, 60, 0, 'Upper floors accessible by stairs only\r\nLinen\r\nExtra long beds (> 2 metres)\r\nSoundproofing\r\nPrivate entrance\r\nIroning facilities\r\nIron\r\nFan\r\nCleaning products\r\nDesk\r\nSeating Area\r\nDining area\r\nBalcony\r\nOutdoor furniture\r\nOutdoor dining area\r\nSocket near the bed\r\nClothes rack\r\nWake-up service'),
(4, 'single bed room', 1, 1, 1, 13, '12', 10, '2021-05-07', '2021-05-08', 1, 'bbvvvh', 1, 50, 0, 'ghvhjbnbb'),
(5, 'Deluxe Quadruple Room', 3, 3, 1, 40, '', 0, '0000-00-00', '0000-00-00', 3, 'This quadruple room features a balcony and view.', 2, 50, 0, 'Upper floors accessible by stairs only\r\nLinen\r\nExtra long beds (> 2 metres)\r\nSoundproofing\r\nPrivate entrance\r\nIroning facilities\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `package_cat`
--

CREATE TABLE `package_cat` (
  `pkg_cat_id` int(5) NOT NULL,
  `pkg_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_cat`
--

INSERT INTO `package_cat` (`pkg_cat_id`, `pkg_cat`) VALUES
(1, 'Single'),
(2, 'Double'),
(3, 'Triple'),
(4, 'Family');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(5) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` int(5) NOT NULL,
  `payment_time` time NOT NULL,
  `res_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_date`, `payment_amount`, `payment_time`, `res_id`) VALUES
(1, '2021-01-25', 146, '16:49:28', 1),
(2, '2021-01-26', 439, '12:04:40', 1),
(3, '2021-01-26', 11, '21:16:07', 2),
(4, '2020-01-06', 11, '18:32:47', 3),
(5, '2020-01-09', 31, '12:32:47', 3),
(6, '2020-02-14', 17, '18:48:11', 4),
(7, '2020-02-15', 48, '11:32:47', 4),
(8, '2020-03-05', 11, '18:57:35', 5),
(9, '2020-03-06', 31, '01:32:47', 5),
(10, '2020-04-14', 17, '19:07:44', 6),
(11, '2020-04-15', 48, '12:32:47', 6),
(12, '2020-05-11', 11, '19:15:42', 7),
(13, '2020-05-12', 54, '01:32:47', 7),
(14, '2020-06-17', 17, '19:18:03', 8),
(15, '2020-07-18', 48, '11:32:47', 8),
(16, '2020-07-09', 11, '19:43:45', 9),
(17, '2020-07-10', 31, '11:32:47', 9),
(18, '2020-08-23', 17, '19:46:16', 10),
(19, '2020-08-24', 48, '12:32:47', 10),
(20, '2020-11-10', 11, '18:32:47', 13),
(21, '2020-11-11', 48, '12:32:47', 13),
(22, '2020-09-08', 11, '18:32:47', 11),
(23, '2020-09-09', 31, '12:32:47', 11),
(24, '2020-10-03', 17, '18:57:35', 12),
(25, '2020-10-04', 54, '01:32:47', 12),
(26, '2020-12-05', 17, '19:18:03', 14),
(27, '2020-12-06', 48, '11:32:47', 14),
(28, '2021-04-19', 21, '10:36:17', 15),
(29, '2021-04-28', 11, '18:18:42', 16),
(30, '2021-04-28', 31, '18:19:45', 16),
(31, '2021-04-28', 16, '18:25:28', 17),
(32, '2021-04-28', 49, '18:25:56', 17),
(34, '2021-05-05', 132, '11:43:52', 18),
(35, '2021-05-06', 3, '22:04:38', 19);

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
  `cus_id` varchar(20) NOT NULL,
  `res_status` tinyint(1) NOT NULL,
  `room_id` int(5) NOT NULL,
  `res_amount` int(5) NOT NULL,
  `full_payment_amount` int(5) DEFAULT NULL,
  `is_cancelled_by` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`res_id`, `res_date`, `arrival_date`, `leaving_date`, `no_of_adults`, `no_of_children`, `cus_id`, `res_status`, `room_id`, `res_amount`, `full_payment_amount`, `is_cancelled_by`) VALUES
(1, '2021-01-25', '2021-01-27', '2021-02-05', 1, 1, '123123123123', 1, 2, 585, 585, NULL),
(2, '2021-01-26', '2021-01-27', '2021-01-28', 1, 1, '123456789012', 1, 1, 42, NULL, NULL),
(3, '2020-01-06', '2020-01-08', '2020-01-09', 1, 0, '967840726V', 1, 1, 42, 42, NULL),
(4, '2020-02-05', '2020-02-14', '2020-02-15', 1, 0, '265467887635', 1, 2, 17, 65, NULL),
(5, '2020-03-04', '2020-03-05', '2020-03-06', 1, 0, '123123123123', 1, 1, 11, 42, NULL),
(6, '2020-04-05', '2020-04-14', '2020-04-15', 1, 0, '967887765V', 1, 2, 17, 65, NULL),
(7, '2020-05-01', '2021-05-11', '2020-05-12', 1, 0, '111111111111', 1, 1, 11, 65, NULL),
(8, '2020-06-02', '2020-06-17', '2020-06-18', 1, 0, '456738987624', 1, 2, 17, 65, NULL),
(9, '2020-07-08', '2020-07-09', '2020-07-10', 1, 0, '265467887635', 1, 1, 11, 42, NULL),
(10, '2020-08-05', '2020-08-23', '2020-08-24', 1, 0, '967876547V', 1, 2, 17, 65, NULL),
(11, '2020-09-08', '2020-09-08', '2020-09-09', 1, 0, '567567483984', 1, 1, 11, 42, NULL),
(12, '2020-10-03', '2020-10-03', '2020-10-04', 1, 0, '123123123123', 1, 2, 17, 65, NULL),
(13, '2020-11-10', '2020-11-10', '2020-11-12', 1, 0, '123456789012', 1, 1, 11, 42, NULL),
(14, '2020-12-05', '2020-12-05', '2020-12-06', 1, 0, '967876547V', 1, 2, 17, 65, NULL),
(15, '2021-04-19', '2021-04-20', '2021-04-22', 1, 0, '111111111111', 1, 1, 84, NULL, NULL),
(16, '2021-04-28', '2021-04-29', '2021-04-30', 1, 0, '111111111111', 1, 1, 42, 42, NULL),
(17, '2021-04-28', '2021-05-07', '2021-05-08', 1, 0, '111111111111', 1, 2, 65, 65, NULL),
(18, '2021-05-05', '2021-05-05', '2021-05-11', 1, 0, '111111111111', 1, 3, 528, NULL, NULL),
(19, '2021-05-06', '2021-05-07', '2021-05-08', 1, 0, '967887765V', 1, 4, 12, NULL, NULL);

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

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_no`, `room_status`, `pkg_id`) VALUES
(1, 'R001', 1, 1),
(2, 'R002', 1, 2),
(3, 'R003', 1, 3),
(4, 'R004', 1, 4),
(5, 'R005', 1, 5),
(6, 'R006', 1, 3),
(7, 'R007', 1, 4);

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
(2, 'aminda', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1, 2, 0),
(5, 'hiru', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', 0, 5, 1),
(6, 'emersons', '7c222fb2927d828af22f592134e8932480637c0d', 0, 6, 0);

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
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `cus_email` (`cus_email`);

--
-- Indexes for table `cus_login`
--
ALTER TABLE `cus_login`
  ADD PRIMARY KEY (`cus_id`),
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
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `pkg_id` (`pkg_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `food_cat_id` (`food_cat_id`);

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
  ADD KEY `cus_id(nic)` (`cus_id`),
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
  MODIFY `bed_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `desig_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback_and_ratings`
--
ALTER TABLE `feedback_and_ratings`
  MODIFY `feedback_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_cat`
--
ALTER TABLE `food_cat`
  MODIFY `food_cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_reservation`
--
ALTER TABLE `food_reservation`
  MODIFY `food_res_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `pkg_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_cat`
--
ALTER TABLE `package_cat`
  MODIFY `pkg_cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `res_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cus_login`
--
ALTER TABLE `cus_login`
  ADD CONSTRAINT `cus_login_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`desig_id`) REFERENCES `designation` (`desig_id`);

--
-- Constraints for table `feedback_and_ratings`
--
ALTER TABLE `feedback_and_ratings`
  ADD CONSTRAINT `feedback_and_ratings_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
  ADD CONSTRAINT `feedback_and_ratings_ibfk_2` FOREIGN KEY (`pkg_id`) REFERENCES `packages` (`pkg_id`);

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`food_cat_id`) REFERENCES `food_cat` (`food_cat_id`);

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
  ADD CONSTRAINT `module_designation_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`);

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
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
