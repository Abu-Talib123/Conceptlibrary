
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
        <?php  
           if($student_data)  
           { 
            foreach($student_data as $row)  
            {  
           ?>  
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <div class="col-md-6">
                <h3 class="card-title"><?=$sub_title?></h3>
                </div>
               
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form role="form" name="frmupdate" id="frmupdate" action="<?php echo base_url();?>admin/student/update_student_data" method="post" enctype="multipart/form-data">


                <div class="card-body">
                  <div class="row">
                  <div class="col-md-6">
                  <label for="inputEmail3" class="col-form-label">Name</label>
                     <input type="text" name="username" id="username" class="form-control" value="<?=$row['username']?>">
                    <span class="text-danger"><?php echo form_error("username"); ?></span>
                    
                  </div>
                  <div class="col-md-6" >
                  <label for="inputEmail3" class="col-form-label">Email</label>
                   <input type="text" name="email" id="email" class="form-control" value="<?=$row['email']?>">
                    <span class="text-danger"><?php echo form_error("email"); ?></span>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                  <label for="inputEmail3" class="col-form-label">Phone</label>
                     <input type="text" name="mobile" id="mobile" class="form-control" value="<?=$row['mobile']?>">
                    <span class="text-danger"><?php echo form_error("mobile"); ?></span>
                    
                  </div>
                  <div class="col-md-6" >
                  <label for="inputEmail3" class="col-form-label">Registration Id</label>
                   <input type="text" name="registration_id" id="registration_id" class="form-control" value="<?=$row['registration_id']?>">
                    <span class="text-danger"><?php echo form_error("registration_id"); ?></span>
                    </div>
                  </div>
                   <div class="row">
                  <div class="col-md-6">
                  <label for="inputEmail3" class="col-form-label">University</label>
                    <select  class="form-control" name="university" id="university" onchange="getcollege();">
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
                  <div class="col-md-6" >
                  <label for="inputEmail3" class="col-form-label">College</label>
                  <div id="universityoptiondata">
                      <select  class="form-control" name="college" id="college">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_collegedata) && $fetch_collegedata!='')
                        {
                        $i = 0;
                        foreach($fetch_collegedata as $data)
                        {
                        ?>
                         <option <?php if($data['college_id'] == $row['college_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['college_id'] ?>"><?php echo $data['college_name']?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                      <!-- <span class="text-danger"><?php echo form_error("subcategory"); ?></span> -->
                    </div>
                    </div>
                  </div>
                
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
                         <option <?php if($data['subcategory_id'] == $row['subcategory_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['subcategory_id'] ?>"><?php echo $data['subcategory_name']?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                      <!-- <span class="text-danger"><?php echo form_error("subcategory"); ?></span> -->
                    </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                  <label for="inputEmail3" class="col-form-label">Country</label>
                    <select  class="form-control" name="country" id="country" onchange="getstate();">
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
                  <div class="col-md-6" >
                  <label for="inputEmail3" class="col-form-label">State</label>
                  <div id="stateoptiondata">
                      <select  class="form-control" name="state" id="state" onchange="getcity();">
                         <option value="">Select</option>
                        <?php
                        if(isset($fetch_statedata) && $fetch_statedata!='')
                        {
                        $i = 0;
                        foreach($fetch_statedata as $data)
                        {
                        ?>
                        <option <?php if($data['state_id'] == $row['state_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['state_id'] ?>"><?php echo $data['state_name']?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                      <!-- <span class="text-danger"><?php echo form_error("subcategory"); ?></span> -->
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="inputEmail3" class="col-form-label">City</label>
                     <div id="cityoptiondata">
                        <select class="form-control form-control-lg" name="city" id="city">
                          <option value="">Select</option>
                        <?php
                        if(isset($fetch_citydata) && $fetch_citydata!='')
                        {
                        $i = 0;
                        foreach($fetch_citydata as $data)
                        {
                        ?>
                        <option <?php if($data['city_id'] == $row['city_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['city_id'] ?>"><?php echo $data['city_name']?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                     <span class="text-danger"><?php echo form_error("city"); ?></span>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <label for="inputEmail3" class="col-form-label">Address</label>
                      <input type="address" name="address" id="address" class="form-control" value="<?=$row['address'];?>">
                      <span class="text-danger"><?php echo form_error("address"); ?></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="inputEmail3" class="col-form-label">Pincode</label>
                      <input type="text" name="pincode" id="pincode" class="form-control" value="<?=$row['pincode'];?>">
                      <span class="text-danger"><?php echo form_error("pincode"); ?></span>
                    </div>
                     <div class="col-md-6">
                      <label for="inputEmail3" class="col-form-label">Aadhar No</label>
                      <input type="text" name="aadhar_no" id="aadhar_no" class="form-control" value="<?=$row['aadhar_no'];?>">
                      <span class="text-danger"><?php echo form_error("aadhar_no"); ?></span>
                    </div>
                    </div>
                     <div class="row">
                     <div class="col-md-6">
                      <label for="exampleInputPassword1" class="col-form-label"> Aadhar File </label>
                      <input type="file" class="form-control" id="aadhar_file"  name="aadhar_file">
                      <span class="text-danger"><?php echo form_error("aadhar_link"); ?></span>
                    <input type="hidden" name="old_aadhar" id="old_aadhar" value="<?=$row['aadhar_link']?>">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <input type="hidden" name="student_id" id="student_id" value="<?=$row['student_id']?>">
                <div class="card-footer">
                  <button type="reset" class="btn btn-default"> Reset</button>
                  <button type="submit" class="btn btn-info float-right" name="update" value="update">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          
          <!--/.col (left) -->
          <!-- right column -->
         <?php
              }
          }  ?>
                           
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
 