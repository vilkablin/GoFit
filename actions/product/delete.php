<?php

require_once "../../database/database.php";

global $database;

if (!isset($_POST)) die("Not Post method");

$id = trim($_POST['id']); 

$sql = "DELETE FROM `product` WHERE `id` = $id";

$database->query($sql);
?>
<script>
  alert("Вы успешно удалили товар");
  document.location.href = "../../index.php?page=adminpanel";
</script>





