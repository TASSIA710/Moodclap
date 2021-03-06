<?php

if (!isset($resource)) {
    http_response_code(500);
    exit;
}

include(__DIR__ . '/../class/Utility.php');
$FILE_PATH = __DIR__ . '/' . $resource;

if (!file_exists($FILE_PATH) || !is_file($FILE_PATH)) {
	http_response_code(404);
	exit;
}


if (Utility::endsWith($FILE_PATH, '.css')) {
	header('Content-Type: text/css');
} elseif (Utility::endsWith($FILE_PATH, '.js')) {
	header('Content-Type: text/javascript');
}


echo file_get_contents($FILE_PATH);
exit;
