<?php

class Account {
	private $accountid;

	/* Constructor */
	public function __construct($accountid) {
		$this->accountid = $accountid;
	}

	public static function FromRow($row) {
		return new Account($row['AccountID']);
	}
	/* Constructor */



	/* Generic */
	public function getID() {
		return $this->accountid;
	}
	/* Generic */

}
