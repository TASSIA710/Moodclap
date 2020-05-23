<?php

class AuthManager {
	private static $currentUser, $currentSession;

	/* Initialize */
	public static function initialize() {
		$token = Cookies::getCookie('session');
		if ($token == null) return;

		$session = Database::getSession($token);
		if ($session == null) return; // TODO: Handle this error

		$account = $session->getAccount();
		if ($account == null) return; // TODO: Handle this error

		$session->setLastLogin(time());
		$session->setLastIP($_SERVER['REMOTE_ADDR']);
		$session->setUserAgent($_SERVER['HTTP_USER_AGENT']);
		$account->setLastVisit(time());

		self::$currentSession = $session;
		self::$currentUser = $account;
	}
	/* Initialize */



	/* Getters */
	public static function getCurrentUser() {
		return self::$currentUser;
	}

	public static function getCurrentSession() {
		return self::$currentSession;
	}

	public static function hasPermission($permission) {
		if (self::isLoggedIn()) {
			return self::getCurrentUser()->getGroup()->hasPermission($permission);
		} else {
			// TODO: Implement guest group
			return false;
		}
	}
	/* Getters */



	/* Login & Logout */
	public static function isLoggedIn() {
		return self::getCurrentUser() != null;
	}

	public static function login($username, $password) {
		$account = Database::getAccountByName($username);
		if ($account == null) return false;

		if (!password_verify($password, $account->getPassword())) return false;

		$token = Utility::generateSessionToken();
		$session = Database::createSession($token, $account->getID());

		self::$currentUser = $account;
		self::$currentSession = $session;
		Cookies::setCookie('session', $token);
		return $token;
	}

	public static function logout() {
		if (!self::isLoggedIn()) return;
		Database::dropSession(self::getCurrentSession()->getToken());
		Cookies::removeCookie('session');
		self::$currentUser = null;
		self::$currentSession = null;
	}
	/* Login & Logout */



	/* Create Account */
	public static function createAccount($username, $password) {
		return Database::createAccount($username, password_hash($password, PASSWORD_DEFAULT));
	}
	/* Create Account */

}
