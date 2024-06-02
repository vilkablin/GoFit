<?php session_start();

require_once '../../database/database.php';


if(!isset($_POST)) die("Поддерживается только метод Post");

$product_id = $_POST['product_id'];
$user_id = $_POST['user_id'];
$page = $_POST['page'];

$sql = "DELETE FROM `favoriteProducts` WHERE `product_id` = :product_id AND `user_id` = :user_id";

$prepare = $database->prepare($sql);

$prepare->execute([
  ':product_id'=> $product_id,
  ':user_id'=> $user_id,
]);

header("Location: ../../index.php?page=" .$page );
