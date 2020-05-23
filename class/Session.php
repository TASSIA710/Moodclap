<?php

class Session {
	private $token, $accountid, $lastLogin, $lastIP, $userAgent;

	/* Constructor */
	public function __construct($token, $accountid, $lastLogin, $lastIP, $userAgent) {
		$this->token = $token;
		$this->accountid = $accountid;
		$this->lastLogin = $lastLogin;
		$this->lastIP = $lastIP;
		$this->userAgent = $userAgent;
	}

	public static function FromRow($row) {
		return new Session($row['Token'], $row['AccountID'], $row['LastLogin'], $row['LastIP'], $row['UserAgent']);
	}
	/* Constructor */



	/* Generic */
	public function getToken() {
		return $this->token;
	}

	public function getAccountID() {
		return $this->accountid;
	}

	public function getAccount() {
		return Database::getAccount(self::getAccountID());
	}
	/* Generic */



	/* Last Login */
	public function getLastLogin() {
		return $this->lastLogin;
	}

	public function setLastLogin($lastLogin, $noUpdate = false) {
		$this->lastLogin = $lastLogin;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_sessions SET LastLogin = ? WHERE Token = ?;';
		Database::prepare($sql, [$lastLogin, $this->getToken()]);
	}
	/* Last Login */



	/* Last IP */
	public function getLastIP() {
		return $this->lastIP;
	}

	public function setLastIP($lastIP, $noUpdate = false) {
		$this->lastIP = $lastIP;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_sessions SET LastIP = ? WHERE Token = ?;';
		Database::prepare($sql, [$lastIP, $this->getToken()]);
	}
	/* Last IP */



	/* User Agent */
	public function getUserAgent() {
		return $this->userAgent;
	}

	public function setUserAgent($userAgent, $noUpdate = false) {
		$this->userAgent = $userAgent;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_sessions SET UserAgent = ? WHERE Token = ?;';
		Database::prepare($sql, [$userAgent, $this->getToken()]);
	}
	/* User Agent */



	/* Push DB */
	public function pushDB() {
		$sql = 'UPDATE moodclap_sessions SET LastLogin = ?, LastIP = ?, UserAgent = ? WHERE Token = ?;';
		Database::prepare($sql, [$this->getLastLogin(), $this->getLastIP(), $this->getUserAgent(), $this->getToken()]);
	}
	/* Push DB */



	/* Pull DB */
	public function pullDB() {
		$sql = 'SELECT * FROM moodclap_sessions WHERE Token = ?;';
		$session = null;
		foreach (Database::prepare($sql, [$this->getToken()]) as $row) $session = $row;
		if ($session == null) return false;

		$this->setLastLogin($session['LastLogin'], true);
		$this->setLastIP($session['LastIP'], true);
		$this->setUserAgent($session['UserAgent'], true);
		return true;
	}
	/* Pull DB */

}
