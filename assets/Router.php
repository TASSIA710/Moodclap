<?php

$path = __DIR__ . '/' . $resource;

if (!file_exists($path) || !is_file($path)) {
	http_response_code(404);
	exit;
}

echo file_get_contents($path);
exit;
