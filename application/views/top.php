<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page_title?>-<?=$sub_title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    
        
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
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
    <link rel="stylesheet" href="<?=base_url('assets/cl/css/calculator.css')?>">
    <link href="<?=base_url('assets/cl/css/video-js.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/cl/css/videojs-overlay-hyperlink.css')?>" rel="stylesheet">
    <link rel="icon" href="assets/img/cl-favicon.png" type="image/png" sizes="16x16">
     <script type="text/x-mathjax-config">
      MathJax.Hub.Config({tex2jax: {inlineMath: [['\\(','\\)']]}});
    </script>
    <script type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
   
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
  .no-padding {
      padding:0 !important;
  }
  </style> 
</head>
 <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<!-- <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" oncontextmenu="return false;" onmousedown="return false;">
 --><div class="site-wrap col-sm-12 no-padding">