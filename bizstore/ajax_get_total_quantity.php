<?php
require_once("./config.php");

$cart = $db->get("cart");
$tQuantity = 0;

foreach ($cart as $key => $value) {
  $tQuantity += $value['quantity'];

}
  echo ($tQuantity);
?>
