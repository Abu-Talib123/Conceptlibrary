<?php 
if($search_result)
{
  $i=$startRow + 1;
  foreach($search_result as $result)
  { ?>
    <tr class="payment_data">
    
     <td><?php echo $i;?></td>
     <td><?php echo  $result['payment_id']; ?></td>
     <td><?php echo  $this->Common_model->subcategory_name($result['material_id']); ?></td>
     <td><a href="<?php echo base_url();?>admin/student/view_more/<?php echo $result['student_id'];?>"><?= $result['student_id']?></a></td>
     <?php if($result['material_type']== 'all')
     {?>
     <td>Video,Mock</td>
    <?php  } else{?>
     <td>Mock</td>
     <?php }?>
     <td><?php echo  $result['price']; ?></td>
     <td><?php echo  $result['razor_payment_id']; ?></td>
     <td><?php echo  $result['payment_date']; ?></td>
  </tr>
  <?php
     $i++;       
     }  
     }  
     else  
     {  
     ?>  
<tr>  
<td colspan="8" align="center">No Data Found</td>  
</tr>  
<?php  
}  
?> 