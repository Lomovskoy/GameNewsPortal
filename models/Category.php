<?php

/**
 * Класс Category - модель для работы с категориями сайта и с разделами
 */
class Category
{
    /**
     * @return type
     * метод getCategoriesList получить лист категорий
     */
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

        return $categoryList;
    }
    
    /**
     * @return type
     * метод getSectionListById получить лист разделов
     */
    public static function getSectionListById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        
        // Запрос к БД
        $sql = 'SELECT id, name, icon, folder_name FROM sections WHERE id_categories = :id';
        
        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        
        $i = 0;
        $sectionList = array();
        while ($row = $result->fetch()) {
            $sectionList[$i]['id'] = $row['id'];
            $sectionList[$i]['name'] = $row['name'];
            $sectionList[$i]['icon'] = $row['icon'];
            $sectionList[$i]['folder_name'] = $row['folder_name'];
            $i++;
        }

        return $sectionList;
    }

}
