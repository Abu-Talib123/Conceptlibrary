
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
                <h2 class="mb-0">Register</h2>
            </div>
        </div>
    </div>
</div>

<?php include 'breadcrumb.php';?>

<div class="site-section">
    <div class="container">
         <?php 
            if($fetch_studentdata)
            {
            foreach($fetch_studentdata as $row)
            {
            ?>
       <div id="ajax_error" class="ajax_error" style="text-align:center;"></div>
        <form action="#" method="post" id="profile_Form" name="profile_Form">
        <div class="row ">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                        <label for="username">Category</label>
                        <select class="form-control form-control-lg" name="category" id="category" onchange="getsubcategory();">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_categorydata) && $fetch_categorydata!='')
                        {
                        $i = 0;
                        foreach($fetch_categorydata as $data)
                        {
                        ?>
                        <option <?php if($data['category_id'] == $row['category_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['category_id'] ?>"><?php echo $data['category_name']?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                        </div>

                        <div class="col-md-12 form-group">
                        <label for="email">University</label>
                        <select class="form-control form-control-lg" name="university" id="university" onchange="getcollege();">
                        <option value="">Select</option>
                        <?php
                        if(isset($fetch_universitydata) && $fetch_universitydata!='')
                        {
                        $i = 0;
                        foreach($fetch_universitydata as $data)
                        {
                        ?>
                         <option <?php if($data['university_id'] == $row['university_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['university_id'] ?>"><?php echo $data['university_name']?> </option>
                        <?php
                        $i++;
                        }
                        }
                        ?>
                      </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">College Registration Id</label>
                            <input type="text" id="registration_id" name="registration_id" class="form-control form-control-lg" value="<?=$row['registration_id']?>" maxlength="16">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword2">State</label>
                            <div id="stateoptiondata">
                            <select class="form-control form-control-lg" name="
                                 state" id="state" required="required" onchange="getcity();">
                                 <option value="">Select</option>
                                 <?php
                                    if(isset($stateoptiondata) && $stateoptiondata!='')
                                    {
                                    $i = 0;
                                    foreach($stateoptiondata as $state)
                                    {
                                    
                                    ?>
                                 <option  name="state" id="state" <?php if($state->id == $result['state']){ echo 'selected="selected"'; } ?> value="<?php echo $state['id']; ?>"<?php echo $state['name']; ?>></option>
                                 <?php
                                    $i++;
                                    }
                                    }
                                    ?>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Address</label>
                            <input type="text" id="address" name="address" value="<?=$row['address']?>" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword2">Aadhar No</label>
                             <input type="text" id="aadhar_no" name="aadhar_no"  value="<?=$row['aadhar_no']?>" class="form-control form-control-lg">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                         <div class="col-md-12 form-group" >
                            <label for="username">SubCategory</label>
                            <div id="subcatoptiondata">
                            <select class="form-control form-control-lg" name="subcategory" id="subcategory">
                            <option value="">Select</option>
                            <?php
                            if(isset($fetch_subcategorydata) && $fetch_subcategorydata!='')
                            {
                            $i = 0;
                            foreach($fetch_subcategorydata as $data)
                            {
                            ?>
                            <option <?php if($data['subcategory_id'] == $row['subcategory_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['subcategory_id'] ?>"><?php echo $data['subcategory_name']?> </option>
                            <?php
                            $i++;
                            }
                            }
                            ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="username">College</label>
                            <div id="universityoptiondata">
                            <select class="form-control form-control-lg" name="college" id="college">
                              <option value="">Select</option>
                              <?php
                              if(isset($fetch_collegedata) && $fetch_collegedata!='')
                              {
                              $i = 0;
                              foreach($fetch_collegedata as $data)
                              {
                              ?>
                              <option <?php if($data['college_id'] == $row['college_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['college_id'] ?>"><?php echo $data['college_name']?> </option>
                              <?php
                              $i++;
                              }
                              }
                              ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="email">Country</label>
                            <select class="form-control form-control-lg" name="country" id="country" onchange="getstate();">
                                <option value="">Select</option>
                                <?php
                                if(isset($fetch_countrydata) && $fetch_countrydata!='')
                                {
                                $i = 0;
                                foreach($fetch_countrydata as $data)
                                {
                                ?>
                                <option <?php if($data['country_id'] == $row['country_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['country_id'] ?>"><?php echo $data['country_name']?> </option>
                                <?php
                                $i++;
                                }
                                }
                                ?>
                      </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">City</label>
                            <div id="cityoptiondata">
                            <select class="form-control form-control-lg" name="city" id="city">
                              <option value="">Select</option>
                              <?php
                              if(isset($fetch_citydata) && $fetch_citydata!='')
                              {
                              $i = 0;
                              foreach($fetch_citydata as $data)
                              {
                              ?>
                              <option <?php if($data['city_id'] == $row['city_id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['city_id'] ?>"><?php echo $data['city_name']?> </option>
                              <?php
                              $i++;
                              }
                              }
                              ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Pincode</label>
                            <input type="text" id="pincode" name="pincode" value="<?=$row['pincode'];?>"class="form-control form-control-lg">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Upload Aadhar</label>
                            <input type="file" id="aadhar_file" name="aadhar_file" class="form-control form-control-lg">
                            <input type="hidden" name="old_aadhar" id="old_aadhar" value="<?=$row['aadhar_link']?>">
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <label></label>
                            <input type="hidden" id="hidden_id" name="hidden_id"  value="<?=$row['student_id'];?>" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Update" class="btn btn-primary btn-lg px-5">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php 
          
            }
        } ?>
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
 <script src="<?=base_url('js/profile.js')?>"></script>
<script>
    
function getsubcategory()
{
   if($('#category').val()!='')
    {
      $.post('<?php echo base_url(); ?>profile/getsubcategory/'+$('#category').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#subcatoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}
function getcollege()
{
   if($('#university').val()!='')
    {
      $.post('<?php echo base_url(); ?>profile/getcollege/'+$('#university').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#universityoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}       
function getstate()
{
   if($('#country').val()!='')
    {
      $.post('<?php echo base_url(); ?>profile/getstate/'+$('#country').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#stateoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}
function getcity()
{
   if($('#state').val()!='')
    {
      $.post('<?php echo base_url(); ?>profile/getcity/'+$('#state').val(), function(data) {
        if(data!='')
        {
           var splitdata  = data.split('^');
          $('#cityoptiondata').html(splitdata[0]);
          //alert(stateoptiondata);
        }
      });
    }
}
</script>
</body>

</html>
