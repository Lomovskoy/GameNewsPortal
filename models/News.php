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
          ORDER BY `post_or_news`.`date` DESC
        LIMIT :count';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        //echo '<pre>';
        //print_r($result);
        //echo '</pre>';
        // Получение и возврат результатов
        $i = 0;
        $newsList = array();
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['section_name'] = $row['section_name'];
            $newsList[$i]['caption'] = $row['caption'];
            $newsList[$i]['image'] = $row['image'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['folder_name'] = $row['folder_name'];
            $i++;
        }
        
        echo '<pre>';
        $post_tyme = $newsList[0]['date'];
        $today = date("Y-m-d H:i:s");
        
        print_r('Время поста:   '.$post_tyme.' - '.gettype($post_tyme));
        echo '<br>';
        print_r('Текущее время: '.$today.' - '.gettype($today));
        echo '<br>';
        $unix_post_time = strtotime($post_tyme);
        print_r('Время поста в UNIX:   '.$unix_post_time.' - '.gettype($unix_post_time));
        echo '<br>';
        $unix_time_today = strtotime($today);
        print_r('Текущее время в UNIX: '.$unix_time_today.' - '.$unix_time_today);
        echo '<br>';
        $difference_in_time = $unix_time_today - $unix_post_time;
        print_r('Разница во времени UNIX: '.$difference_in_time.' - '.gettype($difference_in_time));
        echo '<br>';
        //print_r('Разница во времени: '.date('H:i:s d-m-Y', $difference_in_time));
        //print_r(date("d.m.Y", $difference_in_time));
        /*function second_v_date($sekund)
        {
            $dt = new DateTime('@' . $sekund);
            return array('days'    => $dt->format('z'),
                         'hours'   => $dt->format('G'),
                         'minutes' => $dt->format('i'),
                         'seconds' => $dt->format('s'));
        }
        
        print_r(fsecond_v_date($difference_in_time));*/
        
        echo '</pre>';
        
        return $newsList;
    }

}
