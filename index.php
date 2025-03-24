<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'classes/CatRepository.php';
require_once 'classes/Database.php';
require_once 'classes/Cat.php';
require_once 'router.php';


$db = new Database;
$catRep = new CatRepository($db);

$cats = $catRep->getAllCats();


if (isset($_REQUEST['act'])) {
    if (!empty($routers[$_REQUEST['act']])) {
        require_once $routers[$_REQUEST['act']];
    } else {
        require_once 'actions/404.php';
    }
    die();
}

require_once 'templates/index.php';


