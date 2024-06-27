<!-- Main discription -->

<section class="discription">

   <div class="container-fluid">

      <div class="row">

         <div class="col-md-12">

            <div class="card card-info">

               <div class="card-header">

                  <div class="col-md-6">

                     <h3 class="card-title"><?= $sub_title ?></h3>

                  </div>

               </div>

               <!-- /.card-header -->

               <div class="card-body table-responsive">
                  <?php echo form_open('admin/blog/update/' . $blog['blog_id']); ?>
                  <div class="d-flex justify-content-between">
                     <div class="form-group w-75">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                           value="<?php echo set_value('title', $blog['title']); ?>" required>
                     </div>
                     <div class="form-group mx-2">
                        <label for="author_name">Author</label>
                        <input type="text" class="form-control" id="author_name" name="author_name"
                           value="<?php echo set_value('author_name', $blog['author_name']); ?>" required>
                     </div>
                     <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                           <option value="">Select Category</option>
                           <?php foreach ($categories as $category): ?>
                              <option value="<?= $category->category_id ?>" <?= isset($blog['category_id']) && $blog['category_id'] == $category->category_id ? 'selected' : '' ?>>
                                 <?= $category->name ?>
                              </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="discription">Discription</label>
                     <textarea class="form-control" id="discription" name="discription" rows="10"
                        required><?php echo set_value('discription', $blog['discription']); ?></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                  <?php echo form_close(); ?>
               </div>

            </div>

         </div>

      </div>

   </div>

   <!-- /.container-fluid -->

</section>

<script src="<?= base_url('js/admin/blog.js') ?>"></script>
