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

                  <div class="col-md-6">

                     <h3 class="card-title"><?=$sub_title?></h3>

                  </div>

               </div>

               <!-- /.card-header -->

               <div class="card-body table-responsive">

                  <table class="table table-bordered">

                     <thead>

                         <tr>

                           <th style="width: 10px">S.no</th>

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

                           <td class ='w-auto'>
                                <div class="">
                                    <?php echo  $row['title']; ?>
                                </div>
                                <div class="btn-group btn-group-sm action">
                                    <a href="<?php echo base_url(); ?>admin/blog/edit_blog/<?php echo $row['blog_id']; ?>"
                                    class="text-success px-1 ">View </a>
                                    <span>|</span>
                                    <a href="<?php echo base_url(); ?>admin/blog/edit_blog/<?php echo $row['blog_id']; ?>"
                                    class="text-info px-1">Edit </a>
                                    <span>|</span>
                                    <a href="#" class="text-danger mx-1 delete_blog" id="<?php echo $row['blog_id']; ?>">delete</a>
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