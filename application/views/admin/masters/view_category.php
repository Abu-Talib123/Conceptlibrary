

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <form class="form-horizontal" action="<?php echo base_url()?>admin/masters/form_validation_category"   method="post">
          <?php 
           if($this->session->flashdata('message')!='') {
             echo $this->session->flashdata('message');
           }
           if($this->uri->segment(3) == "category_inserted")  
           {  
           
                echo '<p class="text-success" align="center" style="color:#2de470;">Category Data Inserted</p>';  
           }  
           if($this->uri->segment(3) == "category_updated")  
           {  
                echo '<p class="text-success" align="center" style="color:#2de470;"> Category Data Updated</p>';  
           }  
           ?> 
           <?php 
            if(isset($category_data))  
           {  
              foreach($category_data  as $row)  
              {  
           ?>  
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?=$menu2?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div id="ajax_error" class="ajax_error"></div>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="category_name"  name="category_name" placeholder="Category Name" value="<?php echo $row['category_name'];?>">
                      <span class="text-danger"><?php echo form_error("category_name"); ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="is_active" id="is_active">
                       <option value="1" <?php echo ($row['is_active'] == '1')?'selected':''?>>Active</option>
                       <option value="0" <?php echo ($row['is_active'] == '0')?'selected':''?>>InActive</option>
                      </select>
                      <span class="text-danger"><?php echo form_error("is_active"); ?></span> 
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="hidden_id" value="<?php echo $row['category_id']; ?>" />  
                 <a href="<?=base_url('admin/masters')?>" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-info float-right" name="update" value="Update" >Update</button>
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
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="category_name"  name="category_name" placeholder="Category Name" value="<?php echo set_value('category_name'); ?>" >
                      <span class="text-danger"><?php echo form_error("category_name"); ?></span> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-8">
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
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title"><?=$menu3?></h3>
              <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/masters')?>"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table  class="table table-bordered table-striped">
                <thead>
                 <tr>
                    <th>S.no</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="category_data">
                 <?php  
                 if($fetch_categorydata)  
                 {  
                      $i=1;
                      foreach($fetch_categorydata as $row)  
                      {  
                 ?>  
                  <tr>
                    <td><?php echo $i; ?></td>  
                    <td><?php echo $row['category_name']; ?></td>
                    <?php if($row['is_active']== 1){?>
                      <td>Active</td>
                      <?php } else{?>
                      <td>InActive</td>
                      <?php }?>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="<?php echo base_url(); ?>admin/masters/update_categorydata/<?php echo $row['category_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger delete_category" id="<?php echo $row['category_id']; ?>"><i class="fas fa-trash"></i></a>
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
                           <td colspan="4" align="center">No Data Found</td>  
                      </tr>  
                 <?php  
                 }  
                 ?> 
                </tbody>
               
              </table>
            </div>
            <!-- /.card-body -->
           <div class="card-footer">
            <div class="card-tools">
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  <script src="<?=base_url('js/admin/masters.js')?>"></script>
