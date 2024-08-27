<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

   <!-- Left navbar links -->

   <ul class="navbar-nav">

      <li class="nav-item">

         <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

      </li>

   </ul>

  

   <!-- Right navbar links -->

   <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->

      <li class="nav-item dropdown">

         <a class="nav-link" data-toggle="dropdown" href="#">

         <span class="font-weight-bold  text-capitalize"><span class="mx-2">Welcome,</span><?= $this->session->userdata('AV_ADMIN_USERNAME'); ?></span>

         </a>

        

      </li>

      <!-- Notifications Dropdown Menu -->

      <li class="nav-item dropdown">

         <a class="nav-link" href="<?=base_url('admin/login/logout')?>">

         <i class="fas fa-sign-out-alt"></i>

         </a>

        

      </li>

   </ul>

</nav>

<!-- /.navbar -->