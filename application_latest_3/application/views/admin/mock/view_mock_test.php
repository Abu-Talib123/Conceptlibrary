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
                  <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/mock_test/add_coursemock')?>"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></a></h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th style="width: 10px">S.no</th>
                           <th>Exam Name</th>
                           <th>Category Name</th>
                            <th>SubCategory Name</th>
                           <th>View Questions</th>
                           <th>Status</th>
                           <!-- <th>Action</th> -->
                        </tr>
                     </thead>
                     <tbody id="mock_test_data">
                        <?php  
                           if($fetch_examdata)  
                           {  
                            $i=1;
                            foreach($fetch_examdata as $row)  
                            {
                           ?>  
                        <tr>
                           <td><?php echo $i;?></td>
                           <td><?php echo $row['exam_name'];?> </td>
                           <td><?php echo $row['category_name'];?> </td>
                            <td><?php echo $row['subcategory_name'];?> </td>
                           <td><a href="<?php echo base_url();?>admin/mock_test/list_mock/<?php echo $row['exam_id']; ?>">  View Questions</a></td>
                          
                           <?php if($row['is_active']== 1){?>
                           <td>Active</td>
                           <?php } else{?>
                           <td>InActive</td>
                           <?php }?>
                          
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
<script src="<?=base_url('js/admin/mock_test.js')?>"></script>
