<?php

session_start();
require_once "../../database/database.php";
require_once "../../database/models/User.php";

global $database;


if(!isset($_POST)) die("Not Post method");

$id = trim($_POST['id']);
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$email = trim($_POST['email']);

$user = getUserById($id);

$_SESSION['name'] = $name;
$_SESSION['surname'] = $surname;
$_SESSION['email'] = $email;

if (empty($name)) {
    $_SESSION['errors']['name'] = "Поле имя не может быть пустым";
}
else if (!preg_match('/^[а-я]+$/iu', $name)) {
    $_SESSION['errors']['name'] = "Поле неверного формата";
 }

 if (empty($surname)) {
    $_SESSION['errors']['surname'] = "Поле фамииля не может быть пустым";
}
else if (!preg_match('/^[а-я]+$/iu', $surname)) {
    $_SESSION['errors']['surname'] = "Поле неверного формата";
 }


if (empty($email)) {
    $_SESSION['errors']['email'] = "Поле email является обязательным";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errors']['email'] = "Поле должно быть формата email";
} else {

  if($user['email'] != $email){

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";


    $query = $database->query($sql);

    $isReg = $query->fetch(PDO::FETCH_ASSOC);


    if (!empty($isReg)) {
        $_SESSION['errors']['email'] = "Такой email уже зарегестрирован";
    }
  }
}

if (!empty($_SESSION['errors'])) {
    header('Location: ../../index.php?page=editProfile&id='.$user['id']);
    die();
}

$query = "UPDATE `users` SET `name`=:name,`surname`=:surname,`email`=:email WHERE `id` = {$user['id']}";

$prepare = $database->prepare($query);

$prepare->execute([
    'name' => $name,
    'surname' => $surname,
    'email' => $email,
]);

unset($_SESSION['name']);
unset($_SESSION['surname']);
unset($_SESSION['email']);

header('Location: ../../index.php?page=profile');
