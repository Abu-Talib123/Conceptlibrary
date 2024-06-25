$(document).ready(function () { 

    var url = window.location.href;
    
    var pathname = new URL(url).pathname;
    
    var urlData = pathname.split('/');



   if ($.cookie('pop') == null || $.cookie('pop') == 'undefined') {
         var html   = '';
         $("#myModal").html(html);
         $.cookie('pop', '1');
     }
     var count = 1;
     var unanswered = parseInt($('#question_count').val());
     localStorage.setItem("notVisitedCount", unanswered-1)
      
      //get_updated_question_count();

      var exam_id = $('#exam_id').val();
      var is_written_already = $('#is_written_already').val();
      let exam_duration = $("#exam_duration").val();
      var student_id = $('#student_id').val();

        if(localStorage.getItem("examid")== null) {
            localStorage.setItem("examid", $('#exam_id').val());
            localStorage.setItem("student_id", $('#student_id').val());
            localStorage.setItem("exam_duration", $('#exam_duration').val());
        }
        else
        {
          $.ajax({
            url: site_url('mockpaper/get_student_answers_count'),
            type: 'POST',
            data:{exam_id:exam_id, student_id:student_id},
            dataType: 'html',
            'async': false,
            success: function(count){   
              count = parseInt(count);
              if(count>0)
              {
                swal("You already attend this exam. If you want start again please ask to the admin. Otherwise continue with the remaining time!",{
                   buttons: [false, "Click to Continue"],
                   icon: "warning",
                });                
              }
              else
              {
                localStorage.setItem("exam_duration", $('#exam_duration').val());
                clearTimer();
              }
            }
          });          
        }

        var duration = localStorage.getItem("exam_duration").toString();
        var durationCondition = duration.localeCompare(exam_duration.toString());
        
        var stu_id = localStorage.getItem("student_id").toString();
        var stuCondition = stu_id.localeCompare(student_id.toString());
        
        var ex_id = localStorage.getItem("examid").toString();
        var examCondition = ex_id.localeCompare(exam_id.toString());
        
        if(localStorage.getItem("exam_duration")== null || durationCondition != 0) {
             localStorage.setItem("exam_duration", $('#exam_duration').val());
        }
        if(stuCondition != 0 || examCondition != 0 || (is_written_already > 0 && durationCondition != 0)) {
            clearTimer();
        }
        
        
            
        
      $.ajax({
        url: site_url('mockpaper/get_exam_count'),
        type: 'POST',
        data:{exam_id:exam_id},
        dataType: 'json',
              success: function(json){   
                var counter = 1;
                var notvisit = json - 1;
                $('.option').click(function(){
                  val1 = counter++;
                  val3 = notvisit--;
                  //$('#answered').html(val1);
                  counts = parseInt(json) - parseInt(val1);
                  unans = parseInt(val1) - parseInt(json);
                
                });
           }
      });


    //   $('#btnSubmit').click(function(e) {
    //     e.preventDefault();
    //       var data = $('#frm_mock').serializeArray();
    //       console.log(data);
    //       var url = site_url('mockpaper/updatedata');
    //         $.ajax({
    //             url: url,
    //             type: 'POST',
    //             data: data,
    //             success: function(theResponse) {
    //               console.log(theResponse);
    //               var response= jQuery.parseJSON(theResponse);
    //               var examid  = response.exam_id;
    //             //     $("#mocksection").hide();
    //             //     $("#container1").hide();
    //             //     $("#tab-content").hide();
    //             //     $("#resultSection").show();
    //             //     var html   = '';

    //             //     html +='<table border="2" bordercolor="#0094FE" class = "table">'+
    //             //     '<thead>'+
    //             //     '<tr>'+
    //             //     '<th style="text-align: center">Total Questions </th>'+
    //             //     '<th style="text-align: center" > Correct Answer </th>'+
    //             //     '<th style="text-align: center"> Wrong Answer</th>'+
    //             //     '<th style="text-align: center"> UnAnswered  </th>'+
    //             //     '</tr>'+
    //             //     '</thead>'+
    //             //     '<tbody>';
    //             //     console.log(response.length);

    //             //     html +=
    //             //     '<tr>'+
    //             //   '<td style="text-align: center"> '+response.questioncount+' </td>'+
    //             //     '<td style="text-align: center"> '+response.right_answer +'  </td>'+
    //             //     '<td style="text-align: center"> '+response.wrong_answer+'  </td>'+
    //             //     '<td style="text-align: center"> '+response.unanswered+'  </td>'+
    //             //     '</tr>';
                  

    //             //     html += '</tbody>'+
    //             //     '</table>';

    //             //     $("#content").html(html);
    //               // $("#myModal").modal('show');
                   
    //               window.location = site_url('mockpaper/studenthistorydata/'+examid);
                   
    //                 //$('#ajax_error').html(obj.data);
    //             }
    //         });
    //   });


    var interval;
    if(typeof localStorage.getItem("min") !== 'undefined' && typeof localStorage.getItem("sec") !== 'undefined' &&  typeof localStorage.getItem("sec") !== 'NaN' && localStorage.getItem("min")!= null && localStorage.getItem("sec")!= null)
    {
      
       var minutes = localStorage.getItem("min");
       var seconds = localStorage.getItem("sec");
       console.log('minutes',minutes)
       
    }else {
          
           if(seconds < 10){
            seconds= "0"+ seconds ;
            }if(minutes < 10){
                minutes= "0"+ minutes ;
            }
    }
    let hours =document.getElementById("exam_hour").value;
    let minute =document.getElementById("exam_minute").value;
    let second =document.getElementById("exam_second").value;
    if(typeof localStorage.getItem("min") !== 'undefined' && typeof localStorage.getItem("sec") !== 'undefined' &&  typeof localStorage.getItem("sec") !== 'NaN' &&  localStorage.getItem("hour") !== 'undefined' && localStorage.getItem("min")!= null && localStorage.getItem("sec")!= null && localStorage.getItem("hour")!= null)
    {
       var hour = localStorage.getItem("hour");
       var min = localStorage.getItem("min");
       var sec = localStorage.getItem("sec");
    }
    else {

          var hour = hours;
          var min = minute;
          var sec = second;
        
           if(hour < 10)
           {
             hour="0"+hour;
           }

           if(min < 10)
           {
            min="0"+min;

           }
           if(sec < 10)
           {
            sec="0"+sec;
           }
    }
        setInterval(function()
        {
            localStorage.setItem("hour", hour);
            localStorage.setItem("min", min);
            localStorage.setItem("sec", sec);
            var timevalue= hour+" : "+ min +" : "+ sec;
            document.getElementById("countdown").innerHTML = timevalue ;
            if(parseInt(sec) == 0)
            {
                if(parseInt(min) !=0)
                {
                    min--;
                    sec=59;
                    if(parseInt(min) < 10)
                    {
                        min="0"+min;
                    }
                }else{
                    if(parseInt(hour) !=0){
                        hour--;
                        min=60;
                        if(parseInt(hour) < 10)
                        {
                          hour="0"+hour;
                        }
                    }
                }
                
                // remove localstorage
                if(hour == 00 && min == 00 && sec == 00){
                    localStorage.removeItem("hour");
                    localStorage.removeItem("min");
                    localStorage.removeItem("sec");
                    document.getElementById('frm_mock').submit();
                }
            }
            else
            {
                sec--;
                if(parseInt(sec) < 10)
                {
                    sec="0"+sec;
                }
            }
        },1000);

    });

function savenxtfn(
  questionid,
  is_marked = 0,
  selectedDiv = 1,
  option_type = 0
) {
  // Get all the inputs.
  var inputs = frm_mock.elements;
  var radios = [];
  var optiondata = new Array();
  option = 0;
  if (option_type == 0) {
    var radioValue = $(
      "input[name='option_1[" + questionid + "]']:checked"
    ).val();
  } else if (option_type == 2) {
    var radioValue = [];
    $.each(
      $("input[name='option_1[" + questionid + "]']:checked"),
      function (index) {
        radioValue.push(this.value);
      }
    );
  } else {
    var radioValue = $("input[name='option_1[" + questionid + "]']").val();
  }
  if (radioValue == undefined || radioValue == '') {
    radioValue = 'CL';
  }

  console.log(
    $('#question_a_' + questionid)
      .next()
      .children('span')
      .attr('class')
  );
  if (
    $('#question_a_' + questionid)
      .next()
      .children('span')
      .attr('class') == 'not_visited'
  ) {
    $('#question_a_' + questionid)
      .next()
      .children('span')
      .addClass('not_answered');
    $('#question_a_' + questionid)
      .next()
      .children('span')
      .removeClass('not_visited');
  }
  if (is_marked == 1) {
    $('#question_a_' + questionid)
      .children('span')
      .removeClass('answered')
      .removeClass('not_answered');
    $('#question_a_' + questionid)
      .children('span')
      .addClass('review');
  } else {
    if (
      $('#question_a_' + questionid)
        .children('span')
        .attr('class') == 'not_answered'
    ) {
      if (radioValue != 'CL') {
        $('#question_a_' + questionid)
          .children('span')
          .addClass('answered');
        $('#question_a_' + questionid)
          .children('span')
          .removeClass('not_answered');
      }
    } else {
      if (
        $('#question_a_' + questionid)
          .children('span')
          .attr('class') == 'review'
      ) {
        $('#question_a_' + questionid)
          .children('span')
          .addClass('answered');
        $('#question_a_' + questionid)
          .children('span')
          .removeClass('review');
      }
    }
  }

  var collection = {
    student_id: $('#student_id').val(),
    exam_id: $('#exam_id').val(),
    question_id: questionid,
    option: radioValue,
    is_marked: is_marked,
  };

  var url = site_url('mockpaper/up_studentdata');
  $.ajax({
    type: 'POST',
    url: url,
    data: { collection: collection },
    cache: false,

    success: function (response) {
      get_updated_question_count();

      var response = jQuery.parseJSON(response);
      var question_count = response.questioncount;
      var unanswered = response.unanswered;
      var total_count = $('#question_count').val();
      $('.questions_div').hide();
      var divSelectedId = parseInt(selectedDiv) + 1;

      $('.question_div_' + divSelectedId).show();
    },
  });
}

function mockpaperSubmit(questionid, is_marked = 0, selectedDiv = 1, option_type = 0){
        var option = 0;
        //console.log($('#frm_mock').serializeArray()); return false;
       if(option_type == 0){
          var radioValue = $("input[name='option_1["+questionid+"]']:checked"). val(); 
       } else if(option_type == 2){
          
          var radioValue = [];
          $.each($("input[name='option_1["+questionid+"]']:checked"), function(){
            radioValue.push(this.value);
          });
          radioValue = radioValue.join(',');

       } else{
           var radioValue = $("input[name='option_1["+questionid+"]']"). val(); 
       }
       if(radioValue == undefined || radioValue =='') {
           radioValue = 'CL';
       }

       var collection = {
             'student_id' : $('#student_id').val(),
             'exam_id'    : $('#exam_id').val(),
             'question_id': questionid,
             'option'     : radioValue,
             'is_marked': is_marked
             };
   
        var url = site_url('mockpaper/up_studentdata');
         $.ajax({ 
           type: 'POST',
           url: url,
           data: {collection : collection},
           cache: false,
   
           success: function(response)
           {
             $('#frm_mock')[0].submit();
           }
       });
    
}
function get_updated_question_count() {

    var exam_id = $('#exam_id').val();   
      $.ajax({
        url: site_url('mockpaper/get_updated_question_count'),
        type: 'POST',
        data:{exam_id:exam_id},
        dataType: 'json',
              success: function(json){   
                
                //var obj = $.parseJSON(json);
                $('#answered').html(json.answered);                 
                $('#markedforreview').html(json.mark_for_review);
               
                var unans = 0;
                $('.link .not_answered').each(function(index){
                    unans++;
                    console.log('unans', unans)
                    $('#unanswered').html(unans);
                    
                });
                var i = 0;
                if($('.link .not_visited')[0]){
                  $('.link .not_visited').each(function(index){
                      i++;
                      $('#notvisited').html(i);
                      
                  });
                }else{
                  $('#notvisited').html(i);
                }
              
           }
      });
}

function clearTimer() {
    localStorage.removeItem("hour");
    localStorage.removeItem("min");
    localStorage.removeItem("sec");
    localStorage.setItem("examid", $('#exam_id').val())
    localStorage.setItem("student_id", $('#student_id').val())
}

function clearfn($this, question_id) {
  let parent = $($this).parents('.questions_div');
  var collection = {
    student_id: $('#student_id').val(),
    exam_id: $('#exam_id').val(),
    question_id: question_id,
    remove: true,
  };

  var url = site_url('mockpaper/up_studentdata');
  $.ajax({
    type: 'POST',
    url: url,
    data: { collection: collection },
    cache: false,

    success: function (response) {
      get_updated_question_count();

      $(parent).find('input.option').prop('checked', false);
      $(parent).find('input.txt_option').val('');
      $('#question_a_' + question_id + ' span').removeAttr('class');
      $('#question_a_' + question_id + ' span').attr('class', 'not_visited');
    },
  });
}

$(document).ready(function () {
  $('.questions_div').hide();
  $('#' + $('a span.not_answered:first-child').parents('a').prop('rel')).show();
});




