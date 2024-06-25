$(document).ready(function () {  
  
    $regvalidator = $("#register_Form").validate({
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
    jQuery.validator.addMethod("regex", function(value, element, regexp) {
        if (regexp.constructor != RegExp)
            regexp = new RegExp(regexp);
        else if (regexp.global)
            regexp.lastIndex = 0;
        return this.optional(element) || regexp.test(value);
    }, "Please provide valid email address.");

    $('#register_Form').submit(function(e) {
        e.preventDefault();

        var $valid = $("#register_Form").valid();
        if (!$valid) {
            $regvalidator.focusInvalid();
            return false;
        } else {
            
            var material_id = $('input[name=material_id]').val();
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
                     window.location = site_url('video/video_single/material_id');
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
                
            });
        }
    });
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
    jQuery.validator.addMethod("regex", function(value, element, regexp) {
        if (regexp.constructor != RegExp)
            regexp = new RegExp(regexp);
        else if (regexp.global)
            regexp.lastIndex = 0;
        return this.optional(element) || regexp.test(value);
    }, "Please provide valid email address.");

    $('#login_Form').submit(function(e) {
        e.preventDefault();

        var $valid = $("#login_Form").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
            var material_id = $('input[name=material_id]').val();
            var res = material_id.substring(0, 2);
            var url = site_url('login/logon');
            var data = $("#login_Form").serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    //alert($('#site_url').val() + 'admin/home')
                    if(res == 'VI')
                    {
                    window.location = site_url('video/video_detail/')+material_id;
                    }else{
                       window.location = site_url('mockpaper/mock_detail/')+material_id;  
                    }
                   }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
        }
    });

});