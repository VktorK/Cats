<?php

$request = $_SERVER['REQUEST_URI'];

$request = strtok($request, '?');

switch ($request) {
    case '/':
    case '/index.php':
        include_once 'index.php';
        break;

    case '/add_cat.php':
        include_once 'add_cat.php';
        break;

    case '/filter_cats.php':
        include_once 'filter_cats.php';
        break;

    case '/edit_or_delete_cat.php':
        include_once 'edit_or_delete_cat.php';
        break;

    default:
        http_response_code(404);
        include_once '404.php';
        break;
}
