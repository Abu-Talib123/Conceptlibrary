<?php 
if($search_result)
{
  $i=$startRow + 1;
  foreach($search_result as $result)
  { ?>
    <tr class="exam_data">
      <td><?php echo $i;?></td>
      <td><?php echo  $this->masters_model->category_name($result['category_id']); ?></td>
      <td><?php echo  $this->masters_model->subcategory_name($result['subcategory_id']); ?></td>
      <td><?php echo  $result['exam_name']; ?></td>
      <td><?php echo  $result['exam_duration']; ?></td>
      <td><image src="<?php echo  $result['exam_preview']; ?>" style="height:40px; width:50px;"></td>
      
      
       <td><?php echo $result['start_date']; ?></td>
       <td><?php echo $result['end_date']; ?></td>
      <?php if($result['is_active']== 1){?>
      <td>Active</td>
      <?php } else{?>
      <td>InActive</td>
      <?php }?>
      <td>
      <div class="btn-group btn-group-sm">
      <a href="<?php echo base_url(); ?>admin/exam/update_exam/<?php echo $result['exam_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
      <a href="#" class="btn btn-danger delete_exam" id="<?php echo $result['exam_id']; ?>"><i class="fas fa-trash"></i></a>
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
<td colspan="12" align="center">No Data Found</td>  
</tr>  
<?php  
}  
?> 