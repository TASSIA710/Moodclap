<?php

class Group {
	private $groupID, $groupName, $description, $permissions;

	/* Constructor */
	public function __construct($groupID, $groupName, $description, $permissions) {
		$this->groupID = $groupID;
		$this->groupName = $groupName;
		$this->description = $description;
		$this->permissions = $permissions;
	}

	public static function FromRow($row) {
		return new Group($row['GroupID'], $row['GroupName'], $row['Description'], json_decode($row['Permissions'], true));
	}

	public static function getDefault() {
		return Database::getGroup(1);
	}

	public static function getSysAdmin() {
		return Database::getGroup(2);
	}
	/* Constructor */



	/* Generic */
	public function getID() {
		return $this->groupID;
	}
	/* Generic */



	/* Group Name */
	public function getName() {
		return $this->groupName;
	}

	public function setName($groupName, $noUpdate = false) {
		$this->groupName = $groupName;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_groups SET GroupName = ? WHERE GroupID = ?;';
		Database::prepare($sql, [$this->getID(), $groupName]);
	}
	/* Group Name */



	/* Description */
	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description, $noUpdate = false) {
		$this->description = $description;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_groups SET Description = ? WHERE GroupID = ?;';
		Database::prepare($sql, [$this->getID(), $description]);
	}
	/* Description */



	/* Permissions */
	public function getPermissions() {
		return $this->permissions;
	}

	public function getPermissionJSON() {
		return json_encode($this->getPermissions());
	}

	public function hasPermission($permission) {
		return isset($this->getPermissions()[$permission]) && $this->getPermissions()[$permission] !== false;
	}

	public function setPermission($permission, $value, $noUpdate = false) {
		$this->permissions[$permission] = $value;
		$this->setPermissions($this->permissions, $noUpdate);
	}

	public function unsetPermission($perission, $noUpdate = false) {
		unset($this->permissions[$permission]);
		$this->setPermissions($this->permissions, $noUpdate);
	}

	public function grantPermission($permission, $noUpdate = false) {
		$this->setPermission($permission, true, $noUpdate);
	}

	public function denyPermission($permission, $noUpdate = false) {
		$this->setPermission($permission, false, $noUpdate);
	}

	public function setPermissions($permissions, $noUpdate = false) {
		$this->permissions = $permissions;
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_groups SET Permissions = ? WHERE GroupID = ?;';
		Database::prepare($sql, [json_encode($permissions), $this->getID()]);
	}

	public function setPermissionJSON($json, $noUpdate = false) {
		$this->permissions = json_decode($json, true);
		if ($noUpdate) return;

		$sql = 'UPDATE moodclap_groups SET Permissions = ? WHERE GroupID = ?;';
		Database::prepare($sql, [$json, $this->getID()]);
	}
	/* Permissions */



	/* Push DB */
	public function pushDB() {
		$sql = 'UPDATE moodclap_groups SET GroupName = ?, Description = ?, Permissions = ? WHERE GroupID = ?;';
		Database::prepare($sql, [$this->getName(), $this->getDescription(), $this->getPermissionJSON(), $this->getID()]);
	}
	/* Push DB */



	/* Pull DB */
	public function pullDB() {
		$sql = 'SELECT * FROM moodclap_groups WHERE GroupID = ?;';
		$group = null;
		foreach (Database::prepare($sql, [$this->getID()]) as $row) $group = $row;
		if ($group == null) return false;

		$this->setName($group['GroupName'], true);
		$this->setDescription($group['Description'], true);
		$this->setPermissionJSON($group['Permissions'], true);
		return true;
	}
	/* Pull DB */

}
