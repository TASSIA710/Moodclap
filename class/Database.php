<?php

class Database {
	private static $cachedSessions = [];
	private static $cachedAccounts = [];
	private static $db = null;



	/* Generic */
	public static function connect() {
		Database::$db = new PDO('mysql:dbname=' . CONFIG['db_database'] . ';host=' . CONFIG['db_hostname'] . ':' . CONFIG['db_port'],
				CONFIG['db_username'], CONFIG['db_password']);
	}

	public static function query($sql) {
		return Database::$db->query($sql);
	}

	public static function prepare($sql, $data) {
		$q = Database::$db->prepare($sql);
		$q->execute($data);
		return $q->fetchAll();
	}

	public static function lastInsert() {
		return Database::$db->lastInsertId();
	}
	/* Generic */





	/* Accounts */
	public static function getAccount($id) {
		if (isset(self::$cachedAccounts[$id])) return self::$cachedAccounts[$id];
		$sql = 'SELECT * FROM moodclap_accounts WHERE AccountID = ?;';
		$account = null;
		foreach (Database::prepare($sql, [$id]) as $row) $account = $row;
		if ($account == null) return null;

		$account = Account::FromRow($account);
		self::$cachedAccounts[$id] = $account;
		return $account;
	}
	/* Accounts */





	/* Sessions */
	public static function getSession($token) {
		if (isset(self::$cachedSessions[$token])) return self::$cachedSessions[$token];
		$sql = 'SELECT * FROM moodclap_sessions WHERE Token = ?;';
		$session = null;
		foreach (Database::prepare($sql, [$token]) as $row) $session = $row;
		if ($session == null) return null;

		$session = Session::FromRow($session);
		self::$cachedSessions[$token] = $session;
		return $session;
	}

	public static function dropSession($token) {
		$sql = 'DELETE FROM moodclap_sessions WHERE Token = ?;';
		Database::prepare($sql, [$token]);
	}
	/* Sessions */

}
