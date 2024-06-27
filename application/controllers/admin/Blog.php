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
			'author_name'  => $this->input->post('author_name'),
			'category_id'   => $this->input->post('category_id'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        
        $this->blog_model->update_blogdata($data, $id);
        redirect('admin/blog');
    }

	public function delete_blog() {
        $blogId = $this->input->post('id'); 
        
        $result = ['resultCode' => 0, 'resultMsg' => 'Failed to delete blog post'];
        
        if ($this->blog_model->delete_blog($blogId)) {
            $result = ['resultCode' => 1, 'resultMsg' => 'Blog post deleted successfully'];
        }
        
        echo json_encode($result);
    }
	public function create_blog()
    {
        $data['page_title'] = 'Blog';
        $data['sub_title'] = 'Create Post';
		$data['categories'] = $this->blog_model->get_categories(); 
        $data['load_view'] = 'admin/blog/create_blog';
        $this->load->view('admin/template', $data);
    }
	public function save_blog()
	{
		// Prepare blog data
		$data = array(
			'title'         => $this->input->post('title'),
			'discription'   => $this->input->post('discription'), // Corrected spelling
			'author_name'   => $this->input->post('author_name'),
			'category_id'   => $this->input->post('category_id'),
			'created_at'    => date('Y-m-d H:i:s'),
			'updated_at'    => date('Y-m-d H:i:s'),
			'is_deleted'    => 0 
		);

		// File upload handling
		$this->load->library('upload');
		$blog_image = '';

		if (!empty($_FILES['blog_img']['name'])) {
			$upload_path = './includes/blogs/blog_img/';

			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, true);
			}

			$config['upload_path']   = $upload_path;
			$config['allowed_types'] = 'png|jpg|jpeg|bmp'; // Corrected allowed_types

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('blog_img')) {
				$error = array('error' => $this->upload->display_errors());
				$blog_image = ''; // Handle error, maybe log or display message
			} else {
				$data_upload = $this->upload->data();
				$blog_img = $data_upload['file_name'];
				$blog_image = base_url('includes/blogs/blog_img/') . $blog_img; // Adjust path as per your setup
			}
		} else {
			// Default image path if no image uploaded
			$blog_image = base_url('assets/cl/images/user_pic.png');
		}

		$data['blog_image'] = $blog_image;

		// Insert blog data into database using model method
		$result = $this->blog_model->insert_blogdata($data);

		if ($result) {
			redirect(base_url('admin/blog'));
		} else {
			redirect(base_url('admin/student/create_blog'));
		}
	}

	public function view_more($blog_id)
	{
		$data['blog'] = $this->blog_model->fetch_single_blog($blog_id);
		if (!$data['blog']) {
			show_404();
		}
		$categories = $this->blog_model->get_all_categories();
		$data['category_map'] = array();
		foreach ($categories as $category) {
			$data['category_map'][$category['category_id']] = $category['name'];
		}
		$data['page_title'] = 'Blog';
		$data['sub_title'] = 'View More';
		$data['load_view'] = 'admin/blog/view_more';

		$this->load->view('admin/template', $data);
	}
	public function create_category()
    {
        $data['page_title'] = 'Blog Categories';
        $data['sub_title'] = 'Create Category';
        $data['load_view'] = 'admin/blog/create_category';
        $this->load->view('admin/template', $data);
    }
	public function save_category()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
        );

        $result = $this->blog_model->insert_blog_category_data($data);

		if ($result) {
            echo json_encode(array('status' => true, 'message' => 'Category created successfully'));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Failed to create category'));
        }
    }
	public function edit_category($id)
    {
        $data['category'] = $this->blog_model->get_blog_category_by_id($id);

        if ($this->input->is_ajax_request()) {
            echo $this->load->view('admin/blog/edit_category', $data, true);
        } else {
            $data['page_title'] = 'Edit Blog Category';
            $data['sub_title'] = 'Edit Category';
            $data['load_view'] = 'admin/blog/edit_category';
            $this->load->view('admin/template', $data);
        }
    }
	public function update_category($id)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
        );

        $result = $this->blog_model->update_blog_category_data($data, $id);

        if ($result) {
            echo json_encode(array('status' => true, 'message' => 'Category updated successfully'));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Failed to update category'));
        }
    }
	
	public function delete_category()
	{
		$category_id = $this->input->post('id');
		$response = array('resultCode' => 0, 'resultMsg' => 'Failed to delete category.');

		if ($this->blog_model->delete_blog_category($category_id)) {
			$response['resultCode'] = 1;
			$response['resultMsg'] = 'Category deleted successfully.';
		}

		echo json_encode($response);
	}


	public function view_category($category_id)
	{
		$data['category'] = $this->blog_model->fetch_single_blog_category($category_id);
		if (!$data['category']) {
			show_404();
		}
		$data['page_title'] = 'Blog';
		$data['sub_title'] = 'View More';
		$data['load_view'] = 'admin/blog/view_category';

		$this->load->view('admin/template', $data);
	}
	public function view_categories()
	{
		$data['category'] = $this->blog_model->get_all_category();
		
		$data['page_title'] = 'Blog';
		$data['sub_title'] = 'View Category';
		$data['load_view'] = 'admin/blog/view_categories';

		$this->load->view('admin/template', $data);
	}

}



/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */