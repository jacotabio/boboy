USE db_exam;

DROP TABLE IF EXISTS `tbl_receiveitems`;
CREATE TABLE `tbl_receiveitems`(
	`r_id` int(10) unsigned NOT NULL auto_increment,
	`p_id` int(18) unsigned NOT NULL,
	`p_name` varchar(180) NOT NULL default '',
	`p_description` varchar(255) NOT NULL default '',
	`p_quantity` int(100) NOT NULL default '1',
	`p_price` double NOT NULL default '1',
	`r_date_received` date NOT NULL default '0000-00-00',
	`r_time_received` time NOT NULL default '00:00:00'
	PRIMARY KEY(`r_id`),
	KEY(`p_id`)
)ENGINE=MyISAM AUTO_INCREMENT=201;
