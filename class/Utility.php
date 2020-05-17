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



	/* String Utility */
	public static function startsWith($str, $check) {
		// TODO
	}

	public static function endsWith($str, $check) {
		// TODO
	}
	/* String Utility */

}
