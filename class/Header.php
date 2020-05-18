<?php

class Header {
	private static $stylesheets = [];
	private static $scripts = [];

	/* Stylesheets */
	public static function addStylesheet($stylesheet) {
		self::$stylesheets[$stylesheet] = true;
	}

	public static function removeStylesheet($stylesheet) {
		unset(self::$stylesheets[$stylesheet]);
	}

	public static function getStylesheets() {
		return self::$stylesheets;
	}
	/* Stylesheets */



	/* Scripts */
	public static function addScript($script) {
		self::$scripts[$script] = true;
	}

	public static function removeScript($script) {
		unset(self::$scripts[$script]);
	}

	public static function getScripts() {
		return self::$scripts;
	}
	/* Scripts */

}
