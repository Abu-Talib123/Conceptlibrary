<?php 
            if($search_result)
            {
             $i=$startRow + 1;
            foreach($search_result as $result)
            {
            ?>
           
          <tr class="video_data">
              <td><?php echo  $i;?></td>
               <td><?php echo  $this->masters_model->category_name($result['category_id']); ?></td>
               <td><?php echo  $this->masters_model->subcategory_name($result['subcategory_id']); ?></td>
               <td><?php echo  $result['video_name']; ?></td>
               <td><?php echo  $result['video_description']; ?></td>
               <?php if(isset($result['video_preview']) && $result['video_preview'] !=''){?>
                           <td><image src="<?php echo  $result['video_preview']; ?>" style="height:40px; width:50px;"></td>
                           <?php } else{?>
                           <td> No Preview Available </td><?php }?>
                           <?php if(isset($result['video_url']) && $result['video_url'] !=''){?>
                           <td>  <video controls style="height:40px; width:50px;">
  <source src="<?php echo  $result['video_url']; ?>" type="video/mp4">
</video>
</td>
                           <?php } else{?>
                              <td> No Video Available </td><?php }?>
               <?php if($result['status']== 1){?>
                           <td>Paid Course</td>
                           <?php } else{?>
                           <td>Free</td>
                           <?php }?>
              
               <?php if($result['is_active']== 1){?>
               <td>Active</td>
               <?php } else{?>
               <td>InActive</td>
               <?php }?>
               <td>
               <div class="btn-group btn-group-sm">
               <a href="<?php echo base_url(); ?>admin/video/update_coursevideo/<?php echo $result['video_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
               <a href="#" class="btn btn-danger delete_video1" id="<?php echo $result['video_id']; ?>" onclick="delete_video('<?php echo $row['video_id']; ?>')"><i class="fas fa-trash"></i></a>
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