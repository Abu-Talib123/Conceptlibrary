<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    date_default_timezone_set('Asia/Kolkata');
		$this->load->library('user_session_check');
	    $this->user_session_check->check_student_user_session();
		$this->load->model("student_model", 'student_model');
	}
	public function index()
	{
		$data['page_title'] 		   = 'Concept Library';
		$data['sub_title'] 			   = 'Profile';
		$data['load_view'] 			   = 'profile';
		$student_id 			       = $this->session->userdata('CL_STUDENT_ID');
		$data["fetch_studentdata"]     = $this->student_model->fetch_student($student_id);
		$data["fetch_categorydata"]    = $this->Common_model->fetch_categorydata();
		$data["fetch_subcategorydata"] = $this->Common_model->fetch_subcategorydata();
		$data["fetch_universitydata"]  = $this->Common_model->fetch_universitydata();
		$data["fetch_collegedata"]     = $this->Common_model->fetch_collegedata();
		$data["fetch_countrydata"]     = $this->Common_model->fetch_countrydata();
		$data["fetch_statedata"]       = $this->Common_model->fetch_statedata();
		$data["fetch_citydata"]        = $this->Common_model->fetch_citydata();
		$this->load->view('profile', $data);
	}
	function getsubcategory($category)
    {
	       $subcatoptiondata  = '<select class="form-control form-control-lg"  id="subcategory" name="subcategory" >
	                    <option selected="selected" value="">Select</option>';
		   if($category!='')
	    	{             
			   $getsubcategory   = $this->Common_model->fetchsubcatbyid($category);
			 
		      if($getsubcategory->num_rows()>0)
		      {
		        $i=0;
		        foreach($getsubcategory->result_array() as $subcat)
		        {

		          $subcatoptiondata  = $subcatoptiondata.'<option value="'.$subcat['subcategory_id'].'">'.$subcat['subcategory_name'].'</option>';
		          
		          $i++;
		        }
		      }
	   		} 
	    else
	    {
	      $subcatoptiondata  = $subcatoptiondata.'';
	    }

	    $subcatoptiondata  = $subcatoptiondata.'</select>';
	    
	    echo $subcatoptiondata;

   }	
   function getcollege($university)
   {
        $universityoptiondata  = '<select class="form-control form-control-lg"  id="college" name="college" >
                    <option selected="selected" value="">All</option>';
	   if($university!='')
    	{             
		   $getcollege   = $this->Common_model->fetchcollegebyid($university);
		 
	      if($getcollege->num_rows()>0)
	      {
	        $i=0;
	        foreach($getcollege->result_array() as $college)
	        {

	          $universityoptiondata  = $universityoptiondata.'<option value="'.$college['college_id'].'">'.$college['college_name'].'</option>';
	          
	          $i++;
	        }
	      }
   		} 
    else
    {
      $universityoptiondata  = $universityoptiondata.'';
    }

    $universityoptiondata  = $universityoptiondata.'</select>';
    
    echo $universityoptiondata;
    
   }
   function getstate($country)
   {
        $stateoptiondata  = '<select class="form-control form-control-lg"  id="state" name="state" onchange="getcity()" >
            <option selected="selected" value="">All</option>';
	   if($country!='')
    	{             
		   $getstate   = $this->Common_model->fetchstatebyid($country);
		 
	      if($getstate->num_rows()>0)
	      {
	        $i=0;
	        foreach($getstate->result_array() as $state)
	        {

	          $stateoptiondata  = $stateoptiondata.'<option value="'.$state['state_id'].'">'.$state['state_name'].'</option>';
	          
	          $i++;
	        }
	      }
   		} 
    else
    {
      $stateoptiondata  = $stateoptiondata.'';
    }

    $stateoptiondata  = $stateoptiondata.'</select>';
    
    echo $stateoptiondata;
    
  }		
  function getcity($state_id)
  {
  	 $cityoptiondata  = '<select class="form-control form-control-lg"  id="city" name="city">
            <option selected="selected" value="">All</option>';
	   if($state_id!='')
    	{             
		   $getcity   = $this->Common_model->fetchcitybyid($state_id);
		 
	      if($getcity->num_rows()>0)
	      {
	        $i=0;
	        foreach($getcity->result_array() as $city)
	        {

	          $cityoptiondata  = $cityoptiondata.'<option value="'.$city['city_id'].'">'.$city['city_name'].'</option>';
	          
	          $i++;
	        }
	      }
   		} 
    else
    {
      $cityoptiondata  = $cityoptiondata.'';
    }

    $cityoptiondata  = $cityoptiondata.'</select>';
    
    echo $cityoptiondata;
    
  }
  
  function update()
  {
  	$student_id  				  = @$this->session->userdata('CL_STUDENT_ID');
  	$postdata['category_id']      = @$this->input->post('category');
  	$postdata['subcategory_id']   = @$this->input->post('subcategory');  
  	$postdata['university_id']    = @$this->input->post('university');
  	$postdata['college_id']       = @$this->input->post('college');
  	$postdata['registration_id']  = @$this->input->post('registration_id');
  	$postdata['country_id']       = @$this->input->post('country');
  	$postdata['state_id']      	  = @$this->input->post('state');
  	$postdata['city_id']          = @$this->input->post('city');
  	$postdata['address']          = @$this->input->post('address');
  	$postdata['pincode']      	  = @$this->input->post('pincode');
  	$postdata['aadhar_no']        = @$this->input->post('aadhar_no');
	//FILE UPLOAD CODE FOR IC IMAGE
  	
	$currentPath = $_SERVER['PHP_SELF']; 

	// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
	$pathInfo = pathinfo($currentPath); 

	// output: localhost
	$hostName = $_SERVER['HTTP_HOST']; 

	// output: http://
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';	

	$imagepath='';
	
	// Uploading IC File
	$this->load->library('upload');
	
	if (!empty($_FILES['aadhar_file']['name']))
	{	
		
		$config['upload_path'] 		=	'./includes/student/aadhar/'; /* NB! create this dir! */ 
		$config['allowed_types']	=	'png|jpg|png|bmp|jpeg';  
		$config['max_size'] 		=	'0';  
		$config['max_width']  		=	'0';
		$config['max_height']  		=	'0';  
		$this->upload->initialize($config);
		$this->load->library('upload', $config);  
		$this->load->library('image_lib'); 
		if(!$this->upload->do_upload('aadhar_file'))
		{
			$error4 = array('error' => $this->upload->display_errors());
			$imagepath	=	NULL;
		}
		else
		{
			$data 					=	$this->upload->data();
			$aadharimage			=	$data['file_name'];
			$imagepath				=	$protocol.$hostName.$pathInfo['dirname'].'/includes/student/aadhar/'.$aadharimage;
		}
	}
	 else
		{
           $imagepath       = @$this->input->post('old_aadhar');
        }
    
    $postdata['aadhar_link']	=	$imagepath;
  
    $studentdata= $this->student_model->update_student_data($postdata,$student_id);
    if($studentdata)
		{
			$result['resultCode'] = 1;
			$result['resultMsg'] = 'Successfully Updated';
		}
		else
		{
			$result['resultCode'] = 0;
			$result['resultMsg'] = 'Failed to Update';
		}
		echo json_encode($result);
  }
  function update_password()
  {
        $data['page_title'] 		   = 'Concept Library';
		$data['sub_title'] 			   = 'Profile- Update password';
  		$this->load->view('change_password', $data);
  }
   function updatePasswordData()
	{
		$postdata['student_id']		    =	$this->session->userdata('CL_STUDENT_ID');
		$postdata['password']			=	$_POST['inputPassword'];
		$postdata['confirm_password']	=   $_POST['input_ConfirmPassword'];
		if((isset($postdata['password'])!=''))
		{
			$pwddetails	=	$this->student_model->updatepassword($postdata);
			if($pwddetails)
			{
				$result['resultCode'] = 1;
			    $result['resultMsg'] = 'Password Updated';
			}
			else
			{   
				$result['resultCode'] = 0;
			    $result['resultMsg'] = 'Try Again';
			}	
		}
		else
		{
		$result['resultCode'] = 0;
		$result['resultMsg'] = 'Password and Confirm Password cannot be same ';
		}
	 echo json_encode($result);
	}
  

	
	
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */