<?php

/**
 * Класс News - модель для работы с новостями
 */
class News {

    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 12;

    public static function getIndexNewsList($count = self::SHOW_BY_DEFAULT) {
        // Соединение с БД
        $db = Db::getConnection();

        $sql = '
        SELECT
            post_or_news.id,
            post_or_news.caption,
            post_or_news.image,
            post_or_news.date,
            sections.`name` AS `section_name`,
            sections.`folder_name`
        FROM
            post_or_news,
            sections
        WHERE
            sections.id = post_or_news.section
        AND 
            post_or_news.news_or_forum = 0
        AND 
            post_or_news.public_flag = 1
        ORDER BY 
            `post_or_news`.`date` 
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

}
