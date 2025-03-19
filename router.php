<?php
$request = $_SERVER['REQUEST_URI'];

$request = strtok($request, '?');

$basePath = '/Cats';
if (strpos($request, $basePath) === 0) {
    $request = substr($request, strlen($basePath));
}


switch ($request) {
    case '/':
    case '/index.php':
        require_once 'index.php';
        break;

    case '/create':
        require_once 'actions/create.php';
        break;

    case '/filter':
        require_once 'actions/filter.php';
        break;

    default:
        http_response_code(404);
        require_once 'actions/404.php';
        break;
}
