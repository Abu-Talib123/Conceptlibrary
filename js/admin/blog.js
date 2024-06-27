
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

function ajax_edit_redirect(link) {
  var url = $(link).attr('href');

  $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
          $('#content').html(response);
      },
      error: function(xhr, status, error) {
          alert('An error occurred: ' + xhr.responseText);
      }
  });

  return false;
}

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






