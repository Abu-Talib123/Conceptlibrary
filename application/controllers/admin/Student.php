<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {

  	public function __construct()
  	{
    	  parent::__construct();
    	  $this->load->library('user_session_check');
	      $this->user_session_check->check_user_session();
        $this->load->library('ajax_pagination');
        $this->load->model('admin/masters_model', 'masters_model');
        $this->load->model('admin/student_model', 'student_model');
  	}
  	public function index()
  	{ 
      $filter = $this->input->get('filter', TRUE);
  		$data['page_title'] = 'Student';
      $data['sub_title']  = 'List Student Details';
  		$data['load_view']  = 'admin/student/view_student';
  		$config['base_url'] = site_url('admin/student/fetch_student/');
  		$config['total_rows'] = $this->student_model->fetch_studentdata_count();   
  		$config['paging_function'] = 'ajax_pagination_student';
  		$custom_config      = $this->custom_pagination($config); 
  		$startRow           = 0;
  		$this->ajax_pagination->initialize($custom_config);
  		$data['pagination'] = $this->ajax_pagination->create_links();
      if ($filter) {
        $data["fetch_studentdata"] = $this->student_model->fetch_filtered_student_list($filter,$startRow, $custom_config['per_page']);
      }
      else {
        $data["fetch_studentdata"] = $this->student_model->fetch_studentdata($startRow, $custom_config['per_page']);
      }
  		$this->load->view('admin/template', $data);
  	}
	
  	public function fetch_student()
  	{
  	  $this->fetch_student_list();
  	}
  	public function fetch_student_list()
  	{
   
      $this->load->library('ajax_pagination');
      $config['base_url'] = site_url('admin/student/fetch_student/');
      $config['paging_function'] = 'ajax_pagination_student';
      $config['total_rows'] = $this->student_model->fetch_studentdata_count();
      $custom_config = $this->custom_pagination($config);
      $startRow = 0;
      if($this->uri->segment(3) =='fetch_student')
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
      $data['pagination'] = $this->ajax_pagination->create_links();
      $filter = $this->input->post('filter', TRUE);
      if ($filter) {
        $data["search_result"] = $this->student_model->fetch_filtered_student_list($filter,$startRow, $custom_config['per_page']);
      }
      else {
        $data["search_result"] = $this->student_model->fetch_studentdata($startRow, $custom_config['per_page']);
      }
      $data['startRow']      = $startRow;
      if($this->uri->segment(3) =='fetch_student'){

        $result['search_result'] = $this->load->view('admin/student/list_load_student', $data, true);
        $result['pagination'] = $data['pagination'];
      }else{
        $result['search_result'] = $this->load->view('admin/student/', $data, true);
        $result['pagination'] = $data['pagination'];
      }
      $result['filter'] = $filter;  
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

  function update_student()
  {
    $student_id  = $this->db->escape_str(trim($_POST['student_id']));
    $is_active  = $this->db->escape_str(trim($_POST['is_active']));
    $res                      = $this->student_model->update_student_data($student_id, $is_active);
       if($res)
      { 
        $result['resultCode'] = 1;
        $result['resultMsg'] = 'Updated Successfully';
      }
      else{
        $result['resultCode'] = 0;
        $result['resultMsg'] = 'Failed to  Update';
      }

    echo json_encode($result);
  }
  public function delete_student()
  {
    $student_id  = $this->db->escape_str(trim($_POST['student_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->student_model->update_student_status($student_id, $is_deleted);
    echo 'success';
  }  
    function view_more()
    {
      $data['page_title']         = 'Student Details';
      $data['sub_title']          = 'Detailed View';
      $student_id                 = $this->uri->segment(4);
      $data["student_data"]       = $this->student_model->fetch_student($student_id);
      $data['load_view']          = 'admin/student/view_more';
      $this->load->view('admin/template', $data);
    }
    function edit_student()
    {
      $data['page_title']         = 'Student Details';
      $data['sub_title']          = 'Update Student Data';
      $student_id                 = $this->uri->segment(4);
      $data["fetch_categorydata"]    = $this->Common_model->fetch_categorydata();
      $data["fetch_subcategorydata"] = $this->Common_model->fetch_subcategorydata();
      $data["fetch_universitydata"]  = $this->Common_model->fetch_universitydata();
      $data["fetch_collegedata"]     = $this->Common_model->fetch_collegedata();
      $data["fetch_countrydata"]     = $this->Common_model->fetch_countrydata();
      $data["fetch_statedata"]       = $this->Common_model->fetch_statedata();
      $data["fetch_citydata"]        = $this->Common_model->fetch_citydata();
      $data["student_data"]          = $this->student_model->fetch_student($student_id);
      $data['load_view']             = 'admin/student/edit_student';
      $this->load->view('admin/template', $data);
    }
    function update_student_data()
    {
    $student_id                   = @$this->input->post('student_id');
    $postdata['email']            = @$this->input->post('email');
    $postdata['mobile']           = @$this->input->post('mobile');
    $postdata['category_id']      = @$this->input->post('category');
    $postdata['subcategory_id']   = @$this->input->post('subcategory');  
    $postdata['university_id']    = @$this->input->post('university');
    $postdata['college_id']       = @$this->input->post('college');
    $postdata['registration_id']  = @$this->input->post('registration_id');
    $postdata['country_id']       = @$this->input->post('country');
    $postdata['state_id']         = @$this->input->post('state');
    $postdata['city_id']          = @$this->input->post('city');
    $postdata['address']          = @$this->input->post('address');
    $postdata['pincode']          = @$this->input->post('pincode');
    $postdata['aadhar_no']        = @$this->input->post('aadhar_no');
  //FILE UPLOAD CODE FOR IC IMAGE
    
  $currentPath = $_SERVER['PHP_SELF']; 

  // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
  $pathInfo = pathinfo($currentPath); 

  // output: localhost
  $hostName = $_SERVER['HTTP_HOST']; 

  // output: http://
  $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://'; 

  $imagepath='';
  $student_photo='';
  
  // Uploading IC File
  $this->load->library('upload');
  
  if (!empty($_FILES['aadhar_file']['name']))
  { 
    
    $config['upload_path']    = './includes/student/aadhar/'; /* NB! create this dir! */ 
    $config['allowed_types']  = 'png|jpg|png|bmp|jpeg';  
    $config['max_size']     = '0';  
    $config['max_width']      = '0';
    $config['max_height']     = '0';  
    $this->upload->initialize($config);
    $this->load->library('upload', $config);  
    $this->load->library('image_lib'); 
    if(!$this->upload->do_upload('aadhar_file'))
    {
      $error4 = array('error' => $this->upload->display_errors());
      $imagepath  = NULL;
    }
    else
    {
      $data             = $this->upload->data();
      $aadharimage      = $data['file_name'];
      $imagepath        = $protocol.$hostName.$pathInfo['dirname'].'/includes/student/aadhar/'.$aadharimage;
    }
  }
   else
    {
      $imagepath       = @$this->input->post('old_aadhar');
    }
    
      if (!empty($_FILES['profile_img_file']['name'])){ 
        $upload_path = './includes/student/student_photo/';
        if (!is_dir($upload_path)) {
          mkdir($upload_path, 0777, true);
        }
        $config['upload_path']    = $upload_path; /* NB! create this dir! */ 
        $config['allowed_types']  = 'png|jpg|png|bmp|jpeg';  
        $config['max_size']     = '100';  
        $config['max_width']      = '0';
        $config['max_height']     = '0';  
        $this->upload->initialize($config);
        $this->load->library('upload', $config);  
        $this->load->library('image_lib'); 
        if(!$this->upload->do_upload('profile_img_file'))
        {
          $error4 = array('error' => $this->upload->display_errors());
          $student_photo  = NULL;
          echo "<script>alert('$error4');</script>";
        }
        else
        {
          $data             = $this->upload->data();
          $studentimg      = $data['file_name'];
          $student_photo       = $protocol.$hostName.$pathInfo['dirname'].'/includes/student/student_photo/'.$studentimg;
        }
      }
     else
      {
        $student_photo       = base_url('assets/cl')."/images/user_pic.png";
      }
    $postdata['aadhar_link']  = $imagepath;
    $postdata['student_photo'] = $student_photo;
  
    $studentdata= $this->student_model->update_studentdata($postdata,$student_id);
    if($studentdata)
    {
      
      redirect(base_url() . "admin/student");  
    }
    else
    {
       redirect(base_url() . "admin/student/edit_student"); 
    }  
  }

  public function getStudentSelectJson()
  {
    $searchTerm = @$this->input->post('term')['term'];
    if($searchTerm)
    {
      $students = $this->student_model->getStudentBySearchJson($searchTerm);
    }
    else
    {
      $students = $this->student_model->getStudentByLimitJson();
    }
    $data = array();
    if($students)
    {
      foreach ($students as $key => $student)
      {
        $data[] = array("id" => $student->student_id, "text" => $student->username."($student->student_id)");
      }
    }
    echo json_encode($data);
  }

  public function history()
  {
    $data['page_title'] = 'Student History';
    $data['sub_title']  = 'List Student Exam Details';
    $data['load_view']  = 'admin/student/view_student_history';
    // $config['base_url'] = site_url('admin/student/fetch_student/');
    $this->load->view('admin/template', $data);
  }

  function get_student_exam_history($student_id = false)
    {
        if($student_id)
        {
            $data['exams'] = $this->student_model->get_student_exam_history($student_id);
            $data['student_id'] = $student_id;
            $html = $this->load->view("admin/student/generate_student_exam_history", $data, true);
            echo $html;
        }
        else
        {
            echo "Invalid student id!";
        }
    }

    public function deleteStudentExamHistory($student_id = 0, $exam_id = 0)
    {
      if($student_id && $exam_id)
      {
        $data['status'] = $this->student_model->deleteStudentExamHistory($student_id,$exam_id);
      }
      else 
      {
        $data['status'] = false;
      }
      echo json_encode($data);
    }

    public function upload_student_img() {
      $student_id = $this->input->post('student_id');
  
      $config['upload_path'] = './uploads/students/';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['max_size'] = 0;
      $config['file_name'] = $student_id . '_photo';
  
      $this->load->library('upload', $config);
  
      if (!$this->upload->do_upload('student_img')) {
          $error = $this->upload->display_errors();
          echo "Error: " . $error;
      } else {
          $upload_data = $this->upload->data();
          $photo_path = 'uploads/students/' . $upload_data['file_name'];
  
          $this->load->model('Student_model');
      }}
    
}?>