<div class="custom-breadcrumns border-bottom">
    <div class="container">
    	<div class="row">
    		<div class="col-md-10">
	        <a href="<?=base_url('home')?>">Home</a>
	        <span class="mx-3 icon-keyboard_arrow_right"></span>
	        <span class="current"><?=$sub_title?></span>
	       </div>
	       <div class="col-md-2" >
	       <?php 
	       $stu_id = $this->session->userdata('CL_STUDENT_ID');
	       if(!empty($domain_data)){
	       foreach($domain_data as $result)  
			{
			$cartcontents = $this->Common_model->fetch_cart($stu_id,$result['subcategory_id'],$domain_type);
			//print_r($cartcontents);
			if(!empty($cartcontents)){
		 	  foreach ($cartcontents as $product) 
                { 
                   if ($product['domain_type'] === $domain_type &&  $product['subcategory_id'] == $result['subcategory_id'])
                   {?>
                      <!-- 	<button type="button"  class="btn btn-success"  />Added to Cart</button> -->
              <?php }?>

              <?php } } else {?>
				<input type="hidden" name="product_id" class="form-control quantity" value="<?=$result['subcategory_id']?>" id="product_id" />
				<input type="hidden" name="product_type" class="form-control" value="<?=$domain_type?>" id="product_type" />
				<button type="button" name="add_cart" id="<?php echo $result['subcategory_id'];?>" class="btn btn-success add_cart"  disabled/>Add to Cart</button>  <?php }  } }?>
	       </div>
       </div>
    </div>
</div>