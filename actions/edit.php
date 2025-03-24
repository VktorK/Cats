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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? $oldCat[0]['NAME']));
    $gender = htmlspecialchars(trim($_POST['gender'] ?? $oldCat[0]['GENDER']));
    $age = filter_var($_POST['age'] ?? $oldCat[0]['AGE'], FILTER_VALIDATE_INT);
    $mother_id = isset($_POST['mother_id']) && is_numeric($_POST['mother_id']) ? (int)$_POST['mother_id'] : null;
    $father_ids = isset($_POST['father_ids']) ? array_map('intval', explode(',', $_POST['father_ids'])) : [];

    try {
        if (empty($name)) {
            throw new Exception('Имя не может быть пустым.');
        }

        if (empty($gender) || !in_array($gender, ['male', 'female'])) {
            throw new Exception('Пол указан некорректно.');
        }

        if ($age === false || $age < 1) {
            throw new Exception('Возраст не может быть меньше 1 года.');
        }

        $cat = new Cat($name, $gender, $age, $mother_id, $father_ids);
        $catRepository->editCat($cat, $catId);

        echo "Кошка успешно обновлена!";
    } catch (Exception $e) {
        echo "Ошибка при обновлении кошки: " . htmlspecialchars($e->getMessage());
    }

    header('Location: index.php');
    exit();
}
