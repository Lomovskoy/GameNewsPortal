<?php
/**
 * Модель для работы с информацией о юзере
 *
 * @author imxo
 */
class User {
    
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
}
