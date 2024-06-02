<div class="bread-crumbs w-100">
  <div class="container">
    <div class="bread-crumbs-inner w-100 d-flex-rows">
      <a href="?page=home">Главная /</a>
      <a href="?page=shop" class="active">Корзина</a>
    </div>
  </div>
</div>

<div class="shop w-100">
  <div class="container">
    <div class="shop-inner w-100 d-flex-rows">
      <?php if (empty($user)) { ?>

        <h1 class="nothing">Войдите, чтоб добавлять товары в корзину </h1>

      <?php } else { ?>
        <div class="shop-elements d-flex-columns">
          <div class="shop-title d-flex-rows">
            <h2>Корзина</h2>
            <p>2 товара</p>
          </div>
          <div class="shop-btns w-100 d-flex-rows">
            <div class="selectall d-flex-rows">
              <input type="checkbox" />
              <p>Выбрать все</p>
            </div>
            <a href="#">Очистить корзину</a>
          </div>
          <div class="shop-items w-100 d-flex-columns">
            <div class="shop-item d-flex-rows">
              <img src="media/catalog/products/2.jpg" alt="товар">
              <div class="item-info d-flex-columns">
                <h4>Бра adidas Aeroreact Training Light-Support</h4>
                <div class="info-elements d-flex-rows">
                  <p><span>Размер:</span> XS</p>
                  <p><span>Цвет:</span> Черный</p>
                </div>
              </div>
              <div class="item-price d-flex-columns">
                <p class="price">4 399 ₽</p>
                <div class="counter d-flex-rows">
                  <p><span>-</span></p>
                  <p>1</p>
                  <p>+</p>
                </div>
                <a href="#" class="del">Удалить</a>
              </div>
            </div>

            <div class="shop-item d-flex-rows">
              <img src="media/catalog/products/1.jpg" alt="товар">
              <div class="item-info d-flex-columns">
                <h4>Бра adidas Aeroreact Training Light-Support</h4>
                <div class="info-elements d-flex-rows">
                  <p><span>Размер:</span> XS</p>
                  <p><span>Цвет:</span> Черный</p>
                </div>
              </div>
              <div class="item-price d-flex-columns">
                <p class="price">4 399 ₽</p>
                <div class="counter d-flex-rows">
                  <p><span>-</span></p>
                  <p>1</p>
                  <p>+</p>
                </div>
                <a href="#" class="del">Удалить</a>
              </div>
            </div>
          </div>
        </div>
        <div class="order d-flex-columns">
          <h3>Ваш заказ</h3>
          <div class="tovars d-flex-rows">
            <p>Товары, 2 шт. </p>
            <p class="price">4 399 ₽</p>
          </div>

          <div class="result d-flex-rows">
            <p>Итого</p>
            <p class="price">4 399 ₽</p>
          </div>

          <form class="d-flex-columns" action="#">
            <input type="text" placeholder="Введите промокод">
            <a href="?page=ordering" class="btn">Перейти к оформлению</a>
          </form>
        </div>
      <?php } ?>
    </div>
  </div>
</div>