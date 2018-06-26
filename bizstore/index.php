<?php
 require_once("config.php");
  $behnam = [];

  // $db->where("id" , 1);
  $products = $db->get('products');
  $user = $db->get('users');

?>

<?php include'./header.php' ?>
<?php include'./bizstorenav.php' ?>
<?php include'./substorenav.php' ?>



    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-2 img-responsive headerText  "  style=" height: 500PX; background-image: url('./images/f1.jpg')">

      </header>

      <!-- Page Features -->
      <div class="row text-center my-4">
      <?php foreach($products as $key => $value){?>
        <div class="uk-card uk-card-hover col-lg-4 col-md-6 col-sm-8 mb-4" uk-scrollspy="target: > div; cls:uk-animation-fade; delay: 500">
          <div class="card">
            <img class="card-img-top cardImageSize" src=<?php echo($value['picture_1'])?> alt="">
            <div class="card-body card-body1">
              <h4 class="card-title"><?php echo($value['name']); ?></h4>
              <!-- <p class="card-text">امتیاز:<?php echo($value['score'])?></p>   -->
              <h3 class="cost"><span class="glyphicon glyphicon-usd"></span>قیمت: <?php echo($value['price']-$value['price']/$value['off'])?> <small class="pre-cost"><span class="glyphicon glyphicon-usd"></span><?php echo($value['price'])?> </small></h3>
              <div>
              <!-- <p  id="alert<?php echo($key)?>"></p> -->
              </div>

            </div>
            <div class="row"  >
                            <div class="col-md-6 col-sm-6 col-xs-12  " style=" "  >
                                <select class="form-control" id="color<?php echo($value['id'])?>" name="select" style="display:block;margin:0 auto;width:80%;direction: rtl; ">
                                    <option value="رنگ" disabled selected="">رنگ</option>
                                    <option value="black">Black</option>
                                    <option value="white">White</option>
                                    <option value="gold">Gold</option>
                                    <option value="rose gold">Rose Gold</option>
                                </select>
                            </div>

                            <!-- end col -->
                            <div class="col-md-6 col-sm-6 col-xs-12 mb-4"style=" " >
                                <select class="form-control" id="qty<?php echo($value['id'])?>" name="select" style="display:block;margin:0 auto;width:80%;direction: rtl; ">
                                    <option value="تعداد"disabled  selected="">تعداد</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <!-- end col -->
                        </div>
            <div class="card-footer btn-ground text-center ">
               <button type="button" class="btn btn-success  add_to_cart_btn " id="my_btn"  data-id="<?php echo($value['id'])?>"> <i class="fa fa-shoping-cart"> </i>افزودن به سبد </button>
               <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#product_view<?php echo($key); ?>"> <i class="fa fa-shoping-cart"> </i> مشخصات کالا </button>
            </div>

          </div>
        </div>
      <?php }?><!-- /.row -->

    </div>
    <!-- /.container -->
    <?php foreach($products as $key => $value){?>
    <div class="container">
    	<div class="row">
		    <div class="modal fade product_view" id="product_view<?php echo($key)?>">
		    	<div class="modal-dialog">
		    		<div class="modal-content">
		    			<div class="modal-header">
		    					<a href="#" data-dismiss="modal" class="class pull-left"><span class="glyphicon glyphicon-remove"></span></a>
		                	<h3 class="modal-title">مشخصات کالا</h3>
		    			</div>

		    			<div class="modal-body">
		                <div class="row">

		                    <div class="col-md-12 product_content" align="right">
		                        <h4>شناسه محصول <span><?php echo($value['code'])?></span></h4>
		                        <p><?php echo($value['disc'])?></p>
		                        <h3 class="cost"><span class="glyphicon glyphicon-usd"></span> <?php echo($value['price']-$value['price']/$value['off'])?> <small class="pre-cost"><span class="glyphicon glyphicon-usd"></span><?php echo($value['price'])?> </small></h3>
		                        <div class="space-ten"></div>
		                    </div>
		                </div>
		            </div>
		    		</div>
		    	</div>
		    </div>
	    </div>
    </div>
    <?php }?>


    <!-- Footer -->
    <?php include'footer.php' ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function(){
      $(".add_to_cart_btn").click(function(){
        let id = $(this).attr("data-id");
        let qid = '#qty'.concat(id);
        let q = $(qid).val();
        let cnum = '#color'.concat(id);
        let c = $(cnum).val();
        // let c = (cid).val();
        let a = "";
        let x = 0 ;
        // alert(q);
        if (q == null ){
          a =  "لطفا تعداد کالای موردنظر را انتخاب نمایید!";
          alert(a);
        }
        else if (c == null ){
          a = "لطفا رنگ کالای مورد نظر خود را مشخص نمایید!";
          alert(a);
        }
        else {
          $.post('./ajax_add_to_cart.php' , {
            pid : id,
            c : c , 
            q : q
          }, function(data){
            if (data == 0){
              a = "خطا در ارتباط با سرور" ;
            }
            else if (data == 1){
              a = "کالا با موفقیت به سبد اضافه شد!";
              $.get('./ajax_get_total_quantity.php',{}, function(data){
              $(".show-total-quantity").html(data);
            });
              alert(a);
            }
            else if (data == 2)
            {
              a = "مقادیر جدید به سبد اضافه شد";
              alert(a);
            }
            // alert(data);
          });
          
        }
        // alert(a);
      })
      });
   
    
    </script>
  </body>

</html>
