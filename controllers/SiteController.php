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
    public function actionIndex()
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список последних новостей
        $latestNews = News::getIndexNewsList(4);

        //Описаине сайта
        $decoration = Decoration::getDescriptionTextById(1);
        
        // Подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return true;
    }


}
