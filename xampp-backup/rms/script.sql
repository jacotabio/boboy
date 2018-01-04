-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.33-community - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.0.0.4865
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for db_rms
CREATE DATABASE IF NOT EXISTS `db_rms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_rms`;


-- Dumping structure for table db_rms.tbl_access
CREATE TABLE IF NOT EXISTS `tbl_access` (
  `acc_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `acc_name` varchar(180) NOT NULL DEFAULT '',
  PRIMARY KEY (`acc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table db_rms.tbl_product
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pro_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(20) NOT NULL DEFAULT '',
  `pro_desc` varchar(180) NOT NULL DEFAULT '',
  `pro_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pty_id` int(2) unsigned NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `pty_id` (`pty_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table db_rms.tbl_ptype
CREATE TABLE IF NOT EXISTS `tbl_ptype` (
  `pty_id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `pty_name` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`pty_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table db_rms.tbl_settings
CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `set_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `set_name` varchar(80) NOT NULL DEFAULT '',
  `set_address` varchar(80) NOT NULL DEFAULT '',
  `set_version` varchar(10) NOT NULL DEFAULT '',
  `set_copyright` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`set_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table db_rms.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `usr_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `usr_userid` varchar(8) NOT NULL DEFAULT '',
  `usr_password` varchar(180) NOT NULL DEFAULT '',
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
