<?php

/**
 * Контроллер SiteController
 * для работы с основными функциями а  сайта
 */
class SiteController
{

    /**
     * @return boolean
     * Этот метод отдаёт всю информацию о главной странице
     * (Категории, Последние новости, текст на главнйо странице)
     */
    public function actionIndex($categoryi_id = 1)
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Список последних новостей
        $latestNews = News::getIndexNewsList(4);

        //Описаине сайта
        $decoration = Decoration::getDescriptionTextById($categoryi_id);
        
        // Подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return true;
    }
    
    /**
     * @return boolean
     * Этот метод отдаёт всю информацию о странице контакты
     * (Категории, текст на странице)
     */
    public function actionContacts($categoryi_id = 3)
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        //Описаине сайта
        $decoration = Decoration::getDescriptionTextById($categoryi_id);
        
        // Подключаем вид
        require_once(ROOT . '/views/site/contacts.php');
        return true;
    }

    /**
     * @return boolean
     * Этот метод отдаёт всю информацию о странице о нас
     * (Категории, текст на странице)
     */
    public function actionAboutUs($categoryi_id = 4)
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        //Описаине сайта
        $decoration = Decoration::getDescriptionTextById($categoryi_id);
        
        //Список партнёров из папки в бд добавить название паки и название картинки и сслку
        $parners = Decoration::getPartners();
        
        // Подключаем вид
        require_once(ROOT . '/views/site/aboutUs.php');
        return true;
    }
}
