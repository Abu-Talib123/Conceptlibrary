$(document).ready(function () {  
  $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg != value;
 }, "Value must not equal arg.");
  $validator = $("#addVideo").validate({
        rules: {
            category: {valueNotEquals: "All"},
            subcategory: {valueNotEquals: "All"},
            video_name:{required: true },
            video_description:{  required: true,
          minlength: 5,
          maxlength: 30,
         },
            video_file:{required: true },

        },
        messages: {
            category: {valueNotEquals: "Please select Category"},
            subcategory: {valueNotEquals: "Please select Category"},
            video_name:{required: "Please Enter Video Name"},
            video_description:{required: "Enter your message 3-20 characters"},
            video_file:{required: "Please Choose Video "}
        }
    });
    jQuery.validator.addMethod("regex", function(value, element, regexp) {
        if (regexp.constructor != RegExp)
            regexp = new RegExp(regexp);
        else if (regexp.global)
            regexp.lastIndex = 0;
        return this.optional(element) || regexp.test(value);
    }, "Please provide valid email address.");
    $('#addVideo').submit(function(e) {
        e.preventDefault();
       // $('#btnSave').attr('disabled', true);
        var $valid = $("#addVideo").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
           $('#addVideo')[0].submit();
        }
    });
    // category
    $(document).on("click",".delete_video1",function() {
    var video_id = $(this).attr("id"); 
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
      video_id: video_id
      };
      
    $.ajax({
               url : site_url('admin/video/delete_video'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/video');
               }
            });
    }
  });
  }); 

});

function delete_video(id) {
    var video_id = id; 
        swal({
            title: "Are you sure?",
            text: "If you select Yes, this will be deleted permanently.",
            icon: "warning",
            buttons:["No, keep it", "Yes, delete it"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                  var data = {
                  video_id: video_id
                  };
              
                    $.ajax({
                       url : site_url('admin/video/delete_video'),
                       type: 'POST',
                       data : data,
                       error: function() {
                          alert('Something is wrong');
                       },
                       success: function(theResponse) {
                            window.location = site_url('admin/video');
                       }
                    });
            }
        });
}
function ajax_pagination_video(pageLink) {
  
  $('#video_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/video/fetch_video/');

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
      $('#video_data').html(obj.search_result);
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