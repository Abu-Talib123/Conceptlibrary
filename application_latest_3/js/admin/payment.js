
function ajax_pagination_payment(pageLink) {
  
  $('#payment_data').html('<tr><td colspan="9" align="center"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
  
  var url = site_url('admin/payment/fetch_payment/1');

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
      $('#payment_data').html(obj.search_result);
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