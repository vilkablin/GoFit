  <?php

  global $database;

  $sql = "SELECT * FROM `users`";
  $query = $database->query($sql);
  $users = $query->fetchAll(2);

  ?>


  <div class="users d-flex-columns">
    <?php foreach ($users as $user) {

      $sql = "SELECT * FROM `roles` WHERE id = :id";
      $prepare = $database->prepare($sql);
      $prepare->execute([
        ':id' => $user['role_id']
      ]);

      $role = $prepare->fetch(2); ?>

      <div class="user-item d-flex-rows">
        <div class="avatar">
          <img src="<?php echo is_null($user['avatar']) ? 'media/icons/avatar.svg' : $user['avatar'];  ?>" alt="Аватар">
        </div>
        <p class="name"><?= $user['name'] ?> <br>
          <?= $user['surname'] ?></p>
        <p class="age"><?= (date_diff(date_create($user['birthday']), date_create('now'))->y) ?> лет</p>
        <p class="email"><?= $user['email'] ?></p>
        <p class="role"><?= $role['name'] ?></p>
        <?php if($user['role_id'] === 1) {?>
        <form action="actions/user/ban.php" method="post">
          <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
          <button type="submit">  <svg width="20" height="20" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 0C7.75 0 10 2.25 10 5C10 7.75 7.75 10 5 10C2.25 10 0 7.75 0 5C0 2.25 2.25 0 5 0ZM5 1C4.05 1 3.2 1.3 2.55 1.85L8.15 7.45C8.65 6.75 9 5.9 9 5C9 2.8 7.2 1 5 1ZM7.45 8.15L1.85 2.55C1.3 3.2 1 4.05 1 5C1 7.2 2.8 9 5 9C5.95 9 6.8 8.7 7.45 8.15Z" fill="#C80F0F" /></svg></button>
        </form>
        <?php } else if($user['role_id'] === 3) { ?>

          <form action="actions/user/allow.php" method="post">
          <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
          <button type="submit">  <svg width="20" height="20" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 0C7.75 0 10 2.25 10 5C10 7.75 7.75 10 5 10C2.25 10 0 7.75 0 5C0 2.25 2.25 0 5 0ZM5 1C4.05 1 3.2 1.3 2.55 1.85L8.15 7.45C8.65 6.75 9 5.9 9 5C9 2.8 7.2 1 5 1ZM7.45 8.15L1.85 2.55C1.3 3.2 1 4.05 1 5C1 7.2 2.8 9 5 9C5.95 9 6.8 8.7 7.45 8.15Z" fill="#2D9B3F" /></svg></button>
        </form>

          <?php } ?>
      </div>
    <?php } ?>
  </div>