<style>
    body {
        -webkit-user-select: none;
        -webkit-touch-callout: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        color: #cc0000;
      }
</style>
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
<?php include 'breadcrumb.php';?>
<div class="site-section">
    <div class="container">
        <div class="row">
         
         <?php
          $i=0;
          if(!empty($fetch_categorydata)){
          foreach($fetch_categorydata as $category)
          {?>
            <div class="col-lg-3" onclick="window.location='<?php echo base_url();?>mockpaper/course/<?= $category['category_id']; ?>'" style="cursor:pointer;">
                <div class="feature-1 category1 text-center">
                    <div class="icon-wrapper bg-primary">
                    <a href="javascript:void(0)">    <h5  align="text-center" class="text-white"><?=$category['category_name'];?></h5></a>
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