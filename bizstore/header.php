
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>فروشگاه اینترنتی بیز</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/heroic-features.css" rel="stylesheet">
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!--uikit link -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>

  </head>

  <body>

    <?php
    require_once("./config.php");
    $cart = $db->get("cart");
    $tQuantity = 0;

    foreach ($cart as $key => $value) {
      $tQuantity += $value['quantity'];
    }

    $address = $db->get("addresses");


    ?>
