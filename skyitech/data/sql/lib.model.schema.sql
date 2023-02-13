
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- admin
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;


CREATE TABLE `admin`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50)  NOT NULL,
	`password` VARCHAR(50)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;


CREATE TABLE `category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`category_name` VARCHAR(100),
	`title` VARCHAR(255),
	`description` TEXT,
	`parents` VARCHAR(100) default '|',
	`parentsarray` TEXT,
	`status` VARCHAR(1) default 'A',
	`child` VARCHAR(1) default 'N',
	`ord` INTEGER(4) default 0,
	`flag_new` INTEGER(2) default 0,
	`flag_updated` INTEGER(2) default 0,
	`flag_hot` INTEGER(2) default 0,
	`files` INTEGER(5) default 0,
	`url` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `category_parents_index`(`parents`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- files
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `files`;


CREATE TABLE `files`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`file_name` VARCHAR(255),
	`category_id` INTEGER default 0,
	`description` TEXT,
	`size` INTEGER(9) default 0,
	`today` INTEGER(5) default 0,
	`download` INTEGER(6) default 0,
	`extension` VARCHAR(4),
	`status` VARCHAR(1) default 'A',
	`url` VARCHAR(255),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `files_file_name_index`(`file_name`),
	KEY `files_category_id_index`(`category_id`),
	CONSTRAINT `files_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- download_history
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `download_history`;


CREATE TABLE `download_history`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`date` VARCHAR(8),
	`file_id` INTEGER,
	`extension` VARCHAR(4),
	`hits` INTEGER(5) default 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY `df` (`date`, `file_id`),
	KEY `download_history_date_index`(`date`),
	INDEX `download_history_FI_1` (`file_id`),
	CONSTRAINT `download_history_FK_1`
		FOREIGN KEY (`file_id`)
		REFERENCES `files` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- setting
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `setting`;


CREATE TABLE `setting`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`meta` VARCHAR(40),
	`description` VARCHAR(100),
	`value` TEXT,
	`device` VARCHAR(1) default 'P',
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- updates
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `updates`;


CREATE TABLE `updates`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` TEXT,
	`status` VARCHAR(1) default 'A',
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
