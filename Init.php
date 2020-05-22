<?php

$MOODCLAP_START = microtime(true) * 1000;

// Load core
include('core/Constants.php');
include('Configuration.php');

// Load classes
include('class/Account.php');
include('class/AuthManager.php');
include('class/Breadcrumbs.php');
include('class/Cache.php');
include('class/Cookies.php');
include('class/Database.php');
include('class/Group.php');
include('class/Header.php');
include('class/Session.php');
include('class/Utility.php');


// Initialize
Database::connect();
AuthManager::initialize();


// Load the app
include('app/AppConfig.php');
include('app/AppCore.php');



// Cleanup
register_shutdown_function(function() {

	if (CONFIG['debug_log_access']) {
		$data = "\n";
		$data .= '> Session ID: `' . Utility::getSessionID() . '`' . "\\\n";
		if (AuthManager::isLoggedIn()) {
			$token = AuthManager::getCurrentSession()->getToken();
			$user = AuthManager::getCurrentUser();
			$data .= '> Account: `' . $user->getUsername() . ' [' . $user->getID() . ']` @ `' . $token . '`' . "\\\n";
		} else {
			$data .= '> Account: `GUEST`' . "\\\n";
		}
		$data .= '> Timestamp: `' . date('r') . '`' . "\\\n";
		$data .= '> Browser: `' . Utility::getBrowser()->Name . ' ' . Utility::getBrowser()->Version . '`' . "\\\n";
		$data .= '> Platform: `' . Utility::getBrowser()->Platform . '`' . "\\\n";
		$data .= '> Request: `' . $_SERVER['REQUEST_METHOD'] . '` `' . $_SERVER['REQUEST_URI'] . '` `?' . $_SERVER['QUERY_STRING'] . '`' . "\\\n";
		$data .= '> Connection: `' . $_SERVER['HTTP_CONNECTION'] . '`' . "\\\n";
		$data .= '> Referer: `' . $_SERVER['HTTP_REFERER'] . '`' . "\\\n";
		$data .= '> Address: `' . $_SERVER['REMOTE_ADDR'] . ':' . $_SERVER['REMOTE_PORT'] . '`' . "\\\n";
		$data .= '> Protocol: `' . $_SERVER['SERVER_PROTOCOL'] . '`' . "\\\n";
		$data .= '> Server: `' . $_SERVER['SERVER_SOFTWARE'] . '` on `' . $_SERVER['SERVER_NAME'] . '`' . "\\\n";
		$data .= '> Gateway: `' . $_SERVER['GATEWAY_INTERFACE'] . '`' . "\n";
		file_put_contents(__DIR__ . '/logs/access.md', $data, FILE_APPEND | LOCK_EX);
	}

	if (CONFIG['debug_log_sql']) {
		$data = "\n";
		$data .= '-- ' . Utility::getSessionID() . ' | ' . date('r') . "\n";
		foreach (Database::$queryHistory as $sql) {
			$data .= $sql . "\n";
		}
		file_put_contents(__DIR__ . '/logs/queries.sql', $data, FILE_APPEND | LOCK_EX);
	}

});
