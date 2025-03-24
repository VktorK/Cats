<?php
require_once 'classes/Cat.php';
require_once 'classes/CatRepository.php';
require_once 'classes/Database.php';


$catId = isset($_GET['id'])? $_GET['id'] : null;

if ($catId === null || $catId <= 0) {
    header('Location: index.php');
    die();
}

$db = new Database();
$catRepository = new CatRepository($db);

$catRepository->deleteCat($catId);

header('Location: index.php');
exit();
