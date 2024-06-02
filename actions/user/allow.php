<?php

if(!isset($_POST)) die('Поддерживается только метод post');

require_once '../../database/database.php';

global $database;

// Получение id пользователя и его преобразование в тип int
$user_id = (int) $_POST['user_id'];

// Подготовка запроса
$sql = "UPDATE `users` SET `role_id`= 1 WHERE `id` = :user_id";

$prepare = $database->prepare($sql);

$prepare->execute([
    ':user_id' => $user_id
]);

// Редирект
header('Location: ../../index.php?page=adminpanel');