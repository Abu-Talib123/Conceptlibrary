<?php 
if($search_result)
{
  $i=$startRow + 1;
  foreach($search_result as $result)
  { ?>
    <tr class="mock_test_data">
      <td><?php echo $i;?></td>
      <td><?php echo $result['exam_name'];?> </td>
       <td><?php echo $result['category_name'];?> </td>
      <td><?php echo $result['subcategory_name'];?> </td>
      <td><a href="<?php echo base_url();?>admin/mock_test/list_mock/<?php echo $result['exam_id']; ?>">  View Questions</a></td>

      <?php if($result['is_active']== 1){?>
      <td>Active</td>
      <?php } else{?>
      <td>InActive</td>
      <?php }?>
      <td>
      <div class="btn-group btn-group-sm">
      <!--  <a href="<?php echo base_url(); ?>admin/mock_test/update_mockcourse/<?php echo $result['mock_test_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
      <a href="#" class="btn btn-danger delete_mocktest" id="<?php echo $result['mock_test_id']; ?>"><i class="fas fa-trash"></i></a> -->
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
<td colspan="5" align="center">No Data Found</td>  
</tr>  
<?php  
}  
?> 