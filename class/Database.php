<?php

class Database {
	private static $cachedSessions = [];
	private static $cachedAccounts = [];
	private static $cachedGroups = [];
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

	public static function getAccountByName($name) {
		$sql = 'SELECT * FROM moodclap_accounts WHERE Username = ?;';
		$account = null;
		foreach (Database::prepare($sql, [$name]) as $row) $account = $row;
		if ($account == null) return null;

		$account = Account::FromRow($account);
		self::$cachedAccounts[$account->getID()] = $account;
		return $account;
	}

	public static function createAccount($username, $password) {
		$sql = 'INSERT INTO moodclap_accounts (Username, Password, FirstVisit, LastVisit) VALUES (?, ?, ?, ?);';
		Database::prepare($sql, [$username, $password, time(), time()]);
		return self::lastInsert();
	}
	/* Accounts */





	/* Groups */
	public static function getGroup($id) {
		if (isset(self::$cachedGroups[$id])) return self::$cachedGroups[$id];
		$sql = 'SELECT * FROM moodclap_groups WHERE GroupID = ?;';
		$group = null;
		foreach (Database::prepare($sql, [$id]) as $row) $group = $row;
		if ($group == null) return null;

		$group = Group::FromRow($group);
		self::$cachedGroups[$id] = $group;
		return $group;
	}

	public static function getAllGroups() {
		$sql = 'SELECT * FROM moodclap_groups;';
		$list = [];
		foreach (Database::query($sql) as $row) {
			$group = Group::FromRow($row);
			self::$cachedGroups[$group->getID()] = $group;
			$list[count($list)] = $group;
		}
		return $list;
	}
	/* Groups */





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

	public static function createSession($token, $id) {
		$session = new Session($token, $id, time(), $_SERVER['REMOTE_ADDR']);

		$sql = 'INSERT INTO moodclap_sessions (Token, AccountID, LastLogin, LastIP) VALUES (?, ?, ?, ?);';
		Database::prepare($sql, [$token, $id, $session->getLastLogin(), $session->getLastIP()]);

		return $session;
	}

	public static function dropSession($token) {
		$sql = 'DELETE FROM moodclap_sessions WHERE Token = ?;';
		Database::prepare($sql, [$token]);
	}
	/* Sessions */

}
