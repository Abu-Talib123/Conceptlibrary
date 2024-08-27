<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">

   <!-- Brand Logo -->

   <a href="" class="brand-link">

      <!-- <img src="<?= base_url('assets/admin/dist/img/logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"

      style="opacity: .8"> -->

      <span class="brand-text font-weight-light"><b><img src="<?= base_url('assets/cl/images/logo.png') ?>" width="50%"
               height="100%" alt=""></b></span>

   </a>

   <!-- Sidebar -->

   <div class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">

         <div class="image">

            <img src="<?= base_url('assets/admin/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">

         </div>

         <div class="info">

            <a href="#" class="d-block"> <?= $this->session->userdata('AV_ADMIN_USERNAME'); ?></a>

         </div>

      </div> -->

      <!-- Sidebar Menu -->

      <nav class="mt-2 pb-5">

         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">

               <a href="<?= base_url('admin/home') ?>" class="nav-link <?php if ($sub_title == 'home') {
                    echo 'active';
                 } ?>">

                  <i class="nav-icon fas fa-tachometer-alt"></i>

                  <p>Dashboard</p>

               </a>

            </li>
            <li class="nav-item has-treeview">

               <a href="#" class="nav-link <?php if ($page_title == 'Blog') {
                  echo 'active';
               } ?>">

                  <i class="nav-icon far fa-newspaper"></i>

                  <p>Blog<i class="fas fa-angle-left right"></i></p>

               </a>

               <ul class="nav nav-treeview ml-2">

                  <li class="nav-item">

                     <a href="<?= base_url('admin/blog') ?>" class="nav-link <?php if ($sub_title == 'Posts') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-pen nav-icon"></i>

                        <p>Posts</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/blog/view_categories') ?>" class="nav-link  <?php if ($sub_title == 'Categories') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-tag nav-icon"></i>

                        <p>Categories</p>

                     </a>

                  </li>
               </ul>

            </li>


            <li class="nav-item has-treeview">

               <a href="#" class="nav-link <?php if ($page_title == 'Masters') {
                  echo 'active';
               } ?>">

                  <i class="nav-icon fas fa-lightbulb"></i>

                  <p>Masters<i class="fas fa-angle-left right"></i></p>

               </a>

               <ul class="nav nav-treeview ml-2">

                  <li class="nav-item">

                     <a href="<?= base_url('admin/masters') ?>" class="nav-link <?php if ($sub_title == 'Category') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-tasks nav-icon"></i>

                        <p>Entrance Exam</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/masters/view_subcategory') ?>" class="nav-link  <?php if ($sub_title == 'Sub Category') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-book nav-icon"></i>

                        <p>Subject</p>

                     </a>

                  </li>

                  <!--  <li class="nav-item">

                     <a href="<?= base_url('admin/masters/view_domain') ?>" class="nav-link  <?php if ($sub_title == 'Domain') {
                          echo 'active';
                       } ?>">

                        <i class="far fa-circle nav-icon"></i>

                        <p>Domain</p>

                     </a>

                  </li>  -->

                  <li class="nav-item">

                     <a href="<?= base_url('admin/masters/view_university') ?>" class="nav-link <?php if ($sub_title == 'University') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-university nav-icon"></i>

                        <p>University</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/masters/view_college') ?>" class="nav-link <?php if ($sub_title == 'College') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-building nav-icon"></i>

                        <p>Colleges</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/masters/view_country') ?>" class="nav-link <?php if ($sub_title == 'Country') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-flag nav-icon"></i>

                        <p>Country</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/masters/view_state') ?>" class="nav-link <?php if ($sub_title == 'State') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-compass nav-icon"></i>

                        <p>State</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/masters/view_city') ?>" class="nav-link <?php if ($sub_title == 'City') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-city nav-icon"></i>

                        <p>City</p>

                     </a>

                  </li>

               </ul>

            </li>

            <li class="nav-item">

               <a href="<?= base_url('admin/video') ?>" class="nav-link <?php if ($page_title == 'Video') {
                    echo 'active';
                 } ?>">

                  <i class="nav-icon fas fa-video"></i>

                  <p>Videos</p>

               </a>

            </li>

            <li class="nav-item has-treeview menu-open">

               <a href="#" class="nav-link <?php if ($page_title == 'Exam' || $page_title == 'Mock Test') {
                  echo 'active';
               } ?>">

                  <i class="nav-icon fas fa-copy"></i>

                  <p>Mock Test<i class="fas fa-angle-left right"></i></p>

               </a>

               <ul class="nav nav-treeview ml-2">

                  <li class="nav-item">

                     <a href="<?= base_url('admin/exam') ?>" class="nav-link <?php if ($page_title == 'Exam Details') {
                          echo 'active';
                       } ?>">

                        <i class="far fa-file nav-icon"></i>

                        <p style="color:greenyellow">View All Papers</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/exam/add_exam') ?>" class="nav-link <?php if ($page_title == 'Exam') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-plus-circle nav-icon"></i>

                        <p style="color:orangered">Add New Mock</p>

                     </a>

                  </li>

               </ul>

               <ul class="nav nav-treeview ml-2">

                  <li class="nav-item">

                     <a href="<?= base_url('admin/mock_test') ?>" class="nav-link <?php if ($page_title == 'Mock Test') {
                          echo 'active';
                       } ?>">

                        <i class="far fa-question-circle nav-icon"></i>

                        <p style="color:yellow">View All Questions</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/mock_test/add_coursemock') ?>" class="nav-link <?php if ($page_title == 'Mock Details') {
                          echo 'active';
                       } ?>">

                        <i class="fas fa-plus-circle nav-icon"></i>

                        <p style="color:deepskyblue">Add Question</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/mock_test/csv_upload') ?>" class="nav-link <?php if ($page_title == 'Mock_Details') {
                          echo 'active';
                       } ?>">

                        <i class="far fa-file-alt nav-icon"></i>

                        <p>Create Mock Test CSV</p>

                     </a>

                  </li>

               </ul>

            </li>

            <li class="nav-item has-treeview">

               <a href="#" class="nav-link">

                  <i class="fas fa-users mr-1"></i>

                  <p>

                     Students

                     <i class="fas fa-angle-left right"></i>

                  </p>

               </a>

               <ul class="nav nav-treeview ml-2">

                  <li class="nav-item">

                     <a href="<?= base_url('admin/student') ?>" class="nav-link">

                        <i class="fas fa-user-graduate mr-1"></i> 

                        <p>View Students</p>

                     </a>

                  </li>

                  <li class="nav-item">

                     <a href="<?= base_url('admin/student/history') ?>" class="nav-link">

                        <i class="fas fa-history mr-1"></i>

                        <p>Student History</p>

                     </a>

                  </li>
                  <li class="nav-item">

                     <a href="<?= base_url('admin/result') ?>" class="nav-link">

                        <i class="fas fa-poll mr-1"></i>

                        <p>Results</p>

                     </a>

                  </li>

               </ul>

            </li>

            <li class="nav-item">

               <a href="<?= base_url('admin/payment') ?>" class="nav-link <?php if ($sub_title == 'Payment') {
                    echo 'active';
                 } ?>">

                  <i class="nav-icon fas fa-receipt"></i>

                  <p>Payment Report</p>

               </a>

            </li>

            <li class="nav-header py-0">Settings</li>

            <li class="nav-item">

               <a href="<?= base_url('admin/profile') ?>" class="nav-link <?php if ($page_title == 'Update Password') {
                    echo 'active';
                 } ?>">

                  <i class="nav-icon fas fa-key text-info"></i>

                  <p>Change Password</p>

               </a>

            </li>

         </ul>

         </li>



         </ul>

      </nav>

      <!-- /.sidebar-menu -->

   </div>

   <!-- /.sidebar -->

</aside>

<div class="content-wrapper">

   <!-- Content Header (Page header) -->