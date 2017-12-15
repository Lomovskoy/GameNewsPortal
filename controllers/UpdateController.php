<?php

/**
 * Description of UpdateController
 *
 * @author pupil
 */
class UpdateController {

    public function actionDescriptionForm() {
        $errors = [];
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        //Описаине сайта
        $decorationAll = Decoration::getAllDescriptionText();

        //Список партнёров из папки в бд добавить название паки и название картинки и сслку
        $parners = Decoration::getPartners();

        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_update_description.php');
        return true;
    }

    public function actionDecorationUpdate($id) {
        $errors = [];
        $description = $_POST['description'];
        //Изменить описание
        Decoration::UpdateDescriptionText($id, $description);

        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        //Описаине сайта
        $decorationAll = Decoration::getAllDescriptionText();

        //Список партнёров из папки в бд добавить название паки и название картинки и сслку
        $parners = Decoration::getPartners();

        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_update_description.php');
        return true;
    }

    public function actionNewsForm() {

        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();




        // Подключаем вид
        require_once(ROOT . '/views/admin/action_news_form.php');
        return true;
    }

    public function actionAddPartners() {
        $errors = [];
        //Картинка
        if (!empty($_FILES['image']['name'])) {
//                echo '<br>Картинка: '.$_FILES['image']['name']."<br>";

            $uploaddir = 'upload/images/description';
            if ($_FILES['image']['size'] > 1050000) {
                array_push($errors, 'Размер картинки слишком велик <br>');
            }
            if (!file_exists($uploaddir)) {
                array_push($errors, 'Путь сохранения не доступен обратитесь в поддержку <br>');
            } else {
                $name = $_SESSION['user']['id'] . str_replace('image/', '.', $_FILES['image']['type']);
                $src = $_POST['src'];
                $name = $_FILES['image']['name'];
                Decoration::setNewPartners($src, $name, $uploaddir);
            }
        }

        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        //Описаине сайта
        $decorationAll = Decoration::getAllDescriptionText();

        //Список партнёров из папки в бд добавить название паки и название картинки и сслку
        $parners = Decoration::getPartners();

        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_update_description.php');
        return true;
    }

    public function actionPartners($id) {

        # Если кнопка нажата
        if (isset($_POST['delite_partners'])) {
            $filename = $_POST['name'];
            $filepath = "upload/images/description/$filename";
            if (unlink($filepath)) {
                Decoration::dellPartners($id);
            }
        } 
        else if (isset($_POST['upload_partners'])) {
            $filename = $_POST['name'];
            $filepath = "upload/images/description/$filename";
            
            $errors = [];
            $src = $_POST['src'];
            $id =  $_POST['id'];
            //Картинка
            if (!empty($_FILES['image']['name'])) {
//                echo '<br>Картинка: '.$_FILES['image']['name']."<br>";
                $uploaddir = 'upload/images/description';
                if ($_FILES['image']['size'] > 1050000) {
                    array_push($errors, 'Размер картинки слишком велик <br>');
                }
                if (!file_exists($uploaddir)) {
                    array_push($errors, 'Путь сохранения не доступен обратитесь в поддержку <br>');
                } else {
                    $name = $_FILES['image']['name'];
                    unlink($filepath);
                    Decoration::updatePartners($id, $src, $name, $uploaddir);
                }
            }else{
                Decoration::updatePartners($id, $src);
            }
        }

        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        //Описаине сайта
        $decorationAll = Decoration::getAllDescriptionText();

        //Список партнёров из папки в бд добавить название паки и название картинки и сслку
        $parners = Decoration::getPartners();

        // Подключаем вид
        require_once(ROOT . '/views/admin/admin_update_description.php');
        return true;
    }

}
