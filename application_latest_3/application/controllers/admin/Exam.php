<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam extends CI_Controller {

	public function __construct()
	{
  	  parent::__construct();
  	  $this->load->library('user_session_check');
	   $this->user_session_check->check_user_session();
      $this->load->library('ajax_pagination');
      $this->load->model('admin/masters_model', 'masters_model');
      $this->load->model('admin/exam_model', 'exam_model');
	}
	public function index()
	{
		$data['page_title'] = 'Exam Details';
    $data['sub_title']  = 'List Exam Details';
		$data['load_view']  = 'admin/exam/view_exam';
		$config['base_url'] = site_url('admin/exam/fetch_exam/');
		$config['total_rows'] = $this->exam_model->fetch_examdata_count();   
		$config['paging_function'] = 'ajax_pagination_exam';
		$custom_config      = $this->custom_pagination($config); 
		$startRow           = 0;
		$this->ajax_pagination->initialize($custom_config);
		$data['pagination'] = $this->ajax_pagination->create_links();
    $data["fetch_examdata"] = $this->exam_model->fetch_examdata($startRow, $custom_config['per_page']);
		$this->load->view('admin/template', $data);
	}
	
	public function fetch_exam()
	{
	    $this->fetch_exam_list();
	}
  public function fetch_exam_list()
  {
   
    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/exam/fetch_exam/');
    $config['paging_function'] = 'ajax_pagination_exam';
    $config['total_rows'] = $this->exam_model->fetch_examdata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_exam')
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
    $data['search_result'] = $this->exam_model->fetch_examdata($startRow, $custom_config['per_page']);
    $data['startRow'] = $startRow ;

    if($this->uri->segment(3) =='fetch_exam'){

      $result['search_result'] = $this->load->view('admin/exam/list_load_exam', $data, true);
      $result['pagination'] = $data['pagination'];
    }else{
      $result['search_result'] = $this->load->view('admin/exam/', $data, true);
      $result['pagination'] = $data['pagination'];
    }
    echo json_encode($result);
  }
	public function custom_pagination($main_config ='')
	{
		 $this->load->library('ajax_pagination');
    $config['full_tag_open'] = "<ul class='pagination'>";
    $config['full_tag_close'] ="</ul>";
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
    $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
    $config['next_tag_open'] = "<li>";
    $config['next_tagl_close'] = "</li>";
    $config['prev_tag_open'] = "<li>";
    $config['prev_tagl_close'] = "</li>";
    $config['first_tag_open'] = "<li>";
    $config['first_tagl_close'] = "</li>";
    $config['last_tag_open'] = "<li>";
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
	function add_exam()
	{
	   $data['page_title']= 'Exam';
	   $data['sub_title']= 'Add  Exam';
     $data["fetch_categorydata"] = $this->masters_model->fetch_category();
     $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategory();
     $data['load_view'] = 'admin/exam/add_exam';
     $this->load->view('admin/template', $data);
	}
	 public function form_validation_exam()  
    {  
     $this->form_validation->set_rules("category", "Category", 'required');
 	   $this->form_validation->set_rules("subcategory", "Sub Category", 'required');
 	   $this->form_validation->set_rules("exam_name", "Exam Name", 'required');
 	   $this->form_validation->set_rules("exam_duration", "Exam Duration", 'required');
     
     //$this->form_validation->set_rules("status", "Status", 'required');
     $this->form_validation->set_rules("is_active", "Status", 'required');
    
     //$this->form_validation->set_rules('price','lang:price','required|numeric|regex_match[/^[0-9,]+$/]');
       if($this->form_validation->run())  
       { 

       if(isset($_POST['startdate']) && $_POST['startdate']!='')        {  $start_date   = date('Y-m-d', strtotime(str_replace('/','-',$_POST['startdate'])));  } else  {  $start_date = '';   } 
       if(isset($_POST['enddate']) && $_POST['enddate']!='')        {  $end_date    = date('Y-m-d', strtotime(str_replace('/','-',$_POST['enddate'])));  } else  {  $end_date = '';   }   
       
        $currentPath = $_SERVER['PHP_SELF']; 
      // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
         $pathInfo = pathinfo($currentPath); 
      // output: localhost
         $hostName = $_SERVER['HTTP_HOST'];
         $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://'; 

          $previewpath='';

      // Uploading IC File
      $this->load->library('upload');

      if (!empty($_FILES['preview_file']['name']))
      { 
      $config['upload_path']    = './includes/adminpanel/examcourse/'; /* NB! create this dir! */ 
      $config['allowed_types']  = 'png|jpg|png|bmp|jpeg';  
      $config['max_size']     = '0';  
      $config['max_width']      = '0';
      $config['max_height']     = '0';  
      $this->upload->initialize($config);
      $this->load->library('upload', $config);  
      $this->load->library('image_lib'); 
      if(!$this->upload->do_upload('preview_file'))
      {
        $error = array('error' => $this->upload->display_errors());

        $this->load->view('admin/exam/add_video', $error);
      }
      else
      {
        $data             = $this->upload->data();
        $photoimage       = $data['file_name'];
        
        $previewpath        = $protocol.$hostName.$pathInfo['dirname'].'/includes/adminpanel/examcourse/'.$photoimage;
      }
      }
       else
      {
        $previewpath= @$this->input->post('old_preview_file');
      } 

      $codedata=array();
      $get_lastdetails =  $this->exam_model->fetch_lastdetails();
      
      $data = array(  
                
                "category_id"  	  =>$this->input->post("category"),
                "subcategory_id" 	=>$this->input->post("subcategory"),
                "exam_name" 		  =>$this->input->post("exam_name"),
                "exam_duration"  	=>$this->input->post("exam_duration"),
                "exam_preview"    =>$previewpath,
                "status"  			  =>$this->input->post("status"),
                "price"           =>$this->input->post("price"),
                "start_date"      =>$start_date,
                "end_date"        =>$end_date,
                "is_active"      	=>$this->input->post("is_active"),
                "is_deleted"     	=> 0,
                "created_by"      =>$this->session->userdata('AV_ADMIN_USERID'),
            ); 
            if($this->input->post("update"))  
            {  
                $this->exam_model->update_exam_data($data, $this->input->post("hidden_id"));  
                
                redirect(base_url() . "admin/exam");  
            }  
            if($this->input->post("insert"))  
            { 
                if($get_lastdetails->num_rows()>0)
                {
                      foreach($get_lastdetails->result_array() as $row)
                      {
                          $codedata['exam_id'] = $row['exam_id'];
                          $alpha =  substr($codedata['exam_id'],0,2);
                          
                          $number = (int) substr($codedata['exam_id'],2,strlen($codedata['exam_id'])-1)+1;
                     
                      }
                $examid = $alpha.STR_PAD((string)$number,3,"0",STR_PAD_LEFT);
        
              }
              else
              {
                $examid= 'MT'.'001';
              }
              $data['exam_id'] = $examid;
                  
                $this->exam_model->insert_examdata($data);  
                redirect(base_url() . "admin/exam"); 
            }  
       }  
       else  
       {  
            //false  
            $this->add_exam();  
       }  
    } 
    function update_exam()
    {
      $data['page_title']= 'Exam';
      $data['sub_title']= 'Update Exam Details';
      $data["fetch_categorydata"] = $this->masters_model->fetch_category();
      $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategory();
      $exam_id = $this->uri->segment(4); 
      $data["exam_data"] = $this->exam_model->fetch_single_exam($exam_id);  
      $data['load_view'] = 'admin/exam/update_exam';
      $this->load->view('admin/template', $data);
    }
    public function delete_exam()
    {

      $exam_id  = $this->db->escape_str(trim($_POST['exam_id']));
      $is_deleted['is_deleted']  = 1;
      $res = $this->exam_model->update_exam_status($exam_id, $is_deleted);
      echo 'success';
    }  
}?>