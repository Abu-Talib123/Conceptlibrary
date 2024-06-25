

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <form class="form-horizontal" action="<?php echo base_url()?>admin/masters/form_validation_subcategory"   method="post">
          <?php 
           if($this->session->flashdata('message')!='') {
             echo $this->session->flashdata('message');
           } 
           if($this->uri->segment(3) == "subcategory_inserted")  
           {  
           
                echo '<p class="text-success" align="center" style="color:#2de470;">SubCategory Data Inserted</p>';  
           }  
           if($this->uri->segment(3) == "subcategory_updated")  
           {  
                echo '<p class="text-success" align="center" style="color:#2de470;"> SubCategory Data Updated</p>';  
           }  
           ?> 
           <?php 
            if(isset($subcategory_data))  
           {  
              foreach($subcategory_data  as $row)  
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
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="category" id="category">
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
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label"> SubCategory</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="subcategory_name"  name="subcategory_name" placeholder=" Sub Category Name" value="<?php echo $row['subcategory_name'];?>">
                      <span class="text-danger"><?php echo form_error("subcategory_name"); ?></span> 
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"> Description</label>
                    <div class="col-sm-8">
                    <textarea class="form-control"  name="subcategory_description" id="subcategory_description"  row="3"><?php echo $row['subcategory_description'];?>
                    </textarea>
                    <span class="text-danger"><?php echo form_error("subcategory_description"); ?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">PaymentStatus</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="status" id="status">
                       <option value="1" <?php echo ($row['status'] == '1')?'selected':''?>>Buy</option>
                       <option value="0" <?php echo ($row['status'] == '0')?'selected':''?>>Free</option>
                      </select>
                      <span class="text-danger"><?php echo form_error("status"); ?></span> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Video Price</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control" id="price"  name="price" placeholder="Price" value="<?php echo $row['price'];?>">
                      <span class="text-danger"><?php echo form_error("price"); ?></span> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Video Offer Price</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control" id="offer_price"  name="offer_price" placeholder="Price" value="<?php echo $row['offer_price'];?>">
                      
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Mock Paper Price</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control" id="price"  name="m_price" placeholder="Price" value="<?php echo $row['m_price'];?>">
                      
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Mock Paper Offer Price</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control" id="offer_price"  name="m_offer_price" placeholder="Price" value="<?php echo $row['m_offer_price'];?>">
                      
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
                   <input type="hidden" name="hidden_id" value="<?php echo $row['subcategory_id']; ?>" />
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?=base_url('admin/masters/view_subcategory')?>" class="btn btn-default">Cancel</a>
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
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="category" id="category">
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
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label"> SubCategory</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="subcategory_name"  name="subcategory_name" placeholder=" Sub Category Name" value="<?php echo set_value('subcategory_name'); ?>">
                      <span class="text-danger"><?php echo form_error("subcategory_name"); ?></span> 
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Description</label>
                    <div class="col-sm-8">
                    <textarea class="form-control"  name="subcategory_description" id="subcategory_description"  row="3"><?php echo set_value('subcategory_description'); ?></textarea>
                    <span class="text-danger"><?php echo form_error("subcategory_description"); ?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Payment Status</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="status" id="status">
                       <option value="1">Buy</option>
                       <option value="0">Free</option>
                      </select>
                      <span class="text-danger"><?php echo form_error("status"); ?></span> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Price</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control" id="price"  name="price" placeholder="Price" value="<?php echo set_value('price'); ?>">
                      <span class="text-danger"><?php echo form_error("price"); ?></span> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Offer Price</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control" id="offer_price"  name="offer_price" placeholder="Offer Price" value="<?php echo set_value('offer_price'); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Mock Paper Price</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control" id="m_price"  name="m_price" placeholder="Price" value="<?php echo set_value('m_price'); ?>">
                      <span class="text-danger"><?php echo form_error("price"); ?></span> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Mock Paper  Offer Price</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control" id="m_offer_price"  name="m_offer_price" placeholder="Offer Price" value="<?php echo set_value('m_offer_price'); ?>">
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
                    <input type="hidden" name="insert" value="insert" />
                  <button type="reset" class="btn btn-default"> Reset</button>
                  <input type="submit" class="btn btn-info float-right" name="btnSave" id="btnSave" value="Insert" onclick="$('#btnSave').attr('disabled', true);$('form')[0].submit();">Save
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
                <h3 class="card-title  float-right"style="padding-right: 50px"><a href="<?=base_url('admin/masters/view_subcategory')?>"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fas fa-plus-square"></i></button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table  class="table table-bordered table-striped">
                <thead>
                 <tr>
                    <th>S.no</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Description</th>
                    <th>Payment Status</th>
                    <th>Video Price</th>
                    <th>Mock Price</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="subcategory_data">
                 <?php  
                 if($fetch_subcategorydata)  
                 {  
                      $i=1;
                      foreach($fetch_subcategorydata as $row)  
                      {  
                 ?>  
                  <tr>
                    <td><?php echo $i; ?></td> 
                    <td><?php echo  $this->masters_model->category_name($row['category_id']); ?></td> 
                    <td><?php echo $row['subcategory_name']; ?></td>
                    <td><?php echo $row['subcategory_description']; ?></td>
                     <?php if($row['status']== 1){?>
                      <td>Buy</td>
                      <?php } else{?>
                      <td>Free</td>
                      <?php }?>
                      <td><?php if($row['offer_price'] > 0) { echo '<strike>'.$row['price'].'</strike><br/>'.$row['offer_price'];}else{ echo $row['price'];} ?></td>
                      <td><?php if($row['m_offer_price'] > 0) { echo '<strike>'.$row['m_price'].'</strike><br/>'.$row['m_offer_price'];}else{ echo $row['m_price'];} ?></td>
                     <?php if($row['is_active']== 1){?>
                      <td>Active</td>
                      <?php } else{?>
                      <td>InActive</td>
                      <?php }?>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="<?php echo base_url(); ?>admin/masters/update_subcategorydata/<?php echo $row['subcategory_id'];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger delete_subcategory" id="<?php echo $row['subcategory_id']; ?>"><i class="fas fa-trash"></i></a>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  <script src="<?=base_url('js/admin/masters.js')?>"></script>
