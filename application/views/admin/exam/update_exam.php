
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <div class="col-md-6">
                <h3 class="card-title"><?=$sub_title?></h3>
                </div>
                <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/mock_test')?>"><button type="button" class="btn btn-block btn-warning btn-sm"><i class="nav-icon fas fa-book"></i></button></a></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <?php 
            if(isset($exam_data))  
            {  
            foreach($exam_data  as $row)  
            {  
            ?>  
              <form role="form" name="frmExam" id="frmExam" action="<?php echo base_url();?>admin/exam/form_validation_exam" method="post" enctype="multipart/form-data">
                <div class="card-body">
                 <div class="row">
                  <div class="col-md-6">
                  <label for="inputEmail3" class="col-form-label">Category</label>
                    <select  class="form-control" name="category" id="category" onchange="getsubcategory();">
                      <option value="">Select</option>
                      <?php
                      if(isset($fetch_categorydata) && $fetch_categorydata!='')
                      {
                      $i = 0;
                      foreach($fetch_categorydata as $data)
                      {
                      ?>
                      <option <?php if($data['category_id'] == $row['category_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['category_id'] ?>"><?php echo $data['category_name']?> </option>
                      <?php
                      $i++;
                      }
                      }
                      ?>
                    </select>
                    <span class="text-danger"><?php echo form_error("category"); ?></span>
                    
                  </div>
                  <div class="col-md-6">
                  <label for="inputEmail3" class="col-form-label">SubCategory</label>
                  <div id="subcatoptiondata">
                      <select  class="form-control" name="subcategory" id="subcategory">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_subcategorydata) && $fetch_subcategorydata!='')
                        {
                        $i = 0;
                        foreach($fetch_subcategorydata as $data)
                        {
                        ?>
                        <option <?php if($data['subcategory_id'] == $row['subcategory_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['subcategory_id'] ?>"><?php echo $data['subcategory_name']?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                      <span class="text-danger"><?php echo form_error("subcategory"); ?></span>
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="inputEmail3" class="col-form-label">Exam Name</label>
                      <input type="text" name="exam_name" id="exam_name" value="<?= $row['exam_name']?>" class="form-control" >
                      <span class="text-danger"><?php echo form_error("exam_name"); ?></span>
                    </div>
                    <div class="col-md-6">
                      <label for="inputEmail3" class="col-form-label">Exam Duration</label>
                      <input type="text" name="exam_duration" id="exam_duration" value="<?= $row['exam_duration']?>" class="form-control">
                      <span class="text-danger"><?php echo form_error("exam_duration"); ?></span>
                    </div>                    
                  </div>
                  <div class="row" >
                    
                    <div class="col-md-6">
                      <label for="exampleInputPassword1" class="col-form-label">Status</label>
                      <select class="form-control" name="is_active" id="is_active">
                        <option value="1" <?php echo ($row['is_active'] == '1')?'selected':''?>>Active</option>
                        <option value="0" <?php echo ($row['is_active'] == '0')?'selected':''?>>Inactive</option>
                      </select>
                      <span class="text-danger"><?php echo form_error("is_active"); ?></span>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="col-form-label"> Preview </label>
                        <input type="file" class="form-control" id="preview_file"  name="preview_file">
                        <span class="text-danger"><?php echo form_error("preview_file"); ?></span>
                        <input type="hidden" name="old_preview_file" id="old_preview_file" value="<?php echo $row['exam_preview'];?>"/>
                      </div>
                   </div> 
                    
                     <div class="row">
                    <div class="col-md-6">
                      <label for="exampleInputPassword1" class="col-form-label"> Starts On  </label>
                      <input type="text" id="startdate" name="startdate" value="<?= $row['start_date']?>" class="form-control" autocomplete="off" >
                    </div>
                    <div class="col-md-6">
                      <label for="exampleInputPassword1" class="col-form-label"> Expired On  </label>
                      <input type="text" id="enddate" name="enddate" value="<?= $row['end_date']?>" class="form-control" autocomplete="off" >
                    </div>
                  </div>
                    <div class="row" >
                      <div class="col-md-6" >
                      <label for="exampleInputPassword1" class="col-form-label"> Exam Status</label>
                      <select class="form-control" name="status" id="status">
                        <option value="1" <?php echo ($row['status'] == '1')?'selected':''?>>Paid Course</option>
                        <option value="0" <?php echo ($row['status'] == '0')?'selected':''?>>Free</option>
                    </select>
                    <span class="text-danger"><?php echo form_error("status"); ?></span>
                    </div>
                       <div class="col-md-6" style="display:none">
                      <label for="exampleInputPassword1" class="col-form-label">Price</label>
                       <input type="text" name="price" id="price" value="<?= $row['price']?>" class="form-control" autocomplete="off" >
                      <span class="text-danger"><?php echo form_error("price"); ?></span>
                      </div>
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $row['exam_id'];?>"/>
                  </div>
                  <input name="update" type="hidden" value="update" />
                   <div class="card-footer">
                  <a href="<?=base_url('admin/exam')?>" class="btn btn-default"> Clear</a>
                  <button type="submit" class="btn btn-info float-right">Update</button>
                </div>
                </div>
                <!-- /.card-body -->

               
              </form>
            <?php       
            }  
            }  ?>
            </div>
            <!-- /.card -->
          </div>
          
          <!--/.col (left) -->
          <!-- right column -->
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
 <!-- <script src="<?=base_url('js/admin/video.js')?>"></script>  -->
