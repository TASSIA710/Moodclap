<?php

$ROOT_PATH = '../../';
include($ROOT_PATH . 'core/Init.php');

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$path = substr($path, strlen(substr($_SERVER['SCRIPT_NAME'], 0, strlen($_SERVER['SCRIPT_NAME']) - strlen('index.php'))));

if ($method != 'GET' && $method != 'POST') {
	http_response_code(405);
	return;
}

$callback = ApiRouting::getCallback($path, $method);

if ($callback == null) {
	http_response_code(404);
	return;
}

$data = [];

if ($method == 'GET') {
	foreach ($_GET as $key => $value) {
		$data[$key] = $value;
	}

} elseif ($method == 'POST') {
	$data = json_decode(file_get_contents('php://input'), true);

}

$request = new ApiRequest($data, $method);
$callback($request);

http_response_code($request->getCode());
echo json_encode($request->getResponse());
return;
