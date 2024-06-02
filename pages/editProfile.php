<?php
global $user;
if (!isset($_SESSION['user'])) die('403 Нет прав доступа');
?>

<div class="registr w-100">
    <div class="container">
        <div class="login-inner d-flex-columns">
            <h2>Редактирование</h2>
            <form action="actions/user/editProfile.php" class="d-flex-columns" method="post">
                <input type="hidden" name="id" value="<?=$user['id']?>">
                <div class="input__item">
                    <input type="text" name="name" placeholder="Имя" value="<?php
                  if (isset($_SESSION)) {
                 if (isset($_SESSION['name'])) {
                        echo $_SESSION['name'];
                 unset($_SESSION['name']);
                      } else {
                          echo $user['name'];
                      }
                         }
                  ?>">
                    <label>Имя</label>
                </div>
                <?php
                if (isset($_SESSION['errors']['name'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['name'] ?></p>
                <?php unset($_SESSION['errors']['name']);
                }
                ?>

                <div class="input__item">
                    <input type="text" name="surname" placeholder="Фамилия" value="<?php
                       if (isset($_SESSION)) {
                         if (isset($_SESSION['surname'])) {
                           echo $_SESSION['surname'];
                           unset($_SESSION['surname']);
                         }else {
                           echo $user['surname'];
                            }
                          }
                          ?>">
                    <label>Фамилия</label>
                </div>
                <?php
                if (isset($_SESSION['errors']['surname'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['surname'] ?></p>
                <?php unset($_SESSION['errors']['surname']);
                }
                ?>


                <div class="input__item">
                    <input type="text" name="email" placeholder="Электронная почта" value="<?php echo $user['email'];?>">
                    <label>Электронная почта</label>
                </div>
                <?php
                if (isset($_SESSION['errors']['email'])) { ?>
                    <p class="errors"><?= $_SESSION['errors']['email'] ?></p>
                <?php unset($_SESSION['errors']['email']);
                }
                ?>

                <button type="submit">Сохранить</button>
            </form>
        </div>
    </div>
</div>