<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?=base_url('assets/cl/images/bg_1.jpg')?>'">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-7">
                <h2 class="mb-0"><?=$sub_title;?></h2>
                <p></p>
            </div>
        </div>
    </div>
</div>
<?php include 'videobreadcrumb.php';?>

<div class="site-section">
    <div class="container">
      <form role="form" name="frm_domain" id="frm_domain" action="#" method="post" enctype="multipart/form-data">
        <?php
         $i=0;
          $domain_type= $domain_type;
          if(!empty($fetch_domaindata)){
         ?>
       <div class="row" style="margin-bottom:10px;">
          <div class="col-lg-8" style="text-align: right;">
            <input type="checkbox" name="selectall" id="selectall"/> <strong>Select All</strong> &nbsp;
            <button type="button" name="add_cart_total" id="add_cart_total"  disabled="disabled" class="btn btn-primary add_cart_total"  />Add to Cart</button>
            <input type="hidden" name="product_type" id="product_type" class="form-control quantity" value="<?=$domain_type?>" />
          </div>
          <div class="col-lg-4" style="text-align: right;">
            <a href="javascript:history.back()" class="btn btn-primary rounded-0 px-4">Back</a>
          </div>
        </div>
        <div class="row">
       
        <?php  foreach($fetch_domaindata as $result)
               {
                $stu_id = $this->session->userdata('CL_STUDENT_ID');
                $query  = $this->db->get_where('payment', array(
                'student_id' => $stu_id,
                'material_id'=> $result['subcategory_id'],
                'material_type'=> $domain_type,
                'paymentstatus'=> 2
                ));
                $paymentcount = $query->num_rows();
                 
                ?>
              <input type="hidden" name="material_id[]" id="material_id" class="form-control quantity" value="<?=$result['subcategory_id']?>" id="product_id" />
              <div class="col-lg-4">
                    <div class="course-1-item" style="max-height: 536px;">
                        <figure class="thumnail">
                        <img src="<?php echo base_url();?>assets/cl/images/c_default.jpeg" alt="Image" class="img-fluid">
                        <?php 
                          $query = $this->db->get_where('video', array(//making selection
                          'subcategory_id' => $result['subcategory_id'],
                          'is_deleted'     =>0,
                          'is_active' => 1
                          ));
                          $count = $query->num_rows();
                          if($count != 0){
                          ?>
                          <div class="productcount"> (<?=$count?>) Videos</div>
                        <?php }?>
                        <?php if($result['status'] == 1){?>
                        <div class="price">&#8377;<?php if($result['offer_price'] > 0) { echo '<strike>'.$result['price'].'</strike><br/>'.'&#8377;'.$result['offer_price'];}else{ echo $result['price'];} ?></div>
                        <?php }else {?>
                          <div class="price">Free</div>
                       <?php }?>
                        <div class="category"><h2 ><?=$result['subcategory_name'];?></h2> <small style="color:#FFF">Get Free Mockpapers</small>
                          <h3 align="center"></h3> </div>  
                        </figure>
                        <p class="desc mb-4" align="center"><?=$result['subcategory_description'];?></p>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="course-1-content pb-4">
                              <p><a href="<?php echo base_url();?>video/video_data/<?= $result['subcategory_id']; ?>" class="btn btn-primary rounded-0">View</a></p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <?php
                          if($stu_id)
                          {
                              if($result['status'] == 1  && $paymentcount == 0)
                              { 
                                $cartcontents = $this->Common_model->fetch_cart($this->session->userdata('CL_STUDENT_ID'),$result['subcategory_id'],$domain_type);
                                 if(!empty($cartcontents)){
                                  foreach ($cartcontents as $product) 
                                  { 
                                    if ($product['domain_type'] === $domain_type &&  $product['subcategory_id'] == $result['subcategory_id'])
                                    { 
                                ?>
                                <div class="course-1-content pb-4">
                               
                                </div>
                               <?php }else {  ?>
                                <button type="button" name="add_cart"  class="btn btn-primary add_cart"  id="<?php echo $result['subcategory_id'];?>" />Add to Cart</button> 
                              <?php  } } }else {?>
                              <div class="course-1-content pb-4">
                                  <button type="button" name="add_cart" class="btn btn-primary add_cart"  id="<?php echo $result['subcategory_id'];?>"   />Add to Cart</button> 
                              </div>
                            <?php }} 
                          } else{
                          if($result['status'] == 1){?>
                          <div class="course-1-content pb-4">
                          <a href="<?php echo base_url();?>login" class="btn btn-primary rounded-0 ">Add to Cart </a>
                          </div>
                        <?php } } ?>
                        </div>
                      </div> 
                    </div>
                </div>
            <?php 
            $i++;
          }
            ?> 
        </div>
      <?php  }
        else{?>
              <div class="col-lg-12">
                  <h5 align="center">   No  Data Found</h5>
                </div>
            <?php }?>
      </form>          
    </div>
</div>

<script>
var checker = document.getElementById('selectall');
var sendbtn = document.getElementById('add_cart_total');
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
</script>