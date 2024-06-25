<?php 
            if($search_result)
            {
             $i=$startRow + 1;
            foreach($search_result as $result)
            {
            ?>
           
          <tr class="category_data">
                   <td><?php echo $i;?></td>  
                    <td><?php echo $result['category_name']; ?></td>
                    <?php if($result['is_active']== 1){?>
                      <td>Active</td>
                      <?php } else{?>
                      <td>InActive</td>
                      <?php }?>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="<?php echo base_url(); ?>admin/masters/update_categorydata/<?php echo $result['category_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger delete_category" id="<?php echo $result['category_id']; ?>"><i class="fas fa-trash"></i></a>
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
                           <td colspan="4" align="center">No Data Found</td>  
                      </tr>  
                 <?php  
                 }  
                 ?>