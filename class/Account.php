<?php

class Account {
	private $accountid, $username, $password, $groupID, $firstVisit, $lastVisit;

	/* Constructor */
	public function __construct($accountid, $username, $password, $groupID, $firstVisit, $lastVisit) {
		$this->accountid = $accountid;
		$this->username = $username;
		$this->password = $password;
		$this->groupID = $groupID;
		$this->firstVisit = $firstVisit;
		$this->lastVisit = $lastVisit;
	}

	public static function FromRow($row) {
		return new Account($row['AccountID'], $row['Username'], $row['Password'], $row['GroupID'], $row['FirstVisit'], $row['LastVisit']);
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



	/* Password */
	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password, $noUpdate = false) {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$this->password = $password;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_accounts SET Password = ? WHERE AccountID = ?;';
		Database::prepare($sql, [$password, $this->getID()]);
	}
	/* Password */



	/* Group */
	public function getGroupID() {
		return $this->groupID;
	}

	public function getGroup() {
		return Database::getGroup($this->getGroupID());
	}

	public function setGroupID($groupID) {
		$this->groupID = $groupID;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_accounts SET GroupID = ? WHERE AccountID = ?;';
		Database::prepare($sql, [$groupID, $this->getID()]);
	}
	/* Group */



	/* First Visit */
	public function getFirstVisit() {
		return $this->firstVisit;
	}

	public function setFirstVisit($firstVisit, $noUpdate = false) {
		$this->firstVisit = $firstVisit;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_accounts SET FirstVisit = ? WHERE AccountID = ?;';
		Database::prepare($sql, [$firstVisit, $this->getID()]);
	}
	/* First Visit */



	/* Last Visit */
	public function getLastVisit() {
		return $this->lastVisit;
	}

	public function setLastVisit($lastVisit, $noUpdate = false) {
		$this->lastVisit = $lastVisit;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_accounts SET LastVisit = ? WHERE AccountID = ?;';
		Database::prepare($sql, [$lastVisit, $this->getID()]);
	}
	/* Last Visit */



	/* Push DB */
	public function pushDB() {
		$sql = 'UPDATE moodclap_accounts SET Username = ?, Password = ?, GroupID = ?, FirstVisit = ?, LastVisit = ? WHERE AccountID = ?;';
		Database::prepare($sql, [$this->getUsername(), $this->getPassword(), $this->getGroupID(), $this->getFirstVisit(),
				$this->getLastVisit(), $this->getID()]);
	}
	/* Push DB */



	/* Pull DB */
	public function pullDB() {
		$sql = 'SELECT * FROM moodclap_accounts WHERE AccountID = ?;';
		$account = null;
		foreach (Database::prepare($sql, [$this->getID()]) as $row) $account = $row;
		if ($account == null) return false;

		$this->username = $account['Username'];
		$this->password = $account['Password'];
		$this->groupID = $account['GroupID'];
		$this->firstVisit = $account['FirstVisit'];
		$this->lastVisit = $account['LastVisit'];
		return true;
	}
	/* Pull DB */

}
