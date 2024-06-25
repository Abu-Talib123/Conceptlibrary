<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-info">
               <div class="card-header">
                  <div class="col-md-6">
                     <h3 class="card-title"><?=$sub_title?></h3>
                  </div>
                  <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/video/add_coursevideo')?>"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></a></h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th style="width: 10px">S.no</th>
                           <th>Category</th>
                           <th>SubCategory</th>
                           <th>Video Name</th>
                           <th>Video Description</th>
                           <th>Image Preview</th>
                           <th>Video</th>
                           <th>Free/Paid</th>
                           <th>Video Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="video_data">
                        <?php  
                           if($fetch_videodata)  
                           {  
                            $i=1;
                            foreach($fetch_videodata as $row)  
                            {  
                           ?>  
                        <tr>
                           <td><?php echo  $i;?></td>
                           <td><?php echo  $this->masters_model->category_name($row['category_id']); ?></td>
                           <td><?php echo  $this->masters_model->subcategory_name($row['subcategory_id']); ?></td>
                           <td><?php echo  $row['video_name']; ?></td>
                           <td><?php echo  $row['video_description']; ?></td>
                           <?php if(isset($row['video_preview']) && $row['video_preview'] !=''){?>
                           <td><image src="<?php echo  $row['video_preview']; ?>" style="height:40px; width:50px;"></td>
                           <?php } else{?>
                           <td> No Preview Available </td><?php }?>
                           <?php if(isset($row['video_url']) && $row['video_url'] !=''){?>
                           <td>
                               <video controls style="height:40px; width:50px;">
  <source src="<?php echo  $row['video_url']; ?>" type="video/mp4">
</video>
</td>
                           <?php } else{?>
                              <td> No Video Available </td><?php }?>
                           
                           <?php if($row['status']== 1){?>
                           <td>Paid Course</td>
                           <?php } else{?>
                           <td>Free</td>
                           <?php }?>
                           <?php if($row['is_active']== 1){?>
                           <td>Active</td>
                           <?php } else{?>
                           <td>InActive</td>
                           <?php }?>
                           <td>
                           <div class="btn-group btn-group-sm">
                           <a href="<?php echo base_url(); ?>admin/video/update_coursevideo/<?php echo $row['video_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                           <a href="javascript:void(0)" class="btn btn-danger delete_video" id="<?php echo $row['video_id']; ?>" onclick="delete_video('<?php echo $row['video_id']; ?>')"><i class="fas fa-trash"></i></a>
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
                     </tbody>
                  </table>
               </div>
              <div class="card-footer">
                  <div id="pagination" class="pagination">
                     <div  class="paging">
                     <?php echo $pagination ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
<script src="<?=base_url('js/admin/video.js')?>"></script>