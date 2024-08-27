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
            <div class=" row counts px-3 pb-2">
               <div class="col-lg-3 col-md-6 col-12 d-flex justify-content-between">
                  <div class="total">Blogs (<?php echo $blog_count ? $blog_count : 0; ?>)</div>
                  <div class="published">Published (<?php echo $published ? $published : 0; ?>)</div>

                  <div class="draft">Draft (<?php echo $draft ? $draft : 0; ?>)</div>
               </div>
               <div class="col-lg-9 col-md-9 col-12  d-flex justify-content-end">

                  <div class="mx-1">

                     <a href="<?php echo site_url('admin/blog/create_blog'); ?>" class="btn btn-success">Add
                        New</a>

                  </div>
                  <div class="mx-1">

                     <a href="#" class="btn btn-info publish_all">Publish all</a>

                  </div>
               </div>
            </div>

            <div class="card card-info">

               <div class="card-header">

                  <div class="col-lg-12">
                     <div class="row justify-content-between">
                        <div class="col-md-3 align-self-center">

                           <h3 class="card-title"><?= $sub_title ?></h3>

                        </div>

                     </div>
                  </div>

               </div>

               <!-- /.card-header -->
               <div class="card-body table-responsive">

                  <table class="table table-bordered">

                     <thead>

                        <tr>

                           <th style="width: 10px">S.no</th>
                           <th>Blog Image</th>
                           <th>Blog Title</th>

                           <th>Author</th>
                           <th>Status</th>

                           <th>Posted Date</th>

                        </tr>

                     </thead>

                     <tbody id="blog_data">

                        <?php

                        if ($fetch_blogdata) {

                           $i = 1;

                           foreach ($fetch_blogdata as $row) {

                              ?>

                              <tr>

                                 <td><?php echo $i; ?></td>
                                 <td>
                                    <div class="mx-auto d-flex justify-content-center align-self-center">
                                       <?php if ($row['blog_image']): ?>
                                          <div class=''>
                                             <img width="100%" height="50" align="absmiddle" id="uploadImage" class="profile-img"
                                                src="<?= $row['blog_image'] ?>" style="cursor:pointer;" />
                                             <input type="file" class="form-control" id="fileInput" name="profile_img_file"
                                                style="display: none;">
                                          </div>
                                       <?php else: ?>
                                          <div class="">
                                             <img width="100%" height="50" align="absmiddle" id="uploadImage" class="profile-img"
                                                src="<?= base_url('assets/cl/images/user_pic.png') ?>" style="cursor:pointer;" />
                                             <input type="file" class="form-control" id="fileInput" name="profile_img_file"
                                                style="display: none;">
                                          </div>
                                       <?php endif; ?>
                                    </div>
                                 </td>
                                 <td class='w-auto'>
                                    <div class="">
                                       <?php echo $row['title']; ?>
                                    </div>
                                    <div class="btn-group btn-group-sm action">
                                       <a href="<?php echo base_url(); ?>admin/blog/view_more/<?php echo $row['blog_id']; ?>"
                                          class="text-success px-1 ">View </a>
                                       <span>|</span>
                                       <a href="<?php echo base_url(); ?>admin/blog/edit_blog/<?php echo $row['blog_id']; ?>"
                                          class="text-info px-1">Edit </a>
                                       <?php if (!$row['is_published']) { ?>
                                          <span>|</span>
                                          <a href="#" class="text-primary publish_blog mx-1"
                                             data-id="<?php echo $row['blog_id']; ?>">Publish</a>
                                       <?php } ?>
                                       <span>|</span>
                                       <a href="#" class="text-danger delete_blog mx-1"
                                          data-id="<?php echo $row['blog_id']; ?>">Delete</a>
                                    </div>
                                 </td>

                                 <td><?php echo $row['author_name']; ?></td>

                                 <td>
                                    <?php
                                    $is_published = $row['is_published'] ? 'Published' : 'Draft';
                                    echo $is_published;
                                    ?>
                                 </td>
                                 <td>
                                    <?php
                                    $custome_date = date("F", strtotime($row['created_at'])) . ' ' . date("d", strtotime($row['created_at'])) . ', ' . date("Y", strtotime($row['created_at']));
                                    echo $custome_date;
                                    ?>
                                 </td>


                              </tr>

                              <?php

                              $i++;

                           }

                        } else {

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
                  <div class="card-tools">
                     <div id="pagination" class="pagination">
                        <div class="paging">
                           <?php echo $pagination ?>
                        </div>
                     </div>
                  </div>
               </div>

            </div>

         </div>

      </div>

   </div>

   <!-- /.container-fluid -->

</section>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   $(document).ready(function () {
      $(document).on('click', '.publish_blog', function (e) {
         e.preventDefault();

         var blogId = $(this).data('id');
         Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Publish it!'
         }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  url: '<?php echo site_url("admin/blog/publish_blog"); ?>',
                  method: 'POST',
                  data: { id: blogId },
                  success: function (response) {
                     var result = JSON.parse(response);

                     if (result.resultCode === 1) {
                        Swal.fire(
                           'Published!',
                           'The blog has been published.',
                           'success'
                        ).then(() => {
                           window.location.reload();
                        });
                     }
                  },
                  error: function () {
                     Swal.fire(
                        'Error!',
                        'An error occurred. Please try again.',
                        'error'
                     );
                  }
               });
            }
         });
      });


      $(document).on('click', '.delete_blog', function (e) {
         e.preventDefault();

         var blogId = $(this).data('id');

         Swal.fire({
            title: 'Are you sure you want to delete this blog post?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  url: '<?php echo site_url("admin/blog/delete_blog"); ?>',
                  method: 'POST',
                  data: { id: blogId },
                  success: function (response) {
                     var result = JSON.parse(response);

                     if (result.resultCode === 1) {
                        Swal.fire(
                           'Deleted!',
                           'The blog post has been deleted.',
                           'success'
                        ).then(() => {
                           window.location.reload();
                        });
                     } else {
                        Swal.fire(
                           'Error!',
                           result.resultMsg,
                           'error'
                        );
                     }
                  },
                  error: function (xhr, status, error) {
                     Swal.fire(
                        'Error!',
                        'An error occurred. Please try again.',
                        'error'
                     );
                     console.error('Error deleting blog post:', error);
                  }
               });
            }
         });
      });


      $(document).on('click', '.publish_all', function (e) {
         e.preventDefault();

         Swal.fire({
            title: 'Are you sure you want to publish all blog posts?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, publish all!'
         }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  url: '<?php echo site_url("admin/blog/publish_all_blog"); ?>',
                  method: 'POST',
                  success: function (response) {
                     var result = JSON.parse(response);

                     if (result.resultCode === 1) {
                        Swal.fire(
                           'Published!',
                           'All blog posts have been published.',
                           'success'
                        ).then(() => {
                           window.location.reload();
                        });
                     } else {
                        Swal.fire(
                           'Error!',
                           result.resultMsg,
                           'error'
                        );
                     }
                  },
                  error: function (xhr, status, error) {
                     Swal.fire(
                        'Error!',
                        'An error occurred. Please try again.',
                        'error'
                     );
                     console.error('Error publishing all blog posts:', error);
                  }
               });
            }
         });
      });

   });
   console.log('he;lo');
function ajax_pagination_blog(pageLink) {
  
  $('#blog_data').html('<tr><td colspan="9" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/blog/fetch_blog/1');

  if(pageLink) {
    url = pageLink.attr('href');
  }

  var data = {
      };

  $.ajax({
    url: url,
    type: "POST",
    data: data,
    success: function (theResponse) {
      var obj = jQuery.parseJSON(theResponse);
      //$('#loader').show()
      console.log(obj.pagination)
      $('#blog_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}

</script>
<script src="<?= base_url('js/admin/blog.js') ?>"></script>
