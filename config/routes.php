<?php
//Массив с роутами (путями) для класса Router
return array(
    // Главная страница новостей
    'category-([2])' => 'news/index/$1',

    // Главная страница
    'category-([1])' => 'site/index',
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index',
);
