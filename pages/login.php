<?php

?>


<div class="login w-100">
    <div class="container">
        <div class="login-inner d-flex-columns">
            <h2>Авторизация</h2>
            <form action="actions/user/login.php" class="d-flex-columns" method="post">
                <div class="input__item">
                    <input type="text" name="email" placeholder="Электронная почта*" value="<?php
                                                                                            if (isset($_SESSION['email'])) {
                                                                                                echo $_SESSION['email'];
                                                                                                unset($_SESSION['email']);
                                                                                            }
                                                                                            ?>">


                    <label>Электронная почта*</label>
                </div>
                <?php

                if (isset($_SESSION['errors']['email'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['email'] ?></p>
                <?php unset($_SESSION['errors']['email']);
                }
                ?>
                <div class="input__item">
                    <input type="password" name="password" placeholder="Пароль*" />

                    <label>Пароль*</label>
                </div>
                <?php
                if (isset($_SESSION['errors']['password'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['password'] ?></p>
                <?php unset($_SESSION['errors']['password']);
                }
                ?>


                <button type="submit">Авторизоваться</button>
            </form>
            <p>Нет аккаунта ? <a href="?page=signin">Зарегестрироваться</a></p>
        </div>
    </div>
</div>