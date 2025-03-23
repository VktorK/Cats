<?php
require_once 'classes/Cat.php';
require_once 'classes/CatRepository.php';
require_once 'classes/Database.php';

$catId = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($catId === null || $catId <= 0) {
    header('Location: index.php');
    die();
}
$db = new Database();
$catRepository = new CatRepository($db);

$oldCat = $catRepository->getOldCat($catId);

// var_dump($oldCat);die();


if (count($_POST) > 0) {
    $name = strip_tags($_POST['name'] ?? '');
    $gender = strip_tags($_POST['gender'] ?? '');
    $age = filter_var($_POST['age'] ?? null, FILTER_VALIDATE_INT);
    $mother_id = isset($_POST['mother_id']) && $_POST['mother_id'] !== '' ? (int)$_POST['mother_id'] : null;
    $father_ids = explode(',', $_POST['father_ids']);

    if ($name && $gender && $age !== false) {
        try {
            $cat = new Cat($name, $gender, $age, $mother_id, $father_ids);
            $catRepository->addCat($cat);
            echo "Кошка успешно добавлена!";
        } catch (Exception $e) {
            echo "Ошибка при добавлении кошки: " . $e->getMessage();
        }
    } else {
        echo "Пожалуйста, заполните все обязательные поля.";
    }
    header('Location:index.php' );
    die();
}

require_once 'templates/edit.php';
