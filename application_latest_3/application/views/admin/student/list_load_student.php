<?php 
  if($search_result)
  {
    $i=$startRow + 1;
  foreach($search_result as $result)
  {
  ?>
  <tr class="student_data">
    <td><?php echo $i;?></td>
    <td><a href="<?php echo base_url();?>admin/student/view_more/<?php echo $result['student_id'];?>"><?php echo  $result['student_id']; ?> </a> </td>
    <td><?php echo  $result['username']; ?></td>
    <td><?php echo  $result['email']; ?></td>
    <td><?php echo  $result['mobile']; ?></td>
    <td><?= $this->student_model->get_student_exam_details($result['student_id'])['total_exams'] ?></td>
    <td><?= $this->student_model->get_student_exam_details($result['student_id'])['attended_exams'] ?></td>
    <td><?= $this->student_model->get_student_exam_details($result['student_id'])['not_attended_exams'] ?></td>
    <td><?= $this->masters_model->college_name($result['college_id']);?></td>
    <td><?= $this->masters_model->city_name($result['city_id']);?></td>
    <td><?php echo  $result['pincode']; ?></td>

    <?php if($result['is_active']== 1){?>
    <td>Active</td>
    <?php } else{?>
    <td>InActive</td>
    <?php }?>
    <td>
    <div class="btn-group btn-group-sm">
    <a href="<?php echo base_url();?>admin/student/view_more/<?php echo $result['student_id'];?>">   <i class="fas fa-eye"> </i></a>
    </div>
    </td>     
  </tr>  
<?php 
   $i++;
  }

} 
else  
{  
?>  
    <tr>  
         <td colspan="10" align="center">No Data Found</td>  
    </tr>  
<?php  
}  
?> 