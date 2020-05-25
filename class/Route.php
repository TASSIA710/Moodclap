<?php

class Route {

	/* Methods */
	public static function get($path, $callback) {
		self::any(['GET'], $path, $callback);
	}

	public static function post($path, $callback) {
		self::any(['POST'], $path, $callback);
	}

	public static function put($path, $callback) {
		self::any(['PUT'], $path, $callback);
	}

	public static function patch($path, $callback) {
		self::any(['PATCH'], $path, $callback);
	}

	public static function delete($path, $callback) {
		self::any(['DELETE'], $path, $callback);
	}

	public static function options($path, $callback) {
		self::any(['OPTIONS'], $path, $callback);
	}

	public static function head($path, $callback) {
		self::any(['HEAD'], $path, $callback);
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
