<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	}
	public function index()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'About Us';
		$data['load_view'] 		= 'about';
		$this->load->view('template', $data);
	}
	
	
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */