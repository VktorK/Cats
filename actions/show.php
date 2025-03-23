<?php
require_once 'classes/Database.php';
require_once 'classes/CatRepository.php';

$CatId = $_GET['id'] ?? null;
if ($CatId === false or is_int($CatId)) {
    die("Некорректный ID кота.");
}

$db = new Database();
$catRep = new CatRepository($db);
$cat = $catRep->showCat($CatId);
$year = $catRep->getAgeFront($cat[0]['AGE']);

require_once 'templates/show.php';