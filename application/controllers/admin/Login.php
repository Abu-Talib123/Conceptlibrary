<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
		$this->load->model('admin/login_model', 'login_model');
	}
	public function index()
	{
		$data['page_title'] =	'admin-Login';
		$this->load->view('admin/login',$data);
	}
	public function logon()
	{
		
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
		$udetail = $this->login_model->get_admin_detail($email,$password);
		//$folder = 'synct';
		if($udetail)
		{
			$loginSesData = array(
					'AV_ADMIN_USERID' => $udetail['id'],
					'AV_ADMIN_USERNAME' => $udetail['username'],
					'AV_ADMIN_EMAIL' => $udetail['email'],
					'AV_LAST_LOGIN' => $udetail['last_login'],
					'AV_PHONE' => $udetail['phone'],

				);
			$this->session->set_userdata($loginSesData);

		    $inquery	=	'INSERT INTO admin_logs SET
							user_id	    =	\''.$udetail['id'].'\',
							email       =	\''.$udetail['email'].'\',
							ip_address	=	\''.$postdata['ipaddress'].'\',
						    time		=	\''.date('Y-m-d H:i:s').'\'';
		    $exinquery	=	$this->db->query($inquery);
		    $upquery    = ' UPDATE  users SET 
		    			   last_login = \''.date('Y-m-d H:i:s').'\'
		    			   where email = \''.$udetail['email'].'\'';
		    $exupquery	=	$this->db->query($upquery);

		    

			$result['resultCode'] = 1;
			$result['resultMsg'] = 'Login sucess';
		}else{
			$result['resultCode'] = 0;
			$result['resultMsg'] = 'Invalid username or password';
		}

		echo json_encode($result);
	}
	public function logout()
	{
		$loginSesData = array(
					'AV_ADMIN_USERID',
				);
		$this->session->unset_userdata($loginSesData);
		redirect('admin/login');
	}
	function forgetpassword()
	{
		$data['page_title'] =	'Admin-ForgetPassword';
		$this->load->view('admin/forget_password',$data);
	}
	function forgetPasswordData()
	{
		$this->load->library('email');
		$email = $_POST['inputEmail'];
		$findemail = $this->login_model->forgotPassword($email);
		if ($findemail)
		{
			$query1=$this->db->query("SELECT *  from  users where email = '".$email."' ");
			$row=$query1->result_array();
			if ($query1->num_rows()>0)
			{
			    $passwordplain = "";
			    $passwordplain  = rand(99999,99999);
			    $newpass['password'] = sha1($passwordplain);
				$upquery	=	'UPDATE users set  password = \''.$newpass['password'].' \' WHERE email= \''.$email.'\'';
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
                
                // Send email & return status
                return $this->email->send()?true:false;
    	        $result['resultCode'] = 1;
            	$result['resultMsg'] = 'Password sent to your email ';
			   /* if (!$this->email->send()) {

			        $result['resultCode'] = 0;
		        	$result['resultMsg'] = 'Failed to send password, please try again ';
			    } else {

			        
			    }*/
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

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */