<style>
.rd_option {
    margin: 5px;
    line-height: 20px;
}
body {
        -webkit-user-select: none;
        -webkit-touch-callout: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        color: #000;
      }
  .question_type_title{
    color: blue;
    padding: 0px !important;
  }
</style>
<div class="modal fade" id="myModal">
   <div class="modal-dialog modal-default">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title" align="center" style="color:#0094FE; "><b><b></h3>
         </div>
         <div class="modal-body">
          <h3> Exam starts Now</h3>
         </div>
          <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
   </div>
               <!-- /.modal-dialog -->
</div>
<div class="site-mobile-menu site-navbar-target">
   <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
         <span class="icon-close2 js-menu-toggle"></span>
      </div>
   </div>
   <div class="site-mobile-menu-body"></div>
</div>
<div class="site-section" id="mocksection" onCopy="return false" onCut="return false" >
<?php 
    $result = $this->db->get_where('student_history', array('exam_id' => @$exam_id, 'student_id' => @$student_id, 'is_submitted' => 1));
    $is_exam_written_already = $result->num_rows();
  if($is_exam_written_already == 0){
   if(isset($exam_data))  
   { 
      // old method
      // $time     = $exam_data['exam_duration'];
      // $parsed   = date_parse($time);
      // $hour     = $parsed ['hour'];
      // $minute   = $parsed ['minute'];
      // $second   = $parsed ['second'];
      
      // new mthod
      $time     = explode(':', $exam_data['exam_duration']);
      $time     = ((($time[0]*60)+$time[1])*60)+$time[2];
      $hour     = floor($time / 3600);
      $minute   = floor(($time / 60) % 60);
      $second   = $time % 60;
   ?> 
<div class="custom-breadcrumns border-bottom" id="breadcrumb" style="margin-top:20px">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-md-6">
            <ul class="nav nav-pills">
               <li class="active"><a data-toggle="pill" href="#<?php echo $exam_data['exam_id'] ;?>
                  "><?php echo $exam_data['exam_name'] ;?>
                  </a>
               </li>
               
            </ul>
         </div>
         <div class="col-lg-6 col-md-6" style="text-align: right;">
            <input type="hidden" name="exam_hour"  id="exam_hour" value="<?php echo $hour;?>"/>
            <input type="hidden" name="exam_minute"  id="exam_minute" value="<?php echo $minute;?>"/>
            <input type="hidden" name="exam_second"  id="exam_second" value="<?php echo $second;?>"/>
            <input type="hidden"  id="exam_duration" value="<?php echo $time;?>"/>
            <strong>Time Left:<span id="countdown" class="timer"></span></strong>  &nbsp;&nbsp;&nbsp;
           
         </div>
      </div>
   </div>
</div>
<!-- <div class="container" id="container1">
   <div class="row">
      <div class="col-lg-6 col-md-6 mb-5 mb-lg-5 question_type_title">
         Question Type: MSQ
      </div>
      
   </div>
</div> -->
<div class="tab-content" id="tab-content" >
   <!-- Tab 1  -->
   <div id="<?php echo $exam_data['exam_id'] ;?>" class="tab-pane fade in active show">
      <div class="container">
         <div class="row">
            <?php
            $totalcount = count($question); 

            $attended = $this->mock_model->checkanswer($exam_id, $student_id);
            $total_attended = count($attended);
            // echo "<pre>";
            // print_r($question);
              if(isset($question) )
              { 
                $q=1; 
                $unans = $markedforreview = 0;
                $ans = 0; 
                $notvisited = $totalcount; 
                //print_r($question);
               if($question)
               { 
              ?>
                <div class="col-lg-8 col-md-6 mb-5 mb-lg-5">
                 <form role="form" name="frm_mock" id="frm_mock" action="<?=site_url('mockpaper/updatedata')?>" method="post" enctype="multipart/form-data">
                  
                  <input type="hidden" name="student_id" id="student_id" value="<?=$this->session->userdata('CL_STUDENT_ID');?>">
                  <input type="hidden" name="exam_id" id="exam_id" value="<?=$exam_data['exam_id'];?>">
                    <?php  $i= 0;        
                       foreach($question as $result)
                       {
                         
                          $answered_question =  $this->mock_model->get_answered_question($exam_id, $student_id, $result['mock_test_id']);
                          if($answered_question) {
                            if($answered_question['is_marked'] == 1){
                                $markedforreview++; 
                              }else if($answered_question['student_answered'] == 'CL'){
                                   $unans++; 
                              }else{
                                   $ans++; 
                              }
                          
                           
                          }
                            
                          $styleDiv = 'style="display: none;"';
                          if($q==1){ $styleDiv = ''; }
                         ?>
                         <input type="hidden" id="ans_mark_<?=$result['mock_test_id'];?>" value="<?=$result['mark']?>">
                              <input type="hidden" id="negative_mark_<?=$result['mock_test_id'];?>" value="<?=$result['negative_mark']?>">
                          <div class="col-lg-12 my-2 col-md-6 questions_div question_div_<?=$i?>" id="question_<?php echo $result['mock_test_id'];?>" <?=$styleDiv?>>
                              
                              Question No :<?php echo $q;?>
         <span style="float:right;font-weight:bold"><span style="color:green">Marks for correct answer: <?=$result['mark']?> </span>| <span style="color:red">Negative Marks: <?=$result['negative_mark']?> </span><a href="#" data-toggle="modal" data-target="#modal-default"><span class ='text-dark mx-1'>|</span><img src="<?=base_url('assets/cl/images/calculator.png')?>" alt="Calculator" style=" width: 24px; height: 24px;" /></a></span>
      <?php
      if($result['option_type']==1)
      {
        ?>
        <div class="container" id="container1">
           <div class="row">
              <div class="col-lg-6 col-md-6 mb-5 mb-lg-5 question_type_title">
                 Question Type: NAT
              </div>    
           </div>
        </div>
        <?php
      }else if($result['option_type']==2)
      {
        ?>
        <div class="container" id="container1">
           <div class="row">
              <div class="col-lg-6 col-md-6 mb-5 mb-lg-5 question_type_title">
                 Question Type: MSQ
              </div>    
           </div>
        </div>
        <?php
      }else{
        ?>
        <div class="container" id="container1">
           <div class="row">
              <div class="col-lg-6 col-md-6 mb-5 mb-lg-5 question_type_title">
                 Question Type: MCQ
              </div>    
           </div>
        </div>
        <?php
      }
      ?>
      <br>
                              <?php if($result['question_type']== 1)
                              {?>
                                

                                <image src="<?=$result['question']?> " style="width:700px; height: 200px;"/>
                             <?php  }else{?>
                              <b><?php echo htmlspecialchars_decode($result['question']);?></b> 
                            <?php }?>
                              <input type="hidden" id="question_id"  name="question_id[]" value="<?=$result['mock_test_id'];?>">
                            <?php if($result['option_type'] == 0) { ?>
                              <div id="option_1" class="rd_option">
                                 <input type="radio" class="option" id="option_1_<?php echo $result['option_1'];?>" name="option_1[<?=$result['mock_test_id'];?>]" value="a" 
                                 <?php 
                                  if(isset($answered_question['student_answered'])) 
                                  { 
                                     if($answered_question['student_answered'] == 'a'){
                                        echo "checked";
                                     }
                                     
                                  }
                                 ?>>
                                 <label for="option_1_<?=$result['option_1']?>"><?php echo $result['option_1'];?></label>
                              </div>
                              <div id="option_2" class="rd_option">
                                 <input type="radio" class="option" id="option_2_<?php echo $result['option_2'];?>" name="option_1[<?=$result['mock_test_id'];?>]" value="b" <?php 
                                 if(isset($answered_question['student_answered'])) 
                                 { 
                                    if($answered_question['student_answered'] == 'b'){
                                       echo "checked";
                                    }
                                    
                                 } 
                                 ?>>
                                 <label for="option_2_<?php echo $result['option_2'];?>"><?php echo $result['option_2'];?></label>
                              </div>
                              <div id="option_3" class="rd_option">
                                 <input type="radio" class="option" id="option_3_<?php echo $result['option_3'];?>" name="option_1[<?=$result['mock_test_id'];?>]" value="c"
                                  <?php 
                                   if(isset($answered_question['student_answered'])) 
                                   { 
                                      if($answered_question['student_answered'] == 'c'){
                                         echo "checked";
                                      }
                                      
                                   }
                                  ?>>
                                 <label for="option_3_<?=$result['option_3'];?>"><?php echo $result['option_3'];?></label>
                              </div>
                              <div id="option_4" class="rd_option">
                                 <input type="radio" class="option" id="option_4_<?php echo $result['option_4'];?>" name="option_1[<?=$result['mock_test_id'];?>]" value="d" 
                                 <?php 
                                  if(isset($answered_question['student_answered'])) 
                                  { 
                                     if($answered_question['student_answered'] == 'd'){
                                        echo "checked";
                                     }
                                     
                                  }
                                 ?>>
                                 <label for="option_4_<?php echo $result['option_4'];?>"><?php echo $result['option_4'];?></label>
                              </div>
                            
                            <?php  } else if($result['option_type'] == 2){
                               if(isset($answered_question['student_answered'])){
                                 $student_answered_array = explode(",", $answered_question['student_answered']);
                               }
                               else{
                                 $student_answered_array = [];
                               }
                            
                              ?>
                              <div id="option_1" class="rd_option">
                                 <input type="checkbox" class="option" id="option_1_<?php echo $result['option_1'];?>" name="option_1[<?=$result['mock_test_id'];?>]" value="a" <?php if(in_array("a", $student_answered_array)) { echo "checked";} ?>>
                                 <label for="option_1_<?=$result['option_1']?>"><?php echo $result['option_1'];?></label>
                              </div>
                              <div id="option_2" class="rd_option">
                                 <input type="checkbox" class="option" id="option_2_<?php echo $result['option_2'];?>" name="option_1[<?=$result['mock_test_id'];?>]" value="b" <?php if(in_array("b", $student_answered_array)) { echo "checked";} ?>>
                                 <label for="option_2_<?php echo $result['option_2'];?>"><?php echo $result['option_2'];?></label>
                              </div>
                              <div id="option_3" class="rd_option">
                                 <input type="checkbox" class="option" id="option_3_<?php echo $result['option_3'];?>" name="option_1[<?=$result['mock_test_id'];?>]" value="c" <?php if(in_array("c", $student_answered_array)) { echo "checked";} ?>>
                                 <label for="option_3_<?=$result['option_3'];?>"><?php echo $result['option_3'];?></label>
                              </div>
                              <div id="option_4" class="rd_option">
                                 <input type="checkbox" class="option" id="option_4_<?php echo $result['option_4'];?>" name="option_1[<?=$result['mock_test_id'];?>]" value="d" <?php if(in_array("d", $student_answered_array)) { echo "checked";} ?>>
                                 <label for="option_4_<?php echo $result['option_4'];?>"><?php echo $result['option_4'];?></label>
                              </div>
                              <?php
                            } else { 
                               if(isset($answered_question['student_answered'])){
                                 if($answered_question['student_answered'] == 'CL') {
                                    $answered_question['student_answered'] = '';
                                  }
                               }
                                      
                              ?>
                            <div id="option_1" class="rd_option">
                                 <input type="text" class="option form-control txt_option txt_option_value_<?php echo $result['mock_test_id'];?>" id="option_1_<?php echo $result['option_1'];?>" name="option_1[<?=$result['mock_test_id'];?>]" value="<?=(isset($answered_question['student_answered'])? isset($answered_question['student_answered']) :'')?>">
                                 <label for="option_1_<?php echo $result['option_1'];?>"></label>
                              </div>
                            <?php } ?>
                              <input type="hidden" id="option_<?php echo $result['mock_test_id']?>">
                              
                              <div class="row" style="margin-top:20px">
                                 <div class="col-lg-12 col-md-12 mb-4 mb-lg-3">
                                    <input type="button" class="review mg-10 mg-10 btn btn-success" value="Mark For Review" onclick="savenxtfn('<?=$result['mock_test_id']?>', '1', '<?=$i?>', '<?=$result['option_type']?>')" />
                                    <button type="button" class="btn mg-10 mg-10 btn-warning" onclick="clearfn(this, '<?=$result['mock_test_id']?>')" >Clear</button>
                                 <!--</div>
                                 <div class="col-lg-3 col-md-3 mb-3 mb-lg-3" style="text-align: right;">-->
                                    <?php if($q== count($question))
                                       {?>

                                    <input type="button" id="btnSubmitNext" class="btn mg-10 btn-primary" onclick="mockpaperSubmit('<?=$result['mock_test_id']?>', '0',  '<?=$i?>', '<?=$result['option_type']?>')" value="Submit">
                                    <?php }else {?>
                                    <button id="btnSave" class="link mg-10 mg-10 btn btn-primary text-right saveNextBtn"  rel="question_<?php echo $result['mock_test_id'];?>" onclick="savenxtfn('<?=$result['mock_test_id']?>', '0',  '<?=$i?>', '<?=$result['option_type']?>')">Save & Next</button>
                                    <?php }?>
                                 </div>
                              </div>
                          </div>
                       <?php 
                          $q++;
                          $i++;
                        } 
                        ?>
                      
                 </form>
                </div>
               <?php  
                }
              }
                  ?>
               <div class="col-lg-4 col-md-6 mb-5 mb-lg-5 mt-4">
                  <!-- Left Nav -->     
                  <div class="Rght_Section column" id="col2">
                     <div id="User_Hldr" onclick="showProfile();">
                        <div class="singleImageDiv">
                           <div class="profile_image">
                              <?php if (is_null($this->session->userdata('CL_STUDENT_PHOTO'))): ?>
                                 <img width="auto" height="150" align="absmiddle" class="candidateImg" src="<?=base_url('assets/cl')?>/images/profile.jpg" />
                              <?php else: ?>
                                 <img width="auto" height="150" align="absmiddle" class="candidateImg" src="<?php echo $this->session->userdata('CL_STUDENT_PHOTO');?>" />
                              <?php endif ?>
                           </div>
                           <div class="profile_details py-1">
                              <div id="Username" class="candOriginalName" title="Vikas"><?php  echo $this->session->userdata('CL_STUDENT_USERNAME');?> </div>
                              <!--<div id="viewProButton"><a id = "VPT" class="viewProfile auditlogButton thickbox" onclick="showModule('profileDiv');activeLink(this.id)">View Profile</a></div>-->
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="collapsebel_panel">
                     <span class="collapse_icon"></span>
                     <div class="diff_type_notation_area_outer">
                        <div class="diff_type_notation_area_inner">
                           <div class="notation_type_description">
                              <div class="notation_typeDiv leftdiv_notation">
                                 <span class="answered answeredCount" id="answered"><?=$ans?></span> <span class="type_title answeredLabel longtext-hide" id="" title="Answered">Answered</span>
                              </div>
                              <div class="notation_typeDiv">
                                 <span class="not_answered notAnsweredCount" id="unanswered">
                                  <?php if($total_attended == 0 || $unans == 0) { $unans = 1; echo $unans;}else{echo $unans;}?>
                                    
                                  </span> <span class="type_title notAnsweredLabel longtext-hide" id="" title="Not Answered">UnAnswered</span>
                              </div>
                              <div class="clear"></div>
                              <div class="notation_typeDiv leftdiv_notation">
                                 <span class="not_visited notVisitedCount" id="notvisited"><?=$notvisited - ($ans+$unans+$markedforreview);?></span> <span class="type_title notVisitedLabel longtext-hide" id="" title="Not Visited">Not Visited</span>
                              </div>
                              <div class="notation_typeDiv MarkForReviewDiv">
                                 <span class="review markedCount" id="markedforreview"><?=$markedforreview?></span> <span class="type_title markedLabel longtext-hide" title="Marked for Review">Marked for Review</span>
                              </div>
                              <div class="clear"></div>
                                 <!-- <div class="notation_typeDiv answered_review_container review_mark" id="" style="display: none;">
                                 <span class="review_marked markedReviewCount" id="">0</span>
                                 <span class="type_title markedAndAnsweredLabel" id="" title="Answered &amp; Marked for Review (will be considered for evaluation)">Answered &amp; Marked for Review (will be considered for evaluation)</span>
                                 </div>
                                 <div class="notation_typeDiv answered_review_container review_answer" id="">
                                 <span class="review_answered markedAnsweredCount" id="">0</span>
                                 <span class="type_title markedAndAnsweredLabel" id="" title="Answered &amp; Marked for Review (will be considered for evaluation)">Answered &amp; Marked for Review (will be considered for evaluation)</span>
                                 </div> -->
                              <div style="clear: both;" class="clear"></div>
                           </div>
                        </div>
                     </div>
                     <div class="rightSectionDiv" id="rightSectionDiv2">
                        <div class="subheader" id="chooseQuestion">Choose a Question</div>
                        <div class="content nano has-scrollbar" id="question_area" style="height: 410px;">
                           <div class="question_area nano-content" tabindex="0" style="right: -17px;">
                              <div class="numberpanelQues">
                                 <div>
                                    <?php if(isset($question) ) { 
                                       if($question) {
                                         $i = 1;
                                         $j = 0;
                                       foreach($question as $result1) {
                                           $answered_question =  $this->mock_model->get_answered_question($exam_id, $student_id, $result1['mock_test_id']);
                                          if($answered_question) {
                                              if($answered_question['is_marked'] == 1){
                                                   $class='review'; 
                                              }else if($answered_question['student_answered'] == 'CL') {
                                                   $class= 'not_answered'; 
                                              }else if($answered_question['student_answered'] != 'CL' ){
                                                   $class='answered'; 
                                              }
                                              
                                          }else{
                                              
                                                $j++;
                                            
                                              $class = 'not_visited';
                                          }
                                          
                                           
                                        ?>
                                    <a href="#"  class="link" id="question_a_<?php echo $result1['mock_test_id'];?>" rel="question_<?php echo $result1['mock_test_id'];?>"><span title="Not Visited" id="0" <?php if($class == 'not_visited' && $j == 1)  { echo 'class="not_answered"';}else { ?>  class="<?=$class?>" <?php } ?> ><?=$i?></span></a>
                                    <?php $i++;} } } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="clear" style="clear: both;"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="ge" class="tab-pane fade in active">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 col-md-6 mb-5 mb-lg-5">
                  <h3> GE</h3>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php
      }  
      ?> 
</div>
<?php }else{ redirect('mockpaper/studenthistorydata/'.$exam_data['exam_id']); } ?>
 <input type="hidden" name="student_id" id="student_id" value="<?= $this->session->userdata('CL_STUDENT_ID');?>">
 <input type="hidden" id="is_written_already" value="<?=$is_exam_written_already?>">
                       <input type="hidden" name="exam_id" id="exam_id" value="<?=$exam_data['exam_id'];?>">
                       <input type="hidden" id="question_count"  name="question_count" value="<?php echo count($question);?>">  

