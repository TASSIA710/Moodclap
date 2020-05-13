<?php

class Account {
	private $accountid, $username;

	/* Constructor */
	public function __construct($accountid, $username) {
		$this->accountid = $accountid;
		$this->username = $username;
	}

	public static function FromRow($row) {
		return new Account($row['AccountID'], $row['Username']);
	}
	/* Constructor */



	/* Generic */
	public function getID() {
		return $this->accountid;
	}
	/* Generic */



	/* Username */
	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username, $noUpdate = false) {
		$this->username = $username;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_accounts SET Username = ? WHERE AccountID = ?;';
		Database::prepare($sql, [$username, $this->getID()]);
	}
	/* Username */



	/* Push DB */
	public function pushDB() {
		$sql = 'UPDATE moodclap_accounts SET WHERE AccountID = ?;';
		Database::prepare($sql, [$this->getID()]);
	}
	/* Push DB */



	/* Pull DB */
	public function pullDB() {
		$sql = 'SELECT * FROM moodclap_accounts WHERE AccountID = ?;';
		$account = null;
		foreach (Database::prepare($sql, [$this->getID()]) as $row) $account = $row;
		if ($account == null) return false;

		return true;
	}
	/* Pull DB */

}
