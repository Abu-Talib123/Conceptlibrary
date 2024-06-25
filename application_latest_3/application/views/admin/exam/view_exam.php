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
                  <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/exam/add_exam')?>"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></a></h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive">
                  <table class="table table-bordered">
                     <thead>
                         <tr>
                           <th style="width: 10px">S.no</th>
                           <th>Category</th>
                           <th>SubCategory</th>
                           <th>Exam Name</th>
                           <th>Duration</th>
                           <th>Preview</th>
                           <th>StartDate</th>
                           <th>EndDate</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="exam_data">
                        <?php  
                           if($fetch_examdata)  
                           {  
                            $i=1;
                            foreach($fetch_examdata as $row)  
                            {  
                           ?>  
                        <tr>
                           <td><?php echo $i;?></td>
                           <td><?php echo  $this->masters_model->category_name($row['category_id']); ?></td>
                           <td><?php echo  $this->masters_model->subcategory_name($row['subcategory_id']); ?></td>
                           <td><?php echo  $row['exam_name']; ?></td>
                           <td><?php echo  $row['exam_duration']; ?></td>
                           <?php if(isset($row['exam_preview']) && $row['exam_preview'] !=''){?>
                           <td><image src="<?php echo  $row['exam_preview']; ?>" style="height:40px; width:50px;"></td>
                           <?php } else{?>
                           <td> No Preview Available </td><?php }?>
                           
                          
                           <td><?php echo $row['start_date']; ?></td>
                           <td><?php echo $row['end_date']; ?></td>
                           <?php if($row['is_active']== 1){?>
                           <td>Active</td>
                           <?php } else{?>
                           <td>InActive</td>
                           <?php }?>
                           <td>
                           <div class="btn-group btn-group-sm">
                           <a href="<?php echo base_url(); ?>admin/exam/update_exam/<?php echo $row['exam_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                           <a href="#" class="btn btn-danger delete_exam" id="<?php echo $row['exam_id']; ?>"><i class="fas fa-trash"></i></a>
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
               <!-- /.card-body -->
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
<script src="<?=base_url('js/admin/exam.js')?>"></script>