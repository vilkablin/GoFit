<?php

global $database;

$sql = "SELECT * FROM `product`";
$query = $database->query($sql);
$products = $query->fetchAll(2);

?>

<div class="products d-flex-columns">
    <div class="products-items d-flex-rows">
        <?php foreach ($products as $product) {
            $sql = "SELECT * FROM `type` WHERE id =:id";
            $prepare = $database->prepare($sql);
            $prepare->execute([
                ':id' => $product['type_id']
            ]);

            $type = $prepare->fetch(2)
        ?>
            <div class="catalog-item d-flex-columns">
                <img src="<?= $product['image'] ?>" alt="Изображение товара">

                <p class="category"><?= $type['name'] ?></p>
                <p class="price"><?= number_format($product['price'], '0', '.', ' ') ?> ₽</p>
                <p class="descr"><?= $product['name'] ?></p>
                <a href="?page=editProduct&id=<?= $product['id'] ?>" class="btn">Редактировать</a>
                <form action="actions/product/delete.php" method="post">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <button id="deleteBtn" class="btn">Удалить</button>
                </form>
            </div>
        <?php } ?>
        </div>
        <a href="?page=addProduct" class="addbtn">Добавить товар</a>
    </div>
</div>