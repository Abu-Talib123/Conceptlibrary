$(document).ready(function () {  
  
    $validator = $("#login_Form").validate({
        rules: {
            inputEmail: {required: true, email: true, minlength: 3, maxlength: 100},
            inputPassword: {required: true, minlength: 4},
        },
        messages: {
            inputEmail: {required: "Please enter valid Email Address"},
            inputPassword: {required: "Please Enter Password!"}
        }
    });
   

    $('#login_Form').submit(function(e) {
        e.preventDefault();

        var $valid = $("#login_Form").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
            var url = site_url('login/logon');
            var data = $("#login_Form").serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    console.log(theResponse);
                    if(obj.resultCode == 1) {
                        window.location = site_url('home');
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                    if (obj.resultCode == 2) {
                       // $('#ajax_error').html(obj.resultMsg);
                        window.location = site_url('login/otp_verification');
                    }
                }
            });
        }
    });

    $frgtpwdvalidator = $("#forgetpwd_Form").validate({
        rules: {
            inputEmail: {required: true, email: true, minlength: 3, maxlength: 100},
        },
        messages: {
            inputEmail: {required: "Please enter valid Email Address"}
        }
    });
   

    $('#forgetpwd_Form').submit(function(e) {
        e.preventDefault();

        var $valid = $("#forgetpwd_Form").valid();
        if (!$valid) {
            $frgtpwdvalidator.focusInvalid();
            return false;
        } else {
            var url = site_url('login/forget_passworddata');
            var data = $("#forgetpwd_Form").serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                        window.location = site_url('login');
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
        }
    });

});