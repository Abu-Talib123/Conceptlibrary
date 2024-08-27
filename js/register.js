$(document).ready(function () {  
  
    $validator = $("#register_Form").validate({
        rules: {
            inputUsername:{required: true},
            inputMobile:{required: true,number: true,maxlength:10 },
            inputEmail: {required: true, email: true, minlength: 3, maxlength: 100},
            inputPassword: {required: true, minlength: 4},
            input_confirmPassword: {required: true, minlength: 4, equalTo : "#inputPassword"}
        },
        messages: {
            inputUsername:{required:" Please Enter User Name"},
            inputMobile:{required: "Please Enter  10 digit Mobile Number"},
            inputEmail: {required: "Please enter valid Email Address"},
            inputPassword: {required: "Please Enter Password!"},
            input_confirmPassword: {required: "Please Enter Confirm Password!"}
        }
    });
  

    $('#register_Form').submit(function(e) {
        e.preventDefault();

        var $valid = $("#register_Form").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
            
            var url = site_url('login/register_data');
            var data = $("#register_Form").serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    //alert($('#site_url').val() + 'admin/home')
                        window.location = site_url('login/otp_verification');
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
                
            });
        }
    });
     $validator = $("#otpverify_Form").validate({
        rules: {
            inputotp:{required: true,maxlength:4 }
        },
        messages: {
            inputotp:{required:" Please Enter OTP"}
        }
    });
  

    $('#otpverify_Form').submit(function(e) {
        e.preventDefault();

        var $valid = $("#otpverify_Form").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
            
            var url = site_url('login/otp_verification_data');
            var data = $("#otpverify_Form").serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                      $('#ajax_error').html(obj.resultMsg);
                     window.location = site_url('home');
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
                
            });
        }
    });

});