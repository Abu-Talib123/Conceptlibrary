$(document).ready(function () { 
    // category
    
    $(document).on("click",".delete_exam",function() {
    var exam_id = $(this).attr("id"); 
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
      exam_id: exam_id
      };
      
    $.ajax({
               url : site_url('admin/exam/delete_exam'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/exam');
               }
            });
    }
  });
  }); 

});
function ajax_pagination_exam(pageLink) {
  
  $('#exam_data').html('<tr><td colspan="9" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/exam/fetch_exam/1');

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
      $('#exam_data').html(obj.search_result);
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