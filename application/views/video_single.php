<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?=base_url('assets/cl/images/bg_1.jpg')?>')">
   <div class="container">
      <div class="row align-items-end">
         <div class="col-lg-7">
            <h2 class="mb-0">VIDEO</h2>
         </div>
      </div>
   </div>
</div>
<?php include 'breadcrumb.php';?>
 <div class="site-section">
        <div class="container">
           <?php  
         if($video_data)  
         {  
         foreach($video_data as $result)  
         { 
         ?> 
            <div class="row">
                <div class="col-md-6 mb-4">
                    <p>
                        <img src="<?= $result['video_preview']; ?>" alt="Image" class="img-fluid">
                    </p>
                     <p>
                            <a href="javascript:history.back()" class="btn btn-primary rounded-0 btn-lg px-5">Back</a>
                     </p>
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                        <h2 class="section-title-underline mb-5">
                            <span>Course Details</span>
                        </h2>
                        <p><strong class="text-black d-block">Category:</strong> <?= $this->Common_model->category_name($result['category_id']);?></p>
                        <p class="mb-5"><strong class="text-black d-block">SubCategory:</strong><?= $this->Common_model->subcategory_name($result['subcategory_id']);?></p>
                         <p class="mb-5"><strong class="text-black d-block">Video name:</strong><?= $result['video_name'];?></p>
                        <p  class="mb-5"> <strong class="text-black d-block">Video Description:</strong><?=$result['video_description'];?></p>
                        <p><strong class="text-black d-block">Price:</strong>  <?php if($result['status']== 1){?> Buy * <?php } else{?> Free <?php }?></p>
                        <p></p>
                        <?php print_r($result); if($this->session->userdata('CL_STUDENT_ID') && ($result['status']== 1)){ ?>
                           <p><a href="<?php echo base_url();?>content/payment_video/<?php echo $result['video_id'];?>"> View Video</a></p> <?php  }
                            if($this->session->userdata('CL_STUDENT_ID') && ($result['status']== 0)){?>
                                 <p><a href="<?php echo base_url();?>content/video_detail/<?php echo $result['video_id'];?>"> View Video</a></p> <?php  }
                            else { ?>
                            <?php }  if(! $this->session->userdata('CL_STUDENT_ID') ){ ?>
                        <p>
                            <a href="<?php echo base_url();?>auth/authentication/<?php echo $result['video_id'];?>" class="btn btn-primary rounded-0 btn-lg px-5">Enroll</a>
                        </p>
                    <?php }?>
                        
                    </div>
            </div>
            <?php    
              }  
            }  ?> 
        </div>
    </div>
<div class="section-bg style-1" style="background-image: url('<?=base_url('assets/cl/images/hero_1.jpg')?>')">
   <div class="container">
      <div class="row">
         <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-mortarboard"></span>
            <h3>Our Philosphy</h3>
            <p>Start preparing with right content at right time. Toughest part is not studies but the routine.</p>
         </div>
         <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-school-material"></span>
            <h3>Our believes</h3>
            <p>We belive in teaching style followed by students focus to succeed in their exams.
            </p>
         </div>
         <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-library"></span>
            <h3>Do you need motivation?</h3>
            <p>If you are behind external factors such as motivational videos or motivational guru, it means this dream is not yours.
            </p>
         </div>
      </div>
   </div>
</div>