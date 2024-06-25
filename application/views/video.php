<?php  
if(isset($video_data)&& isset($domain_data) )  
{ 
$i=1;?>
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
<?php 
if($this->session->userdata('CL_STUDENT_ID')){
foreach($domain_data as $result)  
{
    $query = $this->db->get_where('payment', array(//making selection
    'student_id' => $this->session->userdata('CL_STUDENT_ID'),
    'material_id'=> $result['subcategory_id'],
    'material_type'=> $domain_type
    ));
    $count = $query->num_rows();
if($status == 1 &&  $count == 0){?>
<?php include 'breadcrumb1.php';?>
<?php } else if ($status == 1  && ($count != 0)) { ?>
<?php include 'breadcrumb.php';?>
<?php } else{?>
<?php include 'breadcrumb.php';?>
<?php } } } else {?>
<?php include 'breadcrumb2.php';?>
<?php   }?>
 <div class="site-section">
    <div class="container">
        <div class="row">
          <div class="col-lg-8">
          </div>
          <div class="col-lg-4" style="text-align: right;">
            <a href="javascript:history.back()" class="btn btn-primary rounded-0 px-4">Back</a>
          </div>
        </div>
            <div class="row">
            <?php 
            foreach($video_data as $row)  
            {
            ?>  <div class="col-lg-4 col-md-6 mb-4">
                
                    <div class="course-1-item">

                        <figure class="thumnail">
                         <?php //if(!file_exists($row['video_url'])){?>
                         <!--<video src="<?php echo  $row['video_url']; ?>#t=10,25" alt="<?= $row['video_name'];?>" class="img-fluid" id="coursevideo" >-->
                         <?php //} else{?>
                          <img src="<?php echo  $row['video_preview']; ?>" alt="Image" class="img-fluid"><?php //} ?>
                       
                        <div class="category">
                          <h3><?=$row['video_name'];?></h3>
                        <h3>Category:<?php echo  $this->Common_model->category_name($row['category_id']); ?></h3></div>  
                        </figure>
                        <div class="course-1-content pb-4">
                        <p class="desc mb-4"><?=$row['video_description']?></p>
                        <?php 
                           $query = $this->db->get_where('payment', array(//making selection
                            'student_id' => $this->session->userdata('CL_STUDENT_ID'),
                            'material_id'=> $row['subcategory_id'],
                            'material_type'=> 'all',
                            'paymentstatus' =>2
                            ));
                           $paymentcount = $query->num_rows();

                         if($this->session->userdata('CL_STUDENT_ID') && ($paymentcount !=0))
                          { ?>

                           <p><a href="<?php echo base_url();?>video/detail/<?= $row['video_id']; ?>" class="btn btn-primary rounded-0 px-4"> View Video</a></p> 
                   <?php  }else  if($this->session->userdata('CL_STUDENT_ID') && ($row['status'] == 0)){?>
                           
                            <p><a href="<?php echo base_url();?>video/detail/<?= $row['video_id']; ?>" class="btn btn-primary rounded-0 px-4"> View Video</a></p> 
                   <?php }else {?>
                            <div class="overlay">Do you want to view this video please login and buy.</div> 
                            <button class="btn btn-primary rounded-0 login_cart"> View Video</button>
                   <?php }   ?>
                        </div>

                    </div>
                </div>
            <?php
            $i++;       
            }  ?>
         
               
            </div>
        </div>
    </div>
}
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
<?php  }  ?> 
<style>
 
  .overlay {
  position: absolute; 
  bottom: 0; 
  background: rgb(0, 0, 0);
  background: rgba(0, 0, 0, 0.5); /* Black see-through */
  color: #f1f1f1; 
  width: 100%;
  transition: .5s ease;
  opacity:0;
  color: white;
  font-size: 20px;
  padding: 20px;
  text-align: center;
}
.course-1-item:hover .overlay {
  opacity: 1;
}
  </style>
 <script>
    document.onkeydown = function(e) {
    if(event.keyCode == 123) {
    return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
    return false;
    }
    }
  </script>

