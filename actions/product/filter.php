<?php

if ($_SERVER["REQUEST_METHOD"] != "GET") {
    die("Поддерживается только метод GET");
}

$params = [];

foreach ($_GET as $key => $value) {
    $params[$key]= implode(',' ,$value);
}

$query = '';

foreach ($params as $key => $value) {
    $query .= $key . '=' . $value . '|';
}

$query = substr($query, 0, -1);


$callbackUrl = "http://" . $_SERVER["HTTP_HOST"] . '/index.php?page=catalog&filter=' . $query; 
//
header("Location: $callbackUrl");