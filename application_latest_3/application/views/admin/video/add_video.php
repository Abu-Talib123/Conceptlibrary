
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
                <h3 class="card-title"><?=@$sub_title?></h3>
                </div>
                <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/video')?>"><button type="button" class="btn btn-block btn-warning btn-sm"><i class="nav-icon fas fa-book"></i></button></a></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" name="frmVideo" id="addVideo" action="<?php echo base_url();?>admin/video/form_validate_videodata" method="post" enctype="multipart/form-data">
              <?php 
              if($this->session->flashdata('message')!='') {
              echo $this->session->flashdata('message');
              }?>
                <div class="card-body">
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-6">
                      <select  class="form-control" name="category" id="category" onchange="getsubcategory();">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_categorydata) && $fetch_categorydata!='')
                        {
                        $i = 0;
                        foreach($fetch_categorydata as $data)
                        {
                        ?>
                        <option <?php echo (set_value('category')==$data['category_id'])?" selected=' selected'":""?> value="<?php echo $data['category_id']; ?>"><?php echo $data['category_name']; ?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                      <span class="text-danger"><?php echo form_error("category"); ?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">SubCategory</label>
                    <div class="col-sm-6" id="subcatoptiondata">
                      <select  class="form-control" name="subcategory" id="subcategory">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_subcategorydata) && $fetch_subcategorydata!='')
                        {
                        $i = 0;
                        foreach($fetch_subcategorydata as $data)
                        {
                        ?>
                        <option <?php echo (set_value('subcategory')==$data['subcategory_id'])?" selected=' selected'":""?> value="<?php echo $data['subcategory_id']; ?>"><?php echo $data['subcategory_name']; ?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                       <span class="text-danger"><?php echo form_error("subcategory"); ?></span> 
                    </div>
                  </div>
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Video Name</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="text" name="video_name" id="video_name" placeholder="Video Name" value="<?php echo set_value('video_name'); ?>">
                      <span class="text-danger"><?php echo form_error("video_name"); ?></span> 
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Video Description</label>
                    <div class="col-sm-6">
                    <textarea class="form-control"  name="video_description" id="video_description"><?php echo set_value('video_description'); ?></textarea>
                    <span class="text-danger"><?php echo form_error("video_description"); ?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Upload Preview</label>
                    <div class="col-sm-6">
                    <input type="file" class="form-control" id="preview_file"  name="preview_file">
                    <span class="text-danger"><?php echo form_error("preview_file"); ?></span>
                   </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Upload Video</label>
                    <div class="col-sm-6">
                    <input type="file" class="form-control" id="video_file"  name="video_file">
                    <span class="text-danger"><?php echo form_error("video_file"); ?></span>
                   </div>
                  </div>
                  <div class="form-group row" >
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Video Status</label>
                    <div class="col-sm-6">
                    <select class="form-control" name="status" id="status">
                      <option value="1">Paid Course</option>
                      <option value="0">Free</option>
                    </select>
                    <span class="text-danger"><?php echo form_error("status"); ?></span>
                   </div>
                  </div>
                   <div class="form-group row" style="display:none">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Video Price</label>
                    <div class="col-sm-6">
                     <input type="text" class="form-control" id="price"  name="price">
                    <span class="text-danger"><?php echo form_error("price"); ?></span>
                   </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-6">
                    <select class="form-control" name="is_active" id="is_active">
                      <option value="1">Active</option>
                      <option value="0">InActive</option>
                    </select>
                    <span class="text-danger"><?php echo form_error("is_active"); ?></span>
                   </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <input name="insert" type="hidden" value="insert" />
                <div class="card-footer">
                  <button type="reset" class="btn btn-default"> Reset</button>
                  <button type="submit" class="btn btn-info float-right btnVideo" name="insert" value="Insert" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Save</button>
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