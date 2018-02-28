-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_boboy
CREATE DATABASE IF NOT EXISTS `db_boboy` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_boboy`;

-- Dumping structure for table db_boboy.auth
CREATE TABLE IF NOT EXISTS `auth` (
  `auth_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(255) NOT NULL DEFAULT '',
  KEY `id` (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.auth: ~2 rows (approximately)
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` (`auth_id`, `auth_name`) VALUES
	(1, 'User'),
	(2, 'Partnership Brand');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;

-- Dumping structure for table db_boboy.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL DEFAULT '',
  `brand_status` int(11) NOT NULL DEFAULT '0',
  `update_checker` int(11) NOT NULL DEFAULT '0',
  KEY `id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.brands: ~2 rows (approximately)
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_status`, `update_checker`) VALUES
	(14, 'SleepNot', 1, 1),
	(15, 'Starbucks', 1, 1),
	(17, 'BLK6 LT14', 1, 1);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Dumping structure for table db_boboy.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(8) NOT NULL DEFAULT '0',
  `item_qty` int(2) NOT NULL DEFAULT '0',
  `subtotal` float(10,2) NOT NULL DEFAULT '0.00',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000480 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.cart: 0 rows
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table db_boboy.conversations
CREATE TABLE IF NOT EXISTS `conversations` (
  `convo_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `usr_id` int(8) NOT NULL DEFAULT '0',
  `brand_id` int(8) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`convo_id`),
  KEY `usr_id` (`usr_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.conversations: ~1 rows (approximately)
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations` (`convo_id`, `usr_id`, `brand_id`, `created_at`) VALUES
	(4, 1, 14, '2018-02-25 22:30:41'),
	(5, 2, 14, '2018-02-26 18:14:45');
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;

-- Dumping structure for table db_boboy.fees
CREATE TABLE IF NOT EXISTS `fees` (
  `fee_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(255) NOT NULL DEFAULT '',
  `fee_price` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.fees: ~0 rows (approximately)
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` (`fee_id`, `fee_name`, `fee_price`) VALUES
	(1, 'Service Fee', 50.00);
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;

-- Dumping structure for table db_boboy.items
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(3) NOT NULL DEFAULT '0',
  `item_name` varchar(255) NOT NULL DEFAULT '',
  `item_description` varchar(255) NOT NULL DEFAULT '',
  `item_size` varchar(255) NOT NULL DEFAULT '',
  `item_price` float(10,2) NOT NULL DEFAULT '0.00',
  `item_img` varchar(255) NOT NULL DEFAULT '',
  `item_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`item_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.items: ~7 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`item_id`, `brand_id`, `item_name`, `item_description`, `item_size`, `item_price`, `item_img`, `item_status`, `created_at`) VALUES
	(17, 14, 'Iced Coffee', 'Iced coffee is cold coffee with ice. The iced latte and iced mocha are examples. There are various brewing methods, with the fundamental division being cold brew.', '', 45.00, 'sleepnot.jpg', 1, '2017-12-07 11:05:59'),
	(18, 14, 'Coffee Latte', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin in nisl non vulputate. Nam quam orci, consectetur eu massa vel, porttitor elementum turpis. Nulla eu volutpat libero. Curabitur pretium consectetur nulla. Aliquam bibendum eleme', '', 55.00, 'tomncinno.jpg', 1, '2017-12-07 11:09:28'),
	(19, 14, 'Brewed Coffee w/ Milk', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin in nisl non vulputate. Nam quam orci, consectetur eu massa vel, porttitor elementum turpis. Nulla eu volutpat libero. Curabitur pretium consectetur nulla. Aliquam bibendum eleme', '', 30.00, 'brewed coffee.jpg', 1, '2017-12-07 11:10:59'),
	(20, 14, 'Caramel Latte', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin in nisl non vulputate. Nam quam orci, consectetur eu massa vel, porttitor elementum turpis. Nulla eu volutpat libero. Curabitur pretium consectetur nulla. Aliquam bibendum eleme', '', 70.00, 'caramel_flan_latte.jpg', 1, '2017-12-07 11:12:58'),
	(26, 14, 'White Coffee', 'Lorem ipsuma', '', 100.00, 'hot choco.jpg', 1, '2017-12-07 16:44:46'),
	(30, 15, 'White Hot Mocha Latte', 'Lorem ipsum dolor sit amet jud pud pud ba kana ba', '', 145.00, 'mocha latte.jpg', 1, '2017-12-08 17:34:19'),
	(31, 14, 'Espresso', 'Espresso is coffee brewed by forcing a small amount of nearly boiling water under pressure through finely ground coffee beans.', '', 180.00, 'espresso_830x550.jpg', 1, '2017-12-09 13:57:48');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table db_boboy.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `convo_id` bigint(11) NOT NULL DEFAULT '0',
  `msg` longtext NOT NULL,
  `sender_id` int(8) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `show_notif` int(11) NOT NULL DEFAULT '0',
  `msg_open` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`msg_id`),
  KEY `convo_id` (`convo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.messages: ~71 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`msg_id`, `convo_id`, `msg`, `sender_id`, `created_at`, `show_notif`, `msg_open`) VALUES
	(19, 4, 'yow', 14, '2018-02-25 22:30:41', 1, 0),
	(20, 4, 'asdasd', 14, '2018-02-25 22:41:50', 1, 0),
	(21, 4, 'asd', 14, '2018-02-25 22:47:43', 1, 0),
	(22, 4, 'asd', 14, '2018-02-25 22:47:45', 1, 0),
	(23, 4, 'asd', 14, '2018-02-25 22:47:50', 1, 0),
	(24, 4, 'asd', 14, '2018-02-25 22:47:51', 1, 0),
	(25, 4, 'wassup', 14, '2018-02-25 22:47:53', 1, 0),
	(26, 4, 'kamusta?', 14, '2018-02-25 22:48:02', 1, 0),
	(27, 4, 'asd', 14, '2018-02-25 22:49:16', 1, 0),
	(28, 4, 'asd', 1, '2018-02-25 22:50:30', 0, 0),
	(29, 4, 'hahahaha', 1, '2018-02-25 22:51:26', 0, 0),
	(30, 4, 'tol', 1, '2018-02-25 22:56:53', 0, 0),
	(31, 4, 'op?', 14, '2018-02-25 22:56:59', 1, 0),
	(32, 4, 'may customer ka da lihog assist', 1, '2018-02-25 22:57:13', 0, 0),
	(33, 4, 'asd', 14, '2018-02-25 22:58:03', 1, 0),
	(34, 4, 'asdasdasdasd', 1, '2018-02-25 23:00:13', 0, 0),
	(35, 4, 'dddd', 1, '2018-02-25 23:00:17', 0, 0),
	(36, 4, 'asd', 1, '2018-02-25 23:32:07', 0, 0),
	(37, 4, 'asd', 1, '2018-02-25 23:32:30', 0, 0),
	(38, 4, 'asd', 1, '2018-02-25 23:32:31', 0, 0),
	(39, 4, 'asd', 1, '2018-02-25 23:32:31', 0, 0),
	(40, 4, 'as', 1, '2018-02-25 23:32:31', 0, 0),
	(41, 4, 'asd', 1, '2018-02-25 23:32:31', 0, 0),
	(42, 4, 'SleepNot', 1, '2018-02-25 23:36:04', 0, 0),
	(43, 4, 'Yes?', 14, '2018-02-26 18:03:00', 1, 0),
	(44, 4, 'Do we have a problem here?', 14, '2018-02-26 18:07:12', 1, 0),
	(45, 4, 'kjh', 14, '2018-02-26 18:07:30', 1, 0),
	(46, 4, 'kj', 1, '2018-02-26 18:08:15', 0, 0),
	(47, 4, 'jhg', 1, '2018-02-26 18:08:21', 0, 0),
	(48, 4, 'okay2', 14, '2018-02-26 18:08:44', 1, 0),
	(49, 4, 'asd', 14, '2018-02-26 18:12:13', 1, 0),
	(50, 4, 'd', 14, '2018-02-26 18:12:15', 1, 0),
	(51, 4, 'asd', 14, '2018-02-26 18:13:15', 1, 0),
	(52, 5, 'sir', 14, '2018-02-26 18:14:45', 0, 0),
	(53, 5, 'asd', 14, '2018-02-26 18:14:47', 0, 0),
	(54, 5, 'asd', 14, '2018-02-26 18:14:49', 0, 0),
	(55, 5, 'asd', 14, '2018-02-26 18:14:50', 0, 0),
	(56, 5, 'asd', 14, '2018-02-26 18:14:51', 0, 0),
	(57, 5, 'asd', 14, '2018-02-26 18:14:52', 0, 0),
	(58, 5, 'asd', 14, '2018-02-26 18:14:54', 0, 0),
	(59, 4, 'asd', 1, '2018-02-26 18:15:27', 0, 0),
	(60, 4, 'asd', 14, '2018-02-26 18:15:37', 1, 0),
	(61, 4, 'asd', 14, '2018-02-26 18:19:31', 1, 0),
	(62, 4, 'd', 14, '2018-02-26 18:19:33', 1, 0),
	(63, 4, 'asd', 1, '2018-02-26 18:19:59', 0, 0),
	(64, 4, 'asd', 1, '2018-02-26 18:20:01', 0, 0),
	(65, 4, 'asd', 14, '2018-02-26 18:21:15', 1, 0),
	(66, 4, 'd', 14, '2018-02-26 18:21:16', 1, 0),
	(67, 4, 'asd', 14, '2018-02-26 18:22:26', 1, 0),
	(68, 4, 'asd', 14, '2018-02-26 18:25:34', 1, 0),
	(69, 4, 'ddddd', 14, '2018-02-26 18:25:37', 1, 0),
	(70, 4, 'd', 14, '2018-02-26 18:27:03', 1, 0),
	(71, 4, 'asd', 14, '2018-02-26 18:27:24', 1, 0),
	(72, 4, 'd', 14, '2018-02-26 18:27:28', 1, 0),
	(73, 4, 'd', 14, '2018-02-26 18:27:31', 1, 0),
	(74, 4, 'd', 14, '2018-02-26 18:28:56', 1, 0),
	(75, 4, 'd', 14, '2018-02-26 18:29:34', 1, 0),
	(76, 4, 'd', 14, '2018-02-26 18:31:51', 1, 0),
	(77, 4, 'd', 14, '2018-02-26 18:35:05', 1, 0),
	(78, 4, 'asdasd', 14, '2018-02-26 18:35:08', 1, 0),
	(79, 4, 'asd', 14, '2018-02-26 18:37:15', 1, 0),
	(80, 4, 'd', 14, '2018-02-26 18:37:29', 1, 0),
	(81, 4, 'asd', 14, '2018-02-26 18:37:31', 1, 0),
	(82, 4, 'asd', 1, '2018-02-26 19:36:21', 0, 0),
	(83, 4, 'hoy', 1, '2018-02-28 16:37:19', 0, 0),
	(84, 4, 'asd', 1, '2018-02-28 16:37:59', 0, 0),
	(85, 4, 'yow', 1, '2018-02-28 16:39:36', 0, 0),
	(86, 4, 'yes', 14, '2018-02-28 16:39:45', 1, 0),
	(87, 4, 'waay lang', 1, '2018-02-28 16:39:48', 0, 0),
	(88, 4, 'asd', 1, '2018-02-28 16:47:51', 0, 0),
	(89, 5, 'yow', 2, '2018-02-28 17:53:02', 0, 0),
	(90, 4, 'yes?', 1, '2018-02-28 18:08:26', 0, 0),
	(91, 4, 'asd', 1, '2018-02-28 18:08:36', 0, 0),
	(92, 4, 'asd', 1, '2018-02-28 18:08:37', 0, 0),
	(93, 4, 'asd', 1, '2018-02-28 18:08:38', 0, 0),
	(94, 4, 'asd', 1, '2018-02-28 18:08:38', 0, 0),
	(95, 4, 'asd', 1, '2018-02-28 18:08:38', 0, 0),
	(96, 4, 'asd', 1, '2018-02-28 18:08:38', 0, 0),
	(97, 5, 'asd', 2, '2018-02-28 18:09:21', 0, 0),
	(98, 4, 'd', 1, '2018-02-28 18:09:37', 0, 0),
	(99, 4, 'wek wek wek', 1, '2018-02-28 18:09:46', 0, 0),
	(100, 4, 'asd', 1, '2018-02-28 18:10:18', 0, 0),
	(101, 4, 'asd', 1, '2018-02-28 18:10:29', 0, 0),
	(102, 4, 'asd', 1, '2018-02-28 18:11:48', 0, 0),
	(103, 4, 'asd', 1, '2018-02-28 18:19:28', 0, 0),
	(104, 4, 'I am sleepnot', 14, '2018-02-28 18:22:20', 1, 0),
	(105, 4, 'How may I help you?', 14, '2018-02-28 18:22:25', 1, 0),
	(106, 4, 'Baw daw pihu ka hahaha', 1, '2018-02-28 18:23:40', 0, 0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Dumping structure for table db_boboy.oitem
CREATE TABLE IF NOT EXISTS `oitem` (
  `oi_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(8) NOT NULL DEFAULT '0',
  `item_id` int(8) NOT NULL DEFAULT '0',
  `oi_qty` int(2) NOT NULL DEFAULT '0',
  `oi_subtotal` float(10,2) NOT NULL DEFAULT '0.00',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  `oi_status` int(1) NOT NULL DEFAULT '0',
  `oi_delivery` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`oi_id`),
  KEY `item_id` (`item_id`,`order_id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50000351 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.oitem: 4 rows
/*!40000 ALTER TABLE `oitem` DISABLE KEYS */;
INSERT INTO `oitem` (`oi_id`, `order_id`, `item_id`, `oi_qty`, `oi_subtotal`, `usr_id`, `oi_status`, `oi_delivery`) VALUES
	(50000348, 20000275, 17, 1, 45.00, 2, 1, 2),
	(50000350, 20000277, 17, 1, 45.00, 2, 0, 0),
	(50000349, 20000276, 17, 1, 45.00, 2, 0, 0),
	(50000345, 20000273, 17, 1, 45.00, 2, 1, 2),
	(50000344, 20000273, 20, 1, 70.00, 2, 1, 2);
/*!40000 ALTER TABLE `oitem` ENABLE KEYS */;

-- Dumping structure for table db_boboy.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_total` float(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_status` int(1) NOT NULL DEFAULT '0',
  `usr_id` int(8) NOT NULL DEFAULT '0',
  `delivery_address` longtext NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `custom_fee` float(10,2) NOT NULL DEFAULT '0.00',
  `custom_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20000278 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.orders: 3 rows
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`order_id`, `order_total`, `created_at`, `order_status`, `usr_id`, `delivery_address`, `contact_number`, `custom_fee`, `custom_name`) VALUES
	(20000277, 45.00, '2018-02-28 18:09:16', 0, 2, '#22 Clayton Street, St. Francis Village, Brgy. Taculing, Bacolod City', '09437095891', 50.00, ''),
	(20000273, 115.00, '2018-02-23 16:01:16', 4, 2, '#22 Clayton Street, St. Francis Village, Brgy. Taculing, Bacolod City', '09437095891', 50.00, ''),
	(20000276, 45.00, '2018-02-28 17:51:17', 0, 2, '#22 Clayton Street, St. Francis Village, Brgy. Taculing, Bacolod City', '09437095891', 50.00, ''),
	(20000275, 45.00, '2018-02-28 14:56:17', 4, 2, '#22 Clayton Street, St. Francis Village, Brgy. Taculing, Bacolod City', '09437095891', 50.00, '');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table db_boboy.users
CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL DEFAULT '',
  `usr_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL DEFAULT '',
  `usr_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL DEFAULT '',
  `usr_auth` int(1) NOT NULL DEFAULT '0',
  `usr_status` int(11) NOT NULL DEFAULT '0',
  `usr_img` varchar(255) NOT NULL DEFAULT '',
  `brand_id` int(1) NOT NULL DEFAULT '0',
  `usr_address` varchar(255) NOT NULL DEFAULT '',
  `usr_contact` varchar(50) NOT NULL DEFAULT 'N/A',
  `admin` int(11) NOT NULL DEFAULT '0',
  `is_hidden` int(11) NOT NULL DEFAULT '0',
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Dumping data for table db_boboy.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`usr_id`, `usr_name`, `usr_email`, `usr_password`, `usr_auth`, `usr_status`, `usr_img`, `brand_id`, `usr_address`, `usr_contact`, `admin`, `is_hidden`) VALUES
	(2, 'John Carlo H. Octabio', 'jacotabio@gmail.com', '924c7653b61c3f43be726a0300a6f819', 1, 1, '', 0, '#22 Clayton Street, St. Francis Village, Brgy. Taculing, Bacolod City', '09437095891', 0, 0),
	(26, 'SleepNot', 'sleepnot@gmail.com', 'e049a162fbb91145da951b0c438c7b2f', 2, 1, 'img/account/sleepnot-logo.png', 14, 'The Palms, 18th Street Lacson, Bacolod City', '09123456789', 0, 0),
	(27, 'Starbucks', 'coffee@starbucks.com', 'f116acfe9147494063e58da666d1d57e', 2, 1, '', 15, '18th St. Lacson, Bacolod, 6100 Negros Occidental', '09437095893', 0, 0),
	(1, 'admin', '', 'e0ee52e667d352491a2b8baea5336e08', 0, 0, '', 0, '', 'N/A', 1, 0),
	(35, 'BLK6 LT14', 'blk6lt14@gmail.com', 'a3dcb4d229de6fde0db5686dee47145d', 2, 1, '', 17, 'Unit 1D Nolan Building, San Agustin Drive, Barangay 5, Bacolod City, Bacolod, 6100 Negros Occidental', '4331234', 0, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
