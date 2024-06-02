<?php

session_start();

require_once "../../database/database.php";
require_once "../../database/models/User.php";

global $database;

if (!isset($_POST)) die("Поддерживается только метод пост");

$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$email = trim($_POST['email']);
$birthday = trim($_POST['birthday']);
$password = trim($_POST['password']);
$password_r = trim($_POST['password_r']);

$_SESSION['name'] = $name;
$_SESSION['surname'] = $surname;
$_SESSION['email'] = $email;

if (empty($name)) {
    $_SESSION['errors']['name'] = "Поле имя является обязательным";
}
else if (!preg_match('/^[а-я]+$/iu', $name)) {
    $_SESSION['errors']['name'] = "Поле неверного формата";
 }

if (empty($surname)) {
    $_SESSION['errors']['surname'] = "Поле фамииля является обязательным";
}
else if (!preg_match('/^[а-я]+$/iu', $surname)) {
    $_SESSION['errors']['surname'] = "Поле неверного формата";
 }


if (empty($email)) {
    $_SESSION['errors']['email'] = "Поле email является обязательным";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errors']['email'] = "Поле должно быть формата email";
} else {
    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";

    $query = $database->query($sql);

    $isReg = $query->fetch(PDO::FETCH_ASSOC);

    if (!empty($isReg)) {
        $_SESSION['errors']['email'] = "Такой email уже зарегестрирован";
    }
}

if (empty($birthday)) {
    $_SESSION['errors']['birthday'] = "Укажите дату рождения";
} else if ((date_diff(date_create($birthday), date_create('now'))->y) < 14) {
    $_SESSION['errors']['birthday'] = "Вам нет 14";
}


if (empty($password)) {
    $_SESSION['errors']['password'] = "Пароль не может быть пустым";
} else if (strlen($password) > 20) $_SESSION['errors']['password'] = "Длина пароля не должна превышать 20 символов";

if (empty($password_r)) $_SESSION['errors']['password_r'] = "Поле обязательно";

else if ($password_r !== $password) $_SESSION['errors']['password_r'] = "Пароли не совпадают";

if (!empty($_SESSION['errors'])) {
    header('Location: ../../index.php?page=signin');
    die();
}

$password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO `users`(`name`, `surname`, `email`, `birthday`, `password`) VALUES (:name, :surname, :email, :birthday, :password)";

$prepare = $database->prepare($query);

$prepare->execute([
    'name' => $name,
    'surname' => $surname,
    'email' => $email,
    'password' => $password,
    'birthday' => $birthday,
]);

unset($_SESSION['name']);
unset($_SESSION['surname']);
unset($_SESSION['email']);

$user_id = $database->lastInsertId();
$_SESSION['user'] = getUserById($user_id);
$_SESSION['USER_ID'] = $_SESSION['user']['id'];
header('Location: ../../index.php?page=profile');
