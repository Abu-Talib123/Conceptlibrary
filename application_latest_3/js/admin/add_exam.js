$(document).ready(function () {  
   $validator = $("#frmExam").validate({
        rules: {
            category:{required: true},
            subcategory: {required: true},
            exam_name: {required: true},
            exam_duration : {required: true},
           
            startdate:{required: true},
            enddate: {required: true}
            
        },
        messages: {
            category: {required: "Please Select Category"},
            subcategory: {required: "Please Select SubCategory"},
            exam_name: {required: "Please Enter Exam"},
            exam_duration: {required: "Please Enter exam duration"},
            
            startdate:{required: "Please enter start date"},
            enddate:{required: "Please enter end date"}
            
            
        }
    });
   
    $('#btnSave').click(function(e) {
        e.preventDefault();
        $('#ajax_error').html('');
        var $valid = $("#frmExam").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
            $('#btnSave').attr('disalbed', true);
            $("#frmExam")[0].submit();
        }
    });
    $validator = $("#frmExam").validate({
        rules: {
            category:{required: true},
            subcategory: {required: true},
            exam_name: {required: true},
            exam_duration : {required: true},
             preview_file: {required: true},
           
            startdate:{required: true},
            enddate: {required: true}
           
        },
        messages: {
            category: {required: "Please Select Category"},
            subcategory: {required: "Please Select SubCategory"},
            exam_name: {required: "Please Enter Exam"},
            exam_duration: {required: "Please Enter exam duration"},
             preview_file:{required: "Please select the preview file"},
            
            startdate:{required: "Please enter start date"},
            enddate:{required: "Please enter end date"}
           
            
        }
    });
  
    $('#btnUpdate').click(function(e) {
        e.preventDefault();
        $('#ajax_error').html('');
        var $valid = $("#frmExam").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        } else {
            $("#frmExam")[0].submit();
        }
    });
    });

 