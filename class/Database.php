<?php

class Database {
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
	/* Generic */

}
