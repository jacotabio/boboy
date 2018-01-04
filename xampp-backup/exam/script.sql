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


-- Dumping database structure for db_exam
CREATE DATABASE IF NOT EXISTS `db_exam` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_exam`;

-- Dumping structure for table db_exam.tbl_access
CREATE TABLE IF NOT EXISTS `tbl_access` (
  `acc_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `acc_name` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`acc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_exam.tbl_products
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_name` varchar(180) NOT NULL DEFAULT '',
  `p_description` varchar(255) NOT NULL DEFAULT '',
  `p_quantity` int(100) NOT NULL DEFAULT '1',
  `p_price` double NOT NULL DEFAULT '1',
  `p_date_added` date NOT NULL DEFAULT '0000-00-00',
  `p_time_added` time NOT NULL DEFAULT '00:00:00',
  `p_date_modified` date NOT NULL DEFAULT '0000-00-00',
  `p_time_modified` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_exam.tbl_purchaseorder
CREATE TABLE IF NOT EXISTS `tbl_purchaseorder` (
  `po_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_id` int(10) unsigned NOT NULL,
  `p_name` varchar(180) NOT NULL DEFAULT '',
  `p_quantity` int(100) NOT NULL DEFAULT '1',
  `p_price` double NOT NULL DEFAULT '1',
  `po_date_purchased` date NOT NULL DEFAULT '0000-00-00',
  `p_time_purchased` time NOT NULL DEFAULT '00:00:00',
  `p_subtotal` double NOT NULL DEFAULT '0',
  KEY `po_id` (`po_id`),
  KEY `p_id` (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1005 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_exam.tbl_receiveitems
CREATE TABLE IF NOT EXISTS `tbl_receiveitems` (
  `r_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_id` int(18) unsigned NOT NULL,
  `p_name` varchar(180) NOT NULL DEFAULT '',
  `p_description` varchar(255) NOT NULL DEFAULT '',
  `p_quantity` int(100) NOT NULL DEFAULT '1',
  `p_price` double NOT NULL DEFAULT '1',
  `r_date_received` date NOT NULL DEFAULT '0000-00-00',
  `r_time_received` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`r_id`),
  KEY `p_id` (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1008 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_exam.tbl_settings
CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `set_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `set_name` varchar(80) NOT NULL DEFAULT '',
  `set_address` varchar(80) NOT NULL DEFAULT '',
  `set_version` varchar(10) NOT NULL DEFAULT '',
  `set_copyright` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`set_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_exam.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `usr_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `usr_userid` varchar(180) NOT NULL DEFAULT '',
  `usr_password` varchar(100) NOT NULL DEFAULT '',
  `usr_firstname` varchar(180) NOT NULL DEFAULT '',
  `usr_lastname` varchar(180) NOT NULL DEFAULT '',
  `usr_date_added` date NOT NULL DEFAULT '0000-00-00',
  `usr_time_added` time NOT NULL DEFAULT '00:00:00',
  `usr_date_modified` date NOT NULL DEFAULT '0000-00-00',
  `usr_time_modified` time NOT NULL DEFAULT '00:00:00',
  `usr_stat` int(1) NOT NULL DEFAULT '1',
  `acc_id` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usr_id`),
  KEY `acc_id` (`acc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1014 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
