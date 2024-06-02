<?php

function getUserById(int $userId)
{
    global $database;

    $query = "SELECT `users`.*, `roles`.`name` AS 'role_name' FROM `users` JOIN `roles` ON `roles`.`id` = `users`.`role_id` WHERE `users`.`id` = :id";

    $state = $database->prepare($query);

    $state->execute(['id' => $userId]);

    $data = $state->fetch(PDO::FETCH_ASSOC);

    if ($data === '') {
        return null;
    }

    return $data;
}


function getUserByEmail(string $email)
{
    global $database;

    $query = "SELECT `id`, `password`, `role_id` FROM `users` WHERE `email` = :email";

    $state = $database->prepare($query);

    $state->execute(['email' => $email]);

    $data = $state->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        return null;
    }

    return $data;
}
