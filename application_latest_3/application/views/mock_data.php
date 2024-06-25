<?php  
if(isset($exam_data)&& isset($domain_data) )  
{ 
$i=1;?>
<style>
      body {
        -webkit-user-select: none;
        -webkit-touch-callout: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        color: #cc0000;
      }
      .course-1-item .course-1-content {
          padding: 20px 20px;
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
<?php 
$stu_id = 0;
if($this->session->userdata('CL_STUDENT_ID')){
$domain_type= $domain_type;
$check_domain_type= 'all';
$paymentcount = 0;
$stu_id = $this->session->userdata('CL_STUDENT_ID');
foreach($domain_data as $result)  
{ 
  
  $exsqry =   $this->db->query('SELECT * from payment  where student_id = \''.$stu_id.'\' AND material_id ='.$result['subcategory_id'].' AND (material_type = \''.$check_domain_type.'\' or  material_type = \''.$domain_type.'\') AND paymentstatus = 2');
  $paymentcount = $exsqry->num_rows();
  
  /*$query  = $this->db->get_where('payment', array(
  'student_id' => $stu_id,
  'material_id'=> $result['domain_id'],
  'material_type'=> $check_domain_type
  ));
    $paymentcount = $query->num_rows();*/

if($status == 1 &&  $paymentcount == 0){?>
<?php include 'breadcrumb1.php';?>
<?php } else if ($status == 1  && ($paymentcount != 0)) { ?>
<?php include 'mockbreadcrumb.php';?>
<?php } else{?>
<?php include 'breadcrumb.php';?>
<?php } } } else {?>
<?php include 'breadcrumb2.php';?>
<?php   }?>


 <div class="site-section" onCopy="return false" onCut="return false" >
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
            
            foreach($exam_data as $row)  
            {
                $url = site_url('mockpaper/studenthistorydata/'.$row['exam_id']);
                $check_result = $this->mock_model->checkanswer($row['exam_id'],$stu_id)
            ?>  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="course-1-item">
                        <figure class="thumnail">
                         <?php if(file_exists($row['exam_preview'])){?>
                         <image src="<?php echo  $row['exam_preview']; ?>" alt="<?= $row['exam_name'];?>" class="img-fluid">
                         <?php } else{?>
                          <img src="<?php echo  $row['exam_preview']; ?><?php //echo base_url('assets/cl/images/course_1.jpg');?>" alt="Image" class="img-fluid img-thumbnail" style="width:350px;height:200px"><?php }?>
                       
                        <div class="category">
                          <h3><?=$row['exam_name'];?></h3>
                        <h3>Category:<?php echo  $this->Common_model->category_name($row['category_id']); ?></h3></div>  
                        </figure>
                        <div class="course-1-content pb-4">
                        
                         <?php if($row['status']== 0){?>
                     
                         <!--  <p><a href="<?php echo base_url();?>mockpaper/mock_detail/<?= $row['exam_id']; ?>" class="btn btn-primary rounded-0 px-4">View Mock</a></p> -->
                          <?php } 
                          /* $query = $this->db->get_where('payment', array(//making selection
                            'student_id' => $this->session->userdata('CL_STUDENT_ID'),
                            'material_id'=> $row['domain_id'],
                            'material_type'=> $check_domain_type
                            ));
                           $count = $query->num_rows();*/
                           //echo $paymentcount;
                          if($this->session->userdata('CL_STUDENT_ID') && ($paymentcount !=0 || $row['status'] == 0))
                          { ?>
                           <p><a href="<?php echo base_url();?>mockpaper/mock_detail/<?= $row['exam_id']; ?>" class="btn btn-primary rounded-0 px-4"> View Mock</a>
                            <?php if($check_result){ ?>
                            <a href="<?php echo base_url();?>mockpaper/studenthistorydata/<?= $row['exam_id']; ?>" class="btn btn-warning rounded-0 px-4">Test Completed</a>
                            <?php } ?>
                           </p> 
                   <?php  }else  if($this->session->userdata('CL_STUDENT_ID') && ($status ==0 || $row['status'] == 0)){?>
                             <p><a href="<?php echo base_url();?>mockpaper/mock_detail/<?= $row['exam_id']; ?>" class="btn btn-primary rounded-0 px-4"> View Mock</a>
                             <?php if($check_result){ ?>
                            <a href="<?php echo base_url();?>mockpaper/studenthistorydata/<?= $row['exam_id']; ?>" class="btn btn-warning  rounded-0 px-4">Test Completed</a>
                            <?php } ?></p> 
                   <?php }else if($this->session->userdata('CL_STUDENT_ID')) {?>
                          <button class="btn btn-primary rounded-0 pay_cart"> View Mock</button>
                   <?php }else {?>
                          <button class="btn btn-primary rounded-0 login_cart"> View Mock</button>
                   <?php }?>
                        
                        </div>
                    </div>
                </div>
            <?php
            $i++;       
            }  ?>
         
               
            </div>
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
<?php  }  ?> 
