<?php
    require_once("./config.php");
    $address_id = $_POST['address_id'];
    $db->where("id" , $address_id);
    $db->delete("addresses");
?>
