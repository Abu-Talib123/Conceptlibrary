<style type="text/css">
   .pull-right{
      float:right;
   }
   .dataTables_wrapper .row:nth-child(1) div:nth-child(2){
   text-align: right;
}
</style>
<?php
$total_exams = $this->student_model->getTotalExamCounts();
$attended_exams = $this->student_model->getTotalStudentAttendedExams($student_id);
?>
<hr>
<div class="contianer-fluid" >
   <div class="row" >
      <span class="h4 text-center text-info text-bold col-md-4 " > Student Id : <?=$student_id?></span>
      <span class=" text-success h4 text-center text-bold col-md-4 ">Attented Exams: <?=$attended_exams?></span>
      <span class=" text-danger h4 text-center text-bold col-md-4 ">Not Attented Exams: <?=($total_exams-$attended_exams)?></span>
   </div>
   <table class="table" style="width:100%" >
      <thead class="bg-dark" >
         <tr>
            <th>S.No</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Exam Name</th>
            <th>Status</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         if($exams)
         {
            foreach ($exams as $key => $exam)
            {
               $is_attend = $this->student_model->checkStudentExamStatusById($student_id, $exam->exam_id);
            ?>
            <tr>
               <td><?=($key+1)?></td>
               <td><?=($exam->category_name)?></td>
               <td><?=($exam->subcategory_name)?></td>
               <td><?=($exam->exam_name)?></td>
               <td class='status' >
               <?php
                  if($is_attend)
                  {
                     ?>
                     <span class="badge badge-success" >Attended</span>
                     <?php
                  }
                  else
                  {
                     ?>
                     <span class="badge badge-danger" >Not Attended</span>
                     <?php
                  }
               ?>
               </td>

               <td style="white-space: nowrap; " >
               <?php
                  if($is_attend)
                  {
                     ?>
                        <button class="btn btn-danger" onclick="deleteStudentExamHistory(this, '<?=$student_id?>', '<?=$exam->exam_id?>');" ><i class="fas fa-trash" ></i> Clear History</button></td>
                     <?php
                  }
                  ?>
            </tr>
            <?php
            }
         }
         ?>
      </tbody>
   </table>
</div>

<script type="text/javascript">
   $("table").DataTable( {
    paging: true,
    autoWidth: true,
} );
</script>