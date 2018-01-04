USE db_exam;

DROP TABLE IF EXISTS `tbl_purchaseorder`;
CREATE TABLE `tbl_purchaseorder`(
	`po_id` int(10) unsigned NOT NULL auto_increment,
	`p_id` int(10) unsigned NOT NULL,
	`p_name` varchar(180) NOT NULL default '',
	`p_quantity` int(100) NOT NULL default '1',
	`p_price` double NOT NULL default '1',
	`p_subtotal` double NOT NULL default '1',
	`po_date_purchased` date NOT NULL default '0000-00-00',
	`p_time_purchased` time NOT NULL default '00:00:00',
	KEY(`po_id`),
	KEY(`p_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1001;
