
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
               
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" name="frmProfile" id="frmProfile" action="" method="post" >
                <div class="card-body">
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-5">
                      <input class="form-control" type="password" name="inputPassword" id="inputPassword" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Confirm Password</label>
                    <div class="col-sm-5">
                      <input class="form-control" type="password" name="input_ConfirmPassword" id="input_ConfirmPassword" placeholder="Password">
                    </div>
                    </div>
                  </div>
                   <div class="card-footer">
                  <button type="reset" class="btn btn-default"> Reset</button>
                  <button type="submit" class="btn btn-info float-right" name="Update" value="Update">Update</button>
                </div>
                 
                </div>
                <!-- /.card-body -->
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
 <script src="<?=base_url('js/admin/login.js')?>"></script> 