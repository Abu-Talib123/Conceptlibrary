$(document).ready(function(){
 
 $('.add_cart').click(function(){
    var subcategory_id = $(this).attr("id");
    var product_type =  $('input[name=product_type]').val();
   $.ajax({
    url:site_url('cart/add'),
    method:"POST",
    data:{subcategory_id:subcategory_id,product_type:product_type},
    success:function(data)
    {
     swal("Product Added into Cart");
     setInterval('location.reload()', 1000);
    }
   });
  
 });

 $('#cart_details').load("<?php echo base_url(); ?>cart/load");

 $(document).on('click', '.remove_inventory', function(){
  
  swal({
    title: "Are you sure?",
    text: "If you select Yes, this will be removed.",
    icon: "warning",
    buttons:["No, keep it", "Yes, delete it"],
    dangerMode: true,
    })
  .then((willDelete) => {
    if (willDelete) {
    var row_id = $(this).attr("id"); 
    $.ajax({
    url:site_url('cart/remove'),
    method:"POST",
    data:{row_id:row_id},
    success:function(data)
    {
     swal("Product removed from Cart");
     setInterval('location.reload()', 1000);
    }
    });
  }
  else
  {
   return false;
  }
 });
 });

 $(document).on('click', '#clear_cart', function(){
var data = $('#frm_checkout').serializeArray();
console.log(data);
  swal({
    title: "Are you sure?",
    text: "If you select Yes, this will be removed.",
    icon: "warning",
    buttons:["No, keep it", "Yes, delete it"],
    dangerMode: true,
    })
  .then((willDelete) => {
    if (willDelete) {
     var data = $('#frm_checkout').serializeArray();
     $.ajax({
      url:site_url('cart/clear'),
      success:function(data)
      {
       swal("Your cart has been clear...");
       setInterval('location.reload()', 1000);
      }
     });
  }
  else
  {
   return false;
  }
  });
 });

$(document).on('click', '#add_cart_total', function(){
var data = $('#frm_domain').serializeArray();
console.log(data);
  swal({
    title: "Are you sure?",
    text: "Do You Want to Select All courses",
    buttons:["No, keep it", "Yes"],
    })
  .then((value) => {
    if (value) {
     var data = $('#frm_domain').serializeArray();
     $.ajax({
      type: 'POST',
      url:site_url('cart/add_total'),
      data: data,
      success:function(data)
      {
       swal("Product Added into Cart");
       setInterval('location.reload()', 1000);
      }
     });
  }
  else
  {
   return false;
  }
  });
 });




 $('#submit-pay').click(function(e) {
        e.preventDefault();
           // var url = site_url('login/logon');
          var data = $('#frm_checkout').serializeArray();
          console.log(data);
          var url = site_url('cart/proceed_payment');
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                   var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    window.location = site_url('cart/checkout/' +obj.payment_id);
                  }
                  if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
    });



  $('.pay_cart').click(function(){
  swal("Please Buy and Watch Videos and Do  Mock Test");
 });
 
 $('.login_cart').click(function(){
  swal("Please Login to your account and Watch Your Videos and Do  Mock Test");
 });

 /* $(document).ready(function() {
    var $v = $('#myVideo');
    $v.cuepoints({
        17: function() {
            $v[0].stop();
        }
    });

    $('button').click(function(){
        $v[0].play();
        try {$v[0].currentTime = 7;} catch(e) {}
    });
});*/

});