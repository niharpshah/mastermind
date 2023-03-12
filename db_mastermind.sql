-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2019 at 11:31 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_mastermind`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Login ID',
  `username` varchar(50) NOT NULL COMMENT 'Username',
  `password` varchar(50) NOT NULL COMMENT 'Password',
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Admin Login Table' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`login_id`, `username`, `password`) VALUES
(1, 'nihar', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cart_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Cart ID',
  `user_id` int(50) DEFAULT NULL COMMENT 'User ID',
  `product_id` int(50) DEFAULT NULL COMMENT 'Product ID',
  `qty` int(50) NOT NULL COMMENT 'Quantity',
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Cart Table' AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `user_id`, `product_id`, `qty`) VALUES
(15, 5, 38, 2),
(22, 4, 44, 1),
(26, 3, 38, 1),
(27, 3, 42, 1),
(28, 5, 38, 1),
(30, 1, 43, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cat_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Category Id',
  `cat_name` varchar(50) NOT NULL COMMENT 'Category Name',
  `cat_desc` text NOT NULL COMMENT 'Category Description',
  `cat_img` text NOT NULL COMMENT 'Category Image',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Category Table' AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `cat_desc`, `cat_img`) VALUES
(18, 'Cameras', 'security cameras', 'CategoryImage20170721093341.jpg'),
(19, 'Door Lock', 'Door lock with Security Feature', 'CategoryImage20170628074858.jpg'),
(20, 'Finger Print Scnner', 'Bio-metric Security ', 'CategoryImage20170704071636.jpeg'),
(21, 'Monitrr', 'All Companies ', 'CategoryImage20170723021422.jpg'),
(22, 'Doorbell', 'serg', 'CategoryImage20170810095152.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE IF NOT EXISTS `tbl_employee` (
  `emp_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Employee Id',
  `emp_name` varchar(50) NOT NULL COMMENT 'Emplyee name',
  `emp_contact` bigint(10) NOT NULL COMMENT 'Employee Contact == Username',
  `emp_pass` varchar(50) NOT NULL COMMENT 'Employee Password',
  `emp_img` text NOT NULL COMMENT 'Employee Profile Pic',
  `emp_email` varchar(50) NOT NULL COMMENT 'Employee Email Id ',
  `emp_address` text NOT NULL COMMENT 'Employee Address',
  `emp_block` varchar(11) NOT NULL COMMENT 'Block Employee',
  `otp_code` int(10) DEFAULT NULL COMMENT 'OTP CODE FOR FORGOT PAASWORD',
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Employee Table' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `emp_name`, `emp_contact`, `emp_pass`, `emp_img`, `emp_email`, `emp_address`, `emp_block`, `otp_code`) VALUES
(1, 'Nihar Shah', 9824155244, '123', 'EmployeeImage_20170811091749.jpg', 'niharshah1194@gmail.com', 'ghod dod road', 'No', 2463),
(3, 'Jemin', 7405374081, '120', 'EmployeeImage20170616084212.jpg', 'jems@gmail.com', 'Mithila', 'No', NULL),
(4, 'Ankit', 9662061933, '1205', 'EmployeeImage_20170616093754.jpg', 'ankit@gmail.com', 'Mumbai', 'No', NULL),
(8, 'Darshan', 1234567890, '41', 'EmployeeImage_20170617100425.jpg', 'darshan@gmail.com', 'adajan', 'NO', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE IF NOT EXISTS `tbl_log` (
  `log_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Log Id',
  `login_id` int(50) NOT NULL COMMENT 'Login ID from Admin Table',
  `datetime` datetime NOT NULL COMMENT 'Date and Time of User login',
  PRIMARY KEY (`log_id`),
  KEY `login_id` (`login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='User Login Date And Time ' AUTO_INCREMENT=123 ;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`log_id`, `login_id`, `datetime`) VALUES
(1, 1, '2017-06-13 12:12:35'),
(2, 1, '2017-06-13 12:17:45'),
(3, 1, '2017-06-13 12:18:32'),
(4, 1, '2017-06-13 12:31:37'),
(5, 1, '2017-06-13 13:53:10'),
(6, 1, '2017-06-13 13:53:40'),
(7, 1, '2017-06-13 16:34:07'),
(8, 1, '2017-06-14 08:54:32'),
(9, 1, '2017-06-14 10:41:40'),
(10, 1, '2017-06-14 12:04:28'),
(11, 1, '2017-06-14 16:22:19'),
(12, 1, '2017-06-14 16:49:15'),
(13, 1, '2017-06-14 19:38:33'),
(14, 1, '2017-06-15 08:20:22'),
(15, 1, '2017-06-15 10:31:37'),
(16, 1, '2017-06-15 17:37:34'),
(17, 1, '2017-06-16 08:49:55'),
(18, 1, '2017-06-16 10:52:03'),
(19, 1, '2017-06-17 13:27:29'),
(20, 1, '2017-06-18 12:52:29'),
(21, 1, '2017-06-19 10:47:50'),
(22, 1, '2017-06-20 07:54:00'),
(23, 1, '2017-06-20 10:48:15'),
(24, 1, '2017-06-21 08:07:51'),
(25, 1, '2017-06-21 13:06:28'),
(26, 1, '2017-06-25 20:20:35'),
(27, 1, '2017-06-26 19:04:28'),
(28, 1, '2017-06-27 10:57:46'),
(29, 1, '2017-06-28 11:09:43'),
(30, 1, '2017-06-28 13:38:33'),
(31, 1, '2017-06-28 18:03:38'),
(32, 1, '2017-06-29 15:08:58'),
(33, 1, '2017-06-30 01:58:22'),
(34, 1, '2017-06-30 11:39:08'),
(35, 1, '2017-06-30 16:16:38'),
(36, 1, '2017-07-01 07:59:06'),
(37, 1, '2017-07-02 12:51:09'),
(38, 1, '2017-07-03 10:46:33'),
(39, 1, '2017-07-03 10:51:52'),
(40, 1, '2017-07-03 19:25:22'),
(41, 1, '2017-07-03 21:54:52'),
(42, 1, '2017-07-04 10:45:24'),
(43, 1, '2017-07-04 11:06:40'),
(44, 1, '2017-07-04 12:24:17'),
(45, 1, '2017-07-04 15:14:54'),
(46, 1, '2017-07-04 19:57:13'),
(47, 1, '2017-07-04 20:14:44'),
(48, 1, '2017-07-05 09:32:19'),
(49, 1, '2017-07-05 11:02:31'),
(50, 1, '2017-07-06 10:47:38'),
(51, 1, '2017-07-07 10:52:01'),
(52, 1, '2017-07-08 14:35:14'),
(53, 1, '2017-07-08 15:27:19'),
(54, 1, '2017-07-10 10:58:34'),
(55, 1, '2017-07-10 19:34:27'),
(56, 1, '2017-07-11 20:48:44'),
(57, 1, '2017-07-11 20:50:07'),
(58, 1, '2017-07-11 20:50:52'),
(59, 1, '2017-07-13 11:07:05'),
(60, 1, '2017-07-13 19:44:16'),
(61, 1, '2017-07-17 11:09:05'),
(62, 1, '2017-07-17 14:16:01'),
(63, 1, '2017-07-18 12:54:46'),
(64, 1, '2017-07-19 20:32:54'),
(65, 1, '2017-07-20 10:46:44'),
(66, 1, '2017-07-20 11:07:07'),
(67, 1, '2017-07-21 11:46:10'),
(68, 1, '2017-07-21 13:33:30'),
(69, 1, '2017-07-21 15:23:35'),
(70, 1, '2017-07-23 16:51:42'),
(71, 1, '2017-07-23 17:43:04'),
(72, 1, '2017-07-24 11:18:21'),
(73, 1, '2017-07-24 11:50:43'),
(74, 1, '2017-07-24 14:17:56'),
(75, 1, '2017-07-25 10:39:23'),
(76, 1, '2017-07-26 14:40:51'),
(77, 1, '2017-07-28 11:34:32'),
(78, 1, '2017-07-30 10:57:16'),
(79, 1, '2017-07-30 11:47:41'),
(80, 1, '2017-07-31 11:01:40'),
(81, 1, '2017-07-31 11:28:08'),
(82, 1, '2017-07-31 13:53:19'),
(83, 1, '2017-07-31 19:32:03'),
(84, 1, '2017-08-01 11:07:23'),
(85, 1, '2017-08-03 10:54:38'),
(86, 1, '2017-08-08 07:56:15'),
(87, 1, '2017-08-08 11:06:54'),
(88, 1, '2017-08-08 13:37:54'),
(89, 1, '2017-08-09 12:38:57'),
(90, 1, '2017-08-09 13:43:02'),
(91, 1, '2017-08-10 13:20:17'),
(92, 1, '2017-08-11 12:32:55'),
(93, 1, '2017-08-16 12:00:26'),
(94, 1, '2017-08-16 17:50:31'),
(95, 1, '2017-08-16 17:52:46'),
(96, 1, '2017-08-16 17:55:52'),
(97, 1, '2017-08-16 22:43:54'),
(98, 1, '2017-08-17 11:22:55'),
(99, 1, '2017-08-18 10:59:25'),
(100, 1, '2017-08-18 13:57:33'),
(101, 1, '2017-08-19 07:51:08'),
(102, 1, '2017-08-19 11:33:27'),
(103, 1, '2017-08-20 09:03:02'),
(104, 1, '2017-08-20 09:58:52'),
(105, 1, '2017-08-20 10:01:34'),
(106, 1, '2017-08-21 09:09:36'),
(107, 1, '2017-08-22 10:59:50'),
(108, 1, '2017-08-23 10:48:31'),
(109, 1, '2017-08-24 11:09:45'),
(110, 1, '2017-08-24 12:28:41'),
(111, 1, '2017-08-24 12:51:33'),
(112, 1, '2017-08-24 13:41:19'),
(113, 1, '2017-08-25 11:43:18'),
(114, 1, '2017-08-25 11:50:24'),
(115, 1, '2017-08-26 09:20:38'),
(116, 1, '2017-08-26 12:55:40'),
(117, 1, '2017-08-27 19:16:04'),
(118, 1, '2017-08-29 11:20:22'),
(119, 1, '2017-08-30 11:41:12'),
(120, 1, '2017-09-05 19:25:20'),
(121, 1, '2019-08-31 13:09:17'),
(122, 1, '2019-11-15 11:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE IF NOT EXISTS `tbl_notifications` (
  `notification_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Notification Id',
  `ticket_id` int(50) DEFAULT NULL COMMENT 'Ticket Id',
  `order_id` int(50) DEFAULT NULL COMMENT 'Order Id',
  `date_time` datetime NOT NULL COMMENT 'Date and Time Of notification',
  PRIMARY KEY (`notification_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Notification For Admin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Order Id',
  `user_id` int(50) DEFAULT NULL COMMENT 'User Id',
  `order_date` date NOT NULL COMMENT 'Order Date',
  `address` text NOT NULL COMMENT 'Delivery Address Line 01',
  `pincode` int(11) NOT NULL COMMENT 'Delivery Pincode',
  `contact` bigint(11) NOT NULL COMMENT 'Contact Number',
  `status` varchar(50) NOT NULL COMMENT 'Order Status',
  `payment_type` varchar(50) NOT NULL COMMENT 'Payment Method',
  `is_pay` varchar(50) NOT NULL COMMENT 'Paid or Not',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `user_id`, `order_date`, `address`, `pincode`, `contact`, `status`, `payment_type`, `is_pay`) VALUES
(10, 2, '2017-07-26', 'A-901,Kakdia ', 395007, 2147483647, 'pending', 'COD', 'no'),
(12, 5, '2017-07-26', 'nbnm', 0, 2147483647, 'pending', 'payumoney', 'yes'),
(13, 3, '2017-07-27', 'fgfdersgrs', 0, 2147483647, 'pending', 'payumoney', 'yes'),
(15, 1, '2017-08-01', 'A-601, Kakadia ', 395007, 2147483647, 'pending', 'COD', 'no'),
(21, 1, '2017-08-02', 'A-152 Laxmi V', 395007, 2147483647, 'pending', 'COD', 'no'),
(23, 1, '2017-08-02', 'mara ghare', 454554, 2147483647, 'pending', 'payumoney', 'yes'),
(24, 1, '2017-08-02', 'ldmsllakdlsdslvc.v.c', 111111, 1111111111, 'pending', 'payumoney', 'yes'),
(26, 8, '2017-08-02', 'B-1001, Kakadia ', 395007, 2147483647, 'pending', 'payumoney', 'yes'),
(27, 1, '2017-08-26', 'dfgsedfsd', 121212, 2147483647, 'Pending', 'payumoney', 'yes'),
(28, 1, '2017-08-30', 'A-901, Kakadia Complex, Opp. Citi Bank, Ghod Dod Road, Surat.', 395007, 2147483647, 'Pending', 'payumoney', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_order_detail` (
  `order_detail_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Order Detail Id',
  `order_id` int(50) DEFAULT NULL COMMENT 'Order Id',
  `product_id` int(50) DEFAULT NULL COMMENT 'Product Id',
  `qty` int(50) NOT NULL COMMENT 'Quantity ',
  PRIMARY KEY (`order_detail_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Order''s Details' AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`order_detail_id`, `order_id`, `product_id`, `qty`) VALUES
(10, 10, 38, 2),
(12, 12, 41, 1),
(13, 13, 43, 3),
(15, 15, 50, 1),
(18, 21, 41, 2),
(20, 23, 38, 2),
(23, 26, 45, 2),
(24, 27, 39, 1),
(25, 28, 39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE IF NOT EXISTS `tbl_products` (
  `product_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Product Id',
  `subcat_id` int(50) NOT NULL COMMENT 'Sub Category Id',
  `product_name` varchar(50) NOT NULL COMMENT 'Product Namw',
  `description` text NOT NULL COMMENT 'Product Description',
  `prod_img1` text NOT NULL COMMENT 'Product Image 01',
  `prod_img2` text NOT NULL COMMENT 'Product Images 02',
  `prod_img3` text NOT NULL COMMENT 'Product Images 03',
  `instruction` text NOT NULL COMMENT 'Product Instruction',
  `product_code` varchar(100) NOT NULL COMMENT 'Product Code',
  `price` int(50) NOT NULL COMMENT 'Product Price',
  `availibility` text NOT NULL COMMENT 'Product Avaibility',
  `status` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `subcat_id` (`subcat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Product Table' AUTO_INCREMENT=60 ;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `subcat_id`, `product_name`, `description`, `prod_img1`, `prod_img2`, `prod_img3`, `instruction`, `product_code`, `price`, `availibility`, `status`) VALUES
(38, 10, 'CCD Cameras', 'A cameras have 720 HDrecorder and one of best selling product with Night Vision', 'ProductImage0120170628083343.jpg', 'ProductImage0220170628083343.jpg', 'ProductImage0320170628083343.jpg', '20170628083912MASTERMINDTECHNOLOGIES.pdf', '004', 12500, 'Yes', '1'),
(39, 10, 'Ocean CCTV Camera', 'A cameras have HD recorder and one of best selling product with Night Vision', 'ProductImage0120170628083847.jpg', 'ProductImage0220170628083847.jpg', 'ProductImage0320170628083847.jpg', '20170628083847MASTERMINDTECHNOLOGIES.pdf', '005', 10000, 'Yes', '1'),
(41, 10, 'Lorex Camera ', 'Lorex Cameras have HD recorder and one of best selling product with Night Vision', 'ProductImage0120170628085118.jpg', 'ProductImage0220170628085118.jpg', 'ProductImage0320170628085118.jpg', '20170628085118MASTERMINDTECHNOLOGIES.pdf', '006', 22999, 'No', '1'),
(42, 11, 'ZK Teco', 'Fingerprint Scanner With Card scanner as well as Password Protected With Log Register', 'ProductImage0120170628090523.jpg', 'ProductImage0220170628090523.png', 'ProductImage0320170628090523.jpg', '20170628090523MASTERMINDTECHNOLOGIES.pdf', '007', 12899, 'Yes', '1'),
(43, 13, 'CP VTA T2324 U', 'Bio-Metric Lock with Password Safety Fingerprint Time Attendance USB Flash Drive', 'ProductImage0120170628023847.jpg', 'ProductImage0220170628023847.jpg', 'ProductImage0320170628023847.jpg', '20170628023847CPVTAT2324U.pdf', '008', 15499, 'Yes', '1'),
(44, 13, 'CP VTA T2128 C', 'Fingerprint Access Control with fingerprint scanner and password', 'ProductImage0120170628024254.jpg', 'ProductImage0220170628024254.jpg', 'ProductImage0320170628024254.jpg', '201706280242541176d_CPVTAT2128C.pdf', '009', 14499, 'No', '1'),
(45, 13, 'CP VTA T2128 CR', 'Fingerprint Access Control with EM Card, Password, EM Card', 'ProductImage0120170628024459.jpg', 'ProductImage0220170628024459.jpg', 'ProductImage0320170721101925.jpg', '201707211026441177d_CP-VTA-T2128-CR.pdf', '010', 14500, 'Yes', '1'),
(50, 10, 'Hikvision DS-IR Night Vision', 'Image sensor - 1MP CMOS image sensor, signal system - PAL/NTSC,\n\n', 'ProductImage0120170808102102.jpg', 'ProductImage0220170808102102.jpg', 'ProductImage0320170808102102.jpg', '201708081021021177d_CP-VTA-T2128-CR.pdf', '5252', 1090, 'Yes', '1'),
(51, 11, 'Scanner White ', 'A door Lock with Finger Scanner Facility', 'ProductImage0120170809101510.jpeg', 'ProductImage0220170809101510.png', 'ProductImage0320170809101510.jpeg', '201708091015101176d_CP-VTA-T2128-C.pdf', '534', 999, 'Yes', '1'),
(52, 11, 'Advanced Door Lock', 'An Advanced Door Lock with Superb Features', 'ProductImage0120170809101708.jpg', 'ProductImage0220170809101708.jpg', 'ProductImage0320170809101708.jpg', '201708091017081177d_CP-VTA-T2128-CR.pdf', '799', 25000, 'Yes', '1'),
(59, 10, 'khjgfd', '56', 'ProductImage0120170820061046.jpg', 'ProductImage0220170820061046.jpg', 'ProductImage0320170820061046.jpg', '20170820061046CP-VTA-T2324-U.pdf', '0261', 2156, 'Yes', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE IF NOT EXISTS `tbl_rating` (
  `rating_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Rating id',
  `user_id` int(50) DEFAULT NULL COMMENT 'User Id',
  `product_id` int(50) DEFAULT NULL COMMENT 'Product Id',
  `messege` text NOT NULL COMMENT 'Message About product',
  `ratings` int(50) NOT NULL COMMENT 'Ratings about product',
  `date_time` datetime NOT NULL COMMENT 'Date And Time of Review',
  `status` varchar(50) NOT NULL COMMENT 'Status Of Showing Review',
  PRIMARY KEY (`rating_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Rating And Review Table' AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `user_id`, `product_id`, `messege`, `ratings`, `date_time`, `status`) VALUES
(21, 1, 50, 'dasaa', 4, '2017-08-08 14:32:04', 'No'),
(22, 1, 39, 'mast\r\n', 5, '2017-08-08 14:32:28', 'No'),
(23, 2, 50, 'Wah Wah Kya Baat Hai', 5, '2017-08-09 15:03:54', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE IF NOT EXISTS `tbl_subcategory` (
  `subcat_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Sub Category Id',
  `cat_id` int(50) DEFAULT NULL COMMENT 'category Id from Category Table',
  `subcat_name` varchar(50) NOT NULL COMMENT 'Sub Category Name',
  `subcat_desc` text NOT NULL COMMENT 'Sub Category Description',
  `subcat_img` text NOT NULL COMMENT 'Sub Category Image',
  PRIMARY KEY (`subcat_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Sub Category Table' AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcat_id`, `cat_id`, `subcat_name`, `subcat_desc`, `subcat_img`) VALUES
(10, 18, 'CCTV Cameras', 'CCTV cameras', 'Sub-CategoryImage20170628075507.jpg'),
(11, 19, 'biometric DoorLock', 'extra security To your Room', 'Sub-CategoryImage20170628075557.jpg'),
(13, 20, 'Bio-Metric', 'Finger Scanner', 'Sub-CategoryImage20170721103522.jpeg'),
(15, 21, 'ghfd', 'fgsh', 'Sub-CategoryImage20170820054135.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_switch`
--

CREATE TABLE IF NOT EXISTS `tbl_switch` (
  `switch_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Switch Id',
  `emp_id` int(50) DEFAULT NULL COMMENT 'Employee Id',
  `ticket_id` int(50) DEFAULT NULL COMMENT 'Ticket Id',
  `reason` text COMMENT 'Reason for Switch',
  `approve` varchar(50) NOT NULL COMMENT 'Request Approved or Not',
  `date` date NOT NULL COMMENT 'Switch Date',
  PRIMARY KEY (`switch_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Switch Table For Switch Tickets' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_switch`
--

INSERT INTO `tbl_switch` (`switch_id`, `emp_id`, `ticket_id`, `reason`, `approve`, `date`) VALUES
(1, 1, 43, 'Can Not Do', 'Yes', '2017-07-28'),
(2, 4, 45, 'Two Wires And Nuts Changed', 'Yes', '2017-07-28'),
(4, 1, 47, 'try karu chu bhai', 'Yes', '2017-08-08'),
(5, 1, 47, 'sasdsdsad', 'Yes', '2017-08-08'),
(8, 4, 48, 'ni fave', 'Yes', '2017-08-18'),
(9, 1, 65, 'It is too far from  where I am right now', 'No', '2017-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket`
--

CREATE TABLE IF NOT EXISTS `tbl_ticket` (
  `ticket_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Ticket id',
  `user_id` int(50) DEFAULT NULL COMMENT 'User Id',
  `product_id` int(50) DEFAULT NULL COMMENT 'Product Id',
  `problem` text COMMENT 'Product Problem',
  `ticket_date` date DEFAULT NULL COMMENT 'Ticket Date',
  `emp_id` int(50) DEFAULT NULL COMMENT 'Employee Id',
  `prefer_date` date DEFAULT NULL COMMENT 'Prefer Date ',
  `prefer_time` time DEFAULT NULL COMMENT 'Prefer Time',
  `status` varchar(50) DEFAULT NULL COMMENT 'Ticket Status',
  `assign_date` date DEFAULT NULL COMMENT 'Ticket Assign Date',
  `complete_date` date DEFAULT NULL COMMENT 'Ticket Complete Date',
  `remark` text COMMENT 'Remarks about Service',
  `address` text COMMENT 'User Address',
  `landmark` text COMMENT 'LandMark',
  `pincode` bigint(20) DEFAULT NULL COMMENT 'Pincode',
  `contact` bigint(20) DEFAULT NULL COMMENT 'Contact number',
  PRIMARY KEY (`ticket_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Ticket Table For User and Admin' AUTO_INCREMENT=67 ;

--
-- Dumping data for table `tbl_ticket`
--

INSERT INTO `tbl_ticket` (`ticket_id`, `user_id`, `product_id`, `problem`, `ticket_date`, `emp_id`, `prefer_date`, `prefer_time`, `status`, `assign_date`, `complete_date`, `remark`, `address`, `landmark`, `pincode`, `contact`) VALUES
(43, 2, 38, 'Rotation Problem', '2017-06-25', 4, '2017-06-28', '12:00:00', 'completed', '2017-07-28', '2017-07-28', 'Two Wires And Nuts Changed', '41, Mangal Vihar Society, Near Parshuram Garden, Adajan Gam, Surat', 'Opp. Jalaram Mandir', 395009, 9662061593),
(44, 3, 43, 'Scanner Is Not Working', '2017-07-25', 4, '2017-07-02', '09:00:00', 'completed', '2017-07-25', '2017-07-28', 'everyting is OKAY', '16, Mithila Nagri, Opp. Swing Hospital, Adajan Gam, Surat', 'Madhuvan Circle', 395009, 7405374081),
(45, 4, 42, 'Continues Sound buzzing', '2017-07-25', 8, '2017-07-18', '09:00:00', 'assign', '2017-08-18', '2017-08-18', NULL, '302, Skyview Tower, Near, Mahalaxmi Temple, Anadmahal Road, Surat', 'Near, Mahalaxmi Temple', 395009, 7405374019),
(46, 1, 42, 'asadda', '2017-07-26', NULL, '2017-07-15', '15:00:00', 'pending', NULL, NULL, NULL, 'afsacsasd', 'sasasaasas', 141414, 7894561230),
(47, 1, 43, 'afsddf', '2017-07-26', 8, '2017-07-31', '10:00:00', 'completed', '2017-08-08', '2017-08-18', 'ewr', 'aDADASAS', 'rwwe', 123456, 7894561230),
(48, 1, 42, 'fdgdgf', '2017-07-26', 1, '2017-07-19', '17:00:00', 'completed', '2017-08-18', '2017-08-26', 'scanner changed due to warrenty', 'safafafa', 'sdfdsfs', 395001, 1212121212),
(49, 1, 38, 'asasaasasasa', '2017-07-31', NULL, '2017-12-31', '10:00:00', 'pending', NULL, NULL, NULL, 'sdgrgrhjyjju', 'eryrryty', 999999, 1111111111),
(51, 1, 38, 'all camras are not working and rotating as well', '2017-08-08', 1, '2017-08-09', '10:00:00', 'completed', '2017-08-08', '2017-08-18', 'done', 'nvsjkfs', 'sjddnkj', 111122, 3236665445),
(55, 4, 50, 'Camera is Broken ', '2017-08-18', NULL, '2017-08-19', '19:00:00', 'pending', NULL, NULL, NULL, 'sfdzvzdvdfv', 'we', 120120, 1254125412),
(65, 1, 42, 'fdgdgf', '2017-07-26', 1, '2017-07-19', '17:00:00', 'switch', '2017-08-18', NULL, 'It is too far from  where I am right now', 'safafafa', 'sdfdsfs', 395001, 1212121212),
(66, 1, 38, 'all camras are not working and rotating as well', '2017-08-08', 1, '2017-08-09', '10:00:00', 'completed', '2017-08-08', '2017-08-18', 'done', 'nvsjkfs', 'sjddnkj', 111122, 3236665445);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'User Id',
  `user_name` varchar(50) NOT NULL COMMENT 'User Name',
  `contact` bigint(10) NOT NULL COMMENT 'Contact',
  `email` varchar(50) NOT NULL COMMENT 'User''s Email Id',
  `password` varchar(50) NOT NULL COMMENT 'User''s Password',
  `reg_date` date NOT NULL COMMENT 'Registration Date',
  `otp_code` int(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='User Table' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `contact`, `email`, `password`, `reg_date`, `otp_code`) VALUES
(1, 'Nihar Shah ', 9824155244, 'nihar@gmail.com', '123456789', '2017-06-16', 84890),
(2, 'Ankit Patel', 9662061933, 'ankit77777@gmail.com', 'ankit77777', '2017-06-16', 3160),
(3, 'Jemin Shah', 7405374081, 'jemin_jems@gmail.com', 'jems25395', '2017-06-15', NULL),
(4, 'Darshan Shah', 7405148419, 'darshan@gmail.com', 'kalukaliyo', '2017-06-14', 5024),
(5, 'Rajat Nagoria', 7405165856, 'rajatnagoria@gmail.com', 'rajunago', '2017-06-01', 7557),
(6, 'Jay Bhandari', 2222222222, 'qwerty@jay.com', 'jayb', '2017-07-13', NULL),
(7, 'Chirag Shah', 1472583691, 'cs@shivam.com', 'chilishah', '2017-07-11', NULL),
(8, 'Umag Khandelwal', 9510250724, 'umang_k@gmail.com', 'umang_k', '2017-07-11', 2652),
(12, 'Piyush Jhakotia', 7990626500, 'piyu@jakho.co.in', 'piyu', '2017-07-13', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD CONSTRAINT `tbl_log_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `tbl_admin` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD CONSTRAINT `tbl_notifications_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tbl_ticket` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_notifications_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD CONSTRAINT `tbl_order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`subcat_id`) REFERENCES `tbl_subcategory` (`subcat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD CONSTRAINT `tbl_rating_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD CONSTRAINT `tbl_subcategory_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_switch`
--
ALTER TABLE `tbl_switch`
  ADD CONSTRAINT `tbl_switch_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tbl_employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_switch_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tbl_ticket` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD CONSTRAINT `tbl_ticket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ticket_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ticket_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `tbl_employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
