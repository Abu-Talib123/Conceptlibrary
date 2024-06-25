
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
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
              <div id="ajax_error" class="ajax_error"></div>
              <form role="form" name="import_form" id="import_form" action="#" method="post" enctype="multipart/form-data">
                <div class="card-body">
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Upload File</label>
                    <div class="col-sm-10">
                      <input type="file" name="file" id="file" required accept=".xls, .xlsx, .csv" />
                      <span class="text-danger"><?php echo form_error("exam_id"); ?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Sample Format</label>
                     <div class="col-sm-10">
                      <a href="https://docs.google.com/spreadsheets/d/1mRFAZjy4M8rSQ_7wJoQEQ8JsCLqwA69vACy7kSFtd04/edit#gid=0" link-black text-sm><i class="fas fa-link mr-1"></i>Click Here</a>
                     </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="reset" class="btn btn-default">Reset</button>
                  <button type="submit" class="btn btn-info float-right" name="insert" value="Insert">Save</button>
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
 <script src="<?=base_url('js/admin/mock_test.js')?>"></script>
