<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
		
	    $this->load->model('login_model', 'login_model');
	}
	public function index()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Login';
		//$data['load_view'] 		= 'login';
		$this->load->view('login', $data);
	}
	public function logon()
	{
		// IP Address Details		
		$ipaddress				=	NULL;
		$ipaddress				=	$this->get_ip();
		if($ipaddress==NULL || $ipaddress=='' || $ipaddress=='0')
		{
		  $ipaddress			=	$this->get_client_ip();
		  if($ipaddress==NULL || $ipaddress=='' || $ipaddress=='0')
		  {
  			  $ipaddress		=	NULL;
		  }
		}
		else
		{
			$ipaddress			=	$ipaddress;
		}
		$postdata['ipaddress']	=	$ipaddress;
		$email = $_POST['inputEmail'];
		$password = $_POST['inputPassword'];		
		$studentdetail = $this->login_model->get_student_detail($email,$password);
	
		if($studentdetail)
		{
		    if($studentdetail['otp_verified'] == 1)
			{
    		 	
    		 //	if($studentdetail['ip_address'] == $postdata['ipaddress']){
    		 	$loginSesData = array(
    					'CL_STUDENT_ID' => $studentdetail['student_id'],
    					'CL_STUDENT_USERNAME' => $studentdetail['username'],
    					'CL_STUDENT_EMAIL' => $studentdetail['email'],
    					'CL_STUDENT_MOBILE' => $studentdetail['mobile'],
    					'CL_STUDENT_STATUS' => $studentdetail['payment_status'],
						'CL_STUDENT_PHOTO'  => $studentdetail['student_photo']
    				);
    			$this->session->set_userdata($loginSesData);
    			$inquery	=	'INSERT INTO student_logs SET
							student_id	    =	\''.$studentdetail['student_id'].'\',
    							email       =	\''.$studentdetail['email'].'\',
    							ip_address	=	\''.$postdata['ipaddress'].'\',
    						    login_time		=	\''.date('Y-m-d H:i:s').'\'';
    		    $exinquery	=	$this->db->query($inquery);	
    		    $text_to_image_name = $studentdetail['student_id'].$studentdetail['username'].$studentdetail['mobile'];
    		  //	$this->text_to_image($text_to_image_name);
			
				$result['resultCode'] = 1;
			    $result['resultMsg'] = 'Login sucess';
			 // }else{
			 //   $result['resultCode'] = 0 ;
			 //   $result['resultMsg'] = 'Your Ip address is changed Contact Administrator';
			 // } 
				
			}else{
			    //$otpdata['otp']            = rand(1000,9999);
			    //$this->db->where('student_id', $studentdetail['student_id']);
			    //$this->db->update('student', $otpdata);
			    	$loginSesData = array(
    					'STUDENT_ID' => $studentdetail['student_id'],
    					'STUDENT_USERNAME' => $studentdetail['username']
    				);
    			$this->session->set_userdata($loginSesData);
			   /* $otpData = array(
                    'name' => $studentdetail['username'],
                    'email' => $studentdetail['email'],
                    'otp' => $otpdata['otp']
                );*/
                // $send = $this->sendEmail($otpData);
				$result['resultCode'] = 2 ;
			    $result['resultMsg'] = 'OTP verificatin Not Done ';
			}

		}else{
			$result['resultCode'] = 0;
			$result['resultMsg'] = 'Invalid username or password';
		}

		echo json_encode($result);
	}
	
	public function text_to_image($text_to_image_name = 'ConceptLibrary') {
	    
	   
	    
       $img = imagecreate(500, 100);
        
        $textbgcolor = imagecolorallocate($img, 173, 230, 181);
        $textcolor = imagecolorallocate($img, 0, 192, 255);
    
    
        //$txt = 'textsfsd';
        imagestring($img, 5, 5, 5, $text_to_image_name, $textcolor);
        ob_start();
        imagepng($img);
        $data = 'data:image/png;base64,'.base64_encode(ob_get_clean());
        
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        
        file_put_contents('includes/adminpanel/text_img/'.$text_to_image_name.'.png', $data);

       
	}
	public function logout()
	{
		$loginSesData = array(
					'CL_STUDENT_ID',
					'CL_STUDENT_USERNAME',
					'CL_STUDENT_EMAIL',
					'CL_STUDENT'
				);
		$this->session->unset_userdata($loginSesData);
		redirect('login');
	}
	public function register()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Register';
		$data['load_view'] 		= 'register';
		$this->load->view('register', $data);
	}
	function register_data()
	{
		// IP Address Details		
		$ipaddress				=	NULL;
		$ipaddress				=	$this->get_ip();
		if($ipaddress==NULL || $ipaddress=='' || $ipaddress=='0')
		{
		  $ipaddress			=	$this->get_client_ip();
		  if($ipaddress==NULL || $ipaddress=='' || $ipaddress=='0')
		  {
  			  $ipaddress		=	NULL;
		  }
		}
		else
		{
			$ipaddress			=	$ipaddress;
		}
		
	   $codedata=array();
	   $get_lastdetails =  $this->login_model->fetch_lastdetails();
	   if($get_lastdetails->num_rows()>0)
		{
			foreach($get_lastdetails->result_array() as $row)
			{
				$codedata['student_id'] = $row['student_id'];
				$alpha =  substr($codedata['student_id'],0,2);
				$number = (int) substr($codedata['student_id'],2,strlen($codedata['student_id'])-1)+1;
		     }
			 $studentid = $alpha.STR_PAD((string)$number,2,"0",STR_PAD_LEFT);

		}
		else
		{
			$studentid= 'CL'.date('ymd').'01';
		}
		$postdata['student_id'] 	= $studentid;
		$postdata['username'] 		= $_POST['inputUsername'];
		$postdata['mobile']    		= $_POST['inputMobile'];
		$postdata['email']	  		= $_POST['inputEmail'];
		$postdata['password'] 		= sha1($_POST['inputPassword']);
		$postdata['created_at'] 	= date('Y-m-d H:i:s');
		$postdata['otp']            = rand(1000,9999); 
		$postdata['otp_verified']   = 0;
		$postdata['ip_address']     = $ipaddress;
		$postdata['is_active'] 	= 1;
		$postdata['is_deleted'] 	= 0;
		$query = $this->db->get_where('student', array(//making selection
      				'email' => $this->input->post('inputEmail')
     								));
     	$count = $query->num_rows();	
	     if($count===0)
	     {
	     	
			$registerdetail=$this->login_model->insert_student($postdata);
			//$folder = 'synct';
			if($registerdetail)
			{
				$otpData = array(
                    'name' => $postdata['username'],
                    'email' => $postdata['email'],
                    'otp' => $postdata['otp']
                );
			$otpSesData = array(
					'STUDENT_ID'  => $postdata['student_id'],
					'STUDENT_USERNAME' => $postdata['username'],
					'STUDENT_EMAIL' => $postdata['email'],
					);
					$this->session->set_userdata($otpSesData);	
	

				 // Send an email to the site admin
                $send = $this->sendEmail($otpData);	
				$result['resultCode']  = 1;
				$result['resultMsg']   = 'Registered success. Please Check your Mail  For OTP';
			}else{
				$result['resultCode'] = 0;
				$result['resultMsg'] = 'Invalid username or password';
			}
		}else
	      {
	         $result['resultCode'] = 0;
	         $result['resultMsg'] = 'Email Already exists';
	      }

		echo json_encode($result);
	}
	public function otp_verification()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'OTP Verification';
		$data['load_view'] 		= 'otp_verification';
		$this->load->view('otp_verification', $data);
	}
	function otp_verification_data()
	{
		$postdata['student_id'] 	= $_POST['student_id'];
		$otpdata  =  $this->login_model->fetch_otpdata($postdata['student_id']);
		$inputotp = $_POST['inputotp'];
		
		if($otpdata){
		 if($otpdata['otp'] == $inputotp){
	     	
			$registerdetail=$this->login_model->updateotpstatus($postdata);
		
			
				$loginSesData = array(
    					'CL_STUDENT_ID' => $otpdata['student_id'],
    					'CL_STUDENT_USERNAME' => $otpdata['username'],
    					'CL_STUDENT_EMAIL' => $otpdata['email'],
    					'CL_STUDENT_MOBILE' => $otpdata['mobile'],
    					'CL_STUDENT_STATUS' => $otpdata['payment_status'],
    				);
    			$this->session->set_userdata($loginSesData);
				$result['resultCode']  = 1;
				$result['resultMsg']   = 'OTP Verification success.Please continue to login';
			
		}
		else{
				$result['resultCode'] = 0;
				$result['resultMsg'] = 'Invalid OTP';
			}
	  }else
	      {
	         $result['resultCode'] = 0;
	         $result['resultMsg'] = 'Wrong OTP';
	      }

		echo json_encode($result);
	}
	private function sendEmail($otpData){
        // Load the email library
        $this->load->library('email');
        
        // Mail config
        $to = $otpData['email'];
        $from = 'info@conceptlibrary.in';
        $fromName = 'ConceptLibrary';
        $mailSubject = 'OTP Verification From ConceptLibrary  ';
        
        // Mail content
        $mailContent = '
            <h2> Welcome '.$otpData['name'].' </h2>
            <h3> Thanks For Registration. Use '.$otpData['otp'].' as one time password (OTP)  </h3>';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->to($to);
        $this->email->from($from, $fromName);
        $this->email->subject($mailSubject);
        $this->email->message($mailContent);
        
        // Send email & return status
        return $this->email->send()?true:false;
    }
    function forget_password()
    {
    	$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Forget Password';
		$this->load->view('forget_password', $data);
    }
    function forget_passworddata()
    {
    	$this->load->library('email');
		$email = $_POST['inputEmail'];
		$findemail = $this->login_model->forgotPassword($email);
		if ($findemail)
		{
			$query1=$this->db->query("SELECT *  from student where email = '".$email."' ");
			$row=$query1->result_array();
			if ($query1->num_rows()>0)
			{
			    $passwordplain = "";
			    $passwordplain  = rand(99999,99999);
			    $newpass['password'] = sha1($passwordplain);

				$upquery	=	'UPDATE student set  password = \''.$newpass['password'].' \' WHERE email= \''.$email.'\'';
				$exsequery	=	$this->db->query($upquery);	

				$to = $email;
				$from = 'info@conceptlibrary.in';
				$fromName = 'ConceptLibrary';
				$mailSubject = 'Thanks for contacting regarding to forgot password';

				// Mail content
				$mailContent = '
				<h2> Welcome '.$row[0]['username'].' </h2>
				<h3> Thanks For contacting regarding to forgot password. Use '.$passwordplain.' </h3>';
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->to($to);
				$this->email->from($from, $fromName);
				$this->email->subject($mailSubject);
				$this->email->message($mailContent);
				//$this->email->send();
			  
			    if (!$this->email->send()) {

			        $result['resultCode'] = 0;
		        	$result['resultMsg'] = 'Failed to send password, please try again ';
			    } else {

			        $result['resultCode'] = 1;
		        	$result['resultMsg'] = 'Password sent to your email ';
			    }
			}
			else
			{
				$result['resultCode'] = 0;
		        $result['resultMsg'] = 'Email Not Found or Wrong Email ';
			
			}
		} 
		else 
		{
			$result['resultCode'] = 0;
	        $result['resultMsg'] = 'Email Not Found or Wrong Email ';
		}
		echo json_encode($result);
    }
	
	//get ip address details
	function get_ip() 
	{
		//Just get the headers if we can or else use the SERVER global
		if(function_exists('apache_request_headers'))	{	$headers = apache_request_headers();	}	else	{	$headers = $_SERVER;	}
		
		//Get the forwarded IP if it exists
		if(array_key_exists('X-Forwarded-For', $headers) && filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
		{
			$the_ip = $headers['X-Forwarded-For'];
		}
		else if(array_key_exists('HTTP_X_FORWARDED_FOR', $headers) && filter_var($headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) 
		{
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} 
		else 
		{
			$the_ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
		}
		return $the_ip;
	}
	
	// Function to get the client IP address
	function get_client_ip() 
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */