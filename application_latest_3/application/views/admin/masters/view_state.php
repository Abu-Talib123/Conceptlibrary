
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-5">
            <form class="form-horizontal" action="<?php echo base_url()?>admin/masters/form_validation_state"   method="post">
          <?php 
           if($this->session->flashdata('message')!='') {
             echo $this->session->flashdata('message');
           }
           if($this->uri->segment(3) == "state_inserted")  
           {  
           
                echo '<p class="text-success" align="center" style="color:#2de470;">State Data Inserted</p>';  
           }  
           if($this->uri->segment(3) == "state_updated")  
           {  
                echo '<p class="text-success" align="center" style="color:#2de470;"> State Data Updated</p>';  
           }  
           ?> 
           <?php 
            if(isset($state_data))  
           {  
              foreach($state_data  as $row)  
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
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Country Name</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="country" id="country">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_countrydata) && $fetch_countrydata!='')
                        {
                        $i = 0;
                        foreach($fetch_countrydata as $data)
                        {
                        ?>
                        <option <?php if($data['country_id'] == $row['country_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['country_id'] ?>"><?php echo $data['country_name']?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                      <span class="text-danger"><?php echo form_error("country"); ?></span> 
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label"> State Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="state_name"  name="state_name" placeholder=" State Name" value="<?php echo $row['state_name'];?>">
                      <span class="text-danger"><?php echo form_error("state_name"); ?></span> 
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
                   <input type="hidden" name="hidden_id" value="<?php echo $row['state_id']; ?>" />
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?=base_url('admin/masters/view_state')?>" class="btn btn-default">Cancel</a>
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
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Country Name</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="country" id="country">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_countrydata) && $fetch_countrydata!='')
                        {
                        $i = 0;
                        foreach($fetch_countrydata as $data)
                        {
                        ?>
                        <option value="<?php echo $data['country_id']; ?>"><?php echo $data['country_name']; ?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                      <span class="text-danger"><?php echo form_error("country"); ?></span> 
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label"> State Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="state_name"  name="state_name" placeholder=" State Name">
                      <span class="text-danger"><?php echo form_error("state_name"); ?></span> 
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
                <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/masters/view_state')?>"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table  class="table table-bordered table-striped">
                <thead>
                 <tr>
                    <th>S.no</th>
                    <th>Country Name</th>
                    <th>State Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="state_data">
                 <?php  
                 if($fetch_statedata)  
                 {  
                      $i=1;
                      foreach($fetch_statedata as $row)  
                      {  
                 ?>  
                  <tr>
                    <td><?php echo $i; ?></td> 
                    <td><?php echo  $this->masters_model->country_name($row['country_id']); ?></td> 
                    <td><?php echo $row['state_name']; ?></td>
                     <?php if($row['is_active']== 1){?>
                      <td>Active</td>
                      <?php } else{?>
                      <td>InActive</td>
                      <?php }?>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="<?php echo base_url(); ?>admin/masters/update_statedata/<?php echo $row['state_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger delete_state" id="<?php echo $row['state_id']; ?>"><i class="fas fa-trash"></i></a>
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
