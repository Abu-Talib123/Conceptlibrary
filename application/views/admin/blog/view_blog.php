<!-- Main content -->
 <style>
    .action a:hover{
        text-decoration: underline;
    }
    .action a, .action span {
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

                           <h3 class="card-title"><?=$sub_title?></h3>

                        </div>
                        <div class="col-md-6 ">

                           <a href="<?php echo site_url('admin/blog/create_blog'); ?>" class="btn btn-success float-right">Add New Blog</a>

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

                           <th>Posted Date</th>

                        </tr>

                     </thead>

                     <tbody id="blog_data">

                        <?php  

                           if($fetch_blogdata)  

                           {  

                            $i=1;

                            foreach($fetch_blogdata as $row)  

                            {  

                           ?>  

                        <tr>

                           <td><?php echo $i;?></td>
                           <td>
                              <div class="mx-auto d-flex justify-content-center align-self-center">
                                 <?php if ($row['blog_image']): ?>
                                    <div class = ''>
                                       <img width="100%" height="50" align="absmiddle" id="uploadImage" class="profile-img"
                                          src="<?= $row['blog_image'] ?>" style="cursor:pointer;" />
                                       <input type="file" class="form-control" id="fileInput" name="profile_img_file" style="display: none;">
                                    </div>
                                 <?php else: ?>
                                    <div class="">
                                       <img width="100%" height="50" align="absmiddle" id="uploadImage" class="profile-img"
                                          src="<?= base_url('assets/cl/images/user_pic.png') ?>" style="cursor:pointer;" />
                                       <input type="file" class="form-control" id="fileInput" name="profile_img_file" style="display: none;">
                                    </div>
                                 <?php endif; ?>
                              </div>
                           </td>
                           <td class ='w-auto'>
                                <div class="">
                                    <?php echo  $row['title']; ?>
                                </div>
                                <div class="btn-group btn-group-sm action">
                                    <a href="<?php echo base_url(); ?>admin/blog/view_more/<?php echo $row['blog_id']; ?>"
                                    class="text-success px-1 ">View </a>
                                    <span>|</span>
                                    <a href="<?php echo base_url(); ?>admin/blog/edit_blog/<?php echo $row['blog_id']; ?>"
                                    class="text-info px-1">Edit </a>
                                    <span>|</span>
                                    <a href="#" class="text-danger delete_blog mx-1" data-id="<?php echo $row['blog_id']; ?>">Delete</a>
                                </div>
                            </td>

                           <td><?php echo  $row['author_name']; ?></td>
                        
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

   </div>

   <!-- /.container-fluid -->

</section>

<script src="<?=base_url('js/admin/blog.js')?>"></script>
<script>
    $(document).ready(function() {
    $(document).on('click', '.delete_blog', function(e) {
        e.preventDefault(); 

        var blogId = $(this).data('id');

        if (confirm('Are you sure you want to delete this blog post?')) {
            $.ajax({
                url: '<?php echo site_url("admin/blog/delete_blog"); ?>', 
                method: 'POST',
                data: { id: blogId }, 
                success: function(response) {
                    var result = JSON.parse(response);
                    
                    if (result.resultCode === 1) {
                        alert(result.resultMsg); 
                        window.location.reload();
                    } else {
                        alert(result.resultMsg); 
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting blog post:', error);
                }
            });
        }
    });
});

</script>