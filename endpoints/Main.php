<?php

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$path = substr($path, strlen(substr($_SERVER['SCRIPT_NAME'], 0, strlen($_SERVER['SCRIPT_NAME']) - strlen('index.php'))));

if ($method != 'GET' && $method != 'POST') {
	http_response_code(405);
	return;
}

$callback = Routing::getCallback($path, $method);

if ($callback == null) {
	http_response_code(404);
	return;
}

$callback($request);
return;
