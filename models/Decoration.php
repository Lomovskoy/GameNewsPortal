<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Decoration
 *
 * @author pupil
 */
class Decoration {
        
    public static function getDescriptionTextById($id){
        
        // Соединение с БД
        $db = Db::getConnection();
        
        $sql = 'SELECT caption, description FROM decoration WHERE categiri_id = :id';
        
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        $i = 0;
        $decoration = array();
        while ($row = $result->fetch()) {
            $decoration['caption'] = $row['caption'];
            $decoration['description'] = $row['description'];
            $i++;
        }

        return $decoration;
    }
}
