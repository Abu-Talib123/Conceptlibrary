<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Result extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_session_check');
		$this->user_session_check->check_user_session();
		$this->load->model('admin/Result_model', 'Result_model');
		
	}

	public function index()
	{
		$data['page_title'] = 'Results';
		$data['sub_title'] = 'Exam Results';
		$data['load_view'] = 'admin/results/view_result';
		$config['base_url'] = site_url('admin/results/fetch_result/');
		$config['total_rows'] = $this->Result_model->fetch_result_count();
		$config['paging_function'] = 'ajax_pagination_result';
		$custom_config = $this->custom_pagination($config);
		$startRow = 0;
		$this->ajax_pagination->initialize($custom_config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data["fetch_result"] = $this->Result_model->fetch_resultdata($startRow, $custom_config['per_page']);
		$data['results'] = array();

		$this->load->view('admin/template', $data);
	}
	public function fetch_result()
	{
		$this->fetch_result_list();
	}
	public function fetch_result_list()
	{
		$this->load->library('ajax_pagination');
		$config['base_url'] = site_url('admin/result/fetch_result/');
		$config['paging_function'] = 'ajax_pagination_result';
		$config['total_rows'] = $this->Result_model->fetch_result_count();
		$custom_config = $this->custom_pagination($config);
		$startRow = 0;
		if ($this->uri->segment(3) == 'fetch_result') {
			if ($this->uri->segment(4) == '') {
				$startRow = 0;
			} else {
				$startRow = ($this->uri->segment(4) - 1) * PER_PAGE;
			}
		}
		$this->ajax_pagination->initialize($custom_config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['search_result'] = $this->Result_model->fetch_resultdata($startRow, $custom_config['per_page']);
		$data['startRow'] = $startRow;
		if ($this->uri->segment(3) == 'fetch_result') {

			$result['search_result'] = $this->load->view('admin/result/list_load_result', $data, true);
			$result['pagination'] = $data['pagination'];
		} else {
			$result['search_result'] = $this->load->view('admin/result/', $data, true);
			$result['pagination'] = $data['pagination'];
		}
		echo json_encode($result);
	}
	public function custom_pagination($main_config = '')
	{
		$this->load->library('ajax_pagination');
		$config['full_tag_open'] = "<ul class='pagination pagination-sm' >";
		$config['full_tag_close'] = "</ul>";
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
		$config['is_ajax_paging'] = TRUE; // default FALSE;

		if ($main_config != '') {
			$config = array_merge($main_config, $config);
		}
		return $config;
	}

	public function edit_result($id)
	{
		$data['blog'] = $this->blog_model->get_blog_by_id($id);

		if ($this->input->is_ajax_request()) {
			// Load the edit form view and return its HTML content
			echo $this->load->view('admin/blog/edit_blog', $data, true);
		} else {
			$data['page_title'] = 'Edit Blog';
			$data['sub_title'] = 'Edit Post';
			$data['categories'] = $this->blog_model->get_categories();
			$data['load_view'] = 'admin/blog/edit_blog';
			$this->load->view('admin/template', $data);
		}
	}

	public function update($id)
	{
		$data = array(
			'title' => $this->input->post('title'),
			'discription' => $this->input->post('discription'),
			'category_id' => $this->input->post('category_id'),
			'author_name' => $this->input->post('author_name'),
			'updated_at' => date('Y-m-d H:i:s')
		);

		$this->load->library('upload');
		$blog_image = '';

		if (!empty($_FILES['blog_img']['name'])) {
			$upload_path = './includes/blogs/blog_img/';

			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, true);
			}
			$title = $this->input->post('title');
			$sanitized_title = preg_replace('/[^A-Za-z0-9\-]/', '_', $title);
			$timestamp = date('YmdHis');
			$new_filename = $sanitized_title . '_' . $timestamp;

			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'png|jpg|jpeg|bmp';
			$config['file_name'] = $new_filename;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('blog_img')) {
				$error = array('error' => $this->upload->display_errors());
				$blog_image = '';
			} else {
				$data_upload = $this->upload->data();
				$blog_img = $data_upload['file_name'];
				$blog_image = base_url('includes/blogs/blog_img/') . $blog_img;
			}
		} else {
			// Keep the existing image if no new image is uploaded
			$existing_blog = $this->blog_model->get_blog_by_id($id);
			$blog_image = $existing_blog['blog_image'];
		}

		$data['blog_image'] = $blog_image;

		$result = $this->blog_model->update_blogdata($data, $id);

		if ($result) {
			redirect(base_url('admin/blog'));
		} else {
			redirect(base_url('admin/blog/edit_blog/' . $id));
		}
	}



	public function delete_blog()
	{
		$blogId = $this->input->post('id');

		$result = ['resultCode' => 0, 'resultMsg' => 'Failed to delete blog post'];

		if ($this->blog_model->delete_blog($blogId)) {
			$result = ['resultCode' => 1, 'resultMsg' => 'Blog post deleted successfully'];
		}

		echo json_encode($result);
	}
	public function create_result()
	{

		$data['page_title'] = 'Result';
		$data['sub_title'] = 'Post Result';
		$data['students'] = $this->Result_model->getAllStudentname();
		$data['categories'] = $this->Result_model->getAllcategories();
		$data['load_view'] = 'admin/results/create_result';
		$this->load->view('admin/template', $data);
	}
	public function save_result()
	{

		$data = array(
			'year' => $this->input->post('year'),
			'student_id' => $this->input->post('student_id'),
			'category_id' => $this->input->post('category_id'), // Corrected spelling
			'rank' => $this->input->post('rank'),
			'description' => $this->input->post('description'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);

		$result = $this->Result_model->insert_resultdata($data);

		if ($result) {
			redirect(base_url('admin/result'));
		} else {
			redirect(base_url('admin/result/create_result'));
		}
	}

	// public function view_more($blog_id)
	// {
	// 	$data['blog'] = $this->blog_model->fetch_single_blog($blog_id);
	// 	if (!$data['blog']) {
	// 		show_404();
	// 	}
	// 	$categories = $this->blog_model->get_all_categories();
	// 	$data['category_map'] = array();
	// 	foreach ($categories as $category) {
	// 		$data['category_map'][$category['category_id']] = $category['name'];
	// 	}
	// 	$data['page_title'] = 'Blog';
	// 	$data['sub_title'] = 'View More';
	// 	$data['load_view'] = 'admin/blog/view_more';

	// 	$this->load->view('admin/template', $data);
	// }


}



/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */