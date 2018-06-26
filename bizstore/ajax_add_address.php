<?php
    require_once("./config.php");
    $addresses = [];
    $addresses['title'] = $_POST['title'];
    $addresses['location'] = $_POST['location'];
    $data_id = $db->insert('addresses' , $addresses);
    echo($data_id);
?>