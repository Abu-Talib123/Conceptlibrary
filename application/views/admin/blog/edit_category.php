<section class="discription">

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
               <form id="editCategoryForm" method="post" data-category-id="<?php echo $category['id']; ?>">
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $category['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $category['description']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Category</button>
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
    // AJAX submit for updating category
    $('#editCategoryForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var categoryId = $(this).data('category-id');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url("admin/blog/update_category/" + categoryId); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    alert('Category updated successfully');
                    // Optionally, update UI or redirect after success
                    // Example: window.location.href = '<?php echo base_url("admin/blog"); ?>';
                } else {
                    alert('Failed to update category');
                    // Handle error message or UI update
                }
            },
            error: function() {
                alert('Error updating category');
                // Handle AJAX error
            }
        });
    });
});
</script>