

// Create category

// Edit category (assuming you have an edit form)
$('#editCategoryForm').submit(function(e) {
  e.preventDefault();
  var formData = $(this).serialize();
  var categoryId = $(this).data('category-id'); // Get category ID from form data or element
  $.ajax({
      type: 'POST',
      url: '<?php echo base_url("admin/blog/update_category/" + categoryId); ?>',
      data: formData,
      dataType: 'json',
      success: function(response) {
          if (response.status) {
              alert('Category updated successfully');
              // Optionally, update UI or redirect after success
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

// Delete category






