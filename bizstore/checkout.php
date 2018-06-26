<?php include ('./header.php') ?>
<?php include ('./bizstorenav.php');
include('./substorenav.php') ?>
<div class="checkback" style=" background-image: url('./images/checkback.jpg');">
  <div class="container ">
    <div class="row check-box-margin">
      <div class="col-md-1">

      </div>
      <div class="col-md-10 post-title ">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 mt-1">
          روش پرداخت
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 mt-1">
        زمان دریافت مرسوله خود را انتخاب کنید
      </div>
      </div>
      	<div class="row my-3">
          <div class="col-md-6 col-lg-6 col-sm-6 col-6">
                  <button class="uk-button uk-button-secondary" id ="a" type="button" >بانک دی</button>
                  <button class="uk-button uk-button-secondary" id ="a1" type="button" >بانک پاسارگاد</button>
                  <button class="uk-button uk-button-secondary" id ="a2" type="button" >*780#</button>
          </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-6">
            <select class=" selectpicker w-100 p-2 float-right mr-2" data-style="btn-danger" id = "time" placeholder="زمان دریافت مرسوله">
                <option data-divider="انتخاب زمان"></option>
              <optgroup label="ساعت 8 تا 14">
                <option>شنبه</option>
                <option>یکشنبه</option>
                <option>دوشنبه</option>
                <option>سه شنبه</option>
                <option>چهارشنبه</option>
                <option>پنجشنبه</option>
              </optgroup>
              <option data-divider="true"></option>
              <optgroup label="ساعت 15 تا 19">
                <option>شنبه</option>
                <option>یکشنبه</option>
                <option>دوشنبه</option>
                <option>سه شنبه</option>
                <option>چهارشنبه</option>
                <option>پنجشنبه</option>
              </optgroup>
            </select>
          </div>
      </div>
    </div>
    <div class="col-md-1">

    </div>
    
</div>
  </div>
</div>
 
<div class="shopping_forward_container  my-4">
        <div class="row mr-3 ml-3">
            <div class = "col-sm-12 mt-3">
              <div class="address_title uk-text-center"> فروش پایان یک معامله نیست ، آغاز یک تعهد است</div>
            </div>
            
            <div class="col-sm-4">
                <!-- <a href="./checkout.php" class="btn btn-success btn-block"><i class="fa fa-angle-left"></i> پیک و پرداخت نهایی </i></a> -->
            </div>
            <div class=" text-center col-sm-4 pt-2" style="font-weight: bold" id="total"><a href="#" class="btn btn-success btn-block" id="successful"><i class="fa fa-angle-left"></i> اتمام خرید </i></a>
            </div>
            <div class="col-sm-4">
                <!-- <a href='./index.php' class="btn btn-warning btn-block"> ادامه خرید <i class="fa fa-angle-right"></i></a> -->
            </div>
            

        </div>
        </div>
<?php include("./footer.php") ?>
<script>
$(document).ready(function () {
      //adding address
      $("#a").click(function(){
        alert("پرداخت با موفقیت انجام شد");
       });
       $("#a1").click(function(){
        alert("پرداخت با موفقیت انجام شد");
       });
       $("#a2").click(function(){
        alert("پرداخت با موفقیت انجام شد");
       });
       $("#successful").click(function(){
        let time = '#time';
        let t = $(time).val();
        if (t == ''){
          alert("لطفا زمان مناسب برای تحویل کالا را انتخاب نمایید");
        }
        else{
          $.post('./ajax_delete_full_cart.php' , {} , function() {
          $.get('./ajax_get_total_quantity.php',{}, function(data){
                $(".show-total-quantity").html(data);
                });
        });
        window.location.href = "./successful.php";
        }
        
        
       });
    });
</script>
