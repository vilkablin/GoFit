<?php

session_start();

require '../../database/database.php';
require '../../database/models/User.php';


global $database;

if(!isset($_POST)) die('Поддерживается только метод post. Вы передаете get запрос');

if(empty($_FILES['avatar']['name'])) {

    $_SESSION['errors']['avatar'] = 'Загрузите картинку.';

    header('Location: ../../index.php?page=profile');

    die();

}

$file = $_FILES['avatar'];

if($file['size'] > 1024 * 1024 * 10) $_SESSION['errors']['avatar'] = 'Максимальный размер картинки 8 мб.';

$types = [
    'image/jpeg',
    'image/png',
    'image/jpg',
    'image/svg+xml',
];

if(!in_array($file['type'], $types)) $_SESSION['errors']['avatar'] = 'Неверный формат картинки. Поддерживаются следующие форматы: png, jpg, jpeg, svg.';

if($file['error'] !== UPLOAD_ERR_OK) $_SESSION['errors']['avatar'] = 'Файл поврежден.';

if(isset($_SESSION['errors'])) {

    header('Location: ../../index.php?page=profile');

    die();

}

// Расширение файла
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);

// Название файла
// $filename = pathinfo($file['name'], PATHINFO_FILENAME);

$fileName = uniqid() . '.' . $extension;

$path = 'media/avatars/' . $fileName;

if(!move_uploaded_file($file['tmp_name'], '../../media/avatars/' . $fileName)) {

    $_SESSION['errors']['avatar'] = 'Не удалось загрузить картинку.';

    header('Location: ../../index.php?page=profile');

    die();

}

// Получение пользователя через helper
$user = getUserById($_SESSION['user']['id']);

$oldPath = '../' . $user['avatar'];

if(file_exists($oldPath)) unlink($oldPath);

$sql = 'UPDATE `users` SET `avatar` = :path WHERE `users`.`id` = :id';

$prepare = $database->prepare($sql);

$prepare->execute([
    ':path' => $path,
    ':id' => $_SESSION['user']['id'],
]);

header('Location: ../../index.php?page=profile');
