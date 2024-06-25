<style type="text/css">  
.select2-container--default .select2-selection--single{
  padding: 0px !important;
}
</style>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-info">
               <div class="card-header">
                  <div class="col-md-6">
                     <h3 class="card-title"><?=$sub_title?></h3>
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <label class="col-md-3" >Select Student</label>
                  <div class="form-group row " >
                     <div class="col-md-6" >
                        <select class="form-control" id="student_select" ></select>
                     </div>
                     <div class="col-md-2" >
                        <button class="btn btn-success" onclick="getStudentExamDetails($('#student_select').val());" >
                           <i class="fas fa-eye" ></i> View History
                        </button>
                     </div>
                  </div>
                  <div id="student_exam_history_result" >
                     
                  </div>
               </div>
              <div class="card-footer">
               <div class="card-tools">
                </div>
            </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
<script src="<?=base_url('js/admin/student.js')?>"></script>