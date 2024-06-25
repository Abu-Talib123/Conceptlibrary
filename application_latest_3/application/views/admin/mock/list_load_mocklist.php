<?php 
if($search_result)
{
  $i=$startRow + 1;
  foreach($search_result as $result)
  { ?>
    <tr class="mock_list_data">
    <td><?php echo $i;?></td>
       <?php if($result['question_type'] != 0){?>
       <td><image src="<?=$result['question'];?>" style="width:200px; height:200px;"/></td>
       <?php  } else { ?><td><?php echo/* htmlspecialchars_decode(*/$result['question']/*)*/;?> </td><?php } ?>
      
       <td><?php echo $result['option_1'];?> </td>
       <td><?php echo $result['option_2'];?> </td>
       <td><?php echo $result['option_3'];?> </td>
       <td><?php echo $result['option_4'];?> </td>
       <td><?php echo $result['correct_answer'];?> </td>
       <?php if($result['solution_type'] != 0){?>
       <td><image src="<?=$result['step'];?>" style="width:200px; height:200px;"/></td>
       <?php  } else { ?><td><?php echo htmlspecialchars_decode($result['step']);?> </td><?php } ?>
      
       <?php if($result['is_active']== 1){?>
       <td>Active</td>
       <?php } else{?>
       <td>InActive</td>
       <?php }?>
      <td><?php echo $result['mark'];?> </td>
      <?php if($result['is_negative']== 1){?>
      <td>Yes</td>
      <?php } else{?>
      <td>No</td>
      <?php }?>
      <td><?php echo $result['negative_mark'];?> </td>
       <td>
       <div class="btn-group btn-group-sm">
       <a href="<?php echo base_url(); ?>admin/mock_test/edit_mocktest/<?php echo $result['mock_test_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
       <a href="#" class="btn btn-danger delete_mocktest" id="<?php echo $result['mock_test_id']; ?>"><i class="fas fa-trash"></i></a>
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