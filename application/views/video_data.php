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
        <div class="row">
          <div class="col-lg-8">
          </div>
          <div class="col-lg-4" style="text-align: right;">
            <a href="javascript:history.back()" class="btn btn-primary rounded-0 px-4">Back</a>
          </div>
        </div>
         <?php  
         if(!empty($video_data))  
         {  
         foreach($video_data as $result)  
         { 
          //print_r($result);
         ?> 
            <div class="row">
                <div class="col-lg-8 ">
                    <p>
                    <?php if($result['video_url']){?>
                    <video id="videojs-overlay-player" class="video-js vjs-default-skin" controls width="650" height="400">
                    <source src="<?=$result['video_url']?>" type='video/mp4'>
                    </video>
                    
                    <?php } else { ?>
                    <div class="col-lg-8 ml-auto align-self-center">
                       <h3 > No  Such File  Exists</h3>
                    </div>
                    
                     <?php }?>
                     
                    <input type='hidden' name="student_detail" id="student_detail" value="<?php echo ucfirst($this->session->userdata('CL_STUDENT_USERNAME')); ?> &nbsp;<?php echo $this->session->userdata('CL_STUDENT_MOBILE'); ?>">
                    </p>
                </div>
                <div class="col-lg-4 ml-auto align-self-center">
                        <h2 class="section-title-underline mb-5">
                            <span>Course Details</span>
                        </h2>
                        <?php $uriSegments = explode("/", parse_url($result['video_url'], PHP_URL_PATH));
		$lastUriSegment = array_pop($uriSegments); ?>
                        <p><strong class="text-black d-block">Category:</strong> <?= $this->Common_model->category_name($result['category_id']);?></p>
                        <p class="mb-5"><strong class="text-black d-block">SubCategory:</strong><?= $this->Common_model->subcategory_name($result['subcategory_id']);?></p>
                         <p class="mb-5"><strong class="text-black d-block">Video name:</strong><?= $result['video_name'];?></p>
                        <p  class="mb-5"> <strong class="text-black d-block">Video Description:</strong><?=$result['video_description'];?></p>
                        <p><strong class="text-black d-block">Price:</strong>  <?php if($result['status']== 1){?> Buy * <?php } else{?> Free <?php }?></p>
                        
                       
                    </div>
            </div>
            <?php    
              }  
            } else{ ?> 
                No Video Found
            <?php }?>
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

