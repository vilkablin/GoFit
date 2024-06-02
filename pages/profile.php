<?php

if (!isset($_SESSION['user'])) {
    echo ('403 Нет прав доступа');
    die();
}

global $database;
global $user;

?>

<div class="bread-crumbs w-100">
    <div class="container">
        <div class="bread-crumbs-inner w-100 d-flex-rows">
            <a href="?page=home">Главная /</a>
            <a href="?page=profile" class="active">Личный кабинет</a>
        </div>
    </div>
</div>

<div class="profile w-100">
    <div class="container">
        <div class="profile-inner w-100 d-flex-rows">
            <div class="profile-info d-flex-rows">
                <form action="actions/user/uploadAvatar.php" method="post" enctype="multipart/form-data" class="upload">
                    <div class="avatar">
                        <img src="<?php echo is_null($user['avatar']) ? 'media/icons/avatar.svg' : $user['avatar'];  ?>" alt="Аватарка">
                    </div>
                    <?php
                    if (isset($_SESSION['errors'])) {
                        foreach ($_SESSION['errors'] as $error) {
                            echo "<p class='errors'>$error</p>";
                        }
                        unset($_SESSION['errors']);
                    }
                    ?>

                    <input type="file" name="avatar" id="avatar">
                    <label for="avatar"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0H20V10H18V2H2V11.586L7 6.586L12.414 12L11 13.414L7 9.414L2 14.414V18H10V20H0V0ZM13.547 5C13.2818 5 13.0274 5.10536 12.8399 5.29289C12.6524 5.48043 12.547 5.73478 12.547 6C12.547 6.26522 12.6524 6.51957 12.8399 6.70711C13.0274 6.89464 13.2818 7 13.547 7C13.8122 7 14.0666 6.89464 14.2541 6.70711C14.4416 6.51957 14.547 6.26522 14.547 6C14.547 5.73478 14.4416 5.48043 14.2541 5.29289C14.0666 5.10536 13.8122 5 13.547 5ZM10.547 6C10.547 5.20435 10.8631 4.44129 11.4257 3.87868C11.9883 3.31607 12.7514 3 13.547 3C14.3426 3 15.1057 3.31607 15.6683 3.87868C16.2309 4.44129 16.547 5.20435 16.547 6C16.547 6.79565 16.2309 7.55871 15.6683 8.12132C15.1057 8.68393 14.3426 9 13.547 9C12.7514 9 11.9883 8.68393 11.4257 8.12132C10.8631 7.55871 10.547 6.79565 10.547 6ZM18 12V16H22V18H18V22H16V18H12V16H16V12H18Z" fill="black" />
                        </svg></label>
                    <button type="submit" class="btn">Загрузить</button>
                </form>

                <div class="info-items d-flex-columns">
                    <div class="name d-flex-columns">
                        <h4><?= $user['name'] ?></h4>
                        <h4><?= $user['surname'] ?></h4>
                    </div>

                    <p><?= (date_diff(date_create($user['birthday']), date_create('now'))->y) ?> лет</p>
                    <p class="mail"><?= $user['email'] ?></p>
                    <a href="?page=editProfile&id=<? $user['id'] ?>" class="btn">Редактировать</a>
                    <a href="?page=editPassword&id=<? $user['id'] ?>" class="btn">Сменить пароль</a>
                    <a href="actions/user/exit.php" id="exitBtn" class="btn">Выйти</a>
                </div>
            </div>
            <div class="orders d-flex-columns">
                <h3>Мои заказы</h3>
                <div class="order-item d-flex-columns">
                    <p class="number">Заказ №11</p>
                    <div class="order-items d-flex-rows">
                        <img src="media/catalog/products/1.jpg" alt="Товар" />
                        <img src="media/catalog/products/2.jpg" alt="товар" />
                    </div>
                    <div class="order-info d-flex-rows">
                        <p class="price">4 399 ₽</p>
                        <p><span>Статус: </span>Доставлен</p>
                    </div>
                </div>
                <div class="order-item d-flex-columns">
                    <p class="number">Заказ №10</p>
                    <div class="order-items d-flex-rows">
                        <img src="media/catalog/products/1.jpg" alt="товар" />
                        <img src="media/catalog/products/2.jpg" alt="товар" />
                        <img src="media/catalog/products/2.jpg" alt="товар" />
                    </div>
                    <div class="order-info d-flex-rows">
                        <p class="price">4 399 ₽</p>
                        <p><span>Статус: </span>Собирается</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>