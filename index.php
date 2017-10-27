<?php

// FRONT CONTROLLER

// Общие настройки

// Включение вывода всех ошибок и предупреждений в коде PHP-скриптов
ini_set('display_errors',1);
error_reporting(E_ALL);

//Начало сессии
session_start();

//Обсалютный путь до корня папки проекта
define('ROOT', dirname(__FILE__));

//Класс для автозагрузки классов в проекте
require_once(ROOT.'/components/Autoload.php');

//Временная зона
date_default_timezone_set('Europe/Moscow');

// Вызов Router
$router = new Router();
$router->run();