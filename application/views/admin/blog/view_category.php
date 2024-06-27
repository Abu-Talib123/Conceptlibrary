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
                  <div class="col-md-6 align-self-center">

                     <h3 class="card-title"><?=$sub_title?></h3>

                  </div>

               </div>

               <!-- /.card-header -->

               <div class="card-body">
               
                     <div class="form-group">
                           <label for="title">Title</label>
                           <p class="form-control-static"><?php echo $category['name']; ?></p>
                     </div>
                     <div class="form-group">
                           <label for="author_name">Description</label>
                           <p class="form-control-static"><?php echo $category['description']; ?></p>
                     </div>
                    
                    
                    <div class="back-btn">
                     <a href="<?php echo site_url('admin/blog/view_categories'); ?>" class="btn btn-info border border-1">Back</a>
                    </div>
                </div>
                

            </div>

         </div>

      </div>

   </div>

   <!-- /.container-fluid -->

</section>

<script src="<?=base_url('js/admin/blog.js')?>"></script>