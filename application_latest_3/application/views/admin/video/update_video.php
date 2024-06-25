
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
                <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/video')?>"><button type="button" class="btn btn-block btn-warning btn-sm"><i class="nav-icon fas fa-book"></i></button></a></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               <?php 
            if(isset($video_data))  
           {  
             // foreach($video_data  as $row)  
              //{  
           ?>  
              <form role="form" name="frmupdateVideo" id="frmupdateVideo" action="<?php echo base_url();?>admin/video/form_validate_videodata" method="post" enctype="multipart/form-data">
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
                        <option <?php if($data['category_id'] == $video_data['category_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['category_id'] ?>"><?php echo $data['category_name']?> </option>
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
                        <option <?php if($data['subcategory_id'] == $video_data['subcategory_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['subcategory_id'] ?>"><?php echo $data['subcategory_name']?> </option>
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
                      <input class="form-control" type="text" name="video_name" id="video_name" placeholder="Video Name" value="<?php echo $video_data['video_name'];?>">
                      <span class="text-danger"><?php echo form_error("video_name"); ?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Video Description</label>
                    <div class="col-sm-6">
                    <textarea class="form-control"  name="video_description" id="video_description"  row="3"><?=$video_data['video_description']?>
                    </textarea>
                    <span class="text-danger"><?php echo form_error("video_description"); ?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Upload Preview</label>
                    <div class="col-sm-6">
                    <input type="file" class="form-control" id="preview_file"  name="preview_file">
                    <span class="text-danger"><?php echo form_error("preview_file"); ?></span>
                     <input type="hidden" class="form-control" id="old_preview_file"  name="old_preview_file" value="<?php echo $video_data['video_preview'];?>">
                   </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Upload Video</label>
                    <div class="col-sm-6">
                    <input type="file" class="form-control" id="video_file"  name="video_file" value="<?php echo $video_data['video_url'];?>">
                    <span class="text-danger"><?php echo form_error("video_file"); ?></span>
                    <input type="hidden" class="form-control" id="old_video_file"  name="old_video_file" value="<?php echo $video_data['video_url'];?>">
                   </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Video Status</label>
                    <div class="col-sm-6">
                    <select class="form-control" name="status" id="status">
                      <option value="1" <?php echo ($video_data['status'] == '1')?'selected':''?>>Paid Course</option>
                      <option value="0" <?php echo ($video_data['status'] == '0')?'selected':''?>>Free</option>
                    </select>
                    <span class="text-danger"><?php echo form_error("status"); ?></span>
                   </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-6">
                    <select class="form-control" name="is_active" id="is_active">
                      <option value="1" <?php echo ($video_data['is_active'] == '1')?'selected':''?>>Active</option>
                      <option value="0" <?php echo ($video_data['is_active'] == '0')?'selected':''?>>Inactive</option>
                    </select>
                    <span class="text-danger"><?php echo form_error("is_active"); ?></span>
                   </div>
                  </div>
                  <div class="form-group row" style="display:none">
                    <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Price</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id="price"  name="price" value="<?php echo $video_data['price'];?>">
                    <span class="text-danger"><?php echo form_error("price"); ?></span>
                   </div>
                  </div>
                  <input type="hidden" name="hidden_id" id="hidden_id"  value="<?=$video_data['video_id']?>"/>
                </div>
                <!-- /.card-body -->
                <input name="update" type="hidden" value="update" />
                <div class="card-footer">
                  <button type="reset" class="btn btn-default"> Reset</button>
                  <button type="submit" class="btn btn-info float-right btnVideo" name="update" value="Update" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Update</button>
                </div>
              </form>
                <?php       
            //}  
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