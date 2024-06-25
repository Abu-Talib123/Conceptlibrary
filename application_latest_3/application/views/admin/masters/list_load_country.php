<?php 
            if($search_result)
            {
              $i=$startRow + 1;
            foreach($search_result as $result)
            {
            ?>
           
          <tr class="country_data">
               <td><?php echo $i; ?></td>  
                <td><?php echo $result['country_name']; ?></td>
                <td><?php echo $result['short_code']; ?></td>
                <?php if($result['is_active']== 1){?>
                  <td>Active</td>
                  <?php } else{?>
                  <td>InActive</td>
                  <?php }?>
                <td>
                  <div class="btn-group btn-group-sm">
                    <a href="<?php echo base_url(); ?>admin/masters/update_countrydata/<?php echo $result['country_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn btn-danger delete_country" id="<?php echo $result['country_id']; ?>"><i class="fas fa-trash"></i></a>
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