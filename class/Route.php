<?php

class Route {

	/* Methods */
	public static function get($path, $callback) {
		self::match(['GET'], $path, $callback);
	}

	public static function post($path, $callback) {
		self::match(['POST'], $path, $callback);
	}

	public static function put($path, $callback) {
		self::match(['PUT'], $path, $callback);
	}

	public static function patch($path, $callback) {
		self::match(['PATCH'], $path, $callback);
	}

	public static function delete($path, $callback) {
		self::match(['DELETE'], $path, $callback);
	}

	public static function options($path, $callback) {
		self::match(['OPTIONS'], $path, $callback);
	}

	public static function head($path, $callback) {
		self::match(['HEAD'], $path, $callback);
	}

	public static function match($methods, $path, $callback) {
		self::any($path, function() {
			if (in_array($_SERVER['REQUEST_METHOD'], $methods)) {
				$callback();
			} else {
				http_response_code(405);
				return;
			}
		});
	}
	/* Methods */



	/* Redirect */
	public static function redirect($from, $to) {
		// TODO
	}

	public static function redirectPermanent($from, $to) {
		// TODO
	}

	public static function redirectInternal($from, $to) {
		// TODO
	}
	/* Redirect */



	/* Any Method */
	public static function any($path, $callback) {
		// TODO
	}
	/* Any Method */

}
