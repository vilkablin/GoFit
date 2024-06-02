<?php
global $user;
if (!isset($_SESSION['user'])) die('403 Нет прав доступа');
?>

<div class="registr w-100">
    <div class="container">
        <div class="login-inner d-flex-columns">
            <h2>Смена Пароля</h2>
            <form action="actions/user/updatePassword.php" class="d-flex-columns" method="post">
                <input type="hidden" name="id" value="<?=$user['id']?>">
              

                <div class="input__item">
                    <input type="password" placeholder="Пароль" name="password"  />
                    <label for=>Новый пароль</label>
                </div>

                <?php
                if (isset($_SESSION['errors']['password'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['password'] ?></p>
                <?php unset($_SESSION['errors']['password']);
                }
                ?>

                <div class="input__item">
                    <input type="password" placeholder="Повторите пароль" name="password_r"  />
                    <label>Повторите пароль</label>
                </div>

                <?php
                if (isset($_SESSION['errors']['password_r'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['password_r'] ?></p>
                <?php unset($_SESSION['errors']['password_r']);
                }
                ?>

                <button type="submit">Сохранить</button>
            </form>
        </div>
    </div>
</div>