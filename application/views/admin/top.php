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
      <!-- Tempusdominus Bbootstrap 4 -->
      <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
      <!-- iCheck -->
      <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
     
      <!-- Theme style -->
      <link rel="stylesheet" href="<?=base_url('assets/admin/dist/css/adminlte.min.css')?>">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/daterangepicker/daterangepicker.css')?>">
      <!-- summernote -->
      <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/summernote/summernote-bs4.css')?>">
      <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/select2/css/select2.min.css')?>">
      
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script src="https://cdn.ckeditor.com/4.14.1/standard-all/ckeditor.js"></script>    
       
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    

.pagination {
  display: inline-block;
  padding-left: 0;
  margin: 20px 0;
  border-radius: 4px
}

.pagination>li {
  display: inline
}

.pagination>li>a,
.pagination>li>span {
  position: relative;
  float: left;
  padding: 6px 12px;
  margin-left: -1px;
  line-height: 1.42857143;
  color: #337ab7;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #ddd
}

.pagination>li:first-child>a,
.pagination>li:first-child>span {
  margin-left: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px
}

.pagination>li:last-child>a,
.pagination>li:last-child>span {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px
}

.pagination>li>a:focus,
.pagination>li>a:hover,
.pagination>li>span:focus,
.pagination>li>span:hover {
  z-index: 3;
  color: #23527c;
  background-color: #eee;
  border-color: #ddd
}

.pagination>.active>a,
.pagination>.active>a:focus,
.pagination>.active>a:hover,
.pagination>.active>span,
.pagination>.active>span:focus,
.pagination>.active>span:hover {
  z-index: 2;
  color: #fff;
  cursor: default;
  background-color: #337ab7;
  border-color: #337ab7
}

.pagination>.disabled>a,
.pagination>.disabled>a:focus,
.pagination>.disabled>a:hover,
.pagination>.disabled>span,
.pagination>.disabled>span:focus,
.pagination>.disabled>span:hover {
  color: #777;
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd
}

.pagination-lg>li>a,
.pagination-lg>li>span {
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.3333333
}

.pagination-lg>li:first-child>a,
.pagination-lg>li:first-child>span {
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px
}

.pagination-lg>li:last-child>a,
.pagination-lg>li:last-child>span {
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px
}

.pagination-sm>li>a,
.pagination-sm>li>span {
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5
}

.pagination-sm>li:first-child>a,
.pagination-sm>li:first-child>span {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px
}

.pagination-sm>li:last-child>a,
.pagination-sm>li:last-child>span {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px
}
    </style> 
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">