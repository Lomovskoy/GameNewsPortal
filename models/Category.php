<?php

/**
 * Класс Category - модель для работы с категориями сайта и с разделами
 */
class Category
{

    public static function getCategoriesList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name, icon FROM categories ORDER BY categories.id ASC');

        // Получение и возврат результатов
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['icon'] = $row['icon'];
            $i++;
        }
        //echo '<pre>';
        //print_r($categoryList);
        //echo '</pre>';
        return $categoryList;
    }



}
