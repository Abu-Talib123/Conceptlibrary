<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
        $this->load->library('user_session_check');
	    $this->user_session_check->check_user_session();
      $this->load->library('ajax_pagination');
      $this->load->model('admin/masters_model', 'masters_model');
      $this->load->model('admin/video_model', 'video_model');
  }
  public function index()
  {
    $data['page_title']= 'Video';
    $data['sub_title']= 'List Video Courses';
    $data['load_view'] = 'admin/video/view_video';
    $config['base_url'] = site_url('admin/video/fetch_video/');
    $config['total_rows'] = $this->video_model->fetch_videodata_count();   
    $config['paging_function'] = 'ajax_pagination_video';
    $custom_config = $this->custom_pagination($config); 
    $startRow = 0;
    $this->ajax_pagination->initialize($custom_config);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data["fetch_videodata"] = $this->video_model->fetch_videodata($startRow, $custom_config['per_page']);
    $this->load->view('admin/template', $data);
  }
  public function fetch_video()
  {
      $this->fetch_video_list();
  }
    public function fetch_video_list()
    {
   
    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/video/fetch_video/');
    $config['paging_function'] = 'ajax_pagination_video';
    $config['total_rows'] = $this->video_model->fetch_videodata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_video')
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
    $data['search_result'] = $this->video_model->fetch_videodata($startRow, $custom_config['per_page']);
    $data['startRow']      = $startRow;
    if($this->uri->segment(3) =='fetch_video'){

      $result['search_result'] = $this->load->view('admin/video/list_load_video', $data, true);
      $result['pagination'] = $data['pagination'];
    }else{
      $result['search_result'] = $this->load->view('admin/video/', $data, true);
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
  function add_coursevideo()
  {
    $data['page_title']= 'Video';
    $data['sub_title']= 'Add Video Course';
    $data["fetch_categorydata"] = $this->masters_model->fetch_category();
    $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategory();
    $data['load_view'] = 'admin/video/add_video';
    $this->load->view('admin/template', $data);
  }

  function  form_validate_videodata()
  {
   
   $this->form_validation->set_rules("category", "Category", 'required');
   $this->form_validation->set_rules("subcategory", "Sub Category", 'required');
   $this->form_validation->set_rules("video_name", "Video Name", 'required');
   $this->form_validation->set_rules("video_description", "Description", 'required');
   
   if(!$this->input->post("update")) {
      if (empty($_FILES['preview_file']['name']))
      {
      $this->form_validation->set_rules('preview_file', 'Preview File', 'required');
      }
      if (empty($_FILES['video_file']['name']))
      {
        $this->form_validation->set_rules('video_file', 'Video File', 'required');
      }
   }
     
     $this->form_validation->set_rules("is_active", "Status", 'required');
     if($this->form_validation->run())  
     {    
    $currentPath = $_SERVER['PHP_SELF']; 
  
    $pathInfo = pathinfo($currentPath); 
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';

    $config['upload_path']          ="./includes/adminpanel/videocourse";
    $config['allowed_types']        = '*';
    $config['max_size']             = 0;
    //$config['max_width']            = 1300;
    //$config['max_height']           = 1024;
    $videopath ='';
    $this->load->library('upload', $config);
    if (!empty($_FILES['video_file']['name'])){
        if ( ! $this->upload->do_upload('video_file'))
        {
    
          $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
    
          $error = array('error' => $this->upload->display_errors());
    
          $this->load->view('admin/video/add_video', $error);
        }
        else
        {
          $data1               =   $this->upload->data();
          $video              =   $data1['file_name'];
          $videopath          =   $protocol.$hostName.$pathInfo['dirname'].'/includes/adminpanel/videocourse/'.$video;
          
        }
     } else
    {
      $videopath= @$this->input->post('old_video_file');
    }
    $videopath1 = $videopath;
   
    $previewpath='';

    // Uploading IC File
    $this->load->library('upload');

    if (!empty($_FILES['preview_file']['name']))
    { 
        $config['upload_path']    = './includes/adminpanel/videocourse/'; /* NB! create this dir! */ 
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
    
          $this->load->view('admin/video/add_video', $error);
        }
        else
        {
          $data1             = $this->upload->data();
          $photoimage       = $data1['file_name'];
          
          $previewpath      = $protocol.$hostName.$pathInfo['dirname'].'/includes/adminpanel/videocourse/'.$photoimage;
        }
    }
     else
    {
      $previewpath= @$this->input->post('old_preview_file');
    }
    

    $codedata=array();
    $get_lastdetails =  $this->video_model->fetch_lastdetails();
    if($get_lastdetails->num_rows()>0)
    {
        $video_ids = $get_lastdetails->row_array();
    
        $codedata['video_id'] = $video_ids['video_id'];
        $alpha =  substr($codedata['video_id'],0,2);
        
        $number = (int) substr($codedata['video_id'],2,strlen($codedata['video_id'])-1)+1;
        $videoid = $alpha.STR_PAD((string)$number,3,"0",STR_PAD_LEFT);

    }
    else
    {
    $videoid= 'VI'.'001';
    }
    
        $data['video_id']           = $videoid;
        $data['category_id']        = @$this->input->post('category');
        $data['subcategory_id']     = @$this->input->post('subcategory');
        $data['video_name']         = @$this->input->post('video_name');
        $data['video_description']  = @$this->input->post('video_description');
        $data['video_preview']      = $previewpath;
        $data['video_url']          = $videopath1;
        $data['status']             = @$this->input->post('status');
        $data['is_active']          = @$this->input->post('is_active');

         
         
          if($this->input->post("update"))  
          {  
           $this->video_model->update_videodata($data, $this->input->post("hidden_id"));  
          
           redirect(base_url() . "admin/video");  
          }  
          if($this->input->post("insert"))  
          {  
           $this->video_model->insert_videodata($data);  
           redirect(base_url() . "admin/video");
          }  
    }
     else  
     {  
          //false  
          $this->add_coursevideo();  
     }  
  }
  function update_coursevideo()
  {
    $data['page_title']= 'Video';
    $data['sub_title']= 'Update Video Course';
    $data["fetch_categorydata"] = $this->masters_model->fetch_category();
    $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategory();
    $video_id = $this->uri->segment(4); 
    $data["video_data"] = $this->video_model->fetch_single_video($video_id);  
    $data['load_view'] = 'admin/video/update_video';
    $this->load->view('admin/template', $data);
  }
  public function delete_video()
  {

    $video_id  = $this->db->escape_str(trim($_POST['video_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->video_model->update_video_status($video_id, $is_deleted);
    echo 'success';
  } 
    
  
  
}

/* End of file video.php */
/* Location: ./application/controllers/admin/video.php */