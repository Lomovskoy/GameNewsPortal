<?php
/**
 * Этот контроллер, отвечает за вход в панель администратора
 * Вход польхзователя насайт и за регистрацию пользователя
 * @author imxo
 */
class RegistrationController {
    
    private $id;
    
    public function __construct() {
	$this->id = 2147483647;
    }
    /**
     * Метод перехода на страница входа
     * @param type $id
     * @return boolean
     */
    public function actionLoginForm()
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();
        
        //Описаине сайта
        $decoration = Decoration::getDescriptionTextById($this->id);
        
        // Флаг ошибок
        $errors = [];
        
        // Подключаем вид
        require_once(ROOT . '/views/site/login_form.php');
        return true;
    }
    
    /**
     * Метод проверки пользователяна регистрацию
     * Вход в личный кабинет
     * @param type $login
     * @param type $password
     * @return boolean
     */
    public function actionLoginCheck()
    {
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();
        //Описаине сайта
        $decoration = Decoration::getDescriptionTextById($this->id);
        
        // Переменные для формы
        $login = false;
        $password = false;
        
        // Флаг ошибок
        $errors = [];
        
        // Обработка формы
        if (isset($_POST['login']) && isset($_POST['password'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Валидация полей
            if (strlen($login) <= 3) {
                array_push($errors, 'Login не должен быть короче 3-ти символов<br>');
            }
            if (strlen($password) <= 6) {
                array_push($errors, 'Пароль не должен быть короче 6-ти символов<br>');
            }

            //Идентификвця пользователя
            $userId = Registration::getUserByLogin($login, $password);
            echo '<pre>';
            print_r($userId);
            echo '</pre>';
            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                array_push($errors, 'Неправильные данные для входа на сайт<br>');
                
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                // Записываем идентификатор пользователя в сессию
                $_SESSION['user'] = $userId;
                
                // Перенаправляем пользователя в закрытую часть - кабинет 
                require_once(ROOT . '/views/admin/adin_panel.php');
                exit;
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/site/login_form.php');
        return true;
    }
    public function actionLoginOut(){
        
        unset($_SESSION["user"]);
        
        // уничтожаем сессию.
        $session_error = session_destroy();
        
        // Список категорий для верхнего меню
        $categories = Category::getCategoriesList();
        //Описаине сайта
        $decoration = Decoration::getDescriptionTextById($this->id);

        // Флаг ошибок
        $errors = [];
        
        if ($session_error == false){
            // Если данные неправильные - показываем ошибку
            array_push($errors, 'Сессия не завершена<br>');
        }
        // Подключаем вид
        require_once(ROOT . '/views/site/login_form.php');
        return true;
        
        //empty($var) === ( !isset($var) || false == $var )
        //!empty($var) === ( isset($var) && true == $var )
    }
}
