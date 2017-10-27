<?php
// Класс отвечающий за новости

class NewsController {
    
    /**
     * @param type $i
     * @return boolean
     * Этот метод отдаёт всё необходимое для стнаицы новостей
     * (Категории, Разделы, Последние новости)
     */
    public function actionIndex($id)
    {

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список разделов кaегории
        $sections = Category::getSectionListById($id);

        // Список последних новостей
        $latestNews = News::getIndexNewsList(12);
        
        // Подключаем вид
        require_once(ROOT . '/views/site/news.php');

        return true;
    }
    
}
