<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_status
{
	var $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		if($this->CI->uri->segment(1) !== 'login')
		{
			if($this->CI->uri->segment(1) !== 'admin')
			{
				$this->check_user_status();
			}
		}
	}

	public function check_user_status($page_name ='ALLOW')
	{
		if(!isset($this->CI->session->userdata['AV_ADMIN_USERID']))
		{
			if(isset($this->CI->session->userdata['CL_STUDENT_ID']))
			{
				$user_id = $this->CI->session->userdata['CL_STUDENT_ID'];
				$user_status = $this->CI->db->select('*')
									  ->where('student_id', $user_id)
									  ->get('student')
									  ->row()->is_active;
		        if($user_status != 1)
		        {
					redirect('login/logout');
		        }
		        else
		        {
		        	return 0;
		        }
			}
			else
			{
				redirect('login/logout');
			}
		}
		else
		{
			return true;
		}
	}

	
}
/* End of file user_status.php */
/* Location: ./system/applocation/library/user_session_check.php */