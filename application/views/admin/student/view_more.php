<section class="content">
  <div class="container-fluid">
    <div class="row">

      <?php
      if ($student_data) {
        foreach ($student_data as $row) {
          ?>
          <div class="col-12">

            <div id="ajax_error" class="ajax_error" align="center"></div>
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row justify-content-between py-2">
                <div class="col-lg-6 col-md-6">
                  <h4>
                    <i class="fas fa-globe"></i> <?= $row['username']; ?>
                  </h4>
                  <div class="row invoice-info">
                    <div class="col-sm-4 col-lg-12 invoice-col">
                      <strong><?= $row['student_id']; ?></strong>
                      <?php if (isset($row['address']) && $row['address'] != '') { ?>
                        <address>
                          <br>
                          <?= $row['address']; ?>, <br>
                          <?= $this->masters_model->city_name($row['city_id']); ?>       <?= $row['pincode']; ?><br>
                          <?= $this->masters_model->state_name($row['state_id']); ?>,
                          <?= $this->masters_model->country_name($row['country_id']); ?><br>
                          Phone: <?= $row['mobile']; ?><br>
                          Email: <?= $row['email']; ?>
                        </address>
                      <?php } else { ?>
                        <address>
                          <br>
                          Phone: <?= $row['mobile']; ?><br>
                          Email: <?= $row['email']; ?>
                        </address>
                      <?php } ?>
                    </div>
                    <!-- /.col -->
                    <?php if (isset($row['address']) && $row['address'] != '') { ?>
                      <div class="col-sm-4 invoice-col">
                        <b>Registration Id:</b> <?= $row['registration_id']; ?><br>
                        <b>College:</b> <?= $this->masters_model->college_name($row['college_id']); ?><br>
                        <b>University:</b><?= $this->masters_model->university_name($row['university_id']); ?><br>
                      </div>
                    <?php } else { ?>
                      <div class="col-sm-4 invoice-col">
                      </div>
                    <?php } ?>
                    <!-- /.col -->
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <p class='font-weight-bold fs-3 text-right'>Date:
                    <?= date(" Y-m-d g:ia", strtotime($row['created_at'])); ?></p>
                  <div class="profile_image position-relative">
                    <?php if ($row['student_photo']): ?>
                      <img width="auto" height="150" align="absmiddle" id="uploadImage" class="profile-img float-right"
                        src="<?= $row['student_photo'] ?>" />
                      <input type="file" class="form-control" id="fileInput" name="profile_img_file" style="display: none;">
                    <?php else: ?>
                      <img width="auto" height="150" align="absmiddle" id="uploadImage" class="profile-img float-right"
                        src="<?= base_url('assets/cl/images/user_pic.png') ?>" />
                      <input type="file" class="form-control" id="fileInput" name="profile_img_file" style="display: none;">
                    <?php endif; ?>

                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>S.no</th>
                        <th>Category</th>
                        <th>SubCategory</th>
                        <th>Aadhar No</th>
                        <th>Aadhar File</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php if (isset($row['address']) && $row['address'] != '') { ?>
                          <td>1</td>
                          <td><?= $this->masters_model->category_name($row['category_id']); ?></td>
                          <td><?= $this->masters_model->subcategory_name($row['subcategory_id']); ?></td>
                          <td><?= $row['aadhar_no']; ?></td>
                          <td><a href="<?= $row['aadhar_link']; ?>" target="_blank">
                              <image src="<?= $row['aadhar_link']; ?>" style="height:50px;width:50px;">
                            </a></td>

                        <?php } else { ?>
                          <td colspan="5">
                          </td>
                        <?php } ?>
                        <td> <select class="form-control" name="is_active" id="is_active">
                            <option value="0" <?php echo ($row['is_active'] == '0') ? 'selected' : '' ?>>Pending</option>
                            <option value="1" <?php echo ($row['is_active'] == '1') ? 'selected' : '' ?>>Approve</option>
                            <option value="2" <?php echo ($row['is_active'] == '2') ? 'selected' : '' ?>>Reject</option>

                          </select></td>

                        <td>
                          <div class="btn-group btn-group-sm">
                            <a href="<?php echo base_url(); ?>admin/Student/edit_student/<?php echo $row['student_id']; ?>"
                              class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" class="btn btn-danger delete_student" id="<?php echo $row['student_id']; ?>"><i
                                class="fas fa-trash"></i></a>
                          </div>
                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                  <div class="btn-group btn-group-sm">
                    <a href="#" id="backToStdDtls" onclick="window.history.back();" class="btn btn-info">Back</a>
                  </div>
                </div>
                <div class="col-md-4">
                </div>
              </div>
              <!-- /.row -->

            </div>
            <input type="hidden" name="student_id" id="student_id" value="<?= $row['student_id']; ?>">


            <!-- /.invoice -->
          </div><!-- /.col -->
          <?php

        }
      } ?>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<script src="<?= base_url('js/admin/student.js') ?>"></script>