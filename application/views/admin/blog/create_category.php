<!-- Main description -->


<section class="description">

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
                <form id="createCategoryForm" method="post">
                        <div class="form-group">
                            <label for="name">Category Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Create</button>
                        <button type="submit" class="btn btn-secondary" onclick="window.history.back();">Back</button>
                    </form>
               </div>

            </div>

         </div>

      </div>

   </div>

   <!-- /.container-fluid -->

</section>
<script>
    $(document).ready(function() {
    // AJAX submit for creating category
    $('#createCategoryForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url("admin/blog/save_category"); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    window.location.href = '<?php echo base_url("admin/blog/view_categories"); ?>';
                } 
            },
            error: function() {
                alert('Error creating category');
            }
        });
    });
});
</script>
