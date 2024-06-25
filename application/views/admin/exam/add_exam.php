
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
              <form role="form" name="frmExam" id="frmExam" action="<?php echo base_url();?>admin/exam/form_validation_exam" method="post" enctype="multipart/form-data">
                <?php 
                if($this->session->flashdata('message')!='') {
                echo $this->session->flashdata('message');
                }?>
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
                      <option value="<?php echo $data['category_id']; ?>"><?php echo $data['category_name']; ?> </option>
                      <?php
                      $i++;
                      }
                      }
                      ?>
                    </select>
                    <span class="text-danger"><?php echo form_error("category"); ?></span>
                    
                  </div>
                  <div class="col-md-6" >
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
                        <option value="<?php echo $data['subcategory_id']; ?>"><?php echo $data['subcategory_name']; ?> </option>
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
                      <input type="text" name="exam_name" id="exam_name" class="form-control"  value="<?php echo set_value('exam_name'); ?>" >
                      <span class="text-danger"><?php echo form_error("exam_name"); ?></span>
                    </div>
                    <style>
                        .without_ampm::-webkit-datetime-edit-ampm-field {
                           display: none;
                         }
                         input[type=time]::-webkit-clear-button {
                           -webkit-appearance: none;
                           -moz-appearance: none;
                           -o-appearance: none;
                           -ms-appearance:none;
                           appearance: none;
                           margin: -10px; 
                         }
                    </style>
                    <div class="col-md-6">
                      <label for="inputEmail3" class="col-form-label">Exam Duration</label>
                      <input type="text" name="exam_duration" id="exam_duration" class="form-control without_ampm" value="<?php echo set_value('exam_duration'); ?>" >
                      <span class="text-danger"><?php echo form_error("exam_duration"); ?></span>
                    </div>
                    
                  </div>
                  <div class="row">
                    
                    <div class="col-md-6">
                      <label for="exampleInputPassword1" class="col-form-label"> Preview </label>
                      <input type="file" class="form-control" id="preview_file"  name="preview_file">
                      <span class="text-danger"><?php echo form_error("preview_file"); ?></span>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleInputPassword1" class="col-form-label">Status</label>
                      <select class="form-control" name="is_active" id="is_active">
                      <option value="1">Active</option>
                      <option value="0">InActive</option>
                    </select>
                    <span class="text-danger"><?php echo form_error("is_active"); ?></span>
                    </div>
                    
                  </div>
                   
                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleInputPassword1" class="col-form-label"> Starts On  </label>
                      <input type="text" id="startdate" name="startdate" class="form-control" autocomplete="off" >
                    </div>
                    <div class="col-md-6">
                      <label for="exampleInputPassword1" class="col-form-label"> Expired On  </label>
                      <input type="text" id="enddate" name="enddate" class="form-control" autocomplete="off" >
                    </div>
                  </div>
                <div class="row" >
                   
                    
                    <div class="col-md-6" >
                      <label for="exampleInputPassword1" class="col-form-label"> Exam Status</label>
                      <select class="form-control" name="status" id="status">
                      <option value="1">Paid Course</option>
                      <option value="0">Free</option>
                    </select>
                    <span class="text-danger"><?php echo form_error("status"); ?></span>
                    </div>
                     <div class="col-md-6" style="display: none">
                      <label for="inputEmail3" class="col-form-label">Price</label>
                      <input type="text" name="price" id="price" class="form-control">
                      <span class="text-danger"><?php echo form_error("price"); ?></span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
<input type="hidden" class="btn btn-info float-right" name="insert" value="Insert">
                <div class="card-footer">
                  <button type="reset" class="btn btn-default"> Reset</button>
                    <input type="button" class="btn btn-info float-right" id="btnSave" name="Save" value="Save">   
                    
           
                </div>
              </form>
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
