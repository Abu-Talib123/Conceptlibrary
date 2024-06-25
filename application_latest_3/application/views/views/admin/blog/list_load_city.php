    <?php 
    if($search_result)
    {
     $i=$startRow + 1;
    foreach($search_result as $result)
    {
    ?>

    <tr class="city_data">
    <td><?php echo $i;?></td> 
    <td><?php echo $result['city_name']; ?></td>
    <td><?php echo  $this->masters_model->state_name($result['state_id']); ?></td>
    <td><?php echo  $this->masters_model->country_name($result['country_id']); ?></td>
    <?php if($result['is_active']== 1){?>
    <td>Active</td>
    <?php } else{?>
    <td>InActive</td>
    <?php }?>
    <td>
    <div class="btn-group btn-group-sm">
    <a href="<?php echo base_url(); ?>admin/masters/update_citydata/<?php echo $result['city_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
    <a href="#" class="btn btn-danger delete_city" id="<?php echo $result['city_id']; ?>"><i class="fas fa-trash"></i></a>
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
    <td colspan="6" align="center">No Data Found</td>  
    </tr>  
    <?php  
    }  
    ?> 