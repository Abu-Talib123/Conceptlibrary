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

                           <a href="<?php echo site_url('admin/blog/create_category'); ?>" class="btn btn-success float-right">Add New</a>

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
                           <th>Category name</th>
                           <th>Category description</th>

                           <th>Created</th>

                        </tr>

                     </thead>

                     <tbody id="blog_data">

                        <?php  

                           if($category)  

                           {  

                            $i=1;

                            foreach($category as $row)  

                            {  

                           ?>  

                        <tr>

                           <td><?php echo $i;?></td>
                           <td class ='w-auto'>
                                <div class="">
                                    <?php echo  $row['name']; ?>
                                </div>
                                <div class="btn-group btn-group-sm action">
                                    <a href="<?php echo base_url(); ?>admin/blog/view_category/<?php echo $row['category_id']; ?>"
                                    class="text-success px-1 ">View </a>
                                    <span>|</span>
                                    <a href="<?php echo base_url(); ?>admin/blog/edit_blog/<?php echo $row['category_id']; ?>"
                                    class="text-info px-1">Edit </a>
                                    <span>|</span>
                                    <a href="#" class="delete-category text-danger px-1" data-id="<?= $row['category_id']; ?>">Delete</a>                                </div>
                            </td>

                           <td><?php echo  $row['description']; ?></td>
                        
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

            </div>

         </div>

      </div>

   </div>

   <!-- /.container-fluid -->

</section>

<script src="<?=base_url('js/admin/blog.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   
$(document).ready(function() {
    $('.delete-category').on('click', function(e) {
        e.preventDefault();

        var categoryId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('admin/blog/delete_category'); ?>',
                    type: 'POST',
                    data: { id: categoryId },
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'The category has been deleted.',
                            'success'
                        ).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function() {
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
});

</script>
