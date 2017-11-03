<?php
//Массив с роутами (путями) для класса Router
return array(
    //Одна новость
    'category-([2,5])/new-([0-9]+)' => 'news/oneNew/$1/$2',
    
    // Разделы новостей (игровые новости)
    'category-([2,5])/section-([0-9]+)' => 'news/section/$1/$2',
    
     // Главная страница новостей
    'category-(2)' => 'news/index/$1',
    
    // Главная страница
    'category-(1)' => 'site/index',
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index',
);
