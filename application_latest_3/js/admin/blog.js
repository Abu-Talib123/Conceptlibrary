
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
          // Assuming the server returns the HTML form for editing
          $('#content').html(response); // Replace '#content' with the ID of the container where you want to load the form
      },
      error: function(xhr, status, error) {
          alert('An error occurred: ' + xhr.responseText);
      }
  });

  return false;
}
$(document).ready(function() {
  $(document).on("click", ".delete-blog", function() {
      var blogId = $(this).data("id");
      swal({
          title: "Are you sure?",
          text: "If you select Yes, this will be deleted permanently.",
          icon: "warning",
          buttons: ["No, keep it", "Yes, delete it"],
          dangerMode: true,
      }).then((willDelete) => {
          if (willDelete) {
              $.ajax({
                  url: '<?php echo base_url("admin/blog/delete_blog/"); ?>' + blogId,
                  type: 'POST',
                  success: function(response) {
                      var data = JSON.parse(response);
                      if (data.resultCode == 1) {
                          window.location.reload(); // Refresh the page
                      } else {
                          swal("Error", data.resultMsg, "error");
                      }
                  },
                  error: function() {
                      swal("Error", "Something went wrong", "error");
                  }
              });
          }
      });
  });
});



