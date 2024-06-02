<?php

require_once "../../database/database.php";
require_once "../../database/models/Product.php";

session_start();

global $database;

if(!isset($_POST)) die("Not Post method");

$name = trim($_POST['name']);
$description = trim($_POST['desc']);
$price = trim($_POST['price']);
$gender = trim($_POST['gender']);
$color = trim($_POST['color']);
$brand = trim($_POST['brand']);
$type = trim($_POST['type']);
$material = trim($_POST['material']);
$sizes = $_POST['sizes'];
$file = $_FILES['image'];

if(empty($name)) $_SESSION['errors']['name'] = "Заполните поле";
if(empty($description)) $_SESSION['errors']['desc'] = "Заполните поле";
if(empty($name)) $_SESSION['errors']['price'] = "Заполните поле";
if(empty($file)) $_SESSION['errors']['image'] = "Заполните поле";

if($file['size'] > 1024 * 1024 * 5) $_SESSION['errors']['image'] = 'Максимальный размер картинки 8 мб.';

$types = [
    'image/jpeg',
    'image/png',
    'image/jpg',
    'image/svg+xml',
];

if(!in_array($file['type'], $types)) $_SESSION['errors']['image'] = 'Неверный формат картинки. Поддерживаются следующие форматы: png, jpg, jpeg, svg.';

if($file['error'] !== UPLOAD_ERR_OK) $_SESSION['errors']['image'] = 'Файл поврежден.';


if(!empty($_SESSION['errors'])) {

    header('Location: ../../index.php?page=addProduct');

    die();

}

// Расширение файла
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);

$fileName = uniqid() . '.' . $extension;

$path = 'media/catalog/products/' . $fileName;

if(!move_uploaded_file($file['tmp_name'], '../../media/catalog/products/' . $fileName)) {
  

    $_SESSION['errors']['image'] = 'Не удалось загрузить картинку.';

    header('Location: ../../index.php?page=addProduct');

    die();

}

$sql = "INSERT INTO `product`(`name`, `price`, `description`, `gender_id`, `brand_id`, `color_id`, `material_id`, `type_id`, `image`) 
VALUES (:name, :price, :description, $gender, $brand, $color, $material, $type, :path)";

$params = [
  ':name' => $name,
  ':price' => $price,
  ':description' => $description,
  ':path'=> $path,
];

$prepare = $database->prepare($sql);
$prepare->execute($params);

$productId = $database->lastInsertId();
$product = getProductById((int)$productId);


foreach($sizes as $size){
    $sql = "INSERT INTO `product_size`(`product_id`,`size_id`) VALUES (:productId ,:sizeId)";

    $prepare = $database->prepare($sql);

    $prepare->execute([
        ':productId' => $productId,
        ':sizeId' => $size,
    ]);};



header('Location: ../../index.php?page=adminpanel');