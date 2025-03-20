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
    // Проверяем, существует ли маршрут для этого действия
    if (!empty($routers[$_REQUEST['act']])) {
        // Подключаем соответствующий файл действия
        require_once $routers[$_REQUEST['act']];
    } else {
        // Если маршрут не найден, можно подключить страницу 404
        require_once 'actions/404.php';
    }
    die(); // Завершаем выполнение скрипта
}

require_once 'templates/index.php';


