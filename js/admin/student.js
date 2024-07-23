$(document).ready(function () { 
    // category
    $(document).on("click",".delete_student",function() {
      var student_id = $(this).attr("id"); 
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
      student_id: student_id
      };
      
    $.ajax({
               url : site_url('admin/student/delete_student'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    //alert($('#site_url').val() + 'admin/home')
                    window.location = site_url('admin/student');
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
               }
            });
    }
  });
  }); 
$('select:not(#student_select)').on('change', function() {
 var is_active = $('#is_active').val();
 var student_id = $('input[name=student_id]').val();
 var data = {
      student_id: student_id,
      is_active: is_active
      };
       $.ajax({
               url : site_url('admin/student/update_student'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                   var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                      $('#ajax_error').html(obj.resultMsg);
                    }
                    if (obj.resultCode == 0) {
                      $('#ajax_error').html(obj.resultMsg);
                    }
               }
          });
});
  
  $("#student_select").select2({
    ajax: {
        url: site_url('admin/student/getStudentSelectJson'),
        dataType: 'json',
        type: "POST",
        quietMillis: 50,
        data: function (term) {
            return {
                term: term
            };
        },
        processResults: function(data) {
            return {results: data};
        }
    }
  }).change(function(){
    getStudentExamDetails(this.value);
  });

});
function ajax_pagination_student(pageLink) {
  
  $('#student_data').html('<tr><td colspan="13" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/student/fetch_student/1');
  var filter = $('#filter_student').val();


  if(pageLink) {
    url = pageLink.attr('href');
  }
  var data = {
    filter: filter
  };

  $.ajax({
    url: url,
    type: "POST",
    data: data,
    success: function (theResponse) {
      var obj = jQuery.parseJSON(theResponse);
      //$('#loader').show()
      $('#student_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);  
    }
  });

  return false;
}


function getStudentExamDetails(student_id) {
  if(student_id)
  {
    $.ajax({
      url: site_url('admin/student/get_student_exam_history/')+student_id,
      type: "GET",
      success: function (theResponse) {
        $("#student_exam_history_result").html(theResponse);
      }
    });
  }
}
function getStudentExamDetails(filter) {
  if(student_id)
  {
    $.ajax({
      url: site_url('admin/student/get_student_exam_history/')+student_id,
      type: "GET",
      success: function (theResponse) {
        $("#student_exam_history_result").html(theResponse);
      }
    });
  }
}

function deleteStudentExamHistory($this, student_id, exam_id) {
  var confirm = window.confirm('Are you sure to cleare the history?');
  if (confirm) {
    $.ajax({
      url:
        site_url('admin/student/deleteStudentExamHistory/') +
        student_id +
        '/' +
        exam_id,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        if (data.status) {
          $($this)
            .parents('tr')
            .find('td.status')
            .html('<span class="badge badge-danger" >Not Attended</span>');
          $($this).remove();
        } else {
          alert('Faile to clear the history!');
        }
      },
    });
  }
}

