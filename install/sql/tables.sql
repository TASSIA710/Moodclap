
-- Create 'moodclap_sessions'
CREATE TABLE IF NOT EXISTS `moodclap_sessions` (
	`Token` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,
	`AccountID` BIGINT,
	`LastLogin` BIGINT,
	`LastIP` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,
	PRIMARY KEY (`Token`), INDEX (`AccountID`)
);
