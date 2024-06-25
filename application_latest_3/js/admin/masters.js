
$(document).ready(function(){ 

    // category
    $(document).on("click",".delete_category",function() {
    var category_id = $(this).attr("id"); 
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
      category_id: category_id
      };
      
    $.ajax({
               url : site_url('admin/masters/delete_category'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/masters');
               }
            });
    }
  });
  }); 
    // Subcategory
    $(document).on("click",".delete_subcategory",function() {
    var subcategory_id = $(this).attr("id"); 
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
      subcategory_id: subcategory_id
      };
      
    $.ajax({
               url : site_url('admin/masters/delete_subcategory'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/masters/view_subcategory');
               }
            });
    }
  });
  });
    //chapter
    $(document).on("click",".delete_domain",function() {
    var chapter_id = $(this).attr("id"); 
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
      chapter_id: chapter_id
      };
      
    $.ajax({
               url : site_url('admin/masters/delete_domain'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/masters/view_domain');
               }
            });
    }
  });
  });
   // university
    $(document).on("click",".delete_university",function() {
    var university_id = $(this).attr("id"); 
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
      university_id: university_id
      };
      
    $.ajax({
               url : site_url('admin/masters/delete_university'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/masters/view_university');
               }
            });
    }
  });
  });
  //College
    $(document).on("click",".delete_college",function() {
    var college_id = $(this).attr("id"); 
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
      college_id: college_id
      };
      
    $.ajax({
               url : site_url('admin/masters/delete_college'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/masters/view_college');
               }
            });
    }
  });
  });
   // Counrty
    $(document).on("click",".delete_country",function() {
    var country_id = $(this).attr("id"); 
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
      country_id: country_id
      };
      
    $.ajax({
               url : site_url('admin/masters/delete_country'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/masters/view_country');
               }
            });
    }
  });
  }); 
     //state
    $(document).on("click",".delete_state",function() {
    var state_id = $(this).attr("id"); 
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
      state_id: state_id
      };
      
    $.ajax({
               url : site_url('admin/masters/delete_state'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/masters/view_state');
               }
            });
    }
  });
  });
  //city
    $(document).on("click",".delete_city",function() {
    var city_id = $(this).attr("id"); 
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
      city_id: city_id
      };
      
    $.ajax({
               url : site_url('admin/masters/delete_city'),
               type: 'POST',
               data : data,
               error: function() {
                  alert('Something is wrong');
               },
               success: function(theResponse) {
                    window.location = site_url('admin/masters/view_city');
               }
            });
    }
  });
  });
  }); 
function check_if_exists() {

var category_name = $("#category_name").val();

$.ajax(
    {
        type:"post",
        url: site_url('admin/masters/categoryname_exists'),
        data:{ category_name:category_name},
        success:function(response)
        {
            if (response == true) 
            {
                //$('#ajax_error').html('');
            }
            else 
            {
               $('#ajax_error').html('<span style="color:red;" >Category Already exist</span>');
                //$('#msg').html('<span style="color:red;">Value does not exist</span>');
            }  
        }
    });
}
function ajax_pagination_category(pageLink) {
  
  $('#category_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/masters/fetch_category/1');

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
      $('#category_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}
function ajax_pagination_subcategory(pageLink) {
  
  $('#subcategory_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/masters/fetch_subcategory/1');

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
      $('#subcategory_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}
function ajax_pagination_domain(pageLink) {
  
  $('#domain_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/masters/fetch_domaain/1');

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
      $('#domain_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}
function ajax_pagination_university(pageLink) {
  
  $('#university_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/masters/fetch_university/1');

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
      $('#university_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}
function ajax_pagination_college(pageLink) {
  
  $('#country_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/masters/fetch_college/1');

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
      $('#college_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}
function ajax_pagination_country(pageLink) {
  
  $('#country_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/masters/fetch_country/1');

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
      $('#country_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}
function ajax_pagination_state(pageLink) {
  
  $('#state_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/masters/fetch_state/1');

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
      $('#state_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}
function ajax_pagination_city(pageLink) {
  
  $('#city_data').html('<tr><td colspan="10" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/masters/fetch_city/1');

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
      $('#city_data').html(obj.search_result);
      $('#pagination .paging').html(obj.pagination);
    }
  });

  return false;
}