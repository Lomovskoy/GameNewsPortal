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
}
