<!-- Main content -->
<style>
   .action a:hover,
   #addNewCategoryButton:hover {
      text-decoration: underline;
   }

   .action a,
   .action span {
      font-size: 13px;
   }
</style>

<section class="content">

   <div class="container-fluid">

      <div class="row">

         <div class="col-md-12">

            <div class="card card-info">

               <div class="card-header">

                  <div class="col-lg-12">
                     <div class="row justify-content-between">
                        <div class="col-md-6 align-self-center">

                           <h3 class="card-title"><?= $sub_title ?></h3>

                        </div>
                     </div>
                  </div>

               </div>

               <!-- /.card-header -->

               <div class="card-body">
                  <form action="<?php echo site_url('admin/result/save_result'); ?>" method="post"
                     enctype="multipart/form-data">
                     <div class="col-lg-12">
                        <div class="form-group">
                           <label for="title">Result Year</label>
                           <select class="form-control" id="year" name="year" required>
                              <?php
                              $current_year = date('Y') + 1;
                              for ($i = 0; $i <= 3; $i++) {
                                 $year = $current_year - $i;
                                 echo "<option value=\"$year\">$year</option>";
                              }
                              ?>
                           </select>
                        </div>
                        <div class="dynamic_form_fields border border-1 my-3">
                           
                           <div class="row mx-3 py-3">
                           <div class="form-group col-lg-3 col-md-4 col-12">
                                    <label for="student">Student</label>
                                    <select class="form-control" id="student_id" name="student_id" required>
                                                <option value="">Select Student</option>
                                                <?php foreach ($students as $student): ?>
                                                    <option value="<?= $student['student_id'] ?>"><?= $student['username'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-lg-3 col-md-4 col-12">
                                    <label for="author_name">Course</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                                <option value="">Select Category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-lg-3 col-md-4 col-12">
                                    <label for="author_name">Rank</label>
                                    <input type="text" class="form-control" id="rank" name="rank" required>
                                 </div>
                                 <div class="form-group col-lg-12 col-md-12 col-12">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                       required></textarea>
                                 </div>
                                 <div class="col-lg-12 col-md-12 col-12">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <a href="<?php echo site_url('admin/result'); ?>" class="btn btn-secondary">Cancel</a>
                                 </div>
                           </div>
                        </div>
                     </div>

                  </form>
               </div>

               <!-- /.card-body -->
            </div>

         </div>

      </div>

   </div>

   <!-- /.container-fluid -->

</section>
<script>
   document.getElementById('uploadImage').onclick = function () {
      document.getElementById('fileInput').click();
   };

   document.getElementById('fileInput').onchange = function () {
      var file = this.files[0];
      console.log('Selected file:', file);
      var reader = new FileReader();
      reader.onload = function (e) {

         document.getElementById('uploadImage').src = e.target.result;
      };
      reader.readAsDataURL(file);
   };
   
     
   
</script>

<script src="<?= base_url('js/admin/blog.js') ?>"></script>