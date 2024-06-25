<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$page_title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/admin/dist/css/adminlte.min.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script>
    var site_url = function( url_segments ) {
      if(! url_segments) {
        url_segments = '';
      }
      var surl = "<?php echo site_url('" + url_segments + "'); ?>";
      return surl;
    }
    var base_url = function( url_segments ) {
      if(! url_segments) {
        url_segments = '';
      }
      var burl = "<?php echo base_url('" + url_segments + "'); ?>";
      return burl;
    }
  </script> 
  <style>
  .error{
    color: #ec4061 !important;
  }
  .ajax_error{
    color: #ec4061 !important;
  }
  </style> 
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Forget Password </b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
    <div id="ajax_error" class="ajax_error"></div>
      <form action="#" method="post" id="resetpwdForm" name="resetpwdForm">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="inputEmail" id ="inputEmail" class="form-control"  placeholder="Enter email">
        </div>
        <!-- <div class="form-group">
           <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" placeholder="Password"  name="inputPassword" id="inputPassword">
        </div>
        <div class="form-group">
           <label for="exampleInputPassword1"> Confirm Password</label>
          <input type="password" class="form-control" placeholder="Password"  name="input_confirmPassword" id="input_confirmPassword">
        </div> -->
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?=base_url('admin/login')?>">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<script src="<?=base_url('assets/admin/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/admin/dist/js/adminlte.min.js')?>"></script>
<!-- jQuery -->
<script src="<?=base_url('assets/admin/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?=base_url('assets/admin/plugins/jquery-validation/additional-methods.min.js')?>"></script>

<script src="<?=base_url('js/admin/login.js')?>"></script>

</body>
</html>
