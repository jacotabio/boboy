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


-- Dumping database structure for db_capstone
CREATE DATABASE IF NOT EXISTS `db_capstone` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_capstone`;

-- Dumping structure for table db_capstone.tbl_cart
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `c_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(10) NOT NULL DEFAULT '0',
  `c_qty` int(10) NOT NULL DEFAULT '0',
  `usr_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`c_id`),
  KEY `pro_id` (`pro_id`,`usr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000036 DEFAULT CHARSET=latin1;

-- Dumping data for table db_capstone.tbl_cart: 0 rows
/*!40000 ALTER TABLE `tbl_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_cart` ENABLE KEYS */;

-- Dumping structure for table db_capstone.tbl_category
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cat_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

-- Dumping data for table db_capstone.tbl_category: 17 rows
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` (`cat_id`, `cat_name`) VALUES
	(101, 'ANTI-BACTERIAL'),
	(102, 'ANTI-ANGINAL DRUG'),
	(103, 'ANTI-FUNGAL'),
	(104, 'ANALGESIC/ANTIPYRETIC'),
	(105, 'COUGH PREP\'N'),
	(106, 'ANTI-INFLAMMATORY DRUG'),
	(107, 'ANTITHROMBOTIC'),
	(108, 'OXYTOCIC'),
	(109, 'LAXATIVE'),
	(110, 'DECONGESTANT/ANTIPYRETIC'),
	(111, 'GASTROKINETIC'),
	(112, 'SKELETAL MUSCLE RELAXANT'),
	(113, 'ANTI-ASTHMA'),
	(114, 'ANTIBACTERIAL OINTMENT'),
	(115, 'OPTHALMIC ANTIBACTERIAL DROPS'),
	(116, 'VITAMINS'),
	(117, 'INJECTABLES');
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;

-- Dumping structure for table db_capstone.tbl_product
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pro_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_brand` varchar(255) NOT NULL DEFAULT '',
  `pro_name` varchar(255) NOT NULL DEFAULT '',
  `pro_desc` varchar(255) NOT NULL DEFAULT '',
  `pro_qty` int(10) NOT NULL DEFAULT '0',
  `pro_price` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`pro_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000000011 DEFAULT CHARSET=latin1;

-- Dumping data for table db_capstone.tbl_product: 10 rows
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` (`pro_id`, `pro_brand`, `pro_name`, `pro_desc`, `pro_qty`, `pro_price`) VALUES
	(1000000001, 'CFC', 'Cherifer', 'Pang pataas height na bulong', 100, 12.50),
	(1000000002, 'CFC', 'Bioflu', 'Pang kakas flu lels', 200, 11.75),
	(1000000003, 'ZEFCO', 'Tempra', 'Ma bakal sa fishbolan', 150, 6.69),
	(1000000004, 'XMETAZ', 'Revicon', 'Revv revvvvv broom broom hala gid', 250, 4.75),
	(1000000005, 'RAHMACIN', 'Enervon-C', 'Vitamin C nga bulong ah', 113, 32.00),
	(1000000006, 'AZIFAST', 'Plavix', 'Basta ah haha', 562, 32.00),
	(1000000007, 'AZIFAST', 'Lipitor', 'Utod ni thor hala gid', 98, 8.99),
	(1000000008, 'CFC', 'Nexium', 'Tupad balay ko ah haha', 918, 4.50),
	(1000000009, 'AMX', 'Advair Diskus', 'Diskus po maawo po kayo', 89, 6.69),
	(1000000010, 'GLOCLAV', 'Abilify', 'Kaw bahala ano na sa haw', 246, 15.70);
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;

-- Dumping structure for table db_capstone.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `usr_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `usr_username` varchar(255) NOT NULL DEFAULT '',
  `usr_password` varchar(255) NOT NULL DEFAULT '',
  `acc_id` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usr_id`),
  KEY `acc_id` (`acc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10002 DEFAULT CHARSET=latin1;

-- Dumping data for table db_capstone.tbl_users: 1 rows
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`usr_id`, `usr_username`, `usr_password`, `acc_id`) VALUES
	(10001, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
