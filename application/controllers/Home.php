<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('Blog_model');
	}
	public function index()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['categories']     = $this->Common_model->fetch_categorydata();
		$data['blogs'] = $this->Blog_model-> fetch_blogdata(0,4);
		$categories = $this->Blog_model->get_all_categories();
		$data['category_map'] = array();
		foreach ($categories as $category) {
			$data['category_map'][$category['category_id']] = $category['name'];
		}
		$data['sub_title'] 		= 'Home';
		if ($this->session->userdata('CL_STUDENT_ID')) {
			$data['load_view'] 		= 'home';
        } else {
            $data['load_view'] 		= 'home2';
        }
		$this->load->view('template', $data);
	}
	
	
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */