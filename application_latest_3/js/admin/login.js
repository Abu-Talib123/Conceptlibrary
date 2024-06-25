$(document).ready(function () {  
  $validator = $("#loginForm").validate({
        rules: {
            inputEmail: {required: true, email: true, minlength: 3, maxlength: 100},
            inputPassword: {required: true, minlength: 4, maxlength: 8}
        },
        messages: {
            inputEmail: {required: "Please enter valid Email Address"},
            inputPassword: {required: "Please provide valid Password!"}
        }
    });
    /*jQuery.validator.addMethod("regex", function(value, element, regexp) {
        if (regexp.constructor != RegExp)
            regexp = new RegExp(regexp);
        else if (regexp.global)
            regexp.lastIndex = 0;
        return this.optional(element) || regexp.test(value);
    }, "Please provide valid email address.");*/
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $('#ajax_error').html('');
        var $valid = $("#loginForm").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
            var url = site_url('admin/login/logon');
            var data = $("#loginForm").serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    //alert($('#site_url').val() + 'admin/home')
                    window.location = site_url('admin/home');
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
        }
    });
    $resetvalidator = $("#resetpwdForm").validate({
        rules: {
            inputEmail: {required: true, email: true, minlength: 3, maxlength: 100}/*,
            inputPassword: {required: true, minlength: 4},
            input_confirmPassword: {required: true, minlength: 4, equalTo : "#inputPassword"}*/
        },
        messages: {
            inputEmail: {required: "Please enter valid Email Address"}/*,
            inputPassword: {required: "Please Enter Password!"},
            input_confirmPassword: {required: "Please Enter Confirm Password!"}*/
        }
    });
    /*jQuery.validator.addMethod("regex", function(value, element, regexp) {
        if (regexp.constructor != RegExp)
            regexp = new RegExp(regexp);
        else if (regexp.global)
            regexp.lastIndex = 0;
        return this.optional(element) || regexp.test(value);
    }, "Please provide valid email address.");*/

    $('#resetpwdForm').submit(function(e) {
        e.preventDefault();
        $('#ajax_error').html('');
        var $valid = $("#resetpwdForm").valid();
        if (!$valid) {
            $resetvalidator.focusInvalid();
            return false;
        } else {
            var url = site_url('admin/login/forgetPasswordData');
            var data = $("#resetpwdForm").serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    //alert($('#site_url').val() + 'admin/home')
                    window.location = site_url('admin/login');
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
        }
    });
    $changepwdvalidator = $("#frmProfile").validate({
        rules: {
            inputPassword: {required: true, minlength: 4},
            input_ConfirmPassword: {required: true, minlength: 4, equalTo : "#inputPassword"}
        },
        messages: {
            inputPassword: {required: "Please Enter Password!"},
            input_ConfirmPassword: {required: "Please Enter Confirm Password!"}
        }
    });

    $('#frmProfile').submit(function(e) {
        e.preventDefault();

        var $valid = $("#frmProfile").valid();
        if (!$valid) {
            $changepwdvalidator.focusInvalid();
            return false;
        } else {
            var url = site_url('admin/profile/updatePasswordData');
            var data = $("#frmProfile").serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    //alert($('#site_url').val() + 'admin/home')
                    window.location = site_url('admin/login');
                    }
                }
            });
        }
    });

});