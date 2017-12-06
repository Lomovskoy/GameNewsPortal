<?php
//Массив с роутами (путями) для класса Router
return array(
    //Регистрауция пользоватля
    'ragistration_user' => 'user/registrationUser',
    
    //Форма регистрации пользоватля
    'ragistration_form' => 'user/registrationForm',
    
    //Изменение информации о пользователе
    'information_update/([0-9]+)' => 'user/informationUpdate/$1',
    
    //Изменить информацию пользователя
    'change_form/([0-9]+)' => 'user/changeForm/$1', 
    
    //Выход из сессии
    'login_out' => 'registration/loginOut',
    
    //Вход в личный кабинет
    'logincheck' => 'registration/loginCheck',
    
    //Вход в панель логина
    'login_form' => 'registration/loginForm',
    
    //Одна новость
    'category-([2,5])/new-([0-9]+)' => 'news/oneNew/$1/$2',
    
    // Разделы новостей (игровые новости)
    'category-([2,5])/section-([0-9]+)' => 'news/section/$1/$2',
    
     // Главная страница новостей
    'category-(2)' => 'news/index/$1',
    
    // Контакты
    'category-(3)' => 'site/contacts/$1',
    
    //О нас
    'category-(4)' => 'site/aboutUs/$1',
    // Главная страница
    'category-(1)' => 'site/index/$1',
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index',
);
