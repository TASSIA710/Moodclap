<?php

const CONFIG = [

	/* == -- Debugging -- == */
	'debug_log_access'	=> false,
	'debug_log_sql'		=> true,
	/* == -- Debugging -- == */



	/* == -- Cookies -- == */
	'cookie_duration' =>	60 * 60 * 24 * 30,
	'cookie_domain' =>		'example.com',
	/* == -- Cookies -- == */



	/* == -- Tokens -- == */
	'token_session_length' =>	15,
	'token_session_chars' =>	'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
	/* == -- Tokens -- == */



	/* == -- Database Configuration -- == */
	'db_hostname' =>	'localhost',
	'db_port' =>		3306,
	'db_database' =>	'database',
	'db_username' =>	'username',
	'db_password' =>	'password',
	/* == -- Database Configuration -- == */

];
