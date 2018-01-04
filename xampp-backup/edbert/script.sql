USE db_exam;

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE `tbl_products`(
	`p_id` int(10) unsigned NOT NULL auto_increment,
	`p_name` varchar(180) NOT NULL default '',
	`p_description` varchar(255) NOT NULL default '',
	`p_quantity` int(100) NOT NULL default '1',
	`p_price` double(100) NOT NULL default '1',
	PRIMARY KEY(`p_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1;

INSERT INTO tbl_products (`p_name`,`p_description`,`p_quantity`,`p_price`)
VALUES ('A4Tech Keyboard','Mechanical','10','2400');
INSERT INTO tbl_products (`p_name`,`p_description`,`p_quantity`,`p_price`)
VALUES ('Razer Ouroboros Gaming Mouse','2400dpi','4','7999');
INSERT INTO tbl_products (`p_name`,`p_description`,`p_quantity`,`p_price`)
VALUES ('Palit GTX 750 Ti 2GB GDDR5','Video Card','10','6500');
INSERT INTO tbl_products (`p_name`,`p_description`,`p_quantity`,`p_price`)
VALUES ('Acer Aspire R3-131T','Laptop','3','16999');