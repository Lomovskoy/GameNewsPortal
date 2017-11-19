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

        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Список разделов кaегории
        $sections = Category::getSectionByCategories($id);

        // Список последних новостей
        $latestNews = News::getIndexNewsList(12);
        
        // Подключаем вид
        require_once(ROOT . '/views/site/news.php');

        return true;
    }
    
    /**
     * 
     * @param type $categoryi_d1
     * @param type $section_id
     * @return boolean
     * Метод для работы со всеми новостями раздела
     */
    public function actionSection($categoryi_d1, $section_id)
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Список разделов кaегории
        $sections = Category::getSectionByCategories($categoryi_d1);

        // Список всех новостей раздела
        $len = 500;
        $sectionNews = News::getNewsBySection($section_id, $len);
        
        // Подключаем вид
        require_once(ROOT . '/views/site/sectionNews.php');

        return true;
    }
    
    /**
     * 
     * @param type $categoryi_d1
     * @param type $new_id
     * @return boolean
     * Метод для показа одной новости
     */
    public function actionOneNew($categoryi_d1, $new_id)
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Список разделов кaегории
        $sections = Category::getSectionByCategories($categoryi_d1);

        // Получение одной новости
        $New = News::getOneNewsById($new_id);
        
        // Подключаем вид
        require_once(ROOT . '/views/site/oneNew.php');

        return true;
    }
}
