<?php session_start();

require_once '../../database/database.php';

if(!isset($_POST)) die("Поддерживается только метод Post");

$user_id = $_POST['user_id'];
$page = $_POST['page'];


$sql = "DELETE FROM `compareProducts` WHERE `user_id` = :user_id";

$prepare = $database->prepare($sql);

$prepare->execute([
  ':user_id'=> $user_id,
]);

header("Location: ../../index.php?page=" .$page );