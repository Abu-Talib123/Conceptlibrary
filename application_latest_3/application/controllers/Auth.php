<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	}
	public function index()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Auth';
		$data['load_view'] 		= 'auth';
		$data['material_id'] 	= $this->uri->segment(3);
		$this->load->view('auth', $data);
	}
	function authentication()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Auth';
		$data['load_view'] 		= 'auth';
		$data['material_id'] 	= $this->uri->segment(3);
		$this->load->view('auth', $data);
	}
	
	
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */