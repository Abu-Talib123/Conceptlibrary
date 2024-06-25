</div>
<script>
function getsubcategory()
{
   if($('#category').val()!='')
    {
      $.post('<?php echo base_url(); ?>admin/masters/getsubcategory/'+$('#category').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#subcatoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}
/*function getdomain()
{
   if($('#subcategory').val()!='')
    {
      $.post('<?php echo base_url(); ?>admin/masters/getdomain/'+$('#subcategory').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#domainoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}*/
function getcollege()
{
   if($('#university').val()!='')
    {
      $.post('<?php echo base_url(); ?>admin/masters/getcollege/'+$('#university').val(), function(data) {
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
      $.post('<?php echo base_url(); ?>admin/masters/getstate/'+$('#country').val(), function(data) {
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
      $.post('<?php echo base_url(); ?>admin/masters/getcity/'+$('#state').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#cityoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}
/*function update_status()
{
   var student_id = document.getElementById("student_id").value;
   if($('#is_active').val()!='')
    {
      $.post('<?php echo base_url(); ?>admin/student/update_student/'+$('#is_active').val()+'/'+student_id, function(data) {
        if(data!='')
        {
          var result= jQuery.parseJSON(data); 
        }
      });
    }
}*/

</script>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="<?=base_url('assets/admin/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/select2/js/select2.min.js')?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url('assets/admin/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!--<script src="<?=base_url('assets/admin/plugins/jquery/jquery-migrate-1.2.1.min.js')?>"></script>-->
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script src="<?=base_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- DataTables -->
<script src="<?=base_url('assets/admin/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- ChartJS -->
<script src="<?=base_url('assets/admin/plugins/chart.js/Chart.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?=base_url('assets/admin/plugins/sparklines/sparkline.js')?>"></script>
<!-- JQVMap -->
<script src="<?=base_url('assets/admin/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url('assets/admin/plugins/jquery-knob/jquery.knob.min.js')?>"></script>
<!-- daterangepicker -->
<script src="<?=base_url('assets/admin/plugins/moment/moment.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/summernote/summernote-bs4.min.js')?>"></script>

<!-- overlayScrollbars -->
<script src="<?=base_url('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/admin/dist/js/adminlte.js')?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url('assets/admin/dist/js/pages/dashboard.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/admin/dist/js/demo.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/jquery-validation/additional-methods.min.js')?>"></script>

<script>
  $(function () {
    // Summernote
    if($(".textarea").length > 0){
      $('.textarea').summernote();
    }
  });
  
</script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
  $("#startdate").datepicker({
     dateFormat: 'yy/mm/dd'
  });
  $("#enddate").datepicker({
     dateFormat: 'yy/mm/dd'
  });
  </script>
<?php if($this->uri->segment(2) == 'exam' || $this->uri->segment(3) == 'exam') { ?>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<script src="<?=base_url('assets/admin/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<script type='text/javascript' src="<?=base_url('js/admin/add_exam.js')?>"></script>

<script type='text/javascript'>

  $(window).load(function(){
    $("#exam_duration").inputmask("99:99:99");
  });

</script>
<?php } ?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
