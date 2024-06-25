<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?=base_url('assets/cl/images/bg_1.jpg')?>')">
   <div class="container">
      <div class="row align-items-end">
         <div class="col-lg-7">
            
         </div>
      </div>
   </div>
</div>
<?php include 'breadcrumb.php';?>



<div class="site-section">
   <div class="container" id="result">
   <div class="row">
    <h3 align="text-center"> Successfully Completed Your Test</h3>
   </div>
   <?php if($score_percentage>80){?>
   <div class="row">
      <h3 align="text-center"> Congratulations   You Scored  <?=number_format((float)$score_percentage, 2, '.', '');?> %   in  this test</h3>
   </div>
   <?php  }else {?>
    <div class="row">
      <h3 align="text-center"> You Scored  <?= number_format((float)$score_percentage, 2, '.', '');?> %   in  this test</h3>
   </div>
   <?php }?>
   
   </div>
   
     
</div>


