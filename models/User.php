<?php

/**
 * Модель для работы с информацией о юзере
 *
 * @author imxo
 */
class User {

    /**
     * Получение информации о пользователе по Id
     * @param type $id
     * @return type
     */
    public static function getInfornationUserById($id) {

        // Соединение с БД
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        return $result->fetch();
    }

    /**
     * Изменение информации пользователя
     * @param type $id
     * @param type $information
     * @return type
     */
    public static function updateInfornationUserById($id, $information) {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "
            UPDATE
                users
            SET
                login = :login,
                mail = :mail,
                name = :name,
                surname = :surname,
                description = :description,
                interests = :interests
            WHERE
                id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':login', $information['login'], PDO::PARAM_STR);
        $result->bindParam(':mail', $information['mail'], PDO::PARAM_STR);
        $result->bindParam(':name', $information['name'], PDO::PARAM_STR);
        $result->bindParam(':surname', $information['surname'], PDO::PARAM_STR);
        $result->bindParam(':description', $information['description'], PDO::PARAM_STR);
        $result->bindParam(':interests', $information['interests'], PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Изменение пароля пользователя
     * @param type $id
     * @param type $password
     * @return type
     */
    public static function updatePasswordUserById($id, $password) {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "
            UPDATE users
            SET password = :password
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }
    /**
     * Изменение аватарки юзера
     * @param type $id
     * @param type $uploaddir
     * @param type $name
     * @return boolean
     */
    public static function updateImageUserById($id, $uploaddir, $name) {

//        echo 'id = ' . $id . '<br>';
//        echo 'uploaddir = ' . $uploaddir . '<br>';
//        echo 'name = ' . $name . '<br>';

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "
            UPDATE users
            SET image = :image
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':image', $name, PDO::PARAM_STR);

        //************************* ЗАГРУЗКА ИЗОБРАЖЕНИЯ ***********************

        // Проверяем загружен ли файл
        if(is_uploaded_file($_FILES["image"]["tmp_name"])){
            //print "Файл успешно загружен.";
            // Если файл загружен успешно, перемещаем его
            // из временной директории в конечную
            if (move_uploaded_file($_FILES['image']['tmp_name'], "$uploaddir/$name")) {
                //print "Файл успешно перемещён";
                return $result->execute();
            } else {
                //print "Ошибка перемещения";
            }
        }
        else{
             //print "Ошибка загрузки!";
        }
        return false;
    }
    
    /**
     * Метод идентификации пользователя
     * @param type $login
     * @param type $password
     */
    public static function getUserByLogin($login, $password){
        
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = '
            SELECT *, users.id 
            FROM users 
            INNER JOIN 
            rang 
            ON
            users.rang = rang.id
            WHERE login = :login 
            AND password = :password';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Обращаемся к записи
        $user = $result->fetch();

        if ($user) {
            // Если запись существует, возвращаем пользователя
            return $user;
        }
        return false;
    }
    /**
     * Метод идентификации пользователя
     * @return string
     */
    public static function getGreeting(){
        
        $greeting = 'Такого пользователя не существует';
        
        if(isset($_SESSION['user'])){
            
            if($_SESSION['user']['rang'] == 1){
                $greeting = 'Пользователь '.$_SESSION['user']['login'];
            }
            else if($_SESSION['user']['rang'] == 2){
                $greeting = 'Модератор новостей '.$_SESSION['user']['login'];
            }
            else if($_SESSION['user']['rang'] == 3){
                $greeting = 'Модератор форума '.$_SESSION['user']['login'];
            }
            else if($_SESSION['user']['rang'] == 4){
                $greeting = 'Администратор новостей'.$_SESSION['user']['login'];
            }
            else if($_SESSION['user']['rang'] == 5){
                $greeting = 'Администратор форума '.$_SESSION['user']['login'];
            }
            else if($_SESSION['user']['rang'] == 6){
                $greeting = 'Главный администратор '.$_SESSION['user']['login'];
            }
        }
        return $greeting;
    }
    
    /**
     * Проверяет не занят ли email другим пользователем
     * @param type $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function EmailRepeatCheck($mail)
    {
        // Соединение с БД        
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM users WHERE mail = :mail';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':mail', $mail, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()){
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет не занят ли login другим пользователем
     * @param type $login <p>Login</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function LoginRepeatCheck($login)
    {
        // Соединение с БД        
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM users WHERE login = :login';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()){
            return true;
        }
        return false;
    }
    
    
    public static function AddUser($login,$email,$password) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO users (
                rang, 
                ip, 
                login, 
                password, 
                mail, 
                name, 
                surname, 
                image, 
                description, 
                interests
            )
            VALUES (
            :rang, 
            :ip, 
            :login,
            :password, 
            :mail, 
            :name,
            :surname, 
            :image, 
            :description,
            :interests
            )';
        $rang = 1;
        $ip = $_SERVER['REMOTE_ADDR'];
        $name = "";
        $surname = "";
        $image = "noimage.png";
        $description = "";
        $interests = "";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':rang', $rang, PDO::PARAM_INT);
        $result->bindParam(':ip', $ip, PDO::PARAM_STR);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':mail', $email, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':image', $image, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':interests', $interests, PDO::PARAM_STR);

        return $result->execute();

    }
    
    

}
