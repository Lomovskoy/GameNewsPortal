<?php

/**
 * Description of Decoration
 *
 * @author pupil
 */
class Decoration {

    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getDescriptionTextById($id) {

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

        $decoration = array();
        while ($row = $result->fetch()) {
            $decoration['caption'] = $row['caption'];
            $decoration['description'] = $row['description'];
        }

        return $decoration;
    }

    public static function getAllDescriptionText() {

        // Соединение с БД
        $db = Db::getConnection();

        $sql = 'SELECT 
                decoration.id,
                categories.id AS categori_id,
                categories.name AS categiri_name, 
                decoration.caption, 
                decoration.description 
                FROM decoration 
                INNER JOIN 
                categories 
                ON 
                decoration.categiri_id = categories.id
                WHERE 
                decoration.categiri_id = categories.id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        $i = 0;
        $decoration = array();
        while ($row = $result->fetch()) {
            $decoration[$i]['id'] = $row['id'];
            $decoration[$i]['categori_id'] = $row['categori_id'];
            $decoration[$i]['categiri_name'] = $row['categiri_name'];
            $decoration[$i]['caption'] = $row['caption'];
            $decoration[$i]['description'] = $row['description'];
            $i++;
        }

        return $decoration;
    }

    public static function UpdateDescriptionText($id, $description) {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "
            UPDATE decoration
            SET description = :description
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':description', $description);
        return $result->execute();
    }

    public static function getPartners() {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT * FROM partners";

        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        $i = 0;
        $decoration = array();
        while ($row = $result->fetch()) {
            $decoration[$i]['id'] = $row['id'];
            $decoration[$i]['image'] = $row['image'];
            $decoration[$i]['src'] = $row['src'];
            $i++;
        }

        return $decoration;
    }

    public static function setNewPartners($src, $name, $uploaddir) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        // Текст запроса к БД
        $sql = "
            INSERT INTO partners (image, src)
            VALUES 
                (:image, :src)";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':image', $name, PDO::PARAM_INT);
        $result->bindParam(':src', $src, PDO::PARAM_STR);

        // Проверяем загружен ли файл
        if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
            //print "Файл успешно загружен.";
            // Если файл загружен успешно, перемещаем его
            // из временной директории в конечную
            if (move_uploaded_file($_FILES['image']['tmp_name'], "$uploaddir/$name")) {
                //print "Файл успешно перемещён";
                return $result->execute();
            } else {
                //print "Ошибка перемещения";
            }
        } else {
            //print "Ошибка загрузки!";
        }
        return false;
    }

    public static function dellPartners($id) {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM partners WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);


        return $result->execute();
    }

    public static function updatePartners($id, $src, $name = '', $uploaddir = '') {

        // Соединение с БД
        $db = Db::getConnection();

        if ($name != '' && $uploaddir != '') {
            // Текст запроса к БД
            $sql = "
            UPDATE 
                partners
            SET 
                image = :image,
                src = :src
            WHERE 
                id = :id";

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':image', $name, PDO::PARAM_STR);
            $result->bindParam(':src', $src, PDO::PARAM_STR);

            //************************* ЗАГРУЗКА ИЗОБРАЖЕНИЯ ***********************
            // Проверяем загружен ли файл
            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                //print "Файл успешно загружен.";
                // Если файл загружен успешно, перемещаем его
                // из временной директории в конечную
                if (move_uploaded_file($_FILES['image']['tmp_name'], "$uploaddir/$name")) {
                    //print "Файл успешно перемещён";
                    return $result->execute();
                } else {
                    //print "Ошибка перемещения";
                }
            } else {
                //print "Ошибка загрузки!";
            }
            return false;
        }else{
            $sql = "
            UPDATE 
                partners
            SET
                src = :src
            WHERE 
                id = :id";

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':src', $src, PDO::PARAM_STR);
            return $result->execute();
            
        }
    }

}
