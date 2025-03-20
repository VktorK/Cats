<?php
require_once 'classes/Cat.php';
require_once 'classes/CatRepository.php';
require_once 'classes/Database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location:index.php' );
    die();
}

$db = new Database();
$catRepository = new CatRepository($db);
$catRepository->deleteCat($id);

header('Location:index.php' );
die();