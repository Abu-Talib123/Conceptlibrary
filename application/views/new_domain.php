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
      <div class="row" style="margin-bottom:10px;">
          <div class="col-lg-8" style="text-align: right;">
            <input type="checkbox" name="selectall" id="selectall"/>Select All
            <button type="button" name="add_cart" id="add_cart"  disabled="disabled" class="btn btn-primary add_cart"  />Add to Cart</button>
          </div>
          <div class="col-lg-4" style="text-align: right;">
            <a href="javascript:history.back()" class="btn btn-primary rounded-0 px-4">Back</a>
          </div>
        </div>
        <br>
        
    <div class="row">
     
     <?php
      $i=0;
      if(!empty($fetch_subcatdata)){
      foreach($fetch_subcatdata as $result)
      { 
        ?>
          <div class="col-lg-4">
                <div class="course-1-item">
                    <figure class="thumnail">
                    <a href=""><img src="<?php echo base_url();?>assets/cl/images/course_1.jpg" alt="Image" class="img-fluid"></a>
                    <div class="category"><h3><?=$result['subcategory_name'];?></h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                       <p><a href="<?php echo base_url();?>video/domain/<?= $result['subcategory_id']; ?>" class="btn btn-primary rounded-0 px-4">View More</a></p>
                    </div>
                </div>
            </div>
        <?php 
        $i++;
        }} else{?>
           <div class="col-lg-12">
              <h5 align="center">   No  Data Found</h5>
            </div>
        <?php }?>
        
    </div>
    </div>
</div>

<script>
var checker = document.getElementById('selectall');
var sendbtn = document.getElementById('add_cart');
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
</script>