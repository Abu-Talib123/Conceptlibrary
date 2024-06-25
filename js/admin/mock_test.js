$(document).ready(function () {  

 
    // category
    $(document).on("click",".delete_mocktest",function() {
    var mock_test_id = $(this).attr("id"); 
    swal({
    title: "Are you sure?",
    text: "If you select Yes, this will be deleted permanently.",
    icon: "warning",
    buttons:["No, keep it", "Yes, delete it"],
    dangerMode: true,
    })

    .then((willDelete) => {
    if (willDelete) {
      var data = {
      mock_test_id: mock_test_id
      };
      
    $.ajax({
               url : site_url('admin/mock_test/delete_test'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location.reload();
               }
            });
    }
  });
  }); 

    $('#import_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:site_url('admin/mock_test/import'),
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      success:function(theResponse){
        var obj = jQuery.parseJSON(theResponse);
        if(obj.resultCode == 1) {
        
          window.location = site_url('admin/mock_test');
        }
        if (obj.resultCode == 0) {
        $('#ajax_error').html(obj.resultMsg);
        }
      }
    })
  });

});
function ajax_pagination_mock(pageLink) {
  
  $('#mock_test_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/mock_test/fetch_mocktest/1');

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
      $('#mock_test_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}
function ajax_pagination_mocklist(pageLink) {
  
  $('#mock_list_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/mock_test/fetch_mocklist/1');

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
      $('#mock_list_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}
function getsubcategory()
{
   if($('#category').val()!='')
    {
      $.post('<?php echo base_url(); ?>admin/masters/getsubcategory/'+$('#category').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#subcatoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}