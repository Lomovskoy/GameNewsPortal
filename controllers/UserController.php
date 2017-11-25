<?php

/**
 * Этот контроллер предназначен для работы с пользователем 
 * и его информацией
 *
 * @author imxo
 */
class UserController {
    
    public function actionChangeForm($id)
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        $user = User::getInfornationUserById($id);
        echo '<pre>';
        print_r($user);
        echo $user['login'];
        echo '</pre>';
        // Подключаем вид
        require_once(ROOT . '/views/admin/adin_data_form.php');
        return true;
    }
}
