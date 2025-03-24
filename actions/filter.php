<?php
require_once 'classes/CatRepository.php';
require_once 'classes/Database.php';




$db = new Database;
$catRep = new CatRepository($db);

$age = isset($_GET['age']) && is_numeric($_GET['age']) ? (int)$_GET['age'] : null;

$gender = isset($_GET['gender']) ? trim($_GET['gender']) : null;

$cats = $catRep->filterCats($age, $gender);

require_once 'templates/filtered.php';




