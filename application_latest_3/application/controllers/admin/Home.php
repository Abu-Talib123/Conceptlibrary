<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->library('user_session_check');
	    $this->user_session_check->check_user_session();
	    $this->load->model('admin/student_model', 'student_model');
	}
	public function index()
	{
		$data['page_title'] =	'Dashboard';
		$data['sub_title']  =	'Home';
		$data["totalcount"] = $this->student_model->totalcount();
		$data["studentcount"]= $this->student_model->studentcount();
		$data["total_videos"]= $this->student_model->total_videos();
		$data["total_mockpapers"]= $this->student_model->total_mockpapers();
		$data['load_view'] = 'admin/dashboard';
		$this->load->view('admin/template', $data);
	}
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */