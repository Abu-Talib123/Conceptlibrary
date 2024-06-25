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
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?=base_url('assets/cl/images/bg_1.jpg')?>')">
   <div class="container">
      <div class="row align-items-end">
         <div class="col-lg-7">
            <h2 class="mb-0">MOCKPAPERS</h2>
         </div>
      </div>
   </div>
</div>
<?php include 'breadcrumb.php';?>
 <div class="site-section">
        <div class="container">
        <?php $result =  $exam_data ;
        
         if($exam_data)  
         { 
         ?> 
            <div class="row">
                <div class="col-md-6 mb-4">
                 <?php if(file_exists($result['exam_preview'])){?> 
                    <p>  <img src="<?php echo $result['exam_preview'];?> " alt="<?=$result['exam_name'];?>" class="img-fluid"></p>
                  <?php } else{ ?>
                    <p>  <img src="<?php echo $result['exam_preview'];?>" alt="Image" class="img-fluid"></p>
                    <?php }?>
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
                         <p class="mb-5"><strong class="text-black d-block">Exam name:</strong><?= $result['exam_name'];?></p>
                       
                        
                       
                        <?php  

                        $stu_id = $this->session->userdata('CL_STUDENT_ID');
                        $exsqry =   $this->db->query('SELECT * from payment  where student_id = \''.$stu_id.'\' AND material_id ='.$result['subcategory_id'].' AND paymentstatus = 2 AND (material_type = \''.$domain_type.'\' or  material_type = "all")');
                        $paymentcount = $exsqry->num_rows();
                         $query1 = $this->db->get_where('student_history', array(//making selection
                          'student_id' => $this->session->userdata('CL_STUDENT_ID'),
                          'exam_id'=> $result['exam_id'],
                          'is_submitted' => 1
                          ));
                          
                          //print_r($result);exit;
                          $examcount = $query1->num_rows();
                         
                          $status        = $this->mock_model->fetch_statusbysubcat($result['subcategory_id']);
                        
                        if($this->session->userdata('CL_STUDENT_ID') && $result['subcategory_status']== 1 && $examcount ==0 && ($paymentcount > 0 || $result['status'] == 0))
                          { ?>
                           <p><a class="btn btn-primary" href="<?php echo base_url();?>mockpaper/exam_detail/<?php echo $result['exam_id'];?>">Take Test</a></p> 
                         <?php  
                          }else if($this->session->userdata('CL_STUDENT_ID') && $result['subcategory_status']== 1 && $examcount <> 0 && ($paymentcount > 0 || $result['status'] == 0) )
                            { ?>
                           <h4>This test has taken.<a href="<?php echo base_url();?>mockpaper/studenthistorydata/<?php echo $result['exam_id'];?>">View History</a></h4> 
                         <?php  
                          }else if($this->session->userdata('CL_STUDENT_ID') && ($result['subcategory_status'] == 0) && ($examcount == 0 /* || $result['status'] == 0 */)){?>
                                 <p><a class="btn btn-primary" href="<?php echo base_url();?>content/exam_detail/<?php echo $result['exam_id'];?>"> Take Test</a></p> <?php  }
                            else if($this->session->userdata('CL_STUDENT_ID') && ($result['subcategory_status'] == 0) && $examcount <>0 ){?>
                                <h4>This test has taken.<a href="<?php echo base_url();?>mockpaper/studenthistorydata/<?php echo $result['exam_id'];?>">View History</a></h4>
                                 <?php }
                            else { ?>
                              <a href="<?php echo base_url();?>cart" class="btn btn-primary rounded-0 btn-lg px-5">Enroll</a>
                            <?php }  
                          if(! $this->session->userdata('CL_STUDENT_ID') ){ ?>
                        <p>
                            <a href="<?php echo base_url();?>auth/authentication/<?php echo $result['exam_id'];?>" class="btn btn-primary rounded-0 btn-lg px-5">Enroll</a>
                        </p>
                    <?php }?>
                    </div>
            </div>
            <?php    
               
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