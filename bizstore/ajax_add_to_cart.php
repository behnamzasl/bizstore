<?php
    require_once("./config.php");
    $id = $_POST['pid'];
    $color = $_POST['c'];
    $qty = $_POST['q'];
    $db->where("product_id" , $id);
    $db->where("color" , $color);
    $cart = $db -> get("cart");
    $check = 0;
    // echo('injaaaaaaaaaaaaaaaaaaaa');
    foreach($cart as $key => $value){
        if ($value['id'] == $id && $value['color'] == $color){
            $value['quantity'] += $qty ;
            $db->where("product_id" , $id);
            $db->where("color" , $color);
            $db->update('cart' , $value);
            $check = 1 ;
        }
    
    }
    if ($check == 0){
    $c = [];
    $c['product_id'] = $id;
    $c['color'] = $color;
    $c['quantity'] = $qty;
    $db-> insert('cart' , $c);
    echo(1);
    }
    else{
        echo(2);
    }
 ?>