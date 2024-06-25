<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->library('user_session_check');
	    $this->user_session_check->check_user_session();
	    $this->load->model('admin/blog_model', 'blog_model');
        $this->load->model('Common_model', 'common_model');
	}
	public function index()
	{
		$data['page_title'] =	'Blog';
		$data['sub_title']  =	'Posts';
		$data['load_view'] = 'admin/blog/view_blog';
	    $config['base_url'] = site_url('admin/blog/fetch_blog/');
	    $config['total_rows'] = $this->blog_model->fetch_blogdata_count();   
	    $config['paging_function'] = 'ajax_pagination_blog';
	    $custom_config = $this->custom_pagination($config); 
	    $startRow = 0;
	    $this->ajax_pagination->initialize($custom_config);
	    $data['pagination'] = $this->ajax_pagination->create_links();
	    $data["fetch_blogdata"] = $this->blog_model->fetch_blogdata($startRow, $custom_config['per_page']);
			$this->load->view('admin/template', $data);
	}
	public function fetch_blog()
	{
	  $this->fetch_blog_list();
	}
	public function fetch_blog_list()
	{
	$this->load->library('ajax_pagination');
	$config['base_url'] = site_url('admin/blog/fetch_blog/');
	$config['paging_function'] = 'ajax_pagination_blog';
	$config['total_rows'] = $this->blog_model->fetch_blogdata_count();
	$custom_config = $this->custom_pagination($config);
	$startRow = 0;
	if($this->uri->segment(3) =='fetch_blog')
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
	$data['search_result'] = $this->blog_model->fetch_blogdata($startRow, $custom_config['per_page']);
	$data['startRow']      = $startRow;
	if($this->uri->segment(3) =='fetch_blog'){

	  $result['search_result'] = $this->load->view('admin/blog/list_load_blog', $data, true);
	  $result['pagination'] = $data['pagination'];
	}else{
	  $result['search_result'] = $this->load->view('admin/blog/', $data, true);
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

	public function edit_blog($id)
	{
		$data['blog'] = $this->blog_model->get_blog_by_id($id);

		if ($this->input->is_ajax_request()) {
			// Load the edit form view and return its HTML content
			echo $this->load->view('admin/blog/edit_blog', $data, true);
		} else {
			$data['page_title'] = 'Edit Blog';
			$data['sub_title'] = 'Edit Post';
			$data['load_view'] = 'admin/blog/edit_blog';
			$this->load->view('admin/template', $data);
		}
	}

	public function update($id)
    {
        $data = array(
            'title' => $this->input->post('title'),
            'discription' => $this->input->post('discription'),
			'author_name'  => $this->input->post('author_name'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        
        $this->blog_model->update_blogdata($data, $id);
        redirect('admin/blog');
    }

	public function delete_blog($id)
    {
		$result = ['resultCode' => 0, 'resultMsg' => 'Failed to delete blog post'];
		if ($this->blog_model->delete_blog($id)) {
			$result = ['resultCode' => 1, 'resultMsg' => 'Blog post deleted successfully'];
		}
		echo json_encode($result);
    }
}

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */