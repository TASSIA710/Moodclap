<?php

class Cookies {

	public static function setCookie($name, $value) {
		$_COOKIE[$name] = $value;
		setcookie($name, $value, time() + CONFIG['cookie_duration'], '/', CONFIG['cookie_domain']);
	}

	public static function removeCookie($name) {
		if (isset($_COOKIE[$name])) {
			unset($_COOKIE[$name]);
			setcookie($name, '', time() - 3600);
		}
	}

	public static function getCookie($name) {
		return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
	}

}
