<!-- Main content -->
<section class="content">
   <!-- Default box -->
   <div class="card">
      <div class="card-header">
         <h3 class="card-title"><?=$sub_title?></h3>
         <div class="card-tools">
            <a href="javascript:history.back()" class="btn btn-info">Back</a>
         </div>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-12 col-md-12">
               <div class="row">
                  <div class="col-12">
                <?php  
                     if($fetch_mockdata)  
                     {  
                      $i=1;
                      foreach($fetch_mockdata as $row)  
                      {  
                     ?>  
                     <div class="post">
                        <!-- /.user-block -->
                        <div class="form-group row">
                          <p><?php echo $i ;?></p>
                          <p>)</p>
                           <p><?php echo $row['question'];?></p>
                         </div>
                         <div class="form-group row">
                          <div class="col-md-3">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" disabled="">
                            <label class="form-check-label"><?php echo $row['option_1'];?></label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" disabled="">
                            <label class="form-check-label"><?php echo $row['option_2'];?></label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" disabled="">
                              <label class="form-check-label"><?php echo $row['option_3'];?></label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" disabled="">
                              <label class="form-check-label"><?php echo $row['option_4'];?></label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                         <label for="inputEmail3" class="col-sm-2 col-form-label">Correct Answer:<?php echo $row['correct_answer'];?></label>
                       </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Step:<?php echo $row['step'];?></label>
                        </div>
                     </div>
                      <?php
                        $i++;       
                        }  
                      } else  
                        {  
                        ?> 
                            <div class="post">
                            <p>No data Found</p>
                              
                     <?php  
                      }  
                      ?> 
                  </div>
               </div>
            </div>
           
         </div>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</section>