<?php
require_once 'classes/Cat.php';
require_once 'classes/CatRepository.php';
require_once 'classes/Database.php';

if (count($_POST) > 0) {
    $name = strip_tags($_POST['name'] ?? '');
    $gender = strip_tags($_POST['gender'] ?? '');
    $age = filter_var($_POST['age'] ?? null, FILTER_VALIDATE_INT);
    $mother_id = isset($_POST['mother_id']) && $_POST['mother_id'] !== '' ? (int)$_POST['mother_id'] : null;
    $father_ids = explode(',', $_POST['father_ids']);

    if ($name && $gender && $age !== false) {
        try {
            $db = new Database();
            $catRepository = new CatRepository($db);
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
    exit();
}

require_once 'templates/create.php';
