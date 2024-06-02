<?php

session_start();
require_once "../../database/database.php";
require_once "../../database/models/User.php";

global $database;

if(!isset($_POST)) die("Not Post method");

$id = trim($_POST['id']);
$password = trim($_POST['password']);
$password_r = trim($_POST['password_r']);

$user = getUserById($id);


if (empty($password)) {
    $_SESSION['errors']['password'] = "Пароль не может быть пустым";
} else if (strlen($password) > 20) $_SESSION['errors']['password'] = "Длина пароля не должна превышать 20 символов";
else if(password_verify($password, $user['password']))  $_SESSION['errors']['password'] = "Старый пароль не может совпадать с новым";

if (empty($password_r)) $_SESSION['errors']['password_r'] = "Поле обязательно";

else if ($password_r !== $password) $_SESSION['errors']['password_r'] = "Пароли не совпадают";

if (!empty($_SESSION['errors'])) {
    header('Location: ../../index.php?page=editPassword&id='.$user['id']);
    die();
}

$password = password_hash($password, PASSWORD_DEFAULT);

$query = "UPDATE `users` SET `password`=:password WHERE `id` = {$user['id']}";

$prepare = $database->prepare($query);

$prepare->execute([
    'password' => $password,
]);

?>

<script>
alert("Пароль успешно изменен");
document.location.href="../../index.php?page=profile"</script>

