<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
	}
	public function index()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['categories']     = $this->Common_model->fetch_categorydata();
		$data['sub_title'] 		= 'Home';
		if ($this->session->userdata('CL_STUDENT_ID')) {
			$data['load_view'] 		= 'home2';
        } else {
            $data['load_view'] 		= 'home';
        }
		$this->load->view('template', $data);
	}
	
	
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */