<!-- loader -->
<div id="loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78" />
    </svg>
</div>


<script src="<?=base_url('assets/cl/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/jquery-ui.js')?>"></script>
<script src="<?=base_url('assets/cl/js/popper.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/owl.carousel.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/jquery.stellar.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/jquery.countdown.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/jquery.easing.1.3.js')?>"></script>
<script src="<?=base_url('assets/cl/js/aos.js')?>"></script>
<script src="<?=base_url('assets/cl/js/jquery.fancybox.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/jquery.sticky.js')?>"></script>
<script src="<?=base_url('assets/cl/js/jquery.mb.YTPlayer.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/main.js')?>"></script>
<script src="<?=base_url('assets/cl/js/calculator.js')?>"></script>
<script src="<?=base_url('assets/cl/js/jquery.validate.min.js')?>"></script>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/cl/js/sweetalert.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/video.js')?>"></script>
<script src="<?=base_url('assets/cl/js/videojs-overlay-hyperlink.js')?>"></script>

<?php if(isset($load_js) && $load_js == 'cart')
{?> <script src="<?=base_url('js/cart.js')?>"></script>
<?php } ?>
<?php if(isset($load_js) && $load_js == 'mock_test')
{?> <script src="<?=base_url('js/mock_test.js')?>"></script>
<link rel="stylesheet" href="<?=base_url('assets/cl/css/jquery.numpad.css')?>">
<script type="text/javascript" src="<?=base_url('assets/cl/js/jquery.numpad.js')?>"></script>
<script type="text/javascript">
			// Set NumPad defaults for jQuery mobile. 
			// These defaults will be applied to all NumPads within this document!
			$.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
			$.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
			$.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';
			$.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-default"></button>';
			$.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
			$.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-primary');};
			
			// Instantiate NumPad once the page is ready to be shown
			$(document).ready(function(){
			
				$('.txt_option').numpad({
					gridTpl: '<table class="table modal-content"></table>',
					hidePlusMinusButton: false,
					hideDecimalButton: false,
					decimalSeparator :'.'
				});
			
			});
		</script>
		<style type="text/css">
			.nmpd-grid {border: none; padding: 20px;}
			.nmpd-grid>tbody>tr>td {border: none;}
			
			/* Some custom styling for Bootstrap */
			.qtyInput {display: block;
			  width: 100%;
			  padding: 6px 12px;
			  color: #555;
			  background-color: white;
			  border: 1px solid #ccc;
			  border-radius: 4px;
			  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
			  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
			  -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
			  -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			  transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			}
		</style>
<?php } ?>

</body>
<script>
$(".link").click(function(e) {
    var target = $(this).attr('rel');   
    $("#"+target).show().siblings("div").hide();
    $("#menu").show();
   
    if($(this).children('span').attr('class') == 'not_visited') {
        $(this).children('span').addClass("not_answered");
       var unanswered =  parseInt($('#unanswered').text())+1;
       $('#unanswered').html(unanswered);
        $(this).children('span').removeClass("not_visited");
    }
    
    var i = 0;
    if($('.link .not_visited')[0]){
    $('.link .not_visited').each(function(index){
        i++;
         $('#notvisited').html(i);
          unans++;
        
    });
    }else{
      $('#notvisited').html(i);
    }
    var unans = 0;
    
      $('.link .not_answered').each(function(index){
          unans++;
          console.log(unans)
          $('#unanswered').html(unans);
          
      });
    
    return false;
});
</script>
 <script>
    (function(window, videojs) {
      var player = window.player = videojs('videojs-overlay-player');
      var video_data = $('#student_detail').val()
      player.overlay({
        content: video_data,
        debug: true,
        overlays: [{
          start: 0,
          end: 15,
          align: 'bottom-left'
        }, {
          start: 15,
          end: 30,
          align: 'bottom'
        }, {
          start: 30,
          end: 45,
          align: 'bottom-right'
        }]
      });
    }(window, window.videojs));
  </script>
<!--sticky navbar-->
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
<script>


function getsubcategory()
{
   if($('#category').val()!='')
    {
      $.post('<?php echo base_url(); ?>profile/getsubcategory/'+$('#category').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#subcatoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}
function getcollege()
{
   if($('#university').val()!='')
    {
      $.post('<?php echo base_url(); ?>profile/getcollege/'+$('#university').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#universityoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}		
function getstate()
{
   if($('#country').val()!='')
    {
      $.post('<?php echo base_url(); ?>profile/getstate/'+$('#country').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#stateoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}
function getcity()
{
   if($('#state').val()!='')
    {
      $.post('<?php echo base_url(); ?>profile/getcity/'+$('#state').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#cityoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}
function video_conversion(filename) {
    
    var username = '<?=$this->session->userdata('CL_STUDENT_USERNAME')?>';
   $('#downloadBtn').attr('disabled', true);
   var data = { a:username, video_file_name:filename };
   
   $.ajax('http://conceptlibrary.in:3000/video/watermark', {
    type: 'GET',  // http method
    async: false,
    cache: false,
    data: data,  // data to submit
    success: function (data, status, xhr) {
        console.log(data);return false;
    },
    error: function (jqXhr, textStatus, errorMessage) {
            console.log(errorMessage);return false;
    }
    });

    
         
}
</script>
<script language="JavaScript">

//        window.onload = function () {
//            document.addEventListener("contextmenu", function (e) {
//                e.preventDefault();
//            }, false);
//            document.addEventListener("keydown", function (e) {
//                //document.onkeydown = function(e) {
//                // "I" key
//                if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
//                    disabledEvent(e);
//                }
//                // "J" key
//                if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
//                    disabledEvent(e);
//                }
//                // "S" key + macOS
//                if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
//                    disabledEvent(e);
//                }
//                // "U" key
//                if (e.ctrlKey && e.keyCode == 85) {
//                    disabledEvent(e);
//                }
//                // "F12" key
//                if (event.keyCode == 123) {
//                    disabledEvent(e);
//                }
//            }, false);
//            function disabledEvent(e) {
//                if (e.stopPropagation) {
//                    e.stopPropagation();
//                } else if (window.event) {
//                    window.event.cancelBubble = true;
//                }
//                e.preventDefault();
//                return false;
//            }
//        }
// //edit: removed ";" from last "}" because of javascript error
// //Disable full page
//     $('body').bind('cut copy paste', function (e) {
//         e.preventDefault();
//     });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script>
</html>