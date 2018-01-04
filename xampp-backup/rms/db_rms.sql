CREATE DATABASE db_rms;

USE db_rms;

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users`(
	`usr_id` int(4) unsigned NOT NULL auto_increment,
	`usr_userid` varchar(8) NOT NULL default '',
	`usr_password` varchar(180) NOT NULL default '',
	`usr_firstname` varchar(180) NOT NULL default '',
	`usr_lastname` varchar(180) NOT NULL default '',
	`usr_date_added` date NOT NULL default '000-00-00',
	`usr_time_added` time NOT NULL default '0:00:00',
	`usr_date_modified` date NOT NULL default '000-00-00',
	`usr_time_modified` time NOT NULL default '0:00:00',
	`usr_stat` int(1) NOT NULL default '1',
	`acc_id` int(3) NOT NULL default '0',
	KEY (`acc_id`),
	PRIMARY KEY (`usr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1001;

DROP TABLE IF EXISTS `tbl_access`;
CREATE TABLE `tbl_access`(
	`acc_id` int(3) unsigned NOT NULL auto_increment,
	`acc_name` varchar(180) NOT NULL default '',
	PRIMARY KEY (`acc_id`)
)ENGINE=MyISAM AUTO_INCREMENT=201;

DROP TABLE IF EXISTS `tbl_settings`;
CREATE TABLE `tbl_settings`(
	`set_id` int(1) unsigned NOT NULL auto_increment,
	`set_name` varchar(80) NOT NULL default '',
	`set_address` varchar(80) NOT NULL default '',
	`set_version` varchar(10) NOT NULL default '',
	`set_copyright` varchar(10) NOT NULL default '',
	PRIMARY KEY (`set_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1;

INSERT INTO tbl_access(`acc_name`)
VALUES('ADMIN');
INSERT INTO tbl_access(`acc_name`)
VALUES('CASHIER');
INSERT INTO tbl_access(`acc_name`)
VALUES('KITCHEN');
INSERT INTO tbl_access(`acc_name`)
VALUES('OFFICE');
INSERT INTO tbl_access(`acc_name`)
VALUES('SERVER');
INSERT INTO tbl_access(`acc_name`)
VALUES('ADMIN');