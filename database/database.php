<?php

try {
    $dsn = "mysql:host=localhost;dbname=gofit;charset=utf8;";

    $database = new PDO($dsn, 'root', 'vilka');

    return $database;
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных" . $e->getMessage());
}
