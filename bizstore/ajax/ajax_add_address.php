<?php
    require_once ("./config.php");
    $title = $_POST['title'];
    $location = $_POST['location'];

    $addresses = [];
    $addresses['title'] = $title;
    $addresses['location'] = $location;
    $db->insert('addresses' , $addresses);
?>
