
-- Truncate tables, to avoid collisions with the auto increment primary key function.
TRUNCATE `moodclap_groups`;



-- Insert 'Member' group
INSERT INTO `moodclap_groups` (GroupID, GroupNameID, GroupName, Description, Permissions, SortDisplay, SortPermission) VALUES (
	1,
	'member',
	'Member',
	'The default group for new accounts.',
	'{}',
	99,
	99
);



-- Insert 'System Administrator' group
INSERT INTO `moodclap_groups` (GroupID, GroupNameID, GroupName, Description, Permissions, SortDisplay, SortPermission) VALUES (
	2,
	'sysadmin',
	'System Administrator',
	'The highest available group for the root account.',
	'{"*":true}',
	1,
	0
);
