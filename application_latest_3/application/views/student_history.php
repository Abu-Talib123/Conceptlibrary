<div class="site-mobile-menu site-navbar-target">
   <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
         <span class="icon-close2 js-menu-toggle"></span>
      </div>
   </div>
   <div class="site-mobile-menu-body"></div>
</div>
<style>
    .custom-breadcrumns a:not(.solution_container a) {
        color:#FFF !important;
    }
</style>
<div class="site-section" id="mocksection"  style="margin-top:20px" >
<?php 
$exam_count = $this->mock_model->get_exam_count($exam_id);
   if(isset($studenthistorydata))  
   { 
   ?> 
<!-- Menu  -->
<div class="custom-breadcrumns border-bottom" id="breadcrumb">
   <div class="container">
    <div class="row">
      <div class="col-lg-10 col-md-10 ">
      <ul class="nav nav-pills">
         <li class="active"><a data-toggle="pill" href="#<?php echo $exam_name;?>
            "><?php echo $exam_name;?></a>
         </li>
      </ul>
    </div>
    <div class="col-lg-2 col-md-2 ">
      <a href="javascript:history.back()" class="btn btn-primary  btn-lg px-5">Back</a>
    </div>
   </div>
</div>
<div class="container" id="container1">
   <div class="row">
      <!--<div class="col-lg-6 col-md-6" style="margin-bottom: 20px">-->
      <!--   <h4>Question Type: MCQ</h4>-->
      <!--</div>-->
   </div>
</div>
<div class="tab-content" id="tab-content" >
   <!-- Tab 1  -->
   <div id="<?php echo $exam_name;?>" class="tab-pane fade in active show">
      <div class="container">
         <div class="row">
                 <?php
                 
$checkanswerdata = $this->mock_model->checkanswer($exam_id,$student_id);

if(isset($checkanswerdata))  
{ 
    $total_mark = 0;
  $right_answer  = 0;
  $wrong_answer  = 0;
  $unanswered    = $total_sum_mark = $negative_mark = $positive_mark = 0;
  $count        =   $exam_count;
  $i = 0;
  foreach($checkanswerdata as $result1)
  {
      $ans = $this->db->get_where('mock_test', array('mock_test_id' =>$result1['mock_test_id'], 'exam_id' => $exam_id));
      $total_ans = $ans->row_array();
      $correct_answer   = explode(',',$result1['correct_answer']);
      $correct_answer_str = $result1['correct_answer'];
      $student_answered = $result1['student_answered'];
      $total_sum_mark = $total_sum_mark + $total_ans['mark'];
      if(( (isset($correct_answer[0]) && isset($correct_answer[1]) && !isset($correct_answer[2]) && !isset($correct_answer[3])) && ((float)$student_answered >= $correct_answer[0] && (float)$student_answered <= $correct_answer[1] ) && is_numeric($student_answered) ) || ( isset($correct_answer[0]) && $student_answered == $correct_answer) || (is_array($correct_answer) && $student_answered == $correct_answer_str)) 
      {
       $right_answer= $right_answer+1;
       $total_mark = $total_mark + $total_ans['mark'];
       $positive_mark = $positive_mark+ $total_ans['mark'];
      }else if($student_answered == '')
      {
         $unanswered = $unanswered+1;
      }
      else if($correct_answer <> $student_answered)
      {
         $wrong_answer = $wrong_answer+1;
         $total_mark = $total_mark - $total_ans['negative_mark'];
         $negative_mark = $negative_mark + $total_ans['negative_mark'];
      }
  }
  //echo 'negative_mark:'.$negative_mark;
  //echo 'positive_mark:'.$positive_mark;
  
//  if($wrong_answer > 0) {
//      $total_mark = $total_mark - ($wrong_answer/3);
//      $total_mark = number_format((float)$total_mark, 2, '.', '');
//  }
  
  $total_students = $this->mock_model->total_students($exam_id);
  $overall_text = '';
  
  if($total_mark > 0){
       $overall_percentage = round(($total_mark/$total_sum_mark)*95.5);
      $overall_text = "You are better than $overall_percentage% students";
  }else{
      $overall_text = 'Sorry , we are expecting positive marks to declare your overall position';
  } 
//  if($total_students > 0) {
//      if($overallrankdata > 0) {
//          $overall_percentage = round(100 - (($overallrankdata/$total_students)*100));
//          $overall_text = "You are better than $overall_percentage% students";
//      }else{
//           $overall_text = 'Sorry , we are expecting positive marks to declare your overall position';
//      }
//  }
}?>

<div id="content">
                <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr style="background: #01bf1d;color: #FFF;">
                    <th style="text-align: center">Total Questions </th>
                    <th style="text-align: center" >Attempted</th>
                    <th style="text-align: center" > Correct Answer </th>
                    <th style="text-align: center"> Wrong Answer</th>
                    <th style="text-align: center"> UnAttempted</th>
                    <th style="text-align: center"> TotalScore  </th>
                    <th style="text-align: center"> Overall Position </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr style="background:#000;color:#FFF;">
                            <td style="text-align: center;"><?=$count?></td>
                            <td class ="text-primary" style="text-align: center;"><b><?=$right_answer+$wrong_answer?></b></td>
                            <td class ="text-success" style="text-align: center"><b><?=$right_answer?></b></td>
                            <td class ="text-danger" style="text-align: center"><b><?=$wrong_answer?></b></td>
                            <td class ="text-warning" style="text-align: center"><b><?=$exam_count - ($right_answer+$wrong_answer)?></b></td>
                            <td class="text-info" style="text-align: center"><b><?=$total_mark?></b></td>
                            <td class="text-warning" style="text-align: center;color:ffeb3b;"><b><?=$overall_text?></b></td>
                        </tr>
                    </tbody>
                </table>
        </div>
        </div>
        <?php
        
                  $question=1;          
                  foreach($studenthistorydata as $result)
                  { 
                    ?>
                    <div class="col-sm-12" style="border-bottom: 1px solid #ccc">
                     
                    <div class="col-md-12" >
                        <p><span style="float:right;font-weight:bold"><span style="color:green">Marks for correct answer: <?=$result['mark']?> </span>| <span style="color:red">Negative Marks: <?=$result['negative_mark']?> </span></span></p>
                        <h5 style="display: inline-flex;color:#9c27b0;"><?php echo $question.'. '.htmlspecialchars_decode($result['question']);?></h5>
                        
                        </div>
                     <input type="hidden" id="question_id"  name="question_id[]" value="<?php echo $result['mock_test_id'];?>">

                      <div class="col-sm-12" style="border-bottom: 1px solid #ccc">

                      <?php if($result['option_type'] == 0)
                      {?>
                        <div id="option_1">
                          <input type="radio" id="option" name="option_1[<?php echo $result['mock_test_id'];?>]" value="<?=$result['option_1']?>" <?php if($result['student_answered'] == 'a') { echo "checked";} ?>>
                          <label><?php echo $result['option_1'];?></label>
                        </div>
                        <div id="option_2">
                          <input type="radio" id="option" name="option_1[<?php echo $result['mock_test_id'];?>]" value="<?php echo $result['option_2'];?>" <?php if($result['student_answered'] == 'b') { echo "checked";} ?>>
                          <label><?php echo $result['option_2'];?></label>
                        </div>
                        <div id="option_3">
                          <input type="radio" id="option" name="option_1[<?php echo $result['mock_test_id'];?>]" value="<?php echo $result['option_3'];?>" <?php if($result['student_answered'] == 'c') { echo "checked";} ?>>
                          <label><?php echo $result['option_3'];?></label>
                        </div>
                        <div id="option_4">
                          <input type="radio" id="option" name="option_1[<?php echo $result['mock_test_id'];?>]" value="<?php echo $result['option_4'];?>" <?php if($result['student_answered'] == 'd') { echo "checked";} ?> >
                          <label><?php echo $result['option_4'];?></label>
                        </div>

                      <div>
                        <h5 style="color:#51be78"> Correct Answer: Option&nbsp;<?php echo $result['correct_answer'];?></h5>
                        <?php if($result['student_answered'] =='0')
                        {?>
                        <h5 style="color:#17a2b8"> Your Answer: </h5>
                      <?php } else{?>
                         <h5 style="color:#17a2b8"> Your Answer: Option&nbsp;<?php echo $result['student_answered'];?></h5>
                         <?php  } ?>
                      </div>
                    <?php } else if($result['option_type'] == 2){
                        $correct_answer_array = explode(",", $result['student_answered']);
                      ?>
                      <div id="option_1">
                          <input type="checkbox" id="option" name="option_1[<?php echo $result['mock_test_id'];?>]" value="<?=$result['option_1']?>" <?php if(in_array("a", $correct_answer_array)) { echo "checked";} ?>>
                          <label><?php echo $result['option_1'];?></label>
                        </div>
                        <div id="option_2">
                          <input type="checkbox" id="option" name="option_1[<?php echo $result['mock_test_id'];?>]" value="<?php echo $result['option_2'];?>" <?php if(in_array("b", $correct_answer_array)) { echo "checked";} ?>>
                          <label><?php echo $result['option_2'];?></label>
                        </div>
                        <div id="option_3">
                          <input type="checkbox" id="option" name="option_1[<?php echo $result['mock_test_id'];?>]" value="<?php echo $result['option_3'];?>" <?php if(in_array("c", $correct_answer_array)) { echo "checked";} ?>>
                          <label><?php echo $result['option_3'];?></label>
                        </div>
                        <div id="option_4">
                          <input type="checkbox" id="option" name="option_1[<?php echo $result['mock_test_id'];?>]" value="<?php echo $result['option_4'];?>" <?php if(in_array("d", $correct_answer_array)) { echo "checked";} ?> >
                          <label><?php echo $result['option_4'];?></label>
                        </div>

                      <div>
                        <h5 style="color:#51be78"> Correct Answer: Option&nbsp;<?php echo $result['correct_answer'];?></h5>
                        <?php if($result['student_answered'] =='0')
                        {?>
                        <h5 style="color:#17a2b8"> Your Answer: </h5>
                      <?php } else{?>
                         <h5 style="color:#17a2b8"> Your Answer: Option&nbsp;<?php echo $result['student_answered'];?></h5>
                         <?php  } ?>
                      </div>
                    <?php } else{?>
                       <h5 style="color:#51be78"> Correct Answer: &nbsp;<?php echo $result['correct_answer'];?></h5>
                       <h5 style="color:#17a2b8"> Your Answer is: &nbsp;<?php echo $result['student_answered'];?></h5>
                     <?php }?>

                      <?php if($result['solution_type'] == 1){?>
                     <div>
                      <h5>Explanation:</h5><image src="<?=$result['step'];?>" style="width:250px; height:250px;"></image>
                     </div>
                      <?php } else{?>
                      <div class="solution_container">
                          <h5>Explanation:</h5>
                          <div style="color: #2196f3;"><b><?php echo $result['step'];?></b></div>
                      </div>
                      <?php }?>
                      </div>
                   </div>
                  

                  
                  <?php 
                     $question++;
                     }?>
                      
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