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
	/* Getters */



	/* Login & Logout */
	public static function isLoggedIn() {
		return self::getCurrentUser() != null;
	}

	public static function login($username, $password) {
		// TODO
	}

	public static function logout() {
		if (!self::isLoggedIn()) return;
		Database::dropSession(self::getCurrentSession()->getToken());
		Cookies::removeCookie('session');
		self::$currentUser = null;
		self::$currentSession = null;
	}
	/* Login & Logout */

}