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

                           <h3 class="card-title"><?=$sub_title?> </h3>

                        </div>
                        <div class="col-md-6 ">

                           <a href="<?php echo site_url('admin/result/create_result'); ?>" class="btn btn-success float-right">Add New</a>

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
                           <th>Result Year</th>
                           <th>Posted Year</th>


                        </tr>

                     </thead>

                     <tbody id="blog_data">

                        <?php  

                           if($fetch_result)  

                           {  

                            $i=1;

                            foreach($fetch_result as $row)  

                            {  

                           ?>  

                        <tr>

                           <td><?php echo $i;?></td>
                           <td>
                              <?php echo  $row['year']; ?>
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