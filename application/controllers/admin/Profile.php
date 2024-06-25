<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
		$this->load->library('user_session_check');
	    $this->user_session_check->check_user_session();
		$this->load->model('admin/login_model', 'login_model');
	}
	public function index()
	{
		$data['page_title'] =	'Update Password';
		$data['sub_title']  =   'Update Password';
		$data['load_view'] = 'admin/profile/change_password';
		$this->load->view('admin/template', $data);
	}
	
	function updatePasswordData()
	{
		$postdata['email']				=	$this->session->userdata('AV_ADMIN_EMAIL');
		$postdata['password']			=	$_POST['inputPassword'];
		$postdata['confirm_password']	=   $_POST['input_ConfirmPassword'];
		if((isset($postdata['password'])!=''))
		{
			$userdetails	=	$this->login_model->updatepassword($postdata);
			if($userdetails)
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
?>