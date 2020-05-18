
-- Truncate tables, to avoid collisions with the auto increment primary key function.
TRUNCATE `moodclap_groups`;



-- Insert 'Member' group
INSERT INTO `moodclap_groups` (GroupID, GroupName, Description, Permissions) VALUES (
	1,
	'Member',
	'The default group for new accounts.',
	'{}'
);



-- Insert 'System Administrator' group
INSERT INTO `moodclap_groups` (GroupID, GroupName, Description, Permissions) VALUES (
	2,
	'System Administrator',
	'The highest available group for the root account.',
	'{"*":true}'
);
