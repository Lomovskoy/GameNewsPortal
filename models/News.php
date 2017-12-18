<?php

/**
 * Класс News - модель для работы с новостями
 */
class News {

    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 12;

    /**
     * Возвращает лист всех новостей по дате добавления
     * @param type $count
     * @return type
     */
    public static function getIndexNewsList($count = self::SHOW_BY_DEFAULT) {
        // Соединение с БД
        $db = Db::getConnection();

        $sql = '
        SELECT
            p.id,
            p.caption,
            p.image,
            p.date,
            s.name AS section_name,
            s.folder_name
        FROM
            post_or_news p,
            sections s
        WHERE
            s.id = p.section
            AND 
            p.news_or_forum = 0
            AND 
            p.public_flag = 1
        ORDER BY 
            p.date 
        DESC
        LIMIT :count';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        
        // Получение и возврат результатов
        $i = 0;
        $newsList = array();
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['section_name'] = $row['section_name'];
            $newsList[$i]['caption'] = $row['caption'];
            $newsList[$i]['image'] = $row['image'];
            $newsList[$i]['date'] = TimeConverter::time_elapsed_string($row['date'],2);
            $newsList[$i]['folder_name'] = $row['folder_name'];
            $i++;
        }
        
        
        return $newsList;
    }

    /**
     * Возвращает новсти по разелу категории
     * @param type $id
     * @return type
     */
    public static function getNewsBySection($id, $len = 0) {
        
        // Соединение с БД
        $db = Db::getConnection();
        
        $sql = '
        SELECT 
            p.id, 
            p.caption, 
            p.description, 
            p.image, 
            p.date, 
            s.folder_name,
            s.name AS section_name,
            u.id AS author_id,
            u.login AS author_login
        FROM 
            post_or_news p
        INNER JOIN 
            sections s 
            ON 
            p.section=s.id
        INNER JOIN 
            users u 
            ON 
            p.id_user=u.id   
        WHERE 
            p.section = :id 
            AND 
            p.public_flag = 1
        ORDER BY 
            p.date 
        DESC
        ';

    
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        
        // Получение и возврат результатов
        $i = 0;
        $news = array();
        while ($row = $result->fetch()) {
            $news[$i]['id'] = $row['id'];
            $news[$i]['caption'] = $row['caption'];
            if ($len > 0)
                {$news[$i]['description'] = mb_strimwidth($row['description'], 0, $len, "...");}
            else
                {$news[$i]['description'] = $row['description'];}
            $news[$i]['image'] = $row['image'];
            $news[$i]['date'] = TimeConverter::time_elapsed_string($row['date'],2);
            $news[$i]['folder_name'] = $row['folder_name'];
            $news[$i]['section_name'] = $row['section_name'];
            $news[$i]['author_id'] = $row['author_id'];
            $news[$i]['author_login'] = $row['author_login'];
            $i++;
        }
        
        return $news;
    }
    
    /**
     * Достать одну новость то идентификатору
     * @param type $id
     * @return type
     */
    public static function getOneNewsById($id){
        
        // Соединение с БД
        $db = Db::getConnection();
        
        $sql = '
        SELECT 
            p.id, 
            p.caption, 
            p.description, 
            p.image, 
            p.date, 
            s.folder_name,
            s.name AS section_name,
            u.id AS author_id,
            u.login AS author_login
        FROM 
            post_or_news p
        INNER JOIN 
            sections s 
            ON 
            p.section=s.id
        INNER JOIN 
            users u 
            ON 
            p.id_user=u.id   
        WHERE 
            p.id = :id 
            AND 
            p.public_flag = 1
        ';
        
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        
        return $result->fetch();
    }
    
    public static function getPath($sectionId){
        
        // Соединение с БД
        $db = Db::getConnection();
        
        $sql = 'SELECT 	folder_name FROM sections WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $sectionId, PDO::PARAM_INT);
        
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполнение коменды
        $result->execute();
        
        return $result->fetch();
        
    }
    
    public static function addNews($autor,$sectionId,$publicing,$new_or_forum,$caption,$description,$image,$data,$uploaddir=""){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO post_or_news (
                id_user, 
                section, 
                public_flag, 
                news_or_forum, 
                caption, 
                description, 
                image, 
                date
            )
            VALUES (
                :id_user, 
                :section, 
                :public_flag, 
                :news_or_forum, 
                :caption, 
                :description, 
                :image, 
                :date
            )';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id_user', $autor, PDO::PARAM_INT);
        $result->bindParam(':section', $sectionId, PDO::PARAM_INT);
        $result->bindParam(':public_flag', $publicing, PDO::PARAM_BOOL);
        $result->bindParam(':news_or_forum', $new_or_forum, PDO::PARAM_BOOL);
        $result->bindParam(':caption', $caption, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':image', $image, PDO::PARAM_STR);
        $result->bindParam(':date', $data, PDO::PARAM_STR);
        echo 2;
        //************************* ЗАГРУЗКА ИЗОБРАЖЕНИЯ ***********************
        // Проверяем загружен ли файл
        if(is_uploaded_file($_FILES["image"]["tmp_name"])){
            //print "Файл успешно загружен.";
            // Если файл загружен успешно, перемещаем его
            // из временной директории в конечную
            if (move_uploaded_file($_FILES['image']['tmp_name'], "$uploaddir/$image")) {
                //print "Файл успешно перемещён";
                return $result->execute();
            } else {
                //print "Ошибка перемещения";
            }
        }
        else {
             return $result->execute();
        }
        return false;
    }

}
