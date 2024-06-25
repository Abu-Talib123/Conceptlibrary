<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page_title?>-<?=$sub_title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/cl/fonts/icomoon/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/jquery-ui.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/owl.carousel.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/owl.theme.default.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/owl.theme.default.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/jquery.fancybox.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/bootstrap-datepicker.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/cl/fonts/flaticon/font/flaticon.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/aos.css')?>">
    <link href="<?=base_url('assets/cl/css/jquery.mb.YTPlayer.min.css')?>" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/style.css')?>">
   
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

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<div class="site-wrap">
<?php include 'header.php';?>
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?=base_url('assets/cl/images/bg_1.jpg')?>')">
    <div class="container">
        <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
                <h2 class="mb-0">Forgot Password?</h2>
            </div>
        </div>
    </div>
</div>
<?php include 'breadcrumb.php';?>
<div class="site-section">
    <div class="container">
        <div id="ajax_error" class="ajax_error" style="text-align:center;"></div>
        <form action="#" method="post" id="forgetpwd_Form" name="forgetpwd_Form">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="username">Email</label>
                            <input type="email" id="inputEmail"  name="inputEmail" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-md-5">
                            <input type="submit" value="Submit" class="btn btn-primary btn-lg px-5">
                        </div>
                         <div class="col-md-5">
                            <a href="<?=base_url('login')?>" > Login</a>
                         </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<?php include 'footer.php';?>

<script src="<?=base_url('assets/cl/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?=base_url('assets/cl/js/jquery-migrate-3.0.1.min.js')?>"></script>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
 <script src="<?=base_url('js/login.js')?>"></script>

</body>

</html>