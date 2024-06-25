$(document).ready(function () {  
   $validator = $("#frmMock").validate({
        rules: {
            category:{required: true},
            subcategory: {required: true},
            exam_id: {required: true},
            question_type : {required: true},
            option_type:  {required: true},
            solution_type:{required: true},
            status: {required: true},
            mark:{required:true},
            is_negative:{required:true},
        },
        messages: {
            category: {required: "Please Select Category"},
            subcategory: {required: "Please Select SubCategory"},
            exam_id: {required: "Please Select Exam"},

            question_type: {required: "Please Select Question Type"},
            option_type:{required: "Please Select Question Type"},
            solution_type:{required: "Please Select Question Type"},
            status:{required: "Please Select Question Type"},
            mark:{required: "Please  Enter Mark in Number"},
            is_negative:{required: "Please  Select  any option"},
            
        }
    });
   
    $('#frmMock').submit(function(e) {
       
        e.preventDefault();
        $('#ajax_error').html('');
        var $valid = $("#frmMock").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
            if($('#option_type').val() == 0){
                if($('#correct_answer').val() ==''){
                    $("#correct_answer").after("<span class='error_msg text-danger'>please enter correct answer!</span>").focus();
                    return false;
                }
            }
            if($('#option_type').val() == 1){
                if($('#correct_answer1').val() ==''){
                    $("#correct_answer1").after("<span class='error_msg text-danger'>please enter correct answer!</span>").focus();
                    return false;
                }
            }
            
             for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
                }
            var url = site_url('admin/mock_test/form_validation_mock');
            var data = $("#frmMock").serialize();
            $.ajax({
                 url: url,
                processData:false,
              contentType:false,
              cache:false,
              async:false,
                type: 'POST',
                data: new FormData(this),
                success: function(theResponse) {
                    var obj = jQuery.parseJSON(theResponse);

                    if(obj.resultCode == 1) {
                        window.location = site_url('admin/mock_test');
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
        }
    });
    $validator = $("#frmupdateMock").validate({
        rules: {
            category:{required: true},
            subcategory: {required: true},
            exam_id: {required: true},
            question_type : {required: true},
            option_type:  {required: true},
            solution_type:{required: true},
            status: {required: true},
        },
        messages: {
            category: {required: "Please Select Category"},
            subcategory: {required: "Please Select SubCategory"},
            exam_id: {required: "Please Select Exam"},
            question_type: {required: "Please Select Question Type"},
            option_type:{required: "Please Select Question Type"},
            solution_type:{required: "Please Select Question Type"},
            status:{required: "Please Select Question Type"}
            
        }
    });
  
    $('#frmupdateMock').submit(function(e) {
        
        e.preventDefault();
        $('#ajax_error').html('');
        var $valid = $("#frmupdateMock").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
             if($('#option_type').val() == 0){
                if($('#correct_answer').val() ==''){
                    $("#correct_answer").after("<span class='error_msg text-danger'>please enter correct answer!</span>").focus();
                    return false;
                }
            }
            if($('#option_type').val() == 1){
                if($('#correct_answer1').val() ==''){
                    $("#correct_answer1").after("<span class='error_msg text-danger'>please enter correct answer!</span>").focus();
                    return false;
                }
            }
            for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
            }
            var url = site_url('admin/mock_test/update_mock');
            var data = $("#frmupdateMock").serialize();
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
                    window.location.back();
                    }
                    if (obj.resultCode == 0) {
                        $('#ajax_error').html(obj.resultMsg);
                    }
                }
            });
        }
    });
    });

 