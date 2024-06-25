<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->library('user_session_check');
	    $this->user_session_check->check_user_session();
	    $this->load->model('admin/payment_model', 'payment_model');
	    $this->load->model('admin/student_model', 'student_model');
        $this->load->model('Common_model', 'common_model');
	}
	public function index()
	{
		$data['page_title'] =	'Payment';
		$data['sub_title']  =	'Payment';
		$data['load_view'] = 'admin/payment/view_payment';
	    $config['base_url'] = site_url('admin/payment/fetch_payment/');
	    $config['total_rows'] = $this->payment_model->fetch_paymentdata_count();   
	    $config['paging_function'] = 'ajax_pagination_payment';
	    $custom_config = $this->custom_pagination($config); 
	    $startRow = 0;
	    $this->ajax_pagination->initialize($custom_config);
	    $data['pagination'] = $this->ajax_pagination->create_links();
	    $data["fetch_paymentdata"] = $this->payment_model->fetch_paymentdata($startRow, $custom_config['per_page']);
			$this->load->view('admin/template', $data);
	}
	public function fetch_payment()
	{
	  $this->fetch_payment_list();
	}
	public function fetch_payment_list()
	{
	$this->load->library('ajax_pagination');
	$config['base_url'] = site_url('admin/payment/fetch_payment/');
	$config['paging_function'] = 'ajax_pagination_payment';
	$config['total_rows'] = $this->payment_model->fetch_paymentdata_count();
	$custom_config = $this->custom_pagination($config);
	$startRow = 0;
	if($this->uri->segment(3) =='fetch_payment')
	{
	  if($this->uri->segment(4) == '')
	  {
	    $startRow = 0;
	  }
	  else
	  {
	    $startRow = ($this->uri->segment(4) - 1) * PER_PAGE;
	  }
	}
	$this->ajax_pagination->initialize($custom_config);
	$data['pagination']    = $this->ajax_pagination->create_links();
	$data['search_result'] = $this->payment_model->fetch_paymentdata($startRow, $custom_config['per_page']);
	$data['startRow']      = $startRow;
	if($this->uri->segment(3) =='fetch_payment'){

	  $result['search_result'] = $this->load->view('admin/payment/list_load_payment', $data, true);
	  $result['pagination'] = $data['pagination'];
	}else{
	  $result['search_result'] = $this->load->view('admin/payment/', $data, true);
	  $result['pagination'] = $data['pagination'];
	}
	echo json_encode($result);
	}
	public function custom_pagination($main_config ='')
	{
	$this->load->library('ajax_pagination');
	$config['full_tag_open'] = "<ul class='pagination pagination-sm' >";
	$config['full_tag_close'] ="</ul>";
	$config['num_tag_open'] = "<li class='page-item' >";
	$config['num_tag_close'] = "</li>";
	$config['cur_tag_open'] = "<li class='disabled'><li class='page-item'><a href='#' class='page-link'>";
	$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
	$config['next_tag_open'] = "<li class='page-item'>";
	$config['next_tagl_close'] = "</li>";
	$config['prev_tag_open'] = "<li class='page-item'>";
	$config['prev_tagl_close'] = "</li>";
	$config['first_tag_open'] = "<li class='page-item'>";
	$config['first_tagl_close'] = "</li>";
	$config['last_tag_open'] = "<li class='page-item'>";
	$config['last_tagl_close'] = "</li>";
	$config['num_links'] = 5;
	$config['uri_segment'] = 4;
	$config['per_page'] = PER_PAGE;
	$config['use_page_numbers'] = TRUE;
	$config['is_ajax_paging'] =  TRUE; // default FALSE;

	if($main_config !=''){
	$config = array_merge($main_config, $config);
	}
	return $config;
	}

	
}

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */