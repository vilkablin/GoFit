<?php

function getProductById(int $productId): ?array
{
    global $database;

    $query = "SELECT `product`.*, `brand`.`name` AS `brand`, `color`.`name` AS `color`, `color`.`color_value` AS `color_value`,
     `material`.`name` AS `material`, `type`.`name` AS `type`,`gender`.`name` AS `gender` FROM `product`
      JOIN `type` ON `type`.`id` = `product`.`type_id` JOIN `color` ON `color`.`id` = `product`.`color_id` JOIN 
      `material` ON `material`.`id` = `product`.`material_id` JOIN
       `brand` ON `brand`.`id` = `product`.`brand_id` JOIN
        `gender` ON `gender`.`id` = `product`.`gender_id` WHERE `product`.`id` = :id
         LIMIT 1";

    $state = $database->prepare($query);

    $state->execute([':id' => $productId]);

    $data = $state->fetch(PDO::FETCH_ASSOC);

    if ($data === '') {
        return null;
    }

    return $data;
}

function getAllProducts(array $filters): ?array
{
    global $database;

    $sql = "SELECT `product`.*, `brand`.`name` AS `brand`, `color`.`name` AS `color`, `color`.`color_value` AS `color_value`,
     `material`.`name` AS `material`, `type`.`name` AS `type`,`gender`.`name` AS `gender` FROM `product`
      JOIN `type` ON `type`.`id` = `product`.`type_id` JOIN `color` ON `color`.`id` = `product`.`color_id` JOIN 
      `material` ON `material`.`id` = `product`.`material_id` JOIN
       `brand` ON `brand`.`id` = `product`.`brand_id` JOIN
        `gender` ON `gender`.`id` = `product`.`gender_id` JOIN `product_size` ON `product_size`.`product_id` = `product`.`id` JOIN `size` ON `size`.`id` = `product_size`.`size_id`";

    if (count($filters) > 0) {
        $sql .= " WHERE ";

    
        foreach ($filters as $key => $values) {
            $tableName = substr($key, 0, -1);

            $sql .= "`$tableName`.`id` IN ($values) AND";
        }

        $sql = substr($sql, 0, -3);
    }


    $query = $database->query($sql);

    $products = $query->fetchAll(2);

    if ($products === '') {
        return null;
    }

    return $products;
}

function getProductSizesById(int $productId): ?array
{
    global $database;

    $query = "SELECT * FROM `product_size` JOIN size ON product_size.size_id = size.id WHERE `product_id` = :id";

    $state = $database->prepare($query);

    $state->execute(['id' => $productId]);

    $data = $state->fetchAll(PDO::FETCH_ASSOC);

    if ($data === '') {
        return null;
    }

    return $data;
}

 // Функция для получение новостей по страницам
    // $page - активная страница
    // $limit - ограничение на количество выводимых новостей
    function getProductsByPage($page = 1, $limit = 10)
    {
        global $database;

        // Запрос на получение ограниченного числа новостей
        // LIMIT - ограничивает количество выводимых элементов
        // Например LIMIT 10 - означает, что будут выводиться первые 10 записей из БД
        // OFFSET - позволяет пропуска новости
        // Например OFFSET 5 - пропустит первые 5 записей
        // LIMIT 10 OFFSET 15 - означает, что будут выводиться 10 следующих новостей, пропуская первые 15
        $sql = 'SELECT * FROM `product` LIMIT :limit OFFSET :offset';

        $stmt = $database->prepare($sql);

        // Получаем предыдущую страницу
        $prevPage = $page - 1;

        // Вычисляем сколько новостей нужно пропустить в зависимости от активной страницы
        // Например, у нас всего 5 страниц и 55 новостей, на каждой странице выводится по 10 новостей
        // Допустим пользователь пролеснул на 4 страницу и нам нужно вывести новости данной страницы
        // Для этого вычисляем $offset = 3 (предыдущая страница) * 10 (количество новостей на одной странице)
        // $offset = 30
        $offset = $prevPage * $limit;

        // Привязка параметров с типом данных
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);

        $stmt->execute();

        // По итогу пропускам 30 новостей и на 4 странице выводим следующую десятку новостей до 40 новости включительно
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }