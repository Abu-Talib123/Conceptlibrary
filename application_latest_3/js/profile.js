$(document).ready(function () {  
  
    $validator = $("#profile_Form").validate({
        rules: {
            category: {required: true},
            subcategory: {required: true},
            country: {required: true},
            state: {required: true},
            city: {required: true},
            address:{required: true},
            pincode: {required: true,number:true,maxlength:6},
            aadhar_no: {required: true,maxlength:16},
            aadhar_file: {required: true},
        },
        messages: {
            
            category: {required: "Please Choose Category"},
            subcategory: {required: "Please Choose Sub Category!"},
            country: {required: "Please choose country!"},
            state: {required: "Please choose State"},
            city: {required: "Please choose City"},
            address:{required: "please enter address"},
            pincode: {required: "Please enter pincode"},
            aadhar_no: {required: "Please Enter AAdhar No!"},
            aadhar_file: {required: "Please Select File!"}

        }
    });
    

    $('#profile_Form').submit(function(e) {
        e.preventDefault();

        var $valid = $("#profile_Form").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
           
          
            var url = site_url('profile/update');
            $.ajax({
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                data: new FormData(this),
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    //alert($('#site_url').val() + 'admin/home')
                    $('#ajax_error').html(obj.resultMsg);
                    window.setTimeout(function(){location.reload()},3000)
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
        }
    });
     $pwdvalidator = $("#pwd_Form").validate({
        rules: {
            inputPassword: {required: true},
            input_ConfirmPassword: {required: true, equalTo : "#inputPassword"}
        },
        messages: {
            inputPassword: {required: "Please Enter Password!"},
            input_ConfirmPassword: {required: "Please Enter Confirm Password!"}
        }
    });
    

    $('#pwd_Form').submit(function(e) {
        e.preventDefault();

        var $valid = $("#pwd_Form").valid();
        if (!$valid) {
            $pwdvalidator.focusInvalid();
            return false;
        } else {
          
            var url = site_url('profile/updatePasswordData');
            $.ajax({
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                data: new FormData(this),
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);
                    if(obj.resultCode == 1) {
                    //alert($('#site_url').val() + 'admin/home')
                    $('#ajax_error').html(obj.resultMsg);
                    window.setTimeout(function(){location.reload()},3000)
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
        }
    });

});