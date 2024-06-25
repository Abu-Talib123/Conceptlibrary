
<?php
$mobile =$this->session->userdata('CL_STUDENT_MOBILE');
//$productinfo = $itemInfo['material_type'];
$txnid = time();
$surl = $surl;
$furl = $furl;        
$key_id = RAZOR_KEY_ID;
$currency_code = $currency_code; 
$card_holder_name = APPLICATION_NAME;
$email = 'info@conceptlibrary.in';
$phone = $mobile;
$name = APPLICATION_NAME;
$return_url = site_url().'cart/callback';
?>
   <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="<?php echo base_url();?>">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Checkout</span>
      </div>
    </div>
<div class="site-section">
  <div class="container">
  <div class="row">
  <div class="col-lg-12 col-md-6 mb-12">
    <div class="row">
            <div class="col-lg-4 col-md-4 mb-12">
              <h4 class="product-name">Product Name</h4>
            </div>
            <div class="col-lg-3 col-md-2 mb-12">
              <h4 class="product-name">Type</h4>
            </div>  
            <div class="col-lg-3 col-md-2 mb-12">
              <h4 class="product-name">Price</h4>
            </div>
           
      </div>
    <?php
           $count = 0;
           $sum=0;
           
           foreach($itemInfo as $item)
           {?>
            <div class="row">
            <div class="col-lg-4 col-md-4 mb-12">
              <h4 class="product-name"><strong><?php echo  $this->Common_model->subcategory_name($item['material_id']); ?></strong></h4><h4><small>Product description</small></h4>
            </div>
            <div class="col-lg-3 col-md-2 mb-12">
              <h6 class="mtop1"><?php echo $item['material_type'];?></h6>
            </div>
            <div class="col-lg-3 col-md-2 mb-12">
              <h6 class="mtop1">&#8377;<?php echo  $item['price']; ?></h6>
            </div>
            </div>  
            <hr>
             <?php  
        $sum+=  $item['price'];
        $count++; 
        $productinfo = 'all';
        $total = $sum *100;
        $amount = $sum;
        $merchant_order_id = $item['payment_id'];
      }?>
          <div class="panel-footer">
          <div class="row text-center">
            <div class="col-lg-8 col-md-8 mb-12">
            <h4 class="text-right">Total <strong> &#8377;<?php echo number_format($sum,2) ;?></strong></h4>
            <input type="hidden" name="material_price" id="material_price" value="<?php echo $sum;?>">
            </div>
          </div>
         
        </div>
     
 <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
</form>
 </div>
</div>
 <br>
 <br>
 <br>
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="<?php echo site_url();?>" name="reset_add_emp" id="re-submit-emp" class="btn btn-warning"><i class="fa fa-mail-reply"></i> Back</a>
            <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary" />
        </div>
    </div>
</div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total; ?>",
    name: "<?php echo $name; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
    prefill: {
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>
