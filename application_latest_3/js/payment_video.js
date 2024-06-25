$(document).ready(function () {  
  
  
    $('#paymentForm').submit(function(e) {
        e.preventDefault();
        var material_id = $('input[name=material_id]').val();
     
            var url = site_url('content/proceed_payment');
            var data = $("#paymentForm").serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    //alert($('#site_url').val() + 'admin/home')
                    window.location = site_url('content/payment_video/' +obj.material_id);
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
       
    });

});