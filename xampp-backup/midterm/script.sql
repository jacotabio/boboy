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


-- Dumping database structure for db_midterm
CREATE DATABASE IF NOT EXISTS `db_midterm` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_midterm`;

-- Dumping structure for table db_midterm.tbl_access
CREATE TABLE IF NOT EXISTS `tbl_access` (
  `acc_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `acc_name` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`acc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;

-- Dumping data for table db_midterm.tbl_access: 2 rows
/*!40000 ALTER TABLE `tbl_access` DISABLE KEYS */;
INSERT INTO `tbl_access` (`acc_id`, `acc_name`) VALUES
	(201, 'ADMIN'),
	(202, 'STAFF');
/*!40000 ALTER TABLE `tbl_access` ENABLE KEYS */;

-- Dumping structure for table db_midterm.tbl_donation
CREATE TABLE IF NOT EXISTS `tbl_donation` (
  `don_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `don_title` text NOT NULL,
  `don_description` varchar(255) NOT NULL DEFAULT '',
  `don_item` varchar(180) NOT NULL DEFAULT '',
  `don_item_qty` int(8) NOT NULL DEFAULT '0',
  `don_amount` float(12,2) NOT NULL DEFAULT '0.00',
  `don_date_added` date NOT NULL DEFAULT '0000-00-00',
  `don_time_added` time NOT NULL DEFAULT '00:00:00',
  `don_date_modified` date NOT NULL DEFAULT '0000-00-00',
  `don_time_modified` time NOT NULL DEFAULT '00:00:00',
  `sponsor_userid` varchar(80) NOT NULL DEFAULT '0',
  `dtype_id` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`don_id`),
  KEY `dtype_id` (`dtype_id`),
  KEY `sponsor_id` (`sponsor_userid`)
) ENGINE=MyISAM AUTO_INCREMENT=1000065 DEFAULT CHARSET=latin1;

-- Dumping data for table db_midterm.tbl_donation: 10 rows
/*!40000 ALTER TABLE `tbl_donation` DISABLE KEYS */;
INSERT INTO `tbl_donation` (`don_id`, `don_title`, `don_description`, `don_item`, `don_item_qty`, `don_amount`, `don_date_added`, `don_time_added`, `don_date_modified`, `don_time_modified`, `sponsor_userid`, `dtype_id`) VALUES
	(1000061, 'Fifty Shades Of Money', 'Sexy Money', '', 0, 20.00, '2017-02-15', '15:57:21', '0000-00-00', '00:00:00', '1421142', 302),
	(1000062, 'Korean Ng Tigulang', 'For the elderly', '', 0, 5000.00, '2017-02-15', '15:58:18', '0000-00-00', '00:00:00', '1420317', 302),
	(1000057, 'Bantay Bata 163', 'For the poor kids who need help', '', 0, 50000.00, '2017-02-15', '15:27:38', '0000-00-00', '00:00:00', '1420317', 302),
	(1000058, 'USLS-Pigado Kabataan', 'Money for allowance of students', '', 0, 25000.00, '2017-02-15', '15:54:40', '0000-00-00', '00:00:00', '123456', 302),
	(1000059, 'Nike Fund-Run', '', 'Nike Airmaxx', 200, 0.00, '2017-02-15', '15:55:41', '0000-00-00', '00:00:00', '123456', 301),
	(1000060, 'Samsung Galaxy Giveaway', '100 pieces of Galaxy S7 Edge giveaways', 'Galaxy S7 Edge', 100, 0.00, '2017-02-15', '15:56:20', '0000-00-00', '00:00:00', '123456', 301),
	(1000053, 'Yolanda Victims', 'Long life', 'pancit canton', 15, 0.00, '2017-02-14', '23:32:54', '0000-00-00', '00:00:00', '1420317', 301),
	(1000055, 'Handug Kwarta Para sa Pamilya', 'Money for your family', '', 0, 50.00, '2017-02-14', '23:33:31', '0000-00-00', '00:00:00', '1420317', 302),
	(1000063, 'Apple IPhone Charity Giveaway', '5 pcs of iPhone 7 Plus Minus Divide Multipy', 'iPhone 7 Plus Jet Gold', 5, 0.00, '2017-02-15', '15:59:22', '0000-00-00', '00:00:00', '121516', 301),
	(1000064, 'Yolanda Victims', '', 'Sardines', 50, 0.00, '2017-02-15', '16:16:36', '0000-00-00', '00:00:00', '1420317', 301);
/*!40000 ALTER TABLE `tbl_donation` ENABLE KEYS */;

-- Dumping structure for table db_midterm.tbl_dtype
CREATE TABLE IF NOT EXISTS `tbl_dtype` (
  `dtype_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `dtype_name` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`dtype_id`)
) ENGINE=MyISAM AUTO_INCREMENT=303 DEFAULT CHARSET=latin1;

-- Dumping data for table db_midterm.tbl_dtype: 2 rows
/*!40000 ALTER TABLE `tbl_dtype` DISABLE KEYS */;
INSERT INTO `tbl_dtype` (`dtype_id`, `dtype_name`) VALUES
	(301, 'Item'),
	(302, 'Cash');
/*!40000 ALTER TABLE `tbl_dtype` ENABLE KEYS */;

-- Dumping structure for table db_midterm.tbl_sponsor
CREATE TABLE IF NOT EXISTS `tbl_sponsor` (
  `sponsor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sponsor_userid` varchar(80) NOT NULL DEFAULT '',
  `sponsor_firstname` varchar(180) NOT NULL DEFAULT '',
  `sponsor_lastname` varchar(180) NOT NULL DEFAULT '',
  `sponsor_balance` float(12,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`sponsor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1024 DEFAULT CHARSET=latin1;

-- Dumping data for table db_midterm.tbl_sponsor: 9 rows
/*!40000 ALTER TABLE `tbl_sponsor` DISABLE KEYS */;
INSERT INTO `tbl_sponsor` (`sponsor_id`, `sponsor_userid`, `sponsor_firstname`, `sponsor_lastname`, `sponsor_balance`) VALUES
	(1018, '123456', 'Patrick Allen', 'Siacor', 25000.00),
	(1017, '092872', 'Jennifer ', 'Octabio', 0.00),
	(1016, '121516', 'Jileana Clarysse', 'Octabio', 0.00),
	(1015, '1421038', 'John Carlo', 'Octabio', 0.00),
	(1019, '1521556', 'Mary Loisse', 'Guilot', 0.00),
	(1020, '1420317', 'John Brix', 'Arroba', 55050.00),
	(1022, '1', 'Anonymous', 'Anonymous', 0.00),
	(1021, '1421142', 'Christian', 'Hizon', 20.00),
	(1023, '1420137', 'Ricky', 'Aldea', 0.00);
/*!40000 ALTER TABLE `tbl_sponsor` ENABLE KEYS */;

-- Dumping structure for table db_midterm.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `usr_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `usr_userid` varchar(80) NOT NULL DEFAULT '',
  `usr_password` varchar(80) NOT NULL DEFAULT '',
  `usr_firstname` varchar(180) NOT NULL DEFAULT '',
  `usr_lastname` varchar(180) NOT NULL DEFAULT '',
  `acc_id` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usr_id`),
  KEY `acc_id` (`acc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1006 DEFAULT CHARSET=latin1;

-- Dumping data for table db_midterm.tbl_users: 4 rows
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`usr_id`, `usr_userid`, `usr_password`, `usr_firstname`, `usr_lastname`, `acc_id`) VALUES
	(1001, '123', '202cb962ac59075b964b07152d234b70', 'Admin', ' ', 201),
	(1003, '1421038', '6da96bcfa148b896c18dd02526d70ee9', 'John Carlo', 'Octabio', 202),
	(1004, '1420317', '202cb962ac59075b964b07152d234b70', 'John Brix', 'Arrobang', 201),
	(1005, '1420137', '202cb962ac59075b964b07152d234b70', 'Ricky', 'Aldea', 202);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
