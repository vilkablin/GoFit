<?php

require_once "../../database/database.php";
require_once "../../database/models/Product.php";

session_start();

global $database;

if (!isset($_POST)) die("Not Post method");

$id = trim($_POST['id']);
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

if ($file['error'] == 4) $file = '';

if(empty($name)) $_SESSION['errors']['name'] = "Заполните поле";
if(empty($description)) $_SESSION['errors']['desc'] = "Заполните поле";
if(empty($price)) $_SESSION['errors']['price'] = "Заполните поле";
if (!empty($_SESSION['errors'])) {

  header('Location: ../../index.php?page=editProduct&id=' . $id);

  die();
}
if (!empty($file)) {
  if ($file['size'] > 1024 * 1024 * 8) $_SESSION['errors']['image'] = 'Максимальный размер картинки 8 мб.';

  $types = [
    'image/jpeg',
    'image/png',
    'image/jpg',
    'image/svg+xml',
  ];

  if (!in_array($file['type'], $types)) $_SESSION['errors']['image'] = 'Неверный формат картинки. Поддерживаются следующие форматы: png, jpg, jpeg, svg.';

  if ($file['error'] !== UPLOAD_ERR_OK) $_SESSION['errors']['image'] = 'Файл поврежден.';

  if (!empty($_SESSION['errors'])) {

    header('Location: ../../index.php?page=editProduct&id=' . $id);

    die();
  }

  // Расширение файла
  $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

  $fileName = uniqid() . '.' . $extension;

  $path = 'media/catalog/products/' . $fileName;

  if (!move_uploaded_file($file['tmp_name'], '../../media/catalog/products/' . $fileName)) {

    $_SESSION['errors']['image'] = 'Не удалось загрузить картинку.';

    header('Location: ../../index.php?page=editProduct&id=' . $id);

    die();
  }

  $sql = "SELECT * FROM `product` WHERE `id` = $id";

  $query = $database->query($sql);

  $product = $query->fetch(2);

  $oldPath = '../' . $product['image'];

  if (file_exists($oldPath)) unlink($oldPath);

  $sql = "UPDATE `product` SET `name`=:name,`price`=:price,`description`= :description,`gender_id`= $gender,`brand_id`=$brand,`color_id`=$color,`material_id`=$material,`type_id`=$type, `image`=:path  WHERE `id`= :id";

  $prepare = $database->prepare($sql);

  $prepare->execute([
    ':path' => $path,
    ':name' => $name,
    ':price' => $price,
    ':description' => $description,
    ':id' => $id,
  ]);

  $size = getProductSizesById($id);

  foreach ($sizes as $size) {

    $sql = "UPDATE `product_size` SET `product_id`=:id,`size_id`=':size' WHERE `id` = :id";
    $prepare = $database->prepare($sql);
    $prepare->execute([
      ':size' => $size,
      ':product_id' => $id,
    ]);
  }
  header('Location: ../../index.php?page=adminpanel');
}

if (empty($file)) {
  $sql = "UPDATE `product` SET `name`=:name,`price`=:price,`description`= :description,`gender_id`= $gender,`brand_id`=$brand,`color_id`=$color,`material_id`=$material,`type_id`=$type WHERE `id`= :id";

  $params = [
    ':name' => $name,
    ':price' => $price,
    ':description' => $description,
    ':id' => $id,

  ];

  $prepare = $database->prepare($sql);
  $prepare->execute($params);


  $sql  = "DELETE FROM `product_size` WHERE `product_id` = :id";
  $prepare = $database->prepare($sql);
  $prepare->execute([
    ':id' => $id,
  ]);



  foreach($sizes as $size){
    $sql = "INSERT INTO `product_size`(`product_id`,`size_id`) VALUES (:productId ,:sizeId)";

    $prepare = $database->prepare($sql);

    $prepare->execute([
        ':productId' => $id,
        ':sizeId' => $size,
    ]);};


  header('Location: ../../index.php?page=adminpanel');
}
