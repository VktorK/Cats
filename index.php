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

$age = filter_input(INPUT_GET, 'age', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: '';
$gender = isset($_GET['gender']) ? htmlspecialchars($_GET['gender'], ENT_QUOTES, 'UTF-8') : '';

$cats = (!empty($age) || !empty($gender))
    ? $catRep->filterCats($age, $gender)
    : $catRep->getAllCats();


if (isset($_REQUEST['act'])) {
    if (!empty($routers[$_REQUEST['act']])) {
        require_once $routers[$_REQUEST['act']];
    } else {
        require_once 'actions/404.php';
    }
    die();
}

require_once 'templates/index.php';


