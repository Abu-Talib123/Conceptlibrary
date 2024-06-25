
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-5">
            <form class="form-horizontal" action="<?php echo base_url()?>admin/masters/form_validation_college"   method="post">
          <?php 
           if($this->session->flashdata('message')!='') {
             echo $this->session->flashdata('message');
           }
           if($this->uri->segment(3) == "college_inserted")  
           {  
           
                echo '<p class="text-success" align="center" style="color:#2de470;">College Data Inserted</p>';  
           }  
           if($this->uri->segment(3) == "college_updated")  
           {  
                echo '<p class="text-success" align="center" style="color:#2de470;"> College Data Updated</p>';  
           }  
           ?> 
           <?php 
            if(isset($college_data))  
           {  
              foreach($college_data  as $row)  
              {  
           ?>  
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?=$menu2?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">University</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="university" id="category">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_universitydata) && $fetch_universitydata!='')
                        {
                        $i = 0;
                        foreach($fetch_universitydata as $data)
                        {
                        ?>
                        <option <?php if($data['university_id'] == $row['university_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['university_id'] ?>"><?php echo $data['university_name']?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                      <span class="text-danger"><?php echo form_error("university"); ?></span> 
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label"> College Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="college_name"  name="college_name" placeholder="College Name" value="<?php echo $row['college_name'];?>">
                      <span class="text-danger"><?php echo form_error("college_name"); ?></span> 
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="is_active" id="is_active">
                       <option value="1" <?php echo ($row['is_active'] == '1')?'selected':''?>>Active</option>
                       <option value="0" <?php echo ($row['is_active'] == '0')?'selected':''?>>InActive</option>
                      </select>
                      <span class="text-danger"><?php echo form_error("is_active"); ?></span> 
                    </div>
                  </div>
                   <input type="hidden" name="hidden_id" value="<?php echo $row['college_id']; ?>" />
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?=base_url('admin/masters/view_college')?>" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-info float-right"  name="update" value="Update">Update</button>
                </div>
                <!-- /.card-footer -->
              
            </div>
            <?php       
            }  
           } else{ ?>
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?=$menu1?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">University </label>
                    <div class="col-sm-9">
                      <select class="form-control" name="university" id="university">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_universitydata) && $fetch_universitydata!='')
                        {
                        $i = 0;
                        foreach($fetch_universitydata as $data)
                        {
                        ?>
                        <option value="<?php echo $data['university_id']; ?>"><?php echo $data['university_name']; ?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                      <span class="text-danger"><?php echo form_error("university"); ?></span> 
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label"> College Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="college_name"  name="college_name" placeholder="College Name">
                      <span class="text-danger"><?php echo form_error("college_name"); ?></span> 
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="is_active" id="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                      <span class="text-danger"><?php echo form_error("is_active"); ?></span> 
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="reset" class="btn btn-default"> Reset</button>
                  <button type="submit" class="btn btn-info float-right" name="insert" value="Insert">Save</button>
                </div>
                <!-- /.card-footer -->
              
            </div>
             <?php }?>
            </form>
            <!-- /.card -->
          </div>
          <div class="col-md-7">
            <!-- general form elements disabled -->
            <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title"><?=$menu3?></h3>
                <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/masters/view_college')?>"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table  class="table table-bordered table-striped">
                <thead>
                 <tr>
                    <th>S.no</th>
                    <th>University Name</th>
                    <th>College Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="college_data">
                 <?php  
                 if($fetch_collegedata)  
                 {  
                      $i=1;
                      foreach($fetch_collegedata as $row)  
                      {  
                 ?>  
                  <tr>
                    <td><?php echo $i; ?></td> 
                    <td><?php echo  $this->masters_model->university_name($row['university_id']); ?></td> 
                    <td><?php echo $row['college_name']; ?></td>
                     <?php if($row['is_active']== 1){?>
                      <td>Active</td>
                      <?php } else{?>
                      <td>InActive</td>
                      <?php }?>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="<?php echo base_url(); ?>admin/masters/update_collegedata/<?php echo $row['college_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger delete_college" id="<?php echo $row['college_id']; ?>"><i class="fas fa-trash"></i></a>
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
                           <td colspan="5" align="center">No Data Found</td>  
                      </tr>  
                 <?php  
                 }  
                 ?> 
                </tbody>
               
              </table>
            </div>
            <!-- /.card-body -->
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  <script src="<?=base_url('js/admin/masters.js')?>"></script>
