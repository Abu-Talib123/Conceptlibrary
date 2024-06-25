<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mock_test extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->library('user_session_check');
	    $this->user_session_check->check_user_session();
      $this->load->library('ajax_pagination');
      // $this->load->library('excel');
      $this->load->model('admin/exam_model', 'exam_model');
      $this->load->model('admin/masters_model', 'masters_model');
      $this->load->model('admin/mock_test_model', 'mock_model');
	}
	public function index()
	{
		$data['page_title']= 'Mock Test';
    $data['sub_title']= 'List Test Courses';
		$data['load_view'] = 'admin/mock/view_mock_test';
		$config['base_url'] = site_url('admin/mock_test/fetch_mocktest');
		$config['total_rows'] = $this->exam_model->fetch_examdata_count();   
		$config['paging_function'] = 'ajax_pagination_mock';
		$custom_config = $this->custom_pagination($config); 
		$startRow = 0;
		$this->ajax_pagination->initialize($custom_config);
		
		$data['pagination'] = $this->ajax_pagination->create_links();
    
   
    $data["fetch_examdata"] = $this->exam_model->fetch_examdata($startRow, $custom_config['per_page']); 
   
		$this->load->view('admin/template', $data);
	}
	
	public function fetch_mocktest()
	{
	 $this->fetch_mock_list();
	}
	public function fetch_mock_list()
	{
 
  $this->load->library('ajax_pagination');
  $config['base_url'] = site_url('admin/mock_test/fetch_mocktest');
  $config['paging_function'] = 'ajax_pagination_mock';
  $config['total_rows'] = $this->exam_model->fetch_examdata_count();
  $custom_config = $this->custom_pagination($config);
  $startRow = 0;
  if($this->uri->segment(3) =='fetch_mocktest')
  {
    if($this->uri->segment(4) == '')
    {
      $startRow = 0;
    }
    else
    {
      $startRow = ($this->uri->segment(4) - 1) * PER_PAGE;
     // print_r(PER_PAGE);exit;
    }
  }
  
  $this->ajax_pagination->initialize($custom_config);
  $data['pagination'] = $this->ajax_pagination->create_links();
  $data['search_result'] = $this->exam_model->fetch_examdata($startRow, $custom_config['per_page']);
  //$data["fetch_examdata"] = $this->exam_model->fetch_examdetailsdata(); 
  $data['startRow'] = $startRow ;

  if($this->uri->segment(3) =='fetch_mocktest'){

    $result['search_result'] = $this->load->view('admin/mock/list_load_mock', $data, true);
    $result['pagination'] = $data['pagination'];
  }else{
    $result['search_result'] = $this->load->view('admin/mock/', $data, true);
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
	function add_coursemock()
	{
    $data['page_title']= 'Mock Details';
    $data['sub_title']= 'Add  Course Mock';
    $data["fetch_categorydata"] = $this->masters_model->fetch_category();
    $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategory();
    $data['load_js']  = 'mock';
    $data["fetch_examdata"] = $this->exam_model->fetch_examdetailsdata(); 
    $data['load_view'] = 'admin/mock/add_course_mock';
    $this->load->view('admin/add_template', $data);
	}
	
  public function form_validation_mock()  
  {  
        $question_type= @$this->input->post("question_type");
        $questionpath = @$this->input->post("question");
     

         $option_type=$this->input->post("option_type");

         if($option_type == 0)
         {

           $correct_answer  = $this->input->post("correct_answer");
           $optiona = $this->input->post("optiona");
           $optionb = $this->input->post("optionb");
           $optionc = $this->input->post("optionc");
           $optiond = $this->input->post("optiond");
         
         } else if($option_type == 2) {
            
            $correct_answer = implode(",", $this->input->post('checkbox_correct_answer'));
            $optiona = $this->input->post("checkbox_optiona");
            $optionb = $this->input->post("checkbox_optionb");
            $optionc = $this->input->post("checkbox_optionc");
            $optiond = $this->input->post("checkbox_optiond");
         
         } else {
            
            $correct_answer  = $this->input->post("correct_answer1");
            $optiona = "";
            $optionb = "";
            $optionc = "";
            $optiond = "";
         
         }
         $solution_type =$this->input->post("solution_type");
        $previewpath ='';
         if($solution_type == 1){
             $currentPath = $_SERVER['PHP_SELF']; 
          // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
             $pathInfo = pathinfo($currentPath); 
          // output: localhost
             $hostName = $_SERVER['HTTP_HOST'];
             $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://'; 

            $previewpath='';

            // Uploading IC File
            $this->load->library('upload');

            if (!empty($_FILES['step']['name']))
            { 
              $config['upload_path']    = './includes/adminpanel/examcourse/solution/'; /* NB! create this dir! */ 
              $config['allowed_types']  = 'png|jpg|png|bmp|jpeg';  
              $config['max_size']     = '0';  
              $config['max_width']      = '0';
              $config['max_height']     = '0';  
              $this->upload->initialize($config);
              $this->load->library('upload', $config);  
              $this->load->library('image_lib'); 
              if(!$this->upload->do_upload('step'))
              {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('admin/mock_test/add_coursemock', $error);
              }
              else
              {
                $data             = $this->upload->data();
                $photoimage       = $data['file_name'];
                
                $previewpath      = $protocol.$hostName.$pathInfo['dirname'].'/includes/adminpanel/examcourse/solution/'.$photoimage;
              }
            }
            else
            {
              $previewpath='';
            } 
          }else
          {
               $previewpath = @$this->input->post("steps");
          }

          $ques["category_id"]      = $this->input->post("category");
          $ques["subcategory_id"]   = $this->input->post("subcategory");
          $ques["exam_id"]          = $this->input->post("exam_id");
          $ques["question_type"]    = $this->input->post("question_type");
          $ques["question"]         = $this->input->post("question");
          $ques["option_type"]      = $this->input->post("option_type");
          $ques["option_1"]         = $optiona;
          $ques["option_2"]         = $optionb;
          $ques["option_3"]         = $optionc;
          $ques["option_4"]         = $optiond;
          $ques["correct_answer"]   = $correct_answer;
          $ques["solution_type"]    = $solution_type;
          $ques["step"]             = $previewpath;
          $ques["is_active"]        = $this->input->post("is_active");
          $ques["mark"]             = $this->input->post("mark");
          $ques["is_negative"]      = $this->input->post("is_negative");
          $ques["negative_mark"]    = $this->input->post("negative_mark");
          $ques["is_deleted"]       = 0;
      
          $insertdata =  $this->mock_model->insert_mockdata($ques);  
          if($insertdata)
          {
              
            $result['resultCode'] = 1;
            $result['resultMsg'] = 'Success';
          }else{
            $result['resultCode'] = 0;
            $result['resultMsg'] = 'Failed to Add';
          }
       echo json_encode($result);
    } 


    public function delete_test()
    {
    $mock_test_id  = $this->db->escape_str(trim($_POST['mock_test_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->mock_model->update_mock_status($mock_test_id, $is_deleted);
    echo 'success';
    }  
    function csv_upload()
    {
      $data['page_title']= 'Add Mock  Questions through CSV';
      $data['sub_title']= 'Add  Course Mock';
      $data['load_view'] = 'admin/mock/csv_upload';
      $this->load->view('admin/add_template', $data);
    }
    function import()
    {
      if(isset($_FILES["file"]["name"]))
      {
        $path = $_FILES["file"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);
        foreach($object->getWorksheetIterator() as $worksheet)
        {
          $highestRow = $worksheet->getHighestRow();
          $highestColumn = $worksheet->getHighestColumn();
          for($row=2; $row<=$highestRow; $row++)
          {
            $exam_id          = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
            $question         = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $option_1         = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $option_2         = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $option_3         = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $option_4         = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $correct_answer   = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $step             = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
            $is_active        = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
            $data[] = array(
            'exam_id'         =>  $exam_id,
            'question'        =>  $question,
            'option_1'        =>  $option_1,
            'option_2'        =>  $option_2,
            'option_3'        =>  $option_3,
            'option_4'        =>  $option_4,
            'correct_answer'  =>  $correct_answer,
            'step'            =>  $step,
            'is_active'       =>  $is_active,
            'is_deleted'      =>  0
            );
          }
        }
        $this->mock_model->insert($data);
         $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:green;'> Information has been inserted</p></div>");
        $result['resultCode'] = 1;
        $result['resultMsg'] = 'Data Imported successfully';
       
      } else
      {
        $result['resultCode'] = 0;
        $result['resultMsg'] = 'Failed to Upload';
      }
      echo json_encode($result);
    }
    function detailed_view()
    {
      $data['exam_id'] = $this->uri->segment(4);
      $data['page_title']= 'Admin/Mock Test';
      $data['sub_title']= 'List Test Courses';
      $data['load_view'] = 'admin/mock/detailed_view';
      $config['base_url'] = site_url('admin/mock_test/fetch_mocktest/');
      $config['total_rows'] = $this->mock_model->fetch_mockdata_count();   
      $config['paging_function'] = 'ajax_pagination_mock';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_mockdata"] = $this->mock_model->fetch_mockdatabyid($data['exam_id']);
     
      $this->load->view('admin/template', $data);
      
    }
    function list_mock()
    {
      $data['exam_id'] = $this->uri->segment(4);
      $data['page_title']= 'Admin/Mock Test';
      $data['sub_title']= 'List Test Courses';
      $data['load_view'] = 'admin/mock/view_mock';
      $config['base_url'] = site_url('admin/mock_test/fetch_mocklist/'.$data['exam_id']);
      $config['total_rows'] = $this->mock_model->fetch_mockbyid_count($data['exam_id']);   
      $config['paging_function'] = 'ajax_pagination_mocklist';
      $custom_config = $this->custom_pagination1($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_mockdata"] = $this->mock_model->fetch_mockdatabyid($data['exam_id'],$startRow, $custom_config['per_page']);
      $this->load->view('admin/template', $data);
    }
   
  
  public function fetch_mocklist()
  {
    $data['exam_id'] = $this->uri->segment(4);
   $this->fetch_mock_by_id($data['exam_id']);
  }
  public function fetch_mock_by_id($exam_id)
  {
 
  $this->load->library('ajax_pagination');
  $config['base_url'] = site_url('admin/mock_test/fetch_mocklist/'.$exam_id);
  $config['paging_function'] = 'ajax_pagination_mocklist';
  $config['total_rows'] = $this->mock_model->fetch_mockbyid_count($exam_id); 
  $custom_config = $this->custom_pagination1($config);
  $startRow = 0;
  if($this->uri->segment(3) =='fetch_mocklist')
  {
    if($this->uri->segment(5) == '')
    {
      $startRow = 0;
    }
    else
    {
      $startRow = ($this->uri->segment(5) - 1) * PER_PAGE;
     // print_r(PER_PAGE);exit;
    }
  }
  
  $this->ajax_pagination->initialize($custom_config);
  $data['pagination'] = $this->ajax_pagination->create_links();
  $data['search_result'] = $this->mock_model->fetch_mockdatabyid($exam_id,$startRow, $custom_config['per_page']);
  //$data["fetch_examdata"] = $this->exam_model->fetch_examdetailsdata(); 
  $data['startRow'] = $startRow ;

  if($this->uri->segment(3) =='fetch_mocklist'){

    $result['search_result'] = $this->load->view('admin/mock/list_load_mocklist', $data, true);
    $result['pagination'] = $data['pagination'];
  }else{
    $result['search_result'] = $this->load->view('admin/mock/list_mock', $data, true);
    $result['pagination'] = $data['pagination'];
  }
  echo json_encode($result);
}
  function edit_mocktest()
  {
    $data['mock_test_id'] = $this->uri->segment(4);
    $data['page_title']= 'Admin/Mock Test';
    $data['sub_title']= 'Edit Mock Test';
    $data["fetch_categorydata"] = $this->masters_model->fetch_category();
    $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategory();
    $data["fetch_examdata"] = $this->exam_model->fetch_examdetailsdata(); 
    $data['load_js']  = 'mock';
    $data['load_view'] = 'admin/mock/edit_mock';
    $data["fetch_mockdata"] = $this->mock_model->fetch_mocktestbyid($data['mock_test_id']);
    $this->load->view('admin/add_template', $data);
  }

    function update_mock(){
    
        $question_type =  @$this->input->post("question_type");
       
        $questionpath =   @$this->input->post("question");
     
       /* if($question_type == 1){
        $currentPath = $_SERVER['PHP_SELF']; 
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath); 
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST'];
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://'; 

        $questionpath='';

        // Uploading IC File
        $this->load->library('upload');

        if (!empty($_FILES['question1']['name']))
        { 
          $config['upload_path']    = './includes/adminpanel/examcourse/question/'; 
          $config['allowed_types']  = 'png|jpg|png|bmp|jpeg';  
          $config['max_size']     = '0';  
          $config['max_width']      = '0';
          $config['max_height']     = '0';  
          $this->upload->initialize($config);
          $this->load->library('upload', $config);  
          $this->load->library('image_lib'); 
          if(!$this->upload->do_upload('question1'))
          {
          $error = array('error' => $this->upload->display_errors());

          $this->load->view('admin/mock_test/add_coursemock', $error);
          }
          else
          {
          $data             = $this->upload->data();
          $questionimage       = $data['file_name'];

          $questionpath      = $protocol.$hostName.$pathInfo['dirname'].'/includes/adminpanel/examcourse/question/'.$questionimage;
          }
        }
        else
        {
        $questionpath= @$this->input->post('old_question_file');
        } 
        }else
        {
        $questionpath =$this->input->post("question");
        }*/

        $option_type =$this->input->post("option_type");
        if($option_type == 0){

          $correct_answer = @$this->input->post("correct_answer");
          $optiona = $this->input->post("optiona");
          $optionb = $this->input->post("optionb");
          $optionc = $this->input->post("optionc");
          $optiond = $this->input->post("optiond");
        
        } else if($option_type == 2)
        {
          $correct_answer = implode(",", $this->input->post('checkbox_correct_answer'));
          $optiona = $this->input->post("checkbox_optiona");
          $optionb = $this->input->post("checkbox_optionb");
          $optionc = $this->input->post("checkbox_optionc");
          $optiond = $this->input->post("checkbox_optiond");
        }
        else{
          $correct_answer = @$this->input->post("correct_answer1");
          $optiona = "";
          $optionb = "";
          $optionc = "";
          $optiond = "";
        }
        $is_negative =$this->input->post("is_negative");
        if($is_negative == 1){

        $negative_mark = @$this->input->post("negative_mark1");
        }
        else{
         $negative_mark = @$this->input->post("negative_mark");
        }
       

        $solution_type =$this->input->post("solution_type");
     
      if($solution_type == 1){
         $currentPath = $_SERVER['PHP_SELF']; 
      // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
         $pathInfo = pathinfo($currentPath); 
      // output: localhost
         $hostName = $_SERVER['HTTP_HOST'];
         $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://'; 

          $previewpath='';

      // Uploading IC File
      $this->load->library('upload');

            if (!empty($_FILES['step']['name']))
            { 
                $config['upload_path']    = './includes/adminpanel/examcourse/solution/'; /* NB! create this dir! */ 
                $config['allowed_types']  = 'png|jpg|png|bmp|jpeg';  
                $config['max_size']     = '0';  
                $config['max_width']      = '0';
                $config['max_height']     = '0';  
                $this->upload->initialize($config);
                $this->load->library('upload', $config);  
                $this->load->library('image_lib'); 
                  if(!$this->upload->do_upload('step'))
                {
                  $error = array('error' => $this->upload->display_errors());

                  $this->load->view('admin/mock_test/add_coursemock', $error);
                }
                else
                {
                  $img_data            = $this->upload->data();
                  $photoimage       = $img_data['file_name'];
                  
                  $previewpath      = $protocol.$hostName.$pathInfo['dirname'].'/includes/adminpanel/examcourse/solution/'.$photoimage;
                }
              }
              else
              {
                $previewpath= @$this->input->post('old_preview_file');
              } 
            }else
            {
                 $previewpath = @$this->input->post("steps");
            }



          $data1["category_id"]      = $this->input->post("category");
          $data1["subcategory_id"]   = $this->input->post("subcategory");
          $data1["exam_id"]          = $this->input->post("exam_id");
          $data1["question_type"]    = $this->input->post("question_type");
          $data1["question"]         = $this->input->post("question");
          $data1["option_type"]      = $this->input->post("option_type");
          $data1["option_1"]         = $optiona;
          $data1["option_2"]         = $optionb;
          $data1["option_3"]         = $optionc;
          $data1["option_4"]         = $optiond;
          $data1["correct_answer"]   = $correct_answer;
          $data1["solution_type"]    = $solution_type;
          $data1["step"]             = $previewpath;
          $data1["is_active"]        = $this->input->post("is_active");
          $data1["is_deleted"]       = 0;
          $data1["mark"]             = $this->input->post("mark");
          $data1["is_negative"]      = $this->input->post("is_negative");
          $data1["negative_mark"]    = $negative_mark;
  
     
         $updatedata =  $this->mock_model->update_mock_testdata($data1,$this->input->post("hidden_id")); 

          if($updatedata)
          {
              $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:green;'> Information has been updated</p></div>");
            $result['resultCode'] = 1;
            $result['resultMsg'] = 'Success';
          }else{
            $result['resultCode'] = 0;
            $result['resultMsg'] = 'Failed to Update';
          }
       echo json_encode($result);
          
      
    }
  public function custom_pagination1($main_config ='')
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
    $config['uri_segment'] = 5;
    $config['per_page'] = PER_PAGE;
    $config['use_page_numbers'] = TRUE;
    $config['is_ajax_paging'] =  TRUE; // default FALSE;

    if($main_config !=''){
    $config = array_merge($main_config, $config);
    }
    return $config;
  }
   function getsubcategory($category)
    {
         $subcatoptiondata  = '<select class="form-control"  id="subcategory" name="subcategory" onchange="getexam()" >
                  <option selected="selected" value="">Select</option>';
       if($category!='')
        {             
         $getsubcategory   = $this->masters_model->fetchsubcatbyid($category);
       
          if($getsubcategory)
          {
            $i=0;
            foreach($getsubcategory as $subcat)
            {

              $subcatoptiondata  = $subcatoptiondata.'<option value="'.$subcat['subcategory_id'].'">'.$subcat['subcategory_name'].'</option>';
              
              $i++;
            }
          }
        } 
      else
      {
        $subcatoptiondata  = $subcatoptiondata.'';
      }

      $subcatoptiondata  = $subcatoptiondata.'</select>';
      
      echo $subcatoptiondata;

   } 
   function getexam($subcategory_id)
  {
     $examoptiondata  = '<select class="form-control"  id="exam_id" name="exam_id">
            <option selected="selected" value="">All</option>';
     if($subcategory_id!='')
      {             
       $getexam   = $this->masters_model->fetchexambyid($subcategory_id);
     
        if($getexam->num_rows()>0)
        {
          $i=0;
          foreach($getexam->result_array() as $exam)
          {

            $examoptiondata  = $examoptiondata.'<option value="'.$exam['exam_id'].'">'.$exam['exam_name'].'</option>';
            
            $i++;
          }
        }
      } 
    else
    {
      $examoptiondata  = $examoptiondata.'';
    }

    $examoptiondata  = $examoptiondata.'</select>';
    
    echo $examoptiondata;
    
  }
  
  public function editor_file_upload() {
     
$type = $_GET['type'];
$CKEditor = $_GET['CKEditor'];
$funcNum  = $_GET['CKEditorFuncNum'];
$message  = 'uploaded successfully';
// Image upload
if($type == 'image'){
    
    $allowed_extension = array(
        "png",
        "jpg",
        "jpeg",
        "svg"
    );
    
    // Get image file extension
    $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
    
    if(in_array(strtolower($file_extension),$allowed_extension)){

        if(move_uploaded_file($_FILES['upload']['tmp_name'], "./ckeditor_upload_images/".$_FILES['upload']['name'])){

            $url = base_url("ckeditor_upload_images/".$_FILES['upload']['name']);
            $content =" 'Content-type', 'text/html'";
        
            $content .= "<script type=\"text/javascript\">\n";
            $content .= "window.parent.CKEDITOR.tools.callFunction(" . $funcNum . ", ''.$url.'', '');\n";
            $content .= "</script>";
        
             //header($content);
         echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
          //echo $url;
        }
        
    }
    
    exit;
}

// File upload
if($type == 'file'){
    
    $allowed_extension = array(
        "doc",
        "pdf",
        "docx"
    );
    
    // Get image file extension
    $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
    
    if(in_array(strtolower($file_extension),$allowed_extension)){

    	if(move_uploaded_file($_FILES['upload']['tmp_name'], "./ckeditor_upload_images/".$_FILES['upload']['name'])){

           

    		$url = base_url("ckeditor_upload_images/".$_FILES['upload']['name']);

    
    $content =" 'Content-type', 'text/html'";

    $content .= "<script type=\"text/javascript\">\n";
    $content .= "window.parent.CKEDITOR.tools.callFunction(" . $funcNum . ", ''.$url.'', '');\n";
    $content .= "</script>";

    //echo header($content);
    echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    	}
    	 
    }
    
    exit;
}
  }
   
}?>