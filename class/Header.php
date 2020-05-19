<?php

class Header {
	private static $stylesheets = [];
	private static $scripts = [];
	private static $title = '';

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





	/* Window Title */
	public static function getTitle() {
		return self::$title;
	}

	public static function setTitle($title) {
		self::$title = $title;
	}
	/* Window Title */





	/* Bootstrap */
	public static function requireBootstrap() {
		self::addStylesheet('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
		self::addScript('https://code.jquery.com/jquery-3.4.1.slim.min.js');
		self::addScript('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js');
		self::addScript('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js');
	}

	public static function unrequireBootstrap() {
		self::removeStylesheet('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
		self::removeScript('https://code.jquery.com/jquery-3.4.1.slim.min.js');
		self::removeScript('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js');
		self::removeScript('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js');
	}
	/* Bootstrap */





	/* Font Awesome */
	public static function requireFontAwesome() {
		self::addStylesheet('https://use.fontawesome.com/releases/v5.12.1/css/all.css');
	}

	public static function unrequireFontAwesome() {
		self::removeStylesheet('https://use.fontawesome.com/releases/v5.12.1/css/all.css');
	}
	/* Font Awesome */

}
