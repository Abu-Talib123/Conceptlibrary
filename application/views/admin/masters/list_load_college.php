    <?php 
    if($search_result)
    {
    $i=$startRow + 1;
    foreach($search_result as $result)
    {
    ?>

    <tr class="college_data">
    <td><?php echo $i;?></td> 
    <td><?php echo  $this->masters_model->university_name($result['university_id']); ?></td> 
    <td><?php echo $result['college_name']; ?></td>
    <?php if($result['is_active']== 1){?>
    <td>Active</td>
    <?php } else{?>
    <td>InActive</td>
    <?php }?>
    <td>
    <div class="btn-group btn-group-sm">
    <a href="<?php echo base_url(); ?>admin/masters/update_collegedata/<?php echo $result['college_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
    <a href="#" class="btn btn-danger delete_college" id="<?php echo $result['college_id']; ?>"><i class="fas fa-trash"></i></a>
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