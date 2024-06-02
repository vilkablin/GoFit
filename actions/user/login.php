<?php

session_start();

require_once '../../database/database.php';
require_once '../../database/models/User.php';

global $database;

if (!isset($_POST)) die('поддерживается только метод POST');

$email = trim($_POST['email']);
$password = trim($_POST['password']);

$_SESSION['email'] = $email;

$user = getUserByEmail($email);
$sql = "SELECT * FROM `roles` WHERE `id` = {$user['role_id']}";


if (empty($email)) $_SESSION['errors']['email'] = "Поле email обязательно для заполнения";

else if (!filter_var($email, FILTER_VALIDATE_EMAIL))  $_SESSION['errors']['email'] = "Поле email неверного формата";

else if (is_null($user)) $_SESSION['errors']['email'] = "Пользователя с таким email не существует";

else if($user['role_id'] === 3) $_SESSION['errors']['email'] = "Вы заблокированы";

if (empty($password)) $_SESSION['errors']['password'] = "Введите пароль";

else if (!password_verify($password, $user['password'])) $_SESSION['errors']['password'] = "Неверный пароль";


if (!empty($_SESSION['errors'])) {
  header('Location: ../../index.php?page=login');
}

else {
  $id = $user['id'];
$user = getUserById($id);
  $_SESSION['user'] = $user;
  $_SESSION['USER_ID'] = $user['id'];
  header('Location: ../../index.php?page=profile');
  unset($_SESSION['email']);
  die();
}

