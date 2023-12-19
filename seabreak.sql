-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2023 at 01:37 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seabreak`
--

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

DROP TABLE IF EXISTS `foods`;
CREATE TABLE IF NOT EXISTS `foods` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_name` varchar(45) NOT NULL,
  `price` varchar(45) NOT NULL,
  `image` varchar(45) NOT NULL,
  PRIMARY KEY (`food_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`food_id`, `food_name`, `price`, `image`) VALUES
(1, 'sample', '12', 'caramel.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orders_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(45) NOT NULL,
  `table_number` varchar(45) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `size` varchar(45) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(45) NOT NULL,
  `money_paid` varchar(45) NOT NULL,
  `customer_change` decimal(10,0) DEFAULT 0,
  `order_date` date NOT NULL,
  `emp_name` varchar(45) NOT NULL,
  PRIMARY KEY (`orders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `transaction_number`, `table_number`, `product_name`, `size`, `quantity`, `price`, `money_paid`, `customer_change`, `order_date`, `emp_name`) VALUES
(188, 'SBRK-1700209961-5177', '17', 'Black Coffee', 'Medium', 1, '75', '1000', '925', '2023-11-17', 'admin'),
(189, 'SBRK-1700209996-6304', '18', 'Black Coffee', 'Large', 1, '100', '1000', '325', '2023-11-17', 'admin'),
(190, 'SBRK-1700209996-6304', '18', 'Black Coffee', 'Medium', 1, '75', '1000', '325', '2023-11-17', 'admin'),
(191, 'SBRK-1700209996-6304', '18', 'Iced Coffee', 'Medium', 2, '150', '1000', '325', '2023-11-17', 'admin'),
(192, 'SBRK-1700209996-6304', '18', 'Iced Coffee', 'Large', 1, '100', '1000', '325', '2023-11-17', 'admin'),
(193, 'SBRK-1700209996-6304', '18', 'Iced Coffee', 'Small', 1, '25', '1000', '325', '2023-11-17', 'admin'),
(194, 'SBRK-1700209996-6304', '18', 'Cappuccino', 'Small', 1, '50', '1000', '325', '2023-11-17', 'admin'),
(195, 'SBRK-1700209996-6304', '18', 'Cappuccino', 'Medium', 1, '75', '1000', '325', '2023-11-17', 'admin'),
(196, 'SBRK-1700209996-6304', '18', 'Cappuccino', 'Large', 1, '100', '1000', '325', '2023-11-17', 'admin'),
(197, 'SBRK-1700210322-3160', '20', 'Black Coffee', 'Large', 1, '100', '200', '25', '2023-11-17', 'admin'),
(198, 'SBRK-1700210322-3160', '20', 'Black Coffee', 'Medium', 1, '75', '200', '25', '2023-11-17', 'admin'),
(199, 'SBRK-1700210881-4658', '18', 'Black Coffee', 'Medium', 1, '75', '200', '0', '2023-11-17', 'Cashier'),
(200, 'SBRK-1700210881-4658', '18', 'Black Coffee', 'Large', 1, '100', '200', '0', '2023-11-17', 'Cashier'),
(201, 'SBRK-1700210881-4658', '18', 'Iced Coffee', 'Small', 1, '25', '200', '0', '2023-11-17', 'Cashier'),
(202, 'SBRK-1700211558-6135', '20', 'Black Coffee', 'Large', 1, '100', '100', '0', '2023-11-17', 'Cashier'),
(203, 'SBRK-1700211729-7502', '10', 'Black Coffee', 'Large', 1, '100', '200', '25', '2023-11-17', 'Manager'),
(204, 'SBRK-1700211729-7502', '10', 'Black Coffee', 'Medium', 1, '75', '200', '25', '2023-11-17', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `amount`, `date`) VALUES
(1, 75, '2023-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `small_price` varchar(45) DEFAULT NULL,
  `medium_price` varchar(45) DEFAULT NULL,
  `large_price` varchar(45) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `small_price`, `medium_price`, `large_price`, `image`) VALUES
(30, 'Black Coffee', '', '75', '100', 'black coffee.jpg'),
(34, 'Iced Coffee', '25', '75', '100', 'iced_coffee-removebg-preview.png'),
(35, 'Cappuccino', '50', '75', '100', 'cappuccino.png'),
(37, 'Test', '50', '75', '100', 'irish.png');

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

DROP TABLE IF EXISTS `supplies`;
CREATE TABLE IF NOT EXISTS `supplies` (
  `supply_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`supply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`supply_id`, `name`, `quantity`) VALUES
(1, 'Cups', 50),
(4, 'Coffee bags', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` varchar(45) NOT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `emp_name`, `username`, `password`, `user_type`) VALUES
(6, 'admin', 'admin', 'admin', 'Admin'),
(8, 'Cashier', 'cashier', '111', 'Cashier'),
(9, 'Manager', 'manager', 'manager', 'Manager'),
(10, 'Manager', 'admin1', 'admin', 'Admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
