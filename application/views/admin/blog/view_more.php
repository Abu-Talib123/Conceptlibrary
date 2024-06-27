<!-- Main content -->
<style>
   .action a:hover {
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
                  <div class="col-md-6 align-self-center">

                     <h3 class="card-title"><?= $sub_title ?></h3>

                  </div>

               </div>

               <!-- /.card-header -->

               <div class="card-body">
                  <div class="col-lg-12">
                     <div class="row justify-content-between">
                        <div class="col-lg-8">
                           <div class="form-group">
                              <label for="title">Title</label>
                              <p class="form-control-static"><?php echo $blog['title']; ?></p>
                           </div>
                           <div class="form-group ">
                              <label for="description">Description</label>
                              <p class="form-control-static"><?php echo nl2br($blog['discription']); ?></p>
                           </div>
                        </div>
                        <div class="col-lg-4 w-100">
                           <div class="form-group">
                              <label for="title">Feature Image</label>
                              <?php if ($blog['blog_image']): ?>
                                 <div class='w-100'>
                                    <img width="150" height="150" align="absmiddle" id="uploadImage" class="profile-img"
                                       src="<?= $blog['blog_image'] ?>" style="cursor:pointer;" />
                                    <input type="file" class="form-control" id="fileInput" name="profile_img_file"
                                       style="display: none;">
                                 </div>
                              <?php else: ?>
                                 <div class="w-100">
                                    <img width="auto" height="150" align="absmiddle" id="uploadImage" class="profile-img"
                                       src="<?= base_url('assets/cl/images/user_pic.png') ?>" style="cursor:pointer;" />
                                    <input type="file" class="form-control" id="fileInput" name="profile_img_file"
                                       style="display: none;">
                                 </div>
                              <?php endif; ?>
                           </div>
                           <div class="form-group">
                              <label for="author_name">Author</label>
                              <p class="form-control-static"><?php echo $blog['author_name']; ?></p>
                           </div>
                           <div class="form-group">
                              <label for="category">Category</label>
                              <p><?= isset($category_map[$blog['category_id']]) ? $category_map[$blog['category_id']] : 'Unknown' ?>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="back-btn">
                     <a href="<?php echo site_url('admin/blog'); ?>" class="btn btn-info border border-1">Back</a>
                  </div>
               </div>


            </div>

         </div>

      </div>

   </div>

   <!-- /.container-fluid -->

</section>

<script src="<?= base_url('js/admin/blog.js') ?>"></script>