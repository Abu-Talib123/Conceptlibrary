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
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive">
                  <table class="table table-bordered">
                     <thead>
                         <tr>
                           <th style="width: 10px">S.no</th>
                           <th>Payment Id</th>
                           <th>SubCategory</th>
                           <th>Student Id</th>
                           <th>Material Type</th>
                           <th>Price</th>
                           <th>Razor Id</th>
                           <th>PaymentDate</th>
                        </tr>
                     </thead>
                     <tbody id="payment_data">
                        <?php  
                           if($fetch_paymentdata)  
                           {  
                            $i=1;
                            foreach($fetch_paymentdata as $row)  
                            {  
                           ?>  
                        <tr>
                           <td><?php echo $i;?></td>
                           <td><?php echo  $row['payment_id']; ?></td>
                           <td><?php echo  $this->Common_model->subcategory_name($row['material_id']); ?></td>
                           <td><a href="<?php echo base_url();?>admin/student/view_more/<?php echo $row['student_id'];?>"><?= $row['student_id']?></a></td>
                           <?php if($row['material_type']== 'all')
                           {?>
                           <td>Video,Mock</td>
                          <?php  } else{?>
                           <td>Mock</td>
                           <?php }?>
                           <td><?php echo  $row['price']; ?></td>
                           <td><?php echo  $row['razor_payment_id']; ?></td>
                           <td><?php echo  $row['payment_date']; ?></td>
                        </tr>
                        <?php
                           $i++;       
                           }  
                           }  
                           else  
                           {  
                           ?>  
                        <tr>
                           <td colspan="8" align="center">No Data Found</td>
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
<script src="<?=base_url('js/admin/payment.js')?>"></script>