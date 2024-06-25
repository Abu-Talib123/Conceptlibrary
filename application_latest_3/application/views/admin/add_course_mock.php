
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
              <form role="form" name="frmMock" id="frmMock" action="#" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                  <div class="col-sm-10">
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
                  </div>
                 </div>
                 <div class="form-group row">
                   <label for="inputEmail3" class="col-sm-2 col-form-label">SubCategory</label>
                  <div class="col-md-10" >
                
                  <div id="subcatoptiondata">
                      <select  class="form-control" name="subcategory" id="subcategory" onchange="getexam();">
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
                    
                    </div>
                    </div>
                  </div>
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Exam Name</label>
                    <div class="col-sm-10">
                      <div id="examoptiondata">
                      <select  class="form-control" name="exam_id" id="exam_id">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_examdata) && $fetch_examdata!='')
                        {
                        $i = 0;
                        foreach($fetch_examdata as $data)
                        {
                        ?>
                        <option value="<?php echo $data['exam_id']; ?>"><?php echo $data['exam_name']; ?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                    </div>
                     
                    </div>
                  </div>
                   <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Question Type</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="question_type" id="question_type">
                      <option value="">Select</option>
                      <option value="0">Editor </option>
                    </select>
                    
                    </div>
                  </div>
                 <div id="edit">
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Question</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="question" id="question"  row="3" data-sample-short></textarea>
                      <script>
                        

                        CKEDITOR.replace('question', {
                          height: 300,
                            filebrowserImageUploadUrl: "<?=site_url('admin/mock_test/editor_file_upload?type=image&CKEditor=editor&CKEditorFuncNum=1&langCode=en')?>",
                            filebrowserUploadMethod: 'form'

                        });
                      </script>
                    </div>
                  </div>
                </div>
             
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Option Type</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="option_type" id="option_type">
                      <option value="">Select</option>
                      <option value="0">Option Type</option>
                      <option value="1">Text Type</option>
                    </select>
                      <span class="text-danger"><?php echo form_error("option_type"); ?></span>
                    </div>
                  </div>

                  <div id="option">
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Option A</label>
                    <div class="col-sm-10">
                    <textarea class="form-control"  name="optiona" id="optiona"  row="3"></textarea>
                  <!--   <span class="text-danger"><?php echo form_error("optiona"); ?></span> -->
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Option B</label>
                    <div class="col-sm-10">
                    <textarea class="form-control"  name="optionb" id="optionb"  row="3"></textarea>
                    <!-- <span class="text-danger"><?php echo form_error("optionb"); ?></span> -->
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Option C</label>
                    <div class="col-sm-10">
                    <textarea class="form-control"  name="optionc" id="optionc"  row="3"></textarea>
                   <!--  <span class="text-danger"><?php echo form_error("optionc"); ?></span> -->
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Option D</label>
                    <div class="col-sm-10">
                    <textarea class="form-control"  name="optiond" id="optiond"  row="3"></textarea>
                   <!--  <span class="text-danger"><?php echo form_error("optiond"); ?></span> -->
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Correct Answer</label>
                    <div class="col-sm-10">
                     <select class="form-control" name="correct_answer" id="correct_answer">
                      <option value=""></option>
                      <option value="a">Option A</option>
                      <option value="b">Option B</option>
                      <option value="c">Option C</option>
                      <option value="d">Option D</option>
                    </select>
                   <!--  <span class="text-danger"><?php echo form_error("correct_answer"); ?></span> -->
                    </div>
                  </div>
                </div>
                <div id="text" style="display: none">
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Correct Answer</label>
                    <div class="col-sm-10">
                  <input type="text" name="correct_answer1" id="correct_answer1" class="form-control" onkeypress="return validateFloatKeyPress(this,event);" />
                    
                    </div>
                  </div>
                </div>
                

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Solution Type</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="solution_type" id="solution_type">
                      <option value="">Select</option>
                      <option value="0">Editor Type</option>
                      <option value="1">File Type</option>
                    </select>
                      <span class="text-danger"><?php echo form_error("solution_type"); ?></span>
                    </div>
                  </div>
                  <div id="editor" style="display: none">
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Solution</label>
                    <div class="col-sm-10">
                   <textarea class="form-control" id="steps" name="steps" row="3" data-sample-short></textarea>
                   <!--  <span class="text-danger"><?php echo form_error("steps"); ?></span>-->
                    </div> 
                  </div>
                 </div>
                  <div id="files" style="display: none">
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Solution</label>
                    <div class="col-sm-10">
                   <input type="file"  name="step" id="step"class="form-control"/>
                
                    </div>
                  </div>
                 </div>
                  <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="is_active" id="is_active">
                      <option value="1">Active</option>
                      <option value="0">InActive</option>
                    </select>
                   
                   </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Mark</label>
                    <div class="col-sm-10">
                    <input type="text" name="mark" id="mark" class="form-control" onkeypress="return isNumberKey(event)"/>
                   </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Is Negative</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="is_negative" id="is_negative">
                      <option value="">Select</option>
                      <option value="0">No </option>
                      <option value="1">Yes </option>
                    </select>
                    
                    </div>
                  </div>
                  <div id="negative" style="display: none">
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Negative Marks</label>
                    <div class="col-sm-10">
                  <input type="text" name="negative_mark" id="negative_mark" class="form-control" onkeypress="return validateFloatKeyPress(this,event);" />
                    
                    </div>
                  </div>
                </div>
                  
                </div>

              
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="reset" class="btn btn-default" name="reset" value="Reset"> 
                  <input type="submit" class="btn btn-info float-right" name="Save" value="Save">
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
 
 <style>
  #edit, #image { display: none; }
  #option, #text { display: none; }
  #editor,#file{ display: none; }
 </style>
<script>
$('#question_type').on('change', function() {
  //  alert( this.value ); // or $(this).val()
  if(this.value == "0") {
    $('#edit').show();
    $('#image').hide();
  } else {
    $('#edit').hide();
    $('#image').show();
  }
});
$('#option_type').on('change', function() {
  //  alert( this.value ); // or $(this).val()
  if(this.value == "0") {
    $('#option').show();
    $('#text').hide();
  } else {
    $('#option').hide();
    $('#text').show();
  }
});
$('#solution_type').on('change', function() {
  //  alert( this.value ); // or $(this).val()
  if(this.value == "0") {
    $('#editor').show();
    $('#files').hide();
  } else {
    $('#editor').hide();
    $('#files').show();
  }
});
$('#is_negative').on('change', function() {
  //  alert( this.value ); // or $(this).val()
  if(this.value == "1") {
    $('#negative').show();
  } else {
    $('#negative').hide();
  }
});

</script>
