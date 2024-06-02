<?php 

global $database;
global $user;

?>

<div class="bread-crumbs w-100">
      <div class="container">
        <div class="bread-crumbs-inner w-100 d-flex-rows">
          <a href="?page=home">Главная /</a>
          <a href="?page=favourites" class="active">Избранное</a>
        </div>
      </div>
    </div>

    <div class="fav w-100">
      <div class="container">
        <div class="fav-inner w-100 d-flex-rows">

        <?php if(empty($user)) {?>

          <h1 class="nothing">Войдите, чтоб добавлять товары в избранное </h1>

        <?php } else {
        $sql  = "SELECT * FROM `favoriteProducts` WHERE `user_id` = :user_id";
        $prepare = $database->prepare($sql);
        $prepare->execute([
          ':user_id' => $user['id'],
        ]);
        $favouritesProducts = $prepare->fetchAll(2);

         if(empty($favouritesProducts)) {?>
          <h1 class="nothing">Похоже, тут пока ничего нет :( </h1>

          <?php } else { ?>

          <form action="actions/user/deleteAllFavProducts.php" method="POST">
          <input type="text" name="page" value="<?="favourites"?>" style="display:none;">
          <input type="hidden" name="user_id" value="<?=$user['id']?>">
          <button type="submit" class="delall">Очистить все</button>
          </form>
  
          <div class="fav-items d-flex-rows">
            <?php foreach($favouritesProducts as $favouriteProduct) { 
              $product = getProductById($favouriteProduct['product_id']);
              ?>
              <div class="catalog-item d-flex-columns">
              <img src="<?=$product['image']?>" alt="<?=$product['name']?>">
              <p class="category"><?=$product['type']?></p>
              <p class="price"><?=number_format($product['price'], '0', '.', ' ')?>₽</p>
              <p class="descr"><?=$product['name']?></p>
              <a href="?page=more&id=<?=$product['id']?>" class="btn">Подробнее</a>
              <form action="actions/user/deleteFavProduct.php" method="POST">
              <input type="text" name="page" value="<?="favourites"?>" style="display:none;">
                <input type="hidden" name="product_id" value="<?=$product['id']?>">
                <input type="hidden" name="user_id" value="<?=$user['id']?>">
                <button type="submit" class="del">Удалить</button>
            </form>
            </div>

              <?php } ?>

          </div>
          <?php }} ?>
        </div>
      </div>
    </div>