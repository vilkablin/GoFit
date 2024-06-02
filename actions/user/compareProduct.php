<?php

session_start();

require_once '../../database/database.php';
require_once '../../database/models/User.php';
require_once '../../database/models/Product.php';


if(!isset($_POST)) die("Поддерживается только метод Post");

$product_id = $_POST['product_id'];
$user_id = $_POST['user_id'];
$page = $_POST['page'];


$sql = "SELECT * FROM `compareProducts` WHERE `user_id` = :user_id AND `product_id` = :product_id";

$prepare = $database->prepare($sql);

$prepare->execute([
  ':product_id'=> $product_id,
  ':user_id'=> $user_id,
]);

$isCompare = $prepare->fetchAll(2);

if(!empty($isCompare)) {
  header("Location: ../../index.php?page=" .$page );
die();

};

$sql = "INSERT INTO `compareProducts`( `product_id`, `user_id`) VALUES (:product_id,:user_id)";

$prepare = $database->prepare($sql);

$prepare->execute([
  ':product_id'=> $product_id,
  ':user_id'=> $user_id,
]);

header("Location: ../../index.php?page=" .$page );