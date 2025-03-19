<?php
require_once 'classes/CatRepository.php';
require_once 'classes/Database.php';
require_once 'router.php';


$db = new Database;
$catRep = new CatRepository($db);
$cats = $catRep->getAllCats();



include_once 'templates/index.php';

