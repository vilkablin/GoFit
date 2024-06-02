<?php

global $database;
global $user;

$filterParams = [];

if (isset($_GET['filter'])) {

  $options = explode('|', $_GET['filter']);

  foreach ($options as $option) {
    $params = explode("=", $option);

    $filterParams[$params[0]] = $params[1];
  }
}

$products = getAllProducts($filterParams);
$offset = 6;
$pages = ceil(count($products) / $offset);

if (isset($_GET['p'])) {
  $page = $_GET['p'];

  if ($page > 0 && $page <= $pages) $products = getProductsByPage($page, $offset);
  else if ($page > $pages) die("К сожалению, вы превысили лимит страниц.");
  else die('К сожалению, минусовых страниц не бывает.');
}

$sql = "SELECT * FROM `type`";
$query = $database->query($sql);
$types = $query->fetchAll(2);

$sql = "SELECT * FROM `color`";
$query = $database->query($sql);
$colors = $query->fetchAll(2);

$sql = "SELECT * FROM `material`";
$query = $database->query($sql);
$materials = $query->fetchAll(2);

$sql = "SELECT * FROM `brand`";
$query = $database->query($sql);
$brands = $query->fetchAll(2);

$sql = "SELECT * FROM `gender`";
$query = $database->query($sql);
$genders = $query->fetchAll(2);

$sql = "SELECT * FROM `size`";
$query = $database->query($sql);
$sizes = $query->fetchAll(2);

$filters = [
  'types' => [
    'label' => "Тип товара",
    'items' => $types,
  ],
  'colors' => [
    'label' => 'Цвет',
    'items' => $colors,
  ],
  'materials' => [
    'label' => 'Материал',
    'items' => $materials
  ],
  'brands' => [
    'label' => 'Бренд',
    'items' => $brands,
  ],
  'genders' => [
    'label' => 'Пол',
    'items' => $genders,
  ],
  'sizes' => [
    'label' => 'Размер',
    'items' => $sizes
  ],
];

?>
<div class="bread-crumbs w-100">
  <div class="container">
    <div class="bread-crumbs-inner w-100 d-flex-rows">
      <a href="?page=home">Главная /</a>
      <a href="?page=catalog" class="active">Каталог</a>
    </div>
  </div>
</div>

<div class="catalog-intro w-100">
  <div class="container">
    <div class="catalog-intro-inner w-100 d-flex-rows">
      <div class="catalog-intro-wrapper d-flex-columns">
        <h2>Скидки до</h2>
        <h1>30%</h1>
        <p>
          На коллекцию Nike <br />
          Football Women
        </p>
      </div>
    </div>
  </div>
</div>

<div class="catalog w-100">
  <div class="container">
    <div class="catalog-inner w-100 d-flex-rows">
      <div class="hamb">
        <div class="hamb__field" id="catalogHamb">
          <svg width="57" height="57" viewBox="0 0 57 57" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.375 11.875C20.7451 11.875 20.141 12.1252 19.6956 12.5706C19.2502 13.016 19 13.6201 19 14.25C19 14.8798 19.2502 15.4839 19.6956 15.9293C20.141 16.3747 20.7451 16.625 21.375 16.625C22.0049 16.625 22.609 16.3747 23.0544 15.9293C23.4998 15.4839 23.75 14.8798 23.75 14.25C23.75 13.6201 23.4998 13.016 23.0544 12.5706C22.609 12.1252 22.0049 11.875 21.375 11.875ZM14.6538 11.875C15.1444 10.4843 16.0544 9.28012 17.2582 8.42834C18.462 7.57656 19.9003 7.11914 21.375 7.11914C22.8497 7.11914 24.288 7.57656 25.4918 8.42834C26.6956 9.28012 27.6056 10.4843 28.0963 11.875H45.125C45.7549 11.875 46.359 12.1252 46.8044 12.5706C47.2498 13.016 47.5 13.6201 47.5 14.25C47.5 14.8798 47.2498 15.4839 46.8044 15.9293C46.359 16.3747 45.7549 16.625 45.125 16.625H28.0963C27.6056 18.0156 26.6956 19.2198 25.4918 20.0716C24.288 20.9234 22.8497 21.3808 21.375 21.3808C19.9003 21.3808 18.462 20.9234 17.2582 20.0716C16.0544 19.2198 15.1444 18.0156 14.6538 16.625H11.875C11.2451 16.625 10.641 16.3747 10.1956 15.9293C9.75022 15.4839 9.5 14.8798 9.5 14.25C9.5 13.6201 9.75022 13.016 10.1956 12.5706C10.641 12.1252 11.2451 11.875 11.875 11.875H14.6538ZM35.625 26.125C34.9951 26.125 34.391 26.3752 33.9456 26.8206C33.5002 27.266 33.25 27.8701 33.25 28.5C33.25 29.1299 33.5002 29.7339 33.9456 30.1793C34.391 30.6247 34.9951 30.875 35.625 30.875C36.2549 30.875 36.859 30.6247 37.3044 30.1793C37.7498 29.7339 38 29.1299 38 28.5C38 27.8701 37.7498 27.266 37.3044 26.8206C36.859 26.3752 36.2549 26.125 35.625 26.125ZM28.9037 26.125C29.3944 24.7343 30.3044 23.5301 31.5082 22.6783C32.712 21.8266 34.1503 21.3691 35.625 21.3691C37.0997 21.3691 38.538 21.8266 39.7418 22.6783C40.9456 23.5301 41.8556 24.7343 42.3462 26.125H45.125C45.7549 26.125 46.359 26.3752 46.8044 26.8206C47.2498 27.266 47.5 27.8701 47.5 28.5C47.5 29.1299 47.2498 29.7339 46.8044 30.1793C46.359 30.6247 45.7549 30.875 45.125 30.875H42.3462C41.8556 32.2656 40.9456 33.4698 39.7418 34.3216C38.538 35.1734 37.0997 35.6308 35.625 35.6308C34.1503 35.6308 32.712 35.1734 31.5082 34.3216C30.3044 33.4698 29.3944 32.2656 28.9037 30.875H11.875C11.2451 30.875 10.641 30.6247 10.1956 30.1793C9.75022 29.7339 9.5 29.1299 9.5 28.5C9.5 27.8701 9.75022 27.266 10.1956 26.8206C10.641 26.3752 11.2451 26.125 11.875 26.125H28.9037ZM21.375 40.375C20.7451 40.375 20.141 40.6252 19.6956 41.0706C19.2502 41.516 19 42.1201 19 42.75C19 43.3799 19.2502 43.9839 19.6956 44.4293C20.141 44.8747 20.7451 45.125 21.375 45.125C22.0049 45.125 22.609 44.8747 23.0544 44.4293C23.4998 43.9839 23.75 43.3799 23.75 42.75C23.75 42.1201 23.4998 41.516 23.0544 41.0706C22.609 40.6252 22.0049 40.375 21.375 40.375ZM14.6538 40.375C15.1444 38.9843 16.0544 37.7801 17.2582 36.9283C18.462 36.0766 19.9003 35.6191 21.375 35.6191C22.8497 35.6191 24.288 36.0766 25.4918 36.9283C26.6956 37.7801 27.6056 38.9843 28.0963 40.375H45.125C45.7549 40.375 46.359 40.6252 46.8044 41.0706C47.2498 41.516 47.5 42.1201 47.5 42.75C47.5 43.3799 47.2498 43.9839 46.8044 44.4293C46.359 44.8747 45.7549 45.125 45.125 45.125H28.0963C27.6056 46.5156 26.6956 47.7198 25.4918 48.5716C24.288 49.4234 22.8497 49.8808 21.375 49.8808C19.9003 49.8808 18.462 49.4234 17.2582 48.5716C16.0544 47.7198 15.1444 46.5156 14.6538 45.125H11.875C11.2451 45.125 10.641 44.8747 10.1956 44.4293C9.75022 43.9839 9.5 43.3799 9.5 42.75C9.5 42.1201 9.75022 41.516 10.1956 41.0706C10.641 40.6252 11.2451 40.375 11.875 40.375H14.6538Z" fill="#333333" />
          </svg>
        </div>
      </div>
      <div class="categories d-flex-columns" id="categories">
        <h3>Категории</h3>
        <form action="actions/product/filter.php" method="get" name="filters" class="accordion d-flex-columns">

          <?php foreach ($filters as $key => $data) : ?>
            <div class="accordion-item">
              <div class="accordion-header"><?= $data['label'] ?></div>
              <div class="accordion-body">
                <?php foreach ($data['items'] as $option) : ?>
                  <div class="accordion-body-inner">
                    <?php

                    $isChecked = false;

                    if (array_key_exists($key, $filterParams)) {
                      $params = [];


                      if (!is_array($filterParams[$key])) {
                        $params[] = $filterParams[$key];
                      }

                      $filterParams[$key] = $params;

                      if (in_array($option['id'], $filterParams[$key])) {
                        $isChecked = true;
                      }
                    }
                    ?>

                    <input type="checkbox" name="<?= $key ?>[]" value="<?= $option['id'] ?>" <?php echo  $isChecked ?  "checked" :  "" ?> />
                    <?php if ($key === 'colors') : ?>
                      <div class="color" style="background:<?= $option['color_value'] ?>"></div>
                    <?php endif; ?>

                    <p><?= $option['name'] ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>

          <button type="submit" class="btn">Сортировать</button>
        </form>

      </div>
      <div class="popup" id="catalogPopup"></div>

      <div class="catalog-items d-flex-columns">
        <?php if ($pages > 0) : ?>
          <div class="catalog-cards d-flex-rows">

          <?php

          ?>

            <?php
            
            (array) $listId = [];

            foreach ($products as $product) {
              $sql = "SELECT * FROM `type` WHERE id =:id";
              $prepare = $database->prepare($sql);
              $prepare->execute([
                ':id' => $product['type_id']
              ]);
              $type = $prepare->fetch(2);
            
              if(!in_array($product['id'], $listId)):
                  array_push($listId, $product['id']);
                ?>

                <div class="catalog-item d-flex-columns">
                  <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                  <?php if(isset($user)) : ?>
                  <div class="btns">
                    <form action="actions/user/likeProduct.php" method="post">
                      <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                      <input type="text" name="page" value="<?= "catalog" ?>" style="display:none;">
                      <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                      <button type="submit" class="like"><img src="media/icons/fav_black.svg" alt="Избранное"></button>
                    </form>
                    <form action="actions/user/compareProduct.php" method="post">
                      <input type="text" name="page" value="<?= "catalog" ?>" style="display:none;">
                      <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                      <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                      <button class="scale"><img src="media/icons/weight.svg" alt="Сравнение товаров">
                      </button>
                    </form>
                  </div>

                  <?php endif ?>

                  <p class="category"><?= $type['name'] ?></p>
                  <p class="price"><?= number_format($product['price'], '0', '.', ' ') ?> ₽</p>
                  <p class="descr"><?= $product['name'] ?></p>
                  <a href="?page=more&id=<?= $product['id'] ?>" class="btn">Подробнее</a>
                </div>
              <?php endif ?>

            <?php } ?>
          </div>
        <?php else : echo '<p class="errors">К сожалению, нет доступных товаров.</p>';
        endif; ?>
        <div class="catalog-bottom d-flex-rows">

          <p class="catalog-show-items">
            Показано <?= count($products) ?> товаров
          </p>

          <?php if ($pages > 1) : ?>
            <div class="pagination d-flex-rows">
              <?php if(isset($_GET['p']) && (int)$_GET['p'] !== 1) {?>
                <a href="?page=catalog&p=<?= $_GET['p'] - 1 ?>">
                 <svg width="25" height="21" viewBox="0 0 25 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M24.5002 10.5054C24.5002 10.9366 24.1502 11.2866 23.7189 11.2866L3.44015 11.2866L11.4539 19.1679C11.5304 19.239 11.5919 19.3247 11.6347 19.42C11.6775 19.5152 11.7008 19.6181 11.7032 19.7225C11.7055 19.827 11.6869 19.9308 11.6485 20.0279C11.61 20.125 11.5524 20.2134 11.4792 20.2879C11.406 20.3624 11.3186 20.4214 11.2221 20.4615C11.1257 20.5017 11.0222 20.522 10.9177 20.5214C10.8133 20.5208 10.71 20.4993 10.614 20.4581C10.518 20.4169 10.4313 20.3569 10.3589 20.2816L0.991402 11.0697L0.974527 11.0535C0.893342 10.9713 0.831478 10.8721 0.793425 10.763C0.755371 10.6539 0.742084 10.5377 0.754527 10.4229C0.774115 10.2349 0.861421 10.0605 1.00015 9.93225L10.3589 0.72975C10.4313 0.654449 10.518 0.594429 10.614 0.553238C10.71 0.512047 10.8133 0.490524 10.9177 0.489937C11.0222 0.489349 11.1257 0.509714 11.2221 0.549824C11.3186 0.589933 11.406 0.648975 11.4792 0.723457C11.5524 0.797939 11.61 0.886349 11.6485 0.983458C11.6869 1.08057 11.7055 1.1844 11.7032 1.28882C11.7008 1.39325 11.6775 1.49614 11.6347 1.59141C11.5919 1.68668 11.5304 1.7724 11.4539 1.8435L3.44015 9.72475L23.7189 9.72475C24.1502 9.72475 24.5002 10.0735 24.5002 10.5054Z" fill="#333333" />
                  </svg></a>
              <?php } else { ?>
                <span>
                  <svg width="25" height="21" viewBox="0 0 25 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M24.5002 10.5054C24.5002 10.9366 24.1502 11.2866 23.7189 11.2866L3.44015 11.2866L11.4539 19.1679C11.5304 19.239 11.5919 19.3247 11.6347 19.42C11.6775 19.5152 11.7008 19.6181 11.7032 19.7225C11.7055 19.827 11.6869 19.9308 11.6485 20.0279C11.61 20.125 11.5524 20.2134 11.4792 20.2879C11.406 20.3624 11.3186 20.4214 11.2221 20.4615C11.1257 20.5017 11.0222 20.522 10.9177 20.5214C10.8133 20.5208 10.71 20.4993 10.614 20.4581C10.518 20.4169 10.4313 20.3569 10.3589 20.2816L0.991402 11.0697L0.974527 11.0535C0.893342 10.9713 0.831478 10.8721 0.793425 10.763C0.755371 10.6539 0.742084 10.5377 0.754527 10.4229C0.774115 10.2349 0.861421 10.0605 1.00015 9.93225L10.3589 0.72975C10.4313 0.654449 10.518 0.594429 10.614 0.553238C10.71 0.512047 10.8133 0.490524 10.9177 0.489937C11.0222 0.489349 11.1257 0.509714 11.2221 0.549824C11.3186 0.589933 11.406 0.648975 11.4792 0.723457C11.5524 0.797939 11.61 0.886349 11.6485 0.983458C11.6869 1.08057 11.7055 1.1844 11.7032 1.28882C11.7008 1.39325 11.6775 1.49614 11.6347 1.59141C11.5919 1.68668 11.5304 1.7724 11.4539 1.8435L3.44015 9.72475L23.7189 9.72475C24.1502 9.72475 24.5002 10.0735 24.5002 10.5054Z" fill="#ACACAC" />
                  </svg>
                </span>
              <?php } ?>
              <div class="pagination-items d-flex-rows">
                <?php
                  for ($i = 1; $i <= $pages; $i++) : ?>
                     <a href="?page=catalog&p=<?= $i ?>" class="<?php if (($i === 1 && !isset($_GET['p'])) || (isset($_GET['p']) && (int) $_GET['p'] === $i)) echo "active" ?> pagin-item"><?= $i ?></a>
                <?php endfor; ?>
              </div>

              <?php if (isset($_GET['p']) && (int)$_GET['p'] < $pages) { ?>
                <a href="?page=catalog&p=<?= $_GET['p'] + 1 ?>">
                   <svg width="25" height="21" viewBox="0 0 25 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.499847 10.5054C0.499847 10.0741 0.849848 9.72412 1.2811 9.72412L21.5598 9.72412L13.5461 1.84287C13.4696 1.77177 13.4081 1.68605 13.3653 1.59078C13.3225 1.49551 13.2992 1.39262 13.2968 1.2882C13.2945 1.18377 13.3131 1.07994 13.3515 0.982828C13.39 0.885719 13.4476 0.797309 13.5208 0.722828C13.594 0.648346 13.6814 0.589305 13.7779 0.549195C13.8743 0.509086 13.9778 0.488722 14.0823 0.489308C14.1867 0.489895 14.29 0.51142 14.386 0.55261C14.482 0.593801 14.5687 0.65382 14.6411 0.729119L24.0086 9.94099L24.0255 9.95724C24.1067 10.0394 24.1685 10.1387 24.2066 10.2478C24.2446 10.3568 24.2579 10.473 24.2455 10.5879C24.2259 10.7758 24.1386 10.9502 23.9998 11.0785L14.6411 20.281C14.5687 20.3563 14.482 20.4163 14.386 20.4575C14.29 20.4987 14.1867 20.5202 14.0823 20.5208C13.9778 20.5214 13.8743 20.501 13.7779 20.4609C13.6814 20.4208 13.594 20.3618 13.5208 20.2873C13.4476 20.2128 13.39 20.1244 13.3515 20.0273C13.3131 19.9302 13.2945 19.8263 13.2968 19.7219C13.2992 19.6175 13.3225 19.5146 13.3653 19.4193C13.4081 19.3241 13.4696 19.2383 13.5461 19.1672L21.5598 11.286L1.2811 11.286C0.849848 11.286 0.499847 10.9372 0.499847 10.5054Z" fill="#333333" />
                  </svg>
                  </a>
              <?php } else if (isset($_GET['p']) && (int)$_GET['p'] >= $pages) { ?>
                <span>
                  <svg width="25" height="21" viewBox="0 0 25 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.499847 10.5054C0.499847 10.0741 0.849847 9.72412 1.2811 9.72412L21.5598 9.72412L13.5461 1.84287C13.4696 1.77177 13.4081 1.68605 13.3653 1.59078C13.3225 1.49551 13.2992 1.39262 13.2968 1.2882C13.2945 1.18377 13.3131 1.07994 13.3515 0.982828C13.39 0.885719 13.4476 0.797309 13.5208 0.722828C13.594 0.648346 13.6814 0.589305 13.7779 0.549195C13.8743 0.509086 13.9778 0.488722 14.0823 0.489308C14.1867 0.489895 14.29 0.51142 14.386 0.55261C14.482 0.593801 14.5687 0.65382 14.6411 0.729119L24.0086 9.94099L24.0255 9.95724C24.1067 10.0394 24.1685 10.1387 24.2066 10.2478C24.2446 10.3568 24.2579 10.473 24.2455 10.5879C24.2259 10.7758 24.1386 10.9502 23.9998 11.0785L14.6411 20.281C14.5687 20.3563 14.482 20.4163 14.386 20.4575C14.29 20.4987 14.1867 20.5202 14.0823 20.5208C13.9778 20.5214 13.8743 20.501 13.7779 20.4609C13.6814 20.4208 13.594 20.3618 13.5208 20.2873C13.4476 20.2128 13.39 20.1244 13.3515 20.0273C13.3131 19.9302 13.2945 19.8263 13.2968 19.7219C13.2992 19.6175 13.3225 19.5146 13.3653 19.4193C13.4081 19.3241 13.4696 19.2383 13.5461 19.1672L21.5598 11.286L1.2811 11.286C0.849847 11.286 0.499847 10.9372 0.499847 10.5054Z" fill="#ACACAC" />
                  </svg>
                </span>
               <?php } else { ?>
                <a href="?page=catalog&p=2">
                 <svg width="25" height="21" viewBox="0 0 25 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.499847 10.5054C0.499847 10.0741 0.849848 9.72412 1.2811 9.72412L21.5598 9.72412L13.5461 1.84287C13.4696 1.77177 13.4081 1.68605 13.3653 1.59078C13.3225 1.49551 13.2992 1.39262 13.2968 1.2882C13.2945 1.18377 13.3131 1.07994 13.3515 0.982828C13.39 0.885719 13.4476 0.797309 13.5208 0.722828C13.594 0.648346 13.6814 0.589305 13.7779 0.549195C13.8743 0.509086 13.9778 0.488722 14.0823 0.489308C14.1867 0.489895 14.29 0.51142 14.386 0.55261C14.482 0.593801 14.5687 0.65382 14.6411 0.729119L24.0086 9.94099L24.0255 9.95724C24.1067 10.0394 24.1685 10.1387 24.2066 10.2478C24.2446 10.3568 24.2579 10.473 24.2455 10.5879C24.2259 10.7758 24.1386 10.9502 23.9998 11.0785L14.6411 20.281C14.5687 20.3563 14.482 20.4163 14.386 20.4575C14.29 20.4987 14.1867 20.5202 14.0823 20.5208C13.9778 20.5214 13.8743 20.501 13.7779 20.4609C13.6814 20.4208 13.594 20.3618 13.5208 20.2873C13.4476 20.2128 13.39 20.1244 13.3515 20.0273C13.3131 19.9302 13.2945 19.8263 13.2968 19.7219C13.2992 19.6175 13.3225 19.5146 13.3653 19.4193C13.4081 19.3241 13.4696 19.2383 13.5461 19.1672L21.5598 11.286L1.2811 11.286C0.849848 11.286 0.499847 10.9372 0.499847 10.5054Z" fill="#333333" />
                  </svg>
                </a>
              <?php } endif ;?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="script/accordion.js"></script>
<script src="script/accordion-mobile.js"></script>