<?php

/**
 * Этот контроллер предназначен для работы с пользователем 
 * и его информацией
 *
 * @author imxo
 */
class UserController {

    private $id;

    public function __construct() {
        $this->id = 2147483647;
    }

    /**
     * Метод показа формы для именения информации
     * @param type $id
     * @return boolean
     */
    public function actionChangeForm($id) {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Информация о пользвоателе для изменения
        $user = User::getInfornationUserById($id);

        //Флаг ошибок
        $errors = [];

        // Подключаем вид
        require_once(ROOT . '/views/admin/adin_data_form.php');
        return true;
    }

    /**
     * Метод для изменения информации о клиенте
     * @param type $id
     * @return boolean
     */
    public function actionInformationUpdate($id) {

//        echo '<pre>';
//        print_r($_POST);
//        print_r($_FILES);
//        echo '</pre>';
        //Флаг ошибок
        $errors = [];


        if (strlen($_POST["login"]) < 3 || strlen($_POST["login"]) > 20) {
            array_push($errors, 'Login не должен быть короче 3х символов или длиннее 20<br>');
        }
        if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Email указан не правильно<br>');
        }
        if (!empty($_POST["name"])) {

            if (strlen($_POST["name"]) < 3 || strlen($_POST["name"]) > 20) {
                array_push($errors, 'Имя не должено быть короче 3х символов<br>');
            }
            if (is_numeric($_POST["name"])) {
                array_push($errors, 'Имя не должно состоять только из цифр<br>');
            }
        }
        if (!empty($_POST["surname"])) {

            if (strlen($_POST["surname"]) < 3 || strlen($_POST["surname"]) > 20) {
                array_push($errors, 'Фамилия не должено быть короче 3х символов<br>');
            }
            if (is_numeric($_POST["surname"])) {
                array_push($errors, 'Фамилия не должно состоять только из цифр<br>');
            }
        }
        if (is_numeric($_POST["description"])) {
            array_push($errors, 'Описание не должно состоять только из цифр<br>');
        }

        //------------------------если нет ошибок-------------------------------
        if (empty($errors)) {

            //echo 'Массив ошибок пуст';

            $information['login'] = $_POST["login"];
            $information['mail'] = $_POST["mail"];
            $information['name'] = $_POST["name"];
            $information['surname'] = $_POST["surname"];
            $information['description'] = $_POST["description"];
            $information['interests'] = $_POST["interests"];

            if (User::updateInfornationUserById($id, $information)) {
                //Идентификвця пользователя
                $_SESSION['user']['login'] = $information['login'];
                $_SESSION['user']['mail'] = $information['mail'];
                $_SESSION['user']['name'] = $information['name'];
                $_SESSION['user']['surname'] = $information['surname'];
                $_SESSION['user']['description'] = $information['description'];
                $_SESSION['user']['interests'] = $information['interests'];
            }

            //ПАроль
            if (!empty($_POST["password1"]) && !empty($_POST["password2"])) {
                if ($_POST["password1"] == $_POST["password2"]) {

                    $password = $_POST["password1"];
                    if (User::updatePasswordUserById($id, $password)) {
                        $_SESSION['user']['password'] = $password;
                    }
                } else {
                    array_push($errors, 'Пароли должны совпадать <br>');
                }
            }
            if (!empty($_POST["password1"]) xor ! empty($_POST["password2"])) {
                array_push($errors, 'Оба поля паролей должны быть заполненны <br>');
            }
            //Картинка
            if (!empty($_FILES['image']['name'])) {
//                echo '<br>Картинка: '.$_FILES['image']['name']."<br>";

                $uploaddir = 'upload/images/avatar';
                if ($_FILES['image']['size'] > 105000) {
                    array_push($errors, 'Размер картинки слишком велик <br>');
                }
                if (!file_exists($uploaddir)) {
                    array_push($errors, 'Путь сохранения не доступен обратитесь в поддержку <br>');
                } else {
                    $name = $_SESSION['user']['id'] . str_replace('image/', '.', $_FILES['image']['type']);

                    User::updateImageUserById($id, $uploaddir, $name);
                }
            }
        }

        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        // Информация о пользвоателе для изменения
        $user = User::getInfornationUserById($id);

        // Подключаем вид
        require_once(ROOT . '/views/admin/adin_data_form.php');
        return true;
    }

    public function actionRegistrationForm() {

        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        //Флаг ошибок
        $errors = [];

        // Подключаем вид
        require_once(ROOT . '/views/user/user_reg_form.php');
        return true;
    }

    public function actionRegistrationUser() {

        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();

        //Описаине сайта
        $decoration = Decoration::getDescriptionTextById($this->id);

        //Флаг ошибок
        $errors = [];

        $login = $_POST["login"];
        $email = $_POST["email"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];

        if ($login == "") {
            array_push($errors, 'Login не должен быть пустым<br>');
        }
        if (strlen($login) <= 3 || strlen($login) > 20) {
            array_push($errors, 'Login должен быть длиннее 3х символов но короче 20<br>');
        }
        if (strlen($password1) <= 6 || strlen($password1) > 20) {
            array_push($errors, 'Password должен быть длиннее 3х символов но короче 20<br>');
        }
        if ($password1 != $password2) {
            array_push($errors, 'Пароли должны совпадать<br>');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'email не валидный<br>');
        }

        if (empty($errors)) {

            if (User::EmailRepeatCheck($email)) {
                array_push($errors, 'email уже занят<br>');
            }
            if (User::LoginRepeatCheck($login)) {
                array_push($errors, 'email уже занят<br>');
            }
            if (empty($errors)) {

                $password = $password1;
                if (User::AddUser($login, $email, $password)) {
                    array_push($errors, 'Вы зарегистрировались<br>');
                } else {
                    array_push($errors, 'Вы не зарегистрировались<br>');
                    // Подключаем вид
                    require_once(ROOT . '/views/user/user_reg_form.php');
                    return true;
                }
            } else {
                // Подключаем вид
                require_once(ROOT . '/views/user/user_reg_form.php');
                return true;
            }
        } else {
            // Подключаем вид
            require_once(ROOT . '/views/user/user_reg_form.php');
            return true;
        }


        // Подключаем вид
        require_once(ROOT . '/views/site/login_form.php');
        return true;
    }

}
