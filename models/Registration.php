<?php
/**
 * Модель для работы с регистрацией и входом на сайт
 *
 * @author imxo
 */
class Registration {
    
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
            SELECT * 
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
}
