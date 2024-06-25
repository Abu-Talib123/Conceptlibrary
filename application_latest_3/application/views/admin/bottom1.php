  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=base_url('assets/admin/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/admin/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/admin/dist/js/demo.js')?>"></script>
<!-- Summernote -->
<script src="<?=base_url('assets/admin/plugins/summernote/summernote-bs4.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/jquery-validation/additional-methods.min.js')?>"></script>

<script>
 function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
  function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    var allowComma = el.value.split(',');
    console.log(charCode)
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57 ) && charCode != 44 && charCode != 45) {
        return false;
    }
    //just one dot
    // if(number.length>1 && charCode == 46){
    //      return false;
    // }
    
    // //get the carat position
    // var caratPos = getSelectionStart(el);
    // var dotPos = el.value.indexOf(".");
    // if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
    //     return false;
    // }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
  if (o.createTextRange) {
    var r = document.selection.createRange().duplicate()
    r.moveEnd('character', o.value.length)
    if (r.text == '') return o.value.length
    return o.value.lastIndexOf(r.text)
  } else return o.selectionStart
}
</script>
<script>
   /* CKEDITOR.replace('steps', {
      extraPlugins: 'mathjax',
      mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
      height: 320
    });*/

    if (CKEDITOR.env.ie && CKEDITOR.env.version == 8) {
      document.getElementById('ie8-warning').className = 'tip alert';
    }
    //  CKEDITOR.replace('question', {
    //   extraPlugins: 'mathjax',
    //   mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
    //   height: 320
    // });

    if (CKEDITOR.env.ie && CKEDITOR.env.version == 8) {
      document.getElementById('ie8-warning').className = 'tip alert';
    }
  </script>

<?php if(isset($load_js) && $load_js == 'mock')
{?> <script src="<?=base_url('js/admin/mock.js')?>"></script>
<?php } ?>
<script>
function getsubcategory()
{
   if($('#category').val()!='')
    {
      $.post('<?php echo base_url(); ?>admin/mock_test/getsubcategory/'+$('#category').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#subcatoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}
function getexam()
{
   if($('#subcategory').val()!='')
    {
      $.post('<?php echo base_url(); ?>admin/mock_test/getexam/'+$('#subcategory').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#examoptiondata').html(splitdata[0]);
        }
      });
    }
}
  </script>
</body>
</html>
