-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2018 at 01:32 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `user_id`, `order_date`, `address`, `pincode`, `contact`, `status`, `payment_type`, `is_pay`) VALUES
(13, 3, '2017-07-27', 'fgfdersgrs', 0, 2147483647, 'pending', 'payumoney', 'yes'),
(26, 8, '2017-08-02', 'B-1001, Kakadia ', 395007, 2147483647, 'pending', 'payumoney', 'yes'),
(35, 3, '2018-06-21', 'sandringham', 104111, 7878758555, 'Pending', 'COD', 'no'),
(36, 1, '2018-08-15', 'waskbcaksb', 395007, 9824155244, 'Pending', 'payumoney', 'yes');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
