<?php

global $database;
global $user;

?>

<div class="bread-crumbs w-100">
  <div class="container">
    <div class="bread-crumbs-inner w-100 d-flex-rows">
      <a href="?page=home">Главная /</a>
      <a href="?page=comparison" class="active">Сравнение товаров</a>
    </div>
  </div>
</div>

<div class="fav w-100">
  <div class="container">
    <div class="fav-inner w-100 d-flex-rows">

      <?php if (empty($user)) { ?>

        <h1 class="nothing">Войдите, чтоб сравнивать товары </h1>

        <?php } else {
        $sql  = "SELECT * FROM `compareProducts` WHERE `user_id` = :user_id";
        $prepare = $database->prepare($sql);
        $prepare->execute([
          ':user_id' => $user['id'],
        ]);
        $compareProducts = $prepare->fetchAll(2);

        if (empty($compareProducts)) { ?>
          <h1 class="nothing">Похоже, тут пока ничего нет :( </h1>

        <?php } else { ?>

          <form action="actions/user/deleteAllComparisonProducts.php" method="POST">
            <input type="text" name="page" value="<?= "comparison" ?>" style="display:none;">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <button type="submit" class="delall">Очистить все</button>
          </form>

          <div class="fav-items d-flex-rows">
            <?php foreach ($compareProducts as $compareProduct) {
              $product = getProductById($compareProduct['product_id']);
            ?>
              <div class="catalog-item d-flex-columns">
                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                <p class="category"><?= $product['type'] ?></p>
                <p class="price"><?= number_format($product['price'], '0', '.', ' ') ?>₽</p>
                <p class="descr"><?= $product['name'] ?></p>
                <p class="srav"><span>Бренд : </span><?= $product['brand'] ?></p>
                <p class="srav"><span>Пол : </span> <?= $product['gender'] ?></p>
                <p class="srav"><span>Материал : </span><?= $product['material'] ?></p>
                <form action="actions/user/deleteComparisonProduct.php" method="POST">
                  <input type="text" name="page" value="<?= "comparison" ?>" style="display:none;">
                  <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                  <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                  <button type="submit" class="del">Удалить</button>
                </form>
              </div>

            <?php } ?>

          </div>
      <?php }
      } ?>
    </div>
  </div>
</div>