<?php

session_start();

require_once 'database/database.php';
require_once 'database/models/User.php';
require_once 'database/models/Product.php';

$user = null;

if (isset($_SESSION['USER_ID'])) {
  $user = getUserById($_SESSION['USER_ID']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="media/logo/favicon.svg" type="image/x-icon" />
  <link rel="stylesheet" href="styles/main.css" />
  <script src="script/alerts.js" defer></script>

  <title>Go Fit</title>
</head>

<body>
  <?php
  include 'components/header.php';

  if (isset($_GET['page'])) {
    if ($_GET['page'] === 'catalog') {
      include 'pages/catalog.php';
    } else if ($_GET['page'] === 'about') {
      include 'pages/about.php';
    } else if ($_GET['page'] === 'favourites') {
      include 'pages/favourites.php';
    } else if ($_GET['page'] === 'shop') {
      include 'pages/shop.php';
    } else if ($_GET['page'] === 'ordering') {
      include 'pages/ordering.php';
    } else if ($_GET['page'] === 'login') {
      include 'pages/login.php';
    } else if ($_GET['page'] === 'signin') {
      include 'pages/signup.php';
    } else if ($_GET['page'] === 'profile') {
      include 'pages/profile.php';
    } else if ($_GET['page'] === 'editProfile' && isset($_GET['id'])) {
      include 'pages/editProfile.php';
    } else if ($_GET['page'] === 'editPassword' && isset($_GET['id'])) {
      include 'pages/editPassword.php';
    } else if ($_GET['page'] === 'addProduct') {
      include 'pages/admins/addProduct.php';
    } else if ($_GET['page'] === 'more' && isset($_GET['id'])) {
      include  'pages/more.php';
    } else if ($_GET['page'] === 'editProduct' && isset($_GET['id'])) {
      include 'pages/admins/editProduct.php';
    } else if ($_GET['page'] === 'comparison') {
      include 'pages/comparison.php';
    } else if ($_GET['page'] === 'home') {
      include 'pages/home.php';
    } else if((is_null($user) || $user['role_id']===1) && (isset($_GET['adminpanel']) || isset($_GET['page']) && $_GET['page'] === 'adminpanel') ){
      echo "403. Нет прав доступа";
      die();
    }
    else if ($user['role_id'] === 2) {
      if (isset($user) && $user['role_id'] === 2 && (isset($_GET['adminpanel']) || isset($_GET['page']) && $_GET['page'] === 'adminpanel')) : ?>

    <div class="admin w-100">
      <div class="container">
        <div class="admin-inner w-100 d-flex-rows">
          <?php include 'components/adminAsideMenu.php';

          if ($_GET['page'] === 'orders') {
            include 'pages/admins/orders.php';
          } else if ($_GET['page'] === 'users') {
            include 'pages/admins/users.php';
          } else if ($_GET['page'] === 'products') {
            include 'pages/admins/products.php';
          } else {
            include 'pages/admins/products.php';
          } ?>

        </div>
      </div>
    </div>
  <?php endif;
    } else {
      include 'pages/404.php';
    }
  } else {
    include 'pages/home.php';
  }

  include 'components/footer.php';


  ?>

</body>

</html>