<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class user_session_check
{
	var $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
	}

	public function check_user_session($page_name ='ALLOW')
	{
		if(isset($this->CI->session->userdata['AV_ADMIN_USERID']))
		{
			return true;			
		}
		else
		{
			redirect('admin/login/logout');
		}
	}

	public function check_student_user_session($page_name ='ALLOW')
	{
		if(isset($this->CI->session->userdata['CL_STUDENT_ID']))
		{
			return true;			
		}
		else
		{
			redirect('login/logout');
		}
	}

	
}
/* End of file user_session_check.php */
/* Location: ./system/applocation/library/user_session_check.php */