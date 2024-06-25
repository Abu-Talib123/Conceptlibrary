
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
               <div class="card-body table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th style="width: 10px">S.no</th>
                           <th>Question</th>
                           <th>Option1</th>
                           <th>Option2</th>
                           <th>Option3</th>
                           <th>Option4</th>
                           <th>Correct Answer</th>
                           <th>Solution</th>
                           <th>Status</th>
                           <th>Marks</th>
                           <th>IsNegative</th>
                           <th>Negative mark</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="mock_list_data">
                        <?php  
                           if($fetch_mockdata)  
                           {  
                            $i=1;
                            foreach($fetch_mockdata as $row)  
                            {  
                              
                           ?>  
                        <tr>
                           <td><?php echo $i;?></td>
                           <?php if($row['question_type'] != 0){?>
                           <td><image src="<?=$row['question'];?>" style="width:200px; height:200px;"/></td>
                           <?php  } else { ?><td><?php echo/* htmlspecialchars_decode(*/$row['question']/*)*/;?> </td><?php } ?>
                          
                           <td><?php echo $row['option_1'];?> </td>
                           <td><?php echo $row['option_2'];?> </td>
                           <td><?php echo $row['option_3'];?> </td>
                           <td><?php echo $row['option_4'];?> </td>
                           <td><?php echo $row['correct_answer'];?> </td>
                           <?php if($row['solution_type'] != 0){?>
                           <td><image src="<?=$row['step'];?>" style="width:200px; height:200px;"/></td>
                           <?php  } else { ?><td><?php echo htmlspecialchars_decode($row['step']);?> </td><?php } ?>
                          
                           <?php if($row['is_active']== 1){?>
                           <td>Active</td>
                           <?php } else{?>
                           <td>InActive</td>
                           <?php }?>
                           <td><?php echo $row['mark'];?> </td>
                           <?php if($row['is_negative']== 1){?>
                           <td>Yes</td>
                           <?php } else{?>
                           <td>No</td>
                           <?php }?>
                           <td><?php echo $row['negative_mark'];?> </td>
                           <td>

                           <div class="btn-group btn-group-sm">
                           <a href="<?php echo base_url(); ?>admin/mock_test/edit_mocktest/<?php echo $row['mock_test_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                           <a href="#" class="btn btn-danger delete_mocktest" id="<?php echo $row['mock_test_id']; ?>"><i class="fas fa-trash"></i></a>
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


                      </script>