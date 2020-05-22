<?php

class Utility {

	/* Generations */
	public static function generateToken($length, $chars) {
		$clen = strlen($chars);
		$str = '';
		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[rand(0, $clen - 1)];
		}
		return $str;
	}

	public static function generateSessionToken() {
		return Utility::generateToken(CONFIG['token_session_length'], CONFIG['token_session_chars']);
	}
	/* Generations */



	/* Escape */
	public static function escapeXSS($str) {
		return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
	}
	/* Escape */



	/* String Utility */
	public static function startsWith($str, $check) {
		return substr($str, 0, strlen($check)) === $check;
	}

	public static function endsWith($str, $check) {
		if ($check === '') return true;
		return substr($str, -strlen($check)) === $check;
	}

	public static function replaceFirst($from, $to, $content) {
	    $from = '/' . preg_quote($from, '/') . '/';
	    return preg_replace($from, $to, $content, 1);
	}
	/* String Utility */



	/* Access ID */
	private static $sessionID = null;

	public static function getSessionID() {
		if (self::$sessionID != null) return self::$sessionID;
		if (AuthManager::isLoggedIn()) {
			self::$sessionID = uniqid(AuthManager::getCurrentUser()->getID() . '-', true);
		} else {
			self::$sessionID = uniqid('guest-', true);
		}
		return self::$sessionID;
	}
	/* Access ID */

}
