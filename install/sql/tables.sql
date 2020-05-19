
-- Create 'moodclap_accounts'
CREATE TABLE IF NOT EXISTS `moodclap_accounts` (
	`AccountID` BIGINT AUTO_INCREMENT,
	`Username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,
	`Password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,
	`FirstVisit` BIGINT DEFAULT 0,
	`LastVisit` BIGINT DEFAULT 0,
	`GroupID` BIGINT DEFAULT 1,
	PRIMARY KEY (`AccountID`), UNIQUE (`Username`), INDEX (`GroupID`)
);



-- Create 'moodclap_groups'
CREATE TABLE IF NOT EXISTS `moodclap_groups` (
	`GroupID` BIGINT AUTO_INCREMENT,
	`GroupNameID` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,
	`GroupName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,
	`Description` TEXT CHARACTER SET utf8 COLLATE utf8_bin,
	`Permissions` LONGTEXT CHARACTER SET utf8 COLLATE utf8_bin,
	`SortDisplay` INT DEFAULT 0,
	`SortPermission` INT DEFAULT 0,
	PRIMARY KEY (`GroupID`), UNIQUE (`GroupNameID`)
);



-- Create 'moodclap_sessions'
CREATE TABLE IF NOT EXISTS `moodclap_sessions` (
	`Token` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,
	`AccountID` BIGINT,
	`LastLogin` BIGINT,
	`LastIP` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,
	PRIMARY KEY (`Token`), INDEX (`AccountID`)
);
