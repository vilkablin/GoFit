<div class="registr w-100">
    <div class="container">
        <div class="login-inner d-flex-columns">
            <h2>Регистрация</h2>
            <form action="actions/user/signup.php" class="d-flex-columns" method="post">
                <div class="input__item">
                    <input type="text" name="name" placeholder="Имя*" value="<?php
                    if (isset($_SESSION)) {
                    if (isset($_SESSION['name'])) {
                    echo $_SESSION['name'];
                    unset($_SESSION['name']);
                }}
                    ?>">
                    <label>Имя*</label>
                </div>
                <?php
                if (isset($_SESSION['errors']['name'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['name'] ?></p>
                <?php unset($_SESSION['errors']['name']);
                }
                ?>


                <div class="input__item">
                    <input type="text" name="surname" placeholder="Фамилия*" value="<?php
                     if (isset($_SESSION)) {
                       if (isset($_SESSION['surname'])) {
                        echo $_SESSION['surname'];
                           unset($_SESSION['surname']);
                           } }
                       ?>">
                    <label>Фамилия*</label>
                </div>
                <?php
                if (isset($_SESSION['errors']['surname'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['surname'] ?></p>
                <?php unset($_SESSION['errors']['surname']);
                }
                ?>


                <div class="input__item">
                    <input type="text" name="email" placeholder="Электронная почта*" value="<?php
                                                            if (isset($_SESSION)) {
                                                                if (isset($_SESSION['email'])) {
                                                                    echo $_SESSION['email'];
                                                                    unset($_SESSION['email']);
                                                                }
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
                    <input type="date" name="birthday" />
                    <label class="birth">Дата рождения*</label>
                </div>

                <?php
                if (isset($_SESSION['errors']['birthday'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['birthday'] ?></p>
                <?php unset($_SESSION['errors']['birthday']);
                }
                ?>


                <div class="input__item">
                    <input type="password" placeholder="Пароль*" name="password" />
                    <label for=>Пароль*</label>
                </div>

                <?php
                if (isset($_SESSION['errors']['password'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['password'] ?></p>
                <?php unset($_SESSION['errors']['password']);
                }
                ?>


                <div class="input__item">
                    <input type="password" placeholder="Повторите пароль*" name="password_r" />
                    <label>Повторите пароль*</label>
                </div>

                <?php
                if (isset($_SESSION['errors']['password_r'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['password_r'] ?></p>
                <?php unset($_SESSION['errors']['password_r']);
                }
                ?>


                <button type="submit">Зарегестрироваться</button>
            </form>
            <p>Уже есть аккаунт ? <a href="?page=login">Войти </a></p>
        </div>
    </div>
</div>