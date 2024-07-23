<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-info">
               <div class="card-header">
                  <div class="row justify-content-between">
                  <div class="col-md-4 align-self-center">
                     <h3 class="card-title"><?= $sub_title ?></h3>
                  </div>
                  <div class="col-md-6 float-right d-flex justify-content-right ">
                     <form id="filter_form" class="form-inline" method="get" action="<?= base_url('admin/student') ?>">
                        <label for="filter_student" class="mr-2">Filter by:</label>
                        <select class="form-control w-auto mr-2" id="filter_student" name="filter">
                           <option selected disabled>Filter Students</option>
                           <option value="attended">Exam Attended Students</option>
                           <option value="not_attended">Exam Not Attended Students</option>
                           <option value="paid_students">Paid Students</option>
                           <option value="free_students">Free Students</option>
                        </select>
                        <button class="btn btn-success m-1" type="submit">
                           Apply
                        </button>
                        <button class="btn btn-danger m-1" type="button" onclick="resetForm()">Reset</button>


                     </form>
                  </div>
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th style="width: 10px" rowspan="3">S.no</th>
                              <th rowspan="2">Student Id</th>
                              <th rowspan="2">Name</th>
                              <th rowspan="2">Email</th>
                              <th rowspan="2">Mobile</th>
                              <th colspan="3" class="text-center"> Exams</th>
                              <th rowspan="2">College</th>
                              <th rowspan="2">City</th>
                              <th rowspan="2">Pincode</th>
                              <th rowspan="2">Status</th>
                              <th rowspan="2">Action</th>
                           </tr>
                           <tr>
                              <th>Total</th>
                              <th>Attended</th>
                              <th>Not Attended</th>
                           </tr>
                        </thead>
                        <tbody id="student_data">
                           <?php

                           if ($fetch_studentdata) {
                              $i = 1;

                              foreach ($fetch_studentdata as $row) {
                                 ?>

                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><a
                                          href="<?php echo base_url(); ?>admin/student/view_more/<?php echo $row['student_id']; ?>"><?php echo $row['student_id']; ?>
                                       </a> </td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td>
                                       <?= $this->student_model->get_student_exam_details($row['student_id'])['total_exams'] ?>
                                    </td>
                                    <td>
                                       <?= $this->student_model->get_student_exam_details($row['student_id'])['attended_exams'] ?>
                                    </td>
                                    <td>
                                       <?= $this->student_model->get_student_exam_details($row['student_id'])['not_attended_exams'] ?>
                                    </td>
                                    <td><?= $this->masters_model->college_name($row['college_id']); ?></td>
                                    <td><?= $this->masters_model->city_name($row['city_id']); ?></td>
                                    <td><?php echo $row['pincode']; ?></td>

                                    <?php if ($row['is_active'] == 0) { ?>
                                       <td>Pending</td>
                                    <?php } else if ($row['is_active'] == 1) { ?>
                                          <td>Approved </td>
                                    <?php } else { ?>
                                          <td> Rejected</td>
                                    <?php } ?>
                                    <td>
                                       <div class="btn-group btn-group-sm">
                                          <a
                                             href="<?php echo base_url(); ?>admin/student/view_more/<?php echo $row['student_id']; ?>">
                                             <i class="fas fa-eye"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <?php
                                 $i++;
                              }
                           } else {
                              ?>
                              <tr>
                                 <td colspan="13" align="center">No Data Found</td>
                              </tr>
                              <?php
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="card-footer">
                  <div class="card-tools">
                     <div id="pagination" class="pagination">
                        <div class="paging">
                           <?php echo $pagination ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>

<script>
   $(document).ready(function () {
      var filter = "<?= $this->input->get('filter') ?>";
      if (filter) {
         $('#filter_student').val(filter);
      }
   });
   function resetForm() {

      document.getElementById("filter_student").selectedIndex = 0;
      window.location.href = '/application_latest_3/admin/student'; // Reset dropdown to default

   }
</script>
<script src="<?= base_url('js/admin/student.js') ?>"></script>