<?php
require_once("./config.php");
$cart = $db->get("cart");
$products = [];
foreach ($cart as $key => $value) {

    $db->where("id", $value['product_id']);
    $products [] = $db->getOne("products");

}
$total = 0;
foreach ($cart as $key => $value) {
    foreach ($products as $key2 => $value2) {
        if ($value2['id'] == $value['product_id']) {
            $total += $value['quantity'] * $value2['price'];
        }
    }

}

$tQuantity = 0;
foreach ($cart as $key => $value) {
  $tQuantity += $value['quantity'];
}
$address = $db->get("addresses");
?>

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/heroic-features.css" rel="stylesheet">
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<link rel="stylesheet" type="text/css" href="./shopping.css">
<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->

<?php include'header.php' ?>
<?php include'./bizstorenav.php'; 
      include'./substorenav.php';
?>
<div class="container my-4">

    <table id="cart" class="table table-hover table-condensed" align="right" style=" text-align:right;direction: rtl">
        <thead>
        <tr>
            <th style="width:60%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:12%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>


        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart as $key => $value) {
            $db->where("id", $value['product_id']);
            $product = $db->getOne("products");
            ?>
            <tr data-id="<?= $product['id'] ?>">
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs">
                            <?php if (isset($product['picture_1']) && $product['picture_1'] != "") { ?>
                                <img src="<?= $product['picture_1'] ?>" alt="..." class="img-responsive" width="100"
                                     height="100"/>
                            <?php } else { ?>
                                <img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>
                            <?php } ?>
                        </div>
                        <div class="col-sm-10">
                            <h4 class="" style="margin-right: 10px;"><?php echo $product['name']; ?></h4>
                            <p style="margin-right: 10px;"><?php echo $product['disc']; ?> </p>
                        </div>

                    </div>
                </td>
                <td data-th="Price" class="price"
                    data-id="<?= $product['id'] ?>"><?= number_format($product['price']) ?></td>
                <td data-th="Quantity">
                    <input type="number" data-id="<?= $product['id'] ?>" class="form-control text-center number" min="1"
                           value="<?= $value['quantity'] ?>">
                </td>
                <td data-th="Subtotal" data-id="<?= $product['id'] ?>"
                    class="text-center product_total"><?= number_format($product['price'] * $value['quantity']) ?></td>
                <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm delete delete-btn" data-id="<?=$product['id']?>"><i class="fa fa-trash-o"></i></button>
                </td>


            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="address_container">
    <div class="row">
        <div class="col-sm-12">
          <div class="row" >
            <div class="address_title" style="width:80%;">
                آدرس خود را انتخاب کنید :
                <div class="row">
                  <div class="uk-text-small my-2 col-md-8">
                    اضافه کردن آدرس
                    <button class="btn btn-warning "  type="button" uk-toggle="target: #offcanvas-overlay"><i class="fa fa-plus-circle"></i></button>
                  </div>
                </div>
              </div>

                <div class="address_choose_container">
                    <?php foreach ($address as $key=>$value){ ?>
                        <div class="col-sm-12 update_address" data-id="<?php echo($value['id']); ?>" style=" text-align:right;direction: rtl" >
                            <div class="radio">
                                <input type="radio" name="optradio" class="radio_input" <?php if($key == 0) echo 'checked="checked"' ?>>
                                    <div class="address_show_title">
                                       <?php echo $value['title'] ?>
                                    </div>
                                    <!-- <div class="row"> -->
                                      <div class="address_disc col-md-8 address_show_location">
                                          <?= $value['location'] ?>
                                      </div>
                                      <div class="address_option  uk-position-left">
                                          <button class="btn btn-danger btn-sm delete-btn delete_address" data-id="<?php echo($value['id']);?>"><i class="fa fa-trash-o"></i></button>
                                          <button class="btn btn-success btn-sm delete-btn delete_addres" data-id="<?php echo($value['id']);?>"><i class="fa  fa-pencil-square-o"></i></button>
                                      </div>
                                    <!-- </div> -->
                                </div>
                          </div>
                    </div>
                    <?php }?>
                   <!--  -->
                   <div class="uk-offcanvas-content">
                   <div class="uk-transform-origin-center-left uk-background-blend-lighten" id="offcanvas-overlay" uk-offcanvas="flip : true ; overlay : true;">
                          <div class="uk-offcanvas-bar" >

                              <button class="uk-offcanvas-close" type="button" uk-close></button>
                              <input class="uk-input mt-5 address-title-input" required="required" id="address_title_box" placeholder="عنوان آدرس ">
                              <input class="uk-input mt-5 address-title-input" required="required" id="address_discription" placeholder="ادرس دقیق">
                              <div class="row">
                                <div class="col-md-6 col-sm-6">
                                  <button class="btn btn-success btn-sm ml-5 mt-4" id="add_address" type="button">اضافه کردن</button>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <button class="btn  btn-danger btn-sm mr-5 uk-offcanvas-close mt-1" type="button" >  انصراف</button>
                                </div>
                              </div>
                          </div>
                      </div>
              </div>
            </div>
        </div>
    </div>

  </div>

    <div class="shopping_forward_container  my-4">
        <div class="row mr-3 ml-3">
            <div class = "col-sm-12 mt-3">
              <div class="address_title uk-text-center"> فروش پایان یک معامله نیست ، آغاز یک تعهد است</div>
            </div>
            
            <div class="col-sm-3">
                <a href="./checkout.php" class="btn btn-success btn-block"><i class="fa fa-angle-left"></i> پیک و پرداخت نهایی </i></a>
            </div>
            <div class=" text-center col-sm-6 pt-2" style="font-weight: bold" id="total">Total :  <?php echo number_format($total) ?>
            </div>
            <div class="col-sm-3">
                <a href='./index.php' class="btn btn-warning btn-block"> ادامه خرید <i class="fa fa-angle-right"></i></a>
            </div>
            

        </div>
        </div>



<script>


    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }


    $(document).ready(function () {
      //adding address
      $("#add_address").click(function(){
        var aTitle = $("#address_title_box").val();
        var aDisc = $("#address_discription").val();
        if(aTitle == '' || aDisc == ''){
            alert("لطفا همه فیلد های ادرس را پر کنید");
        }
        else {
            $.post("./ajax_add_address.php",{
            title : aTitle,
            location : aDisc
            } , function(data_id) {
                alert(data_id)
                $(".update_address[data-id=" + data_id + "]").css('display' , 'none');
            });
        }
        // if (aTitle == null)
        
       });


        //changing quantity
        $(".number").change(function () {
            let data_id = $(this).attr('data-id');
            let price = $(".price[data-id=" + data_id + "]").html();
            price = price.replace(',', '');
            let quantity = $(this).val();
            let subtotal = quantity * price;
            alert(subtotal);
            
            $.post('ajax_update_quantity.php', {
                product_id: data_id,
                quantity: quantity
            }, function (data, err) {
                // alert(subtotal);
                alert(data);
                $(".product_total[data-id=" + data_id + "]").html(addCommas(subtotal));
                $.get('./ajax_get_total.php', {}, function (data) {
                    $("#total").html("Total : " + data);
                });
                $.get('./ajax_get_total_quantity.php',{}, function(data){
                $(".show-total-quantity").html(data);
                });
            });
            
        });

        //deleting product

        $(".delete").click(function() {
            let data_id = $(this).attr('data-id');
            $.post('./ajax_delete_cart.php' , {
                product_id: data_id
            } , function(data) {
                $("tr[data-id=" + data_id + "]").css('display' , '');
                $.get('./ajax_get_total.php', {}, function (data) {
                    $("#total").html("Total :" + data);
                });
                $.get('./ajax_get_total_quantity.php',{}, function(data){
                $(".show-total-quantity").html(data);
                });
            });
            
        });


        //deleting address
        $(".delete_address").click(function() {
            let data_id = $(this).attr('data-id');
            $.post('./ajax_delete_address.php', {
                address_id: data_id
            }, function() {
                $(".update_address[data-id=" + data_id + "]").css('display' , 'none');
            });
        });
    });
</script>
