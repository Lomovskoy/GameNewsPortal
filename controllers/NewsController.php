<?php
// Класс отвечающий за новости

class NewsController {
    
    /**
     * @param type $i
     * @return boolean
     * Этот метод отдаёт всё необходимое для стнаицы новостей
     * (Категории, Разделы, Последние новости)
     */
    public function actionIndex($categoryi_id)
    {

        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Список разделов кaегории
        $sections = Category::getSectionByCategories($categoryi_id);

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
    public function actionSection($categoryi_id, $section_id)
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Список разделов кaегории
        $sections = Category::getSectionByCategories($categoryi_id);

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
    public function actionOneNew($categoryi_id, $new_id)
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Список разделов кaегории
        $sections = Category::getSectionByCategories($categoryi_id);

        // Получение одной новости
        $New = News::getOneNewsById($new_id);
        
        // Подключаем вид
        require_once(ROOT . '/views/site/oneNew.php');

        return true;
    }
    
    public function actionUpdateForm(){
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();
        
        $categoryi_id = 2;
        
        // Список разделов кaегории
        $sections = Category::getSectionByCategories($categoryi_id);
        
        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_news_update_form.php');
        return true;
    }
    
    public function actionAddNews(){
        
        $caption = $_POST['caption'];
        $description = $_POST['description'];
        $sectionId = $_POST['section'];
        $publicing = $_POST['publicing'];
        $autor = $_SESSION['user']['id'];
        $data = date("Y-m-d H:i:s");
        // Флаг ошибок
        $errors = [];
        
        if($_SESSION['user']['rang'] == 6){
            $new_or_forum = $_POST['new_or_forum'];
        }else{
            if($_SESSION['user']['rang'] == 4 || $_SESSION['user']['rang'] == 2){
                $new_or_forum = '0';
            }
            if($_SESSION['user']['rang'] == 5 || $_SESSION['user']['rang'] == 3){
                $new_or_forum = '1';
            }
        }
        if(empty($_FILES['image']['name'])){
            $image = 'no-image.jpg';
            
        }else{
            $image = $_FILES['image']['name'];
        }

        //Картинка
        if (!empty($_FILES['image']['name'])) {

            //Получить директорию файла
            $uploaddir = News::getPath($sectionId);
            if($new_or_forum == '0'){
                $path = 'upload/images/news/'.$uploaddir['folder_name'].'/';
                //$uploaddir = 'upload/images/avatar';
            }elseif ($new_or_forum == '1') {
                $path = 'upload/images/forum/'.$uploaddir['folder_name'].'/';
            }
            
            echo dirname(__FILE__).'<br>';
            echo $path.'<br>';
            
            if ($_FILES['image']['size'] > 1050000) {
                array_push($errors, 'Размер картинки слишком велик <br>');
            }
            if (!file_exists($path)) {
                array_push($errors, 'Путь сохранения не доступен обратитесь в поддержку <br>');
            } else {
                
                News::addNews($autor,$sectionId,$publicing,$new_or_forum,$caption,$description,$image,$data,$path);
            }
        }else{
            
            News::addNews($autor,$sectionId,$publicing,$new_or_forum,$caption,$description,$image,$data);
        }
     
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Подключаем вид
        require_once(ROOT . '/views/admin/adin_panel.php');

        return true;
    }
    
    public function actionViewNewsListByCategory(){
        // Флаг ошибок
        $errors = [];
        
        if($_SESSION['user']['rang'] == 6){
            $categoryi_id = $_POST['new_or_forum'];
        }else{
            if($_SESSION['user']['rang'] == 4 || $_SESSION['user']['rang'] == 2){
                $categoryi_id = 2;
            }
            if($_SESSION['user']['rang'] == 5 || $_SESSION['user']['rang'] == 3){
                $categoryi_id = 5;
            }
        }
        
        // Список разделов кaегории
        $sections = Category::getSectionByCategories($categoryi_id);
        
        $sectionId = $_POST['section'];
        $news_by_category = News::getNewsBySection($sectionId);
        
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();
        
        
        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_news_update_form.php');

        return true;
        
    }
}
