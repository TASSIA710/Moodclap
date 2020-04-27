<?php

class Routing {
	private static $callbacks = null;

	public static function initialize() {
		Routing::$callbacks = [
			'GET' => [],
			'POST' => []
		];
	}

	private static function register($path, $method, $callback) {
		Routing::$callbacks[$method][$path] = $callback;
	}

	public static function getCallback($path, $method) {
		if (!isset(Routing::$callbacks[$method])) return null;
		if (!isset(Routing::$callbacks[$method][$path])) return null;
		return Routing::$callbacks[$method][$path];
	}

	public static function GET($path, $callback) {
		Routing::register($path, 'GET', $callback);
	}

	public static function POST($path, $callback) {
		Routing::register($path, 'POST', $callback);
	}

}



class ApiRouting {
	private static $callbacks = null;

	public static function initialize() {
		ApiRouting::$callbacks = [
			'GET' => [],
			'POST' => []
		];
	}

	private static function register($path, $method, $callback) {
		ApiRouting::$callbacks[$method][$path] = $callback;
	}

	public static function getCallback($path, $method) {
		if (!isset(ApiRouting::$callbacks[$method])) return null;
		if (!isset(ApiRouting::$callbacks[$method][$path])) return null;
		return ApiRouting::$callbacks[$method][$path];
	}

	public static function GET($path, $callback) {
		ApiRouting::register($path, 'GET', $callback);
	}

	public static function POST($path, $callback) {
		ApiRouting::register($path, 'POST', $callback);
	}

}
