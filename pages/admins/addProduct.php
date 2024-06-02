<?php
global $database;
global $user;

if (!isset($user) || !($user['role_id'] === 2))  die('403 Нет прав доступа');

$sql = "SELECT * FROM `product`";
$query = $database->query($sql);
$product = $query->fetch(2);

if (isset($_GET['page']) && isset($_GET['id']) && $_GET['page'] === 'editProduct') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `product` WHERE `id` = :id";
    $prepare = $database->prepare($sql);
    $prepare->execute([
        ':id' => $product['id']
    ]);

    $product = $prepare->fetch(2);
};

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

?>

<div class="add w-100">
    <div class="container">
        <div class="add-inner w-100 d-flex-columns">
            <h3>Добавление товара</h3>
            <form action="actions/product/add.php" method="POST" class="d-flex-columns" enctype="multipart/form-data">
                <div class="input__item">
                    <input type="text" name="name" placeholder="Название" />
                    <label for="name">Название</label>
                </div>
                <?php
                if (isset($_SESSION['errors']['name'])) :
                ?> <p class="errors"><?=$_SESSION['errors']['name'] ?></p>
                <?php unset($_SESSION['errors']['name']);
                endif; ?>
                <div class="input__item">
                    <input type="text" name="desc" placeholder="Описание">
                    <label for="desc">Описание</label>
                </div>
                <?php
                if (isset($_SESSION['errors']['desc'])) :
                ?> <p class="errors"><?=$_SESSION['errors']['desc'] ?></p>
                <?php unset($_SESSION['errors']['desc']);
                endif; ?>
                <div class="input__item">
                    <input type="text" name="price" placeholder="Цена" />
                    <label for="price">Цена</label>
                </div>
                <?php
                if (isset($_SESSION['errors']['price'])) :
                ?> <p class="errors"><?=$_SESSION['errors']['price'] ?></p>
                <?php unset($_SESSION['errors']['price']);
                endif; ?>
                <div class="select__item">
                    <label for="">Пол</label>
                    <select name="gender">
                        <?php foreach ($genders as $gender) { ?>
                            <option value="<?= $gender['id'] ?>"><?= $gender['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="select__item">
                    <label for="">Цвет</label>
                    <select name="color">
                        <?php foreach ($colors as $color) { ?>
                            <option value="<?= $color['id'] ?>"><?= $color['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="select__item">
                    <label for="">Тип товара</label>
                    <select name="type">
                        <?php foreach ($types as $type) { ?>
                            <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                        <?php } ?>
                    </select>

                </div>

                <div class="select__item">
                    <label for="">Бренд</label>
                    <select name="brand">
                        <?php foreach ($brands as $brand) { ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="select__item">
                    <label for="">Материал</label>
                    <select name="material">
                        <?php foreach ($materials as $material) { ?>
                            <option value="<?= $material['id'] ?>"><?= $material['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="select__item">
                    <label for="">Размер</label>
                    <select name="sizes[]" multiple="multiple">
                        <?php foreach ($sizes as $size) { ?>
                            <option value="<?= $size['id'] ?>"><?= $size['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

            
                <div class="input__image">
                    <input type="file" name="image" id="image">
                    <label for="image" class="imgs">Выберите изображениe<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0H20V10H18V2H2V11.586L7 6.586L12.414 12L11 13.414L7 9.414L2 14.414V18H10V20H0V0ZM13.547 5C13.2818 5 13.0274 5.10536 12.8399 5.29289C12.6524 5.48043 12.547 5.73478 12.547 6C12.547 6.26522 12.6524 6.51957 12.8399 6.70711C13.0274 6.89464 13.2818 7 13.547 7C13.8122 7 14.0666 6.89464 14.2541 6.70711C14.4416 6.51957 14.547 6.26522 14.547 6C14.547 5.73478 14.4416 5.48043 14.2541 5.29289C14.0666 5.10536 13.8122 5 13.547 5ZM10.547 6C10.547 5.20435 10.8631 4.44129 11.4257 3.87868C11.9883 3.31607 12.7514 3 13.547 3C14.3426 3 15.1057 3.31607 15.6683 3.87868C16.2309 4.44129 16.547 5.20435 16.547 6C16.547 6.79565 16.2309 7.55871 15.6683 8.12132C15.1057 8.68393 14.3426 9 13.547 9C12.7514 9 11.9883 8.68393 11.4257 8.12132C10.8631 7.55871 10.547 6.79565 10.547 6ZM18 12V16H22V18H18V22H16V18H12V16H16V12H18Z" fill="#fff" />
                        </svg></label>
                </div>

                <?php
                if (isset($_SESSION['errors']['image'])) :
                ?> <p class="errors"><?=$_SESSION['errors']['image'] ?></p>
                <?php unset($_SESSION['errors']['image']);
                endif; ?>

                <button type="submit">Добавить товар</button>

            </form>
        </div>
    </div>
</div>