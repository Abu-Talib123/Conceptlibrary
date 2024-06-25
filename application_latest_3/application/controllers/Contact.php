<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	}
	public function index()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Contact Us';
		$data['load_view'] 		= 'contact';
		$this->load->view('template', $data);
	}
	
	
}

/* End of file contact.php */
/* Location: ./application/controllers/contact.php */