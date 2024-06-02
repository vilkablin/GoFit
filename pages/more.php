<?php

global $database;

$product = null;

if (isset($_GET['id']) && isset($_GET['page']) && $_GET['page'] == 'more') {
  $product = getProductById((int)$_GET['id']);
}

if (is_null($product)) {
  die("Товар не найден!");
}

$sizes = getProductSizesById($product['id']);

?>

<div class="bread-crumbs w-100">
  <div class="container">
    <div class="bread-crumbs-inner w-100 d-flex-rows">
      <a href="?page=home">Главная /</a>
      <a href="?page=catalog">Каталог /</a>
      <a href="?page=more&id=<?= $product['id'] ?>" class="active"><?= $product['name'] ?></a>
    </div>
  </div>
</div>

<div class="one-item w-100">
  <div class="container">
    <div class="one-item-inner w-100 d-flex-columns">
      <div class="one-item-info w-100 d-flex-rows">
        <div class="item-images d-flex-rows">
          <img src="<?= $product['image'] ?>" class="selected-image" alt="" />
        </div>

        <div class="item-info d-flex-columns">
          <h3><?= $product['name'] ?></h3>
          <p><span>Категория:</span> <?= $product['type'] ?></p>
          <p><span>Бренд:</span> <?= $product['brand'] ?></p>
          <p><span>Пол:</span><?= $product['gender'] ?></p>
          <p><span>Материал:</span> <?= $product['material'] ?></p>
          <p class="price"><?= number_format($product['price'], '0', '.', ' ') ?> ₽</p>
          <p><span>Цвет:</span><?= $product['color'] ?></p>
          <p><span>Размер:</span></p>
          <div class="size-select d-flex-rows">
            <?php foreach ($sizes as $size) : ?>
              <div class="size"><?= $size['name'] ?></div>
            <?php endforeach; ?>
          </div>
          <div class="btns d-flex-rows">
            <a href="#" class="btn">Добавить в корзину</a>
            <?php if(isset($user)) : ?>
            <form action="actions/user/likeProduct.php" method="post">
            <input type="text" name="page" value="<?="more&id=".$product['id']?>" style="display:none;">
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="hidden" name="user_id" value="<?=$user['id']?>">
              <button type="submit" class="btn"><img src="media/icons/fav_white.svg" alt="Избранное"></button>
            </form>
            <form action="actions/user/compareProduct.php" method="post">
            <input type="text" name="page" value="<?="more&id=".$_product['id']?>" style="display:none;">
            <input type="hidden" name="user_id" value="<?=$user['id']?>">
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <button class="btn"><img src="media/icons/weight_white.svg" alt="Сравнение товаров"></button>
            </form>
            <?php endif ?>
          </div>
        </div>
      </div>
      <div class="one-item-description w-100 d-flex-columns">
        <h3>Описание</h3>
        <p><?= $product['description'] ?></p>
      </div>
    </div>
  </div>
</div>