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
		return Routing::$callbacks[$method][$path];
	}

	public static function GET($path, $callback) {
		register($path, 'GET', $callback);
	}

	public static function POST($path, $callback) {
		register($path, 'POST', $callback);
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
		return ApiRouting::$callbacks[$method][$path];
	}

	public static function GET($path, $callback) {
		register($path, 'GET', $callback);
	}

	public static function POST($path, $callback) {
		register($path, 'POST', $callback);
	}

}
