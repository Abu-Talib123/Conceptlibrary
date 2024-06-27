<?php 
  if($search_result)
  {
    $i=$startRow + 1;
  foreach($search_result as $result)
  {
  ?>
  <tr class="blog_data">
    <td><?php echo $i;?></td>
    <td><a href="<?php echo base_url();?>admin/blog/view_more/<?php echo $result['blog_id'];?>"><?php echo  $result['blog_id']; ?> </a> </td>
    <td><?php echo  $result['username']; ?></td>
    <td><?php echo  $result['email']; ?></td>
    <td><?php echo  $result['mobile']; ?></td>
    <td><?= $this->blog_model->get_blog_exam_details($result['blog_id'])['total_exams'] ?></td>
    <td><?= $this->blog_model->get_blog_exam_details($result['blog_id'])['attended_exams'] ?></td>
    <td><?= $this->blog_model->get_blog_exam_details($result['blog_id'])['not_attended_exams'] ?></td>
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
    <a href="<?php echo base_url();?>admin/blog/view_more/<?php echo $result['blog_id'];?>">   <i class="fas fa-eye"> </i></a>
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