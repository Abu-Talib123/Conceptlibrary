<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publics extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->library('user_session_check');
	    $this->user_session_check->check_user_session();
      $this->load->library('ajax_pagination');
      $this->load->model('admin/masters_model', 'masters_model');
      $this->load->model('Common_model', 'common_model');
  }
  
  public function index()
  {
    $data['page_title']= 'Public';
    $data['sub_title']= 'Post';
    $data['menu1'] = 'Add Post';
    $data['menu2'] = 'Edit Post';
    $data['menu3'] = 'List Post';
    $data['load_view'] = 'admin/blogs/view_posts';
    // $config['base_url'] = site_url('admin/masters/fetch_category/');
    // $config['total_rows'] = $this->masters_model->fetch_categorydata_count();   
    // $config['paging_function'] = 'ajax_pagination_category';
    // $custom_config = $this->custom_pagination($config); 
    // $startRow = 0;
    // $this->ajax_pagination->initialize($custom_config);
    // $data['pagination'] = $this->ajax_pagination->create_links();
    // $data["fetch_categorydata"] = $this->masters_model->fetch_categorydata($startRow, $custom_config['per_page']);
    $this->load->view('admin/template', $data);
  }
  public function fetch_category()
  {
      $this->fetch_category_list();
  }
  public function fetch_category_list()
  {
    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/masters/fetch_category/');
    $config['paging_function'] = 'ajax_pagination_category';
    $config['total_rows'] = $this->masters_model->fetch_categorydata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_category')
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
    $data['search_result'] = $this->masters_model->fetch_categorydata($startRow, $custom_config['per_page']);
    $data['startRow']      = $startRow;
    if($this->uri->segment(3) =='fetch_category'){

      $result['search_result'] = $this->load->view('admin/masters/list_load_category', $data, true);
      $result['pagination'] = $data['pagination'];
    }else{
      $result['search_result'] = $this->load->view('admin/masters/', $data, true);
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
    public function form_validation_category()  
    {  
       $this->form_validation->set_rules("category_name", "Category Name", 'required');
       $this->form_validation->set_rules("is_active", "Status", 'required');
       if($this->form_validation->run())  
       {    
          
              $data = array(  
                 "category_name"  =>ucfirst($this->input->post("category_name")),
                 "is_active"      =>$this->input->post("is_active"),
                 "is_deleted"     => 0,
              );  
              if($this->input->post("update"))  
              {  
                 $this->masters_model->update_categorydata($data, $this->input->post("hidden_id"));  
                 redirect(base_url() . "admin/masters/category_updated");  
              }  
              if($this->input->post("insert"))  
              { 
                $query = $this->db->get_where('category', array(//making selection
                'category_name' => ucfirst($this->input->post("category_name")),
                'is_deleted' => 0
                ));
                $count = $query->num_rows();  
                if($count===0)
                {  
                 $this->masters_model->insert_categorydata($data);  
                 redirect(base_url() . "admin/masters/category_inserted");  
                } 
                else
                {
                $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:#2de470;'> Sub Category already exists</p></div>");
                redirect(base_url() .'admin/masters');
                } 
              }
       }  
       else  
       {  
            //false  
            $this->index();  
       }  
    }  
    public function category_inserted()  
    {  
      $this->index();  
    } 
    public function update_categorydata()
    { 
      $data['page_title']= 'Masters';
      $data['sub_title']= 'Category';
      $data['menu1'] = 'Add Category';
      $data['menu2'] = 'Edit Category';
      $data['menu3'] = 'List Category';
      $category_id = $this->uri->segment(4); 
      $data["category_data"] = $this->masters_model->fetch_single_category($category_id);
      $config['paging_function'] = 'ajax_pagination_category';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_categorydata"] = $this->masters_model->fetch_categorydata($startRow, $custom_config['per_page']);
      $data['load_view'] = 'admin/masters/view_category';
      $this->load->view('admin/template', $data);
      
    }  
    public function category_updated()  
    {  
      $this->index();  
    } 
    public function delete_category()
    {

    $category_id  = $this->db->escape_str(trim($_POST['category_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->masters_model->update_category_status($category_id, $is_deleted);
    echo 'success';
    } 
    // subcategory
    public function view_subcategory()
    {
      $data['page_title']= 'Masters';
      $data['sub_title']= 'Sub Category';
      $data['menu1'] = 'Add  Sub Category';
      $data['menu2'] = 'Edit Sub Category';
      $data['menu3'] = 'List Sub Category';
      $data["fetch_categorydata"] = $this->masters_model->fetch_category(); 
      $config['base_url'] = site_url('admin/masters/fetch_subcategory/');
      $config['total_rows'] = $this->masters_model->fetch_subcategorydata_count();   
      $config['paging_function'] = 'ajax_pagination_subcategory';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategorydata($startRow, $custom_config['per_page']);
      $data['load_view'] = 'admin/masters/view_subcategory';
      $this->load->view('admin/template', $data);
      
    }
    public function fetch_subcategory()
  {
      $this->fetch_subcategory_list();
  }
  public function fetch_subcategory_list()
  {
   
    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/masters/fetch_subcategory/');
    $config['paging_function'] = 'ajax_pagination_subcategory';
    $config['total_rows'] = $this->masters_model->fetch_subcategorydata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_subcategory')
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
    $data['search_result'] = $this->masters_model->fetch_subcategorydata($startRow, $custom_config['per_page']);
    $data['startRow']      = $startRow;

    if($this->uri->segment(3) =='fetch_subcategory'){
      $result['search_result'] = $this->load->view('admin/masters/list_load_subcategory', $data, true);
      $result['pagination'] = $data['pagination'];
    }else{
      $result['search_result'] = $this->load->view('admin/masters/view_subcategory', $data, true);
      $result['pagination'] = $data['pagination'];
    }
    echo json_encode($result);
  }
    public function form_validation_subcategory()  
    { 
       $this->form_validation->set_rules("category", "Category Name", 'required');
       $this->form_validation->set_rules("subcategory_name", " Sub Category Name", 'required');
       $this->form_validation->set_rules("subcategory_description", "Subategory Description", 'required');
       $this->form_validation->set_rules("status", "PaymentStatus", 'required');
       $this->form_validation->set_rules("price", " Price", 'required');
       $this->form_validation->set_rules("is_active", "Status", 'required');
       if($this->form_validation->run())  
       {    
          
            $data = array(  
                "category_id"               =>$this->input->post("category"),
                "subcategory_name"          =>$this->input->post("subcategory_name"),
                "subcategory_description"   =>$this->input->post("subcategory_description"),
                "status"                    =>$this->input->post("status"),
                "price"                     =>$this->input->post("price"),
                "offer_price"               =>$this->input->post("offer_price"),
                "m_price"                     =>$this->input->post("m_price"),
                "m_offer_price"               =>$this->input->post("m_offer_price"),
                "is_active"                 =>$this->input->post("is_active"),
                "is_deleted"                => 0,
            );  
            
            if($this->input->post("update"))  
            {  
                $query = $this->db->get_where('sub_category', 
                        array('subcategory_name' => $this->input->post("subcategory_name"),
                        "category_id" =>$this->input->post("category"),
                        "subcategory_id !=" =>$this->input->post("hidden_id"),
                        'is_deleted' => 0
                    ));
                $count = $query->num_rows();
                if($count===0)
                {
                 $this->masters_model->update_subcategorydata($data, $this->input->post("hidden_id")); 
                 $this->session->set_flashdata('message', '<p class="text-success text-center">SubCategory is Updated successfully</p>');
                 $this->updateProductPriceForCartPayment($data, $this->input->post("hidden_id"));
                }else {
                     $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:#2de470;'> Sub Category already exists</p></div>");
                }
                 redirect(base_url() . "admin/masters/update_subcategorydata/".$this->input->post("hidden_id"));  
            } 
            $query = $this->db->get_where('sub_category', 
                        array('subcategory_name' => $this->input->post("subcategory_name"),
                        "category_id" =>$this->input->post("category"),
                        'is_deleted' => 0
                    ));
            
            $count = $query->num_rows(); 
            
            if($count===0)
            {  
              if($this->input->post("insert"))  
              {  

                   $this->masters_model->insert_subcategorydata($data); 
                    $this->session->set_flashdata('message', '<p class="text-success text-center">SubCategory is inserted successfully</p>');
                   redirect(base_url() . "admin/masters/view_subcategory");  
              }  
           }else{
                $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:#2de470;'> Sub Category already exists</p></div>");
                redirect(base_url() .'admin/masters/view_subcategory');
          }
         
       }  
       else  
       {  
            //false  
            $this->view_subcategory();  
       }  
    }  
    public function subcategory_inserted()  
    {  
      $this->view_subcategory();  
    } 
    public function update_subcategorydata()
    { 
      $data['page_title']= 'Masters';
      $data['sub_title']= 'SubCategory';
      $data['menu1'] = 'Add  SubCategory';
      $data['menu2'] = 'Edit SubCategory';
      $data['menu3'] = 'List SubCategory';
      $subcategory_id = $this->uri->segment(4); 
      $data["subcategory_data"] = $this->masters_model->fetch_single_subcategory($subcategory_id);
      $data["fetch_categorydata"] = $this->masters_model->fetch_category();
      $config['base_url'] = site_url('admin/masters/fetch_subcategory/');
      $config['total_rows'] = $this->masters_model->fetch_subcategorydata_count();   
      $config['paging_function'] = 'ajax_pagination_subcategory';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategorydata($startRow, $custom_config['per_page']);
      $data['load_view'] = 'admin/masters/view_subcategory';
      $this->load->view('admin/template', $data);
      
    }  
    public function subcategory_updated()  
    {  
      $this->view_subcategory();  
    } 
    public function delete_subcategory()
    {

    $subcategory_id  = $this->db->escape_str(trim($_POST['subcategory_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->masters_model->update_subcategory_status($subcategory_id, $is_deleted);
    echo 'success';
    }
     //chapter
    public function view_domain()
    {
      $data['page_title']= 'Masters';
      $data['sub_title']= 'Domain';
      $data['menu1'] = 'Add  Domain';
      $data['menu2'] = 'Edit Domain';
      $data['menu3'] = 'List Domain';
      $config['base_url'] = site_url('admin/masters/fetch_domain/');
      $config['total_rows'] = $this->masters_model->fetch_domaindata_count();   
      $config['paging_function'] = 'ajax_pagination_domain';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_domaindata"] = $this->masters_model->fetch_domaindata($startRow, $custom_config['per_page']);
      $data["fetch_categorydata"] = $this->masters_model->fetch_category(); 
      $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategory();
      $data['load_view'] = 'admin/masters/view_domain';
      $this->load->view('admin/template', $data);
    }
     public function fetch_domain()
    {
      $this->fetch_domain_list();
    }
    public function fetch_domain_list()
    {

    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/masters/fetch_domain/');
    $config['paging_function'] = 'ajax_pagination_domain';
    $config['total_rows'] = $this->masters_model->fetch_domaindata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_domain')
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
    $data['search_result'] = $this->masters_model->fetch_domaindata($startRow, $custom_config['per_page']);
    $data['startRow']      = $startRow;

    if($this->uri->segment(3) =='fetch_domain'){

      $result['search_result'] = $this->load->view('admin/masters/list_load_domain', $data, true);
      $result['pagination'] = $data['pagination'];
    }else{
      $result['search_result'] = $this->load->view('admin/masters/view_domain', $data, true);
      $result['pagination'] = $data['pagination'];
    }
    echo json_encode($result);
    }
    public function form_validation_domain()  
    {  
       $this->form_validation->set_rules("category", "Category Name", 'required');
       $this->form_validation->set_rules("subcategory", "SubCategory Name", 'required');
       $this->form_validation->set_rules("domain_name", "Domain Name", 'required');
       $this->form_validation->set_rules("domain_description", "domain Description", 'required');
       $this->form_validation->set_rules("status", "PaymentStatus", 'required');
       $this->form_validation->set_rules("price", " Price", 'required');
       $this->form_validation->set_rules("is_active", "Status", 'required');
       if($this->form_validation->run())  
       {    
          
            $data = array(  
                "category_id"          =>$this->input->post("category"),
                "subcategory_id"       =>$this->input->post("subcategory"),
                "domain_name"          =>$this->input->post("domain_name"),
                "domain_description"   =>$this->input->post("domain_description"),
                "status"               =>$this->input->post("status"),
                "price"                =>$this->input->post("price"),
                "is_active"            =>$this->input->post("is_active"),
                "is_deleted"           => 0,
            );  
            if($this->input->post("update"))  
            {  
                $this->masters_model->update_domaindata($data, $this->input->post("hidden_id"));  
                redirect(base_url() . "admin/masters/domain_updated");  
            }  
            if($this->input->post("insert"))  
            { 
               
                $this->masters_model->insert_domaindata($data);  
                redirect(base_url() . "admin/masters/domain_inserted"); 
            }

       }  
       else  
       {  
            //false  
            $this->view_domain();  
       }  
    }  
    public function domain_inserted()  
    {  
      $this->view_domain();  
    } 
    public function update_domaindata()
    { 
      $data['page_title']= 'Masters';
      $data['sub_title']= 'Domain';
      $data['menu1'] = 'Add  Domain';
      $data['menu2'] = 'Edit Domain';
      $data['menu3'] = 'List Domain';
      $domain_id = $this->uri->segment(4); 
      $data["domain_data"] = $this->masters_model->fetch_single_domain($domain_id);
      $data["fetch_categorydata"] = $this->masters_model->fetch_category();
      $data["fetch_subcategorydata"] = $this->masters_model->fetch_subcategory();
      $config['base_url'] = site_url('admin/masters/fetch_domain/');
      $config['total_rows'] = $this->masters_model->fetch_domaindata_count();   
      $config['paging_function'] = 'ajax_pagination_domain';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_domaindata"] = $this->masters_model->fetch_domaindata($startRow, $custom_config['per_page']);
      $data['load_view'] = 'admin/masters/view_domain';
      $this->load->view('admin/template', $data);
      
    }  
    public function domain_updated()  
    {  
      $this->view_domain();  
    } 
    public function delete_domain()
    {
    $domain_id  = $this->db->escape_str(trim($_POST['domain_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->masters_model->update_domain_status($domain_id, $is_deleted);
    echo 'success';
    } 
    // University
    public function view_university()
    {
      $data['page_title']= 'Masters';
      $data['sub_title']= 'University';
      $data['menu1'] = 'Add University';
      $data['menu2'] = 'Edit University';
      $data['menu3'] = 'List University';
      $config['base_url'] = site_url('admin/masters/fetch_university/');
      $config['total_rows'] = $this->masters_model->fetch_universitydata_count();   
      $config['paging_function'] = 'ajax_pagination_university';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_universitydata"] = $this->masters_model->fetch_universitydata($startRow, $custom_config['per_page']); 
      $data['load_view'] = 'admin/masters/view_university';
      $this->load->view('admin/template', $data);
    }
    public function fetch_university()
  {
      $this->fetch_university_list();
  }
  public function fetch_university_list()
  {
   
    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/masters/fetch_university/');
    $config['paging_function'] = 'ajax_pagination_university';
    $config['total_rows'] = $this->masters_model->fetch_universitydata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_university')
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
    $data['search_result'] = $this->masters_model->fetch_universitydata($startRow, $custom_config['per_page']);
    $data['startRow']      = $startRow;
    if($this->uri->segment(3) =='fetch_university'){

      $result['search_result'] = $this->load->view('admin/masters/list_load_university', $data, true);
      $result['pagination'] = $data['pagination'];
    }else{
      $result['search_result'] = $this->load->view('admin/masters/view_university', $data, true);
      $result['pagination'] = $data['pagination'];
    }
    echo json_encode($result);
  }
  
    public function form_validation_university()  
    {  
       $this->form_validation->set_rules("university_name", "University Name", 'required');
       $this->form_validation->set_rules("is_active", "Status", 'required');
       if($this->form_validation->run())  
       {    
         
            $data = array(  
                 "university_name"  =>$this->input->post("university_name"),
                 "is_active"      =>$this->input->post("is_active"),
                 "is_deleted"     => 0,
            );  
            if($this->input->post("update"))  
            {  
                 $this->masters_model->update_universitydata($data, $this->input->post("hidden_id"));  
                 redirect(base_url() . "admin/masters/university_updated");  
            }  
            if($this->input->post("insert"))  
            { 
              $query = $this->db->get_where('university', array(//making selection
              'university_name' => ucfirst($this->input->post("university_name"))
              ));
              $count = $query->num_rows();  
              if($count===0)
              {  
                 $this->masters_model->insert_universitydata($data);  
                 redirect(base_url() . "admin/masters/university_inserted");  
              }else{
             
              $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:#2de470;'> Data Already Exists</p></div>");
              redirect(base_url() .'admin/masters/view_university');

              }  
            }
       }  
       else  
       {  
            //false  
            $this->view_university();  
       }  
    }  
    public function university_inserted()  
    {  
      $this->view_university();  
    } 
    public function update_universitydata()
    { 
      $data['page_title']= 'Masters';
      $data['sub_title']= 'University';
      $data['menu1'] = 'Add University';
      $data['menu2'] = 'Edit University';
      $data['menu3'] = 'List University';
      $university_id = $this->uri->segment(4); 
      $config['base_url'] = site_url('admin/masters/fetch_university/');
      $config['total_rows'] = $this->masters_model->fetch_universitydata_count();   
      $config['paging_function'] = 'ajax_pagination_university';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_universitydata"] = $this->masters_model->fetch_universitydata($startRow, $custom_config['per_page']); 
      $data["university_data"] = $this->masters_model->fetch_single_university($university_id);
      $data['load_view'] = 'admin/masters/view_university';
      $this->load->view('admin/template', $data);
      
    }  
    public function university_updated()  
    {  
      $this->view_university();  
    } 
    public function delete_university()
    {

    $university_id  = $this->db->escape_str(trim($_POST['university_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->masters_model->update_university_status($university_id, $is_deleted);
    echo 'success';
    }
    //college
    public function view_college()
    {
      $data['page_title']= 'Masters';
      $data['sub_title']= 'College';
      $data['menu1'] = 'Add  College';
      $data['menu2'] = 'Edit College';
      $data['menu3'] = 'List College';
      $config['base_url'] = site_url('admin/masters/fetch_college/');
      $config['total_rows'] = $this->masters_model->fetch_collegedata_count();   
      $config['paging_function'] = 'ajax_pagination_college';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_collegedata"] = $this->masters_model->fetch_collegedata($startRow, $custom_config['per_page']);
      $data["fetch_universitydata"] = $this->masters_model->fetch_university(); 
      $data['load_view'] = 'admin/masters/view_college';
      $this->load->view('admin/template', $data);
    }
    public function fetch_college()
    {
    $this->fetch_college_list();
    }
    public function fetch_college_list()
    {

    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/masters/fetch_college/');
    $config['paging_function'] = 'ajax_pagination_college';
    $config['total_rows'] = $this->masters_model->fetch_collegedata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_college')
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
    $data['search_result'] = $this->masters_model->fetch_collegedata($startRow, $custom_config['per_page']);
    $data['startRow']      = $startRow;

    if($this->uri->segment(3) =='fetch_college'){

    $result['search_result'] = $this->load->view('admin/masters/list_load_college', $data, true);
    $result['pagination'] = $data['pagination'];
    }else{
    $result['search_result'] = $this->load->view('admin/masters/view_college', $data, true);
    $result['pagination'] = $data['pagination'];
    }
    echo json_encode($result);
    }
    public function form_validation_college()  
    {  
       $this->form_validation->set_rules("university", "University Name", 'required');
       $this->form_validation->set_rules("college_name", "College Name", 'required');
       $this->form_validation->set_rules("is_active", "Status", 'required');
       if($this->form_validation->run())  
       {   
       
            $data = array(  
                "university_id"  =>$this->input->post("university"),
                "college_name"  =>$this->input->post("college_name"),
                "is_active"      =>$this->input->post("is_active"),
                "is_deleted"     => 0,
            );  
            if($this->input->post("update"))  
            {  
                 $this->masters_model->update_collegedata($data, $this->input->post("hidden_id"));  
                 redirect(base_url() . "admin/masters/college_updated");  
            }  
            if($this->input->post("insert"))  
            { 
              $query = $this->db->get_where('category', array(//making selection
              'college_name' => ucfirst($this->input->post("college_name"))
              ));
              $count = $query->num_rows();  
              if($count===0)
              {  

                 $this->masters_model->insert_collegedata($data);  
                 redirect(base_url() . "admin/masters/college_inserted");  
              } 
              else{
               $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:#2de470;'> Data Already Exists</p></div>");
               redirect(base_url() .'admin/masters/view_college');

              } 
           }
       }  
       else  
       {  
            //false  
            $this->view_college();  
       }  
    }  
    public function college_inserted()  
    {  
      $this->view_college();  
    } 
    public function update_collegedata()
    { 
      $data['page_title']= 'Masters';
      $data['sub_title']= 'College';
      $data['menu1'] = 'Add  College';
      $data['menu2'] = 'Edit College';
      $data['menu3'] = 'List College';
      $college_id = $this->uri->segment(4); 
      $data["college_data"] = $this->masters_model->fetch_single_college($college_id);
      $data["fetch_universitydata"] = $this->masters_model->fetch_university();

      $config['base_url'] = site_url('admin/masters/fetch_college/');
      $config['total_rows'] = $this->masters_model->fetch_collegedata_count();   
      $config['paging_function'] = 'ajax_pagination_college';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_collegedata"] = $this->masters_model->fetch_collegedata($startRow, $custom_config['per_page']);
      $data['load_view'] = 'admin/masters/view_college';
      $this->load->view('admin/template', $data);
      
    }  
    public function college_updated()  
    {  
      $this->view_college();  
    } 
    public function delete_college()
    {

    $college_id  = $this->db->escape_str(trim($_POST['college_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->masters_model->update_college_status($college_id, $is_deleted);
    echo 'success';
    } 
    // Country
  public function view_country()
  {
    $data['page_title']= 'Masters';
    $data['sub_title']= 'Country';
    $data['menu1'] = 'Add Country';
    $data['menu2'] = 'Edit Country';
    $data['menu3'] = 'List Country';
    $data['load_view'] = 'admin/masters/view_country';
    $config['base_url'] = site_url('admin/masters/fetch_country/');
    $config['total_rows'] = $this->masters_model->fetch_countrydata_count();   
    $config['paging_function'] = 'ajax_pagination_country';
    $custom_config = $this->custom_pagination($config); 
    $startRow = 0;
    $this->ajax_pagination->initialize($custom_config);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data["fetch_countrydata"] = $this->masters_model->fetch_countrydata($startRow, $custom_config['per_page']);
    $this->load->view('admin/template', $data);
  }
    public function fetch_country()
  {
      $this->fetch_country_list();
  }
  public function fetch_country_list()
  {
   
    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/masters/fetch_country/');
    $config['paging_function'] = 'ajax_pagination_country';
    $config['total_rows'] = $this->masters_model->fetch_countrydata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_country')
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
    $data['search_result'] = $this->masters_model->fetch_countrydata($startRow, $custom_config['per_page']);
    $data['startRow']      = $startRow;

    if($this->uri->segment(3) =='fetch_country'){

      $result['search_result'] = $this->load->view('admin/masters/list_load_country', $data, true);
      $result['pagination'] = $data['pagination'];
    }else{
      $result['search_result'] = $this->load->view('admin/masters/view_country', $data, true);
      $result['pagination'] = $data['pagination'];
    }
    echo json_encode($result);
  }
  
    public function form_validation_country()  
    {  
       $this->form_validation->set_rules("country_name", "Country Name", 'required');
       $this->form_validation->set_rules("short_code", "Short Name", 'required');
       $this->form_validation->set_rules("is_active", "Status", 'required');
       if($this->form_validation->run())  
       {   
         
            $data = array(  
                 "country_name"  =>$this->input->post("country_name"),
                 "short_code"  =>$this->input->post("short_code"),
                 "is_active"      =>$this->input->post("is_active"),
                 "is_deleted"     => 0,
            );  
            if($this->input->post("update"))  
            {  
                 $this->masters_model->update_countrydata($data, $this->input->post("hidden_id"));  
                 redirect(base_url() . "admin/masters/country_updated");  
            }  
            if($this->input->post("insert"))  
            { 
              $query = $this->db->get_where('country', array(//making selection
              'country_name' => ucfirst($this->input->post("country_name"))
              ));
              $count = $query->num_rows();  
              if($count===0)
              {  
                 $this->masters_model->insert_countrydata($data);  
                 redirect(base_url() . "admin/masters/country_inserted");  
              }else
              {
                $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:#2de470;'> Data Already Exists</p></div>");
                redirect(base_url() .'admin/masters/view_country');
              }  

             }
       }  
       else  
       {  
            //false  
            $this->view_country();  
       }  
    }  
    public function country_inserted()  
    {  
      $this->view_country();  
    } 
    public function update_countrydata()
    { 
      $data['page_title']= 'Masters';
      $data['sub_title']= 'Country';
      $data['menu1'] = 'Add Country';
      $data['menu2'] = 'Edit Country';
      $data['menu3'] = 'List Country';
      $data['load_view'] = 'admin/masters/view_country';
      $config['base_url'] = site_url('admin/masters/fetch_country/');
      $config['total_rows'] = $this->masters_model->fetch_countrydata_count();   
      $config['paging_function'] = 'ajax_pagination_country';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_countrydata"] = $this->masters_model->fetch_countrydata($startRow, $custom_config['per_page']);
      $country_id = $this->uri->segment(4); 
      $data["country_data"] = $this->masters_model->fetch_single_country($country_id);
      $this->load->view('admin/template', $data);
      
    }  
    public function country_updated()  
    {  
      $this->view_country();  
    } 
    public function delete_country()
    {

    $country_id  = $this->db->escape_str(trim($_POST['country_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->masters_model->update_country_status($country_id, $is_deleted);
    echo 'success';
    } 
     //state
    public function view_state()
    {
      $data['page_title']= 'Masters';
      $data['sub_title']= 'State';
      $data['menu1'] = 'Add  State';
      $data['menu2'] = 'Edit State';
      $data['menu3'] = 'List State';
      $data["fetch_countrydata"] = $this->masters_model->fetch_country(); 
      $config['base_url'] = site_url('admin/masters/fetch_state/');
      $config['total_rows'] = $this->masters_model->fetch_statedata_count();   
      $config['paging_function'] = 'ajax_pagination_state';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_statedata"] = $this->masters_model->fetch_statedata($startRow, $custom_config['per_page']);
      $data['load_view'] = 'admin/masters/view_state';
      $this->load->view('admin/template', $data);
    }
    public function fetch_state()
    {
      $this->fetch_state_list();
    }
    public function fetch_state_list()
    {

    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/masters/fetch_state/');
    $config['paging_function'] = 'ajax_pagination_category';
    $config['total_rows'] = $this->masters_model->fetch_statedata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_state')
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
    $data['search_result'] = $this->masters_model->fetch_statedata($startRow, $custom_config['per_page']);
    $data['startRow']      = $startRow;

    if($this->uri->segment(3) =='fetch_state'){

      $result['search_result'] = $this->load->view('admin/masters/list_load_state', $data, true);
      $result['pagination'] = $data['pagination'];
    }else{
      $result['search_result'] = $this->load->view('admin/masters/view_state', $data, true);
      $result['pagination'] = $data['pagination'];
    }
    echo json_encode($result);
    }
    public function form_validation_state()  
    {  
       $this->form_validation->set_rules("country", "Country Name", 'required');
       $this->form_validation->set_rules("state_name", "State Name", 'required');
       $this->form_validation->set_rules("is_active", "Status", 'required');
       if($this->form_validation->run())  
       {    
          
           $data = array(  
                "country_id"  =>$this->input->post("country"),
                "state_name"  =>$this->input->post("state_name"),
                "is_active"      =>$this->input->post("is_active"),
                "is_deleted"     => 0,
            );  
            if($this->input->post("update"))  
            {  
                 $this->masters_model->update_statedata($data, $this->input->post("hidden_id"));  
                 redirect(base_url() . "admin/masters/state_updated");  
            }  
            if($this->input->post("insert"))  
            {  
              $query = $this->db->get_where('state', array(//making selection
              'state_name' => ucfirst($this->input->post("state_name"))
              ));
              $count = $query->num_rows();  
              if($count===0)
              { 

                 $this->masters_model->insert_statedata($data);  
                 redirect(base_url() . "admin/masters/state_inserted");  
              }
              else
              {
              $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:#2de470;'> Data Already Exists</p></div>");
              redirect(base_url() .'admin/masters/view_state');
              }  
          }
       }  
       else  
       {  
            //false  
            $this->view_state();  
       }  
    }  
    public function state_inserted()  
    {  
      $this->view_state();  
    } 
    public function update_statedata()
    { 
      $data['page_title']= 'Masters';
      $data['sub_title']= 'State';
      $data['menu1'] = 'Add  State';
      $data['menu2'] = 'Edit State';
      $data['menu3'] = 'List State';
      $state_id = $this->uri->segment(4); 
      $data["state_data"] = $this->masters_model->fetch_single_state($state_id);
      $data["fetch_countrydata"] = $this->masters_model->fetch_country();
      $config['base_url'] = site_url('admin/masters/fetch_state/');
      $config['total_rows'] = $this->masters_model->fetch_statedata_count();   
      $config['paging_function'] = 'ajax_pagination_state';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_statedata"] = $this->masters_model->fetch_statedata($startRow, $custom_config['per_page']);
      $data['load_view'] = 'admin/masters/view_state';
      $this->load->view('admin/template', $data);
      
    }  
    public function state_updated()  
    {  
      $this->view_state();  
    } 
    public function delete_state()
    {
    $state_id  = $this->db->escape_str(trim($_POST['state_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->masters_model->update_state_status($state_id, $is_deleted);
    echo 'success';
    } 
     //city
    public function view_city()
    {
      $data['page_title']= 'Masters';
      $data['sub_title']= 'City';
      $data['menu1'] = 'Add  City';
      $data['menu2'] = 'Edit City';
      $data['menu3'] = 'List City';
      $config['base_url'] = site_url('admin/masters/fetch_city/');
      $config['total_rows'] = $this->masters_model->fetch_citydata_count();   
      $config['paging_function'] = 'ajax_pagination_city';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_citydata"] = $this->masters_model->fetch_citydata($startRow, $custom_config['per_page']);
      $data["fetch_countrydata"] = $this->masters_model->fetch_country(); 
      $data["fetch_statedata"] = $this->masters_model->fetch_state();
      $data['load_view'] = 'admin/masters/view_city';
      $this->load->view('admin/template', $data);
    }
     public function fetch_city()
    {
      $this->fetch_city_list();
    }
    public function fetch_city_list()
    {

    $this->load->library('ajax_pagination');
    $config['base_url'] = site_url('admin/masters/fetch_city/');
    $config['paging_function'] = 'ajax_pagination_city';
    $config['total_rows'] = $this->masters_model->fetch_citydata_count();
    $custom_config = $this->custom_pagination($config);
    $startRow = 0;
    if($this->uri->segment(3) =='fetch_city')
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
    $data['search_result'] = $this->masters_model->fetch_citydata($startRow, $custom_config['per_page']);
    $data['startRow']      = $startRow;

    if($this->uri->segment(3) =='fetch_city'){

      $result['search_result'] = $this->load->view('admin/masters/list_load_city', $data, true);
      $result['pagination'] = $data['pagination'];
    }else{
      $result['search_result'] = $this->load->view('admin/masters/view_city', $data, true);
      $result['pagination'] = $data['pagination'];
    }
    echo json_encode($result);
    }
    public function form_validation_city()  
    {  
       $this->form_validation->set_rules("country", "Country Name", 'required');
       $this->form_validation->set_rules("state", "State Name", 'required');
       $this->form_validation->set_rules("city_name", "City Name", 'required');
       $this->form_validation->set_rules("is_active", "Status", 'required');
       if($this->form_validation->run())  
       {    
          
            $data = array(  
                "country_id"  =>$this->input->post("country"),
                "state_id"    =>$this->input->post("state"),
                "city_name"  =>$this->input->post("city_name"),
                "is_active"   =>$this->input->post("is_active"),
                "is_deleted"  => 0,
            );  
            if($this->input->post("update"))  
            {  
                 $this->masters_model->update_citydata($data, $this->input->post("hidden_id"));  
                 redirect(base_url() . "admin/masters/city_updated");  
            }  
            if($this->input->post("insert"))  
            { 
              $query = $this->db->get_where('category', array(//making selection
              'city_name' => ucfirst($this->input->post("city_name"))
              ));
              $count = $query->num_rows();  
              if($count===0)
              {  
                 $this->masters_model->insert_citydata($data);  
                 redirect(base_url() . "admin/masters/city_inserted");  
              }
              else{

              $this->session->set_flashdata('message'," <div style='display:flex;justify-content: center;align-items:center;'><p class='text-danger' style='color:#2de470;'> Data Already Exists</p></div>");
              redirect(base_url() .'admin/masters/view_city');
              }
          }

       }  
       else  
       {  
            //false  
            $this->view_city();  
       }  
    }  
    public function city_inserted()  
    {  
      $this->view_city();  
    } 
    public function update_citydata()
    { 
      $data['page_title']= 'Masters';
      $data['sub_title']= 'City';
      $data['menu1'] = 'Add  City';
      $data['menu2'] = 'Edit City';
      $data['menu3'] = 'List City';
      $city_id = $this->uri->segment(4); 
      $data["city_data"] = $this->masters_model->fetch_single_city($city_id);
      $data["fetch_countrydata"] = $this->masters_model->fetch_country();
      $data["fetch_statedata"] = $this->masters_model->fetch_state();
      $config['base_url'] = site_url('admin/masters/fetch_city/');
      $config['total_rows'] = $this->masters_model->fetch_citydata_count();   
      $config['paging_function'] = 'ajax_pagination_city';
      $custom_config = $this->custom_pagination($config); 
      $startRow = 0;
      $this->ajax_pagination->initialize($custom_config);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data["fetch_citydata"] = $this->masters_model->fetch_citydata($startRow, $custom_config['per_page']);
      $data['load_view'] = 'admin/masters/view_city';
      $this->load->view('admin/template', $data);
      
    }  
    public function city_updated()  
    {  
      $this->view_city();  
    } 
    public function delete_city()
    {
    $city_id  = $this->db->escape_str(trim($_POST['city_id']));
    $is_deleted['is_deleted']  = 1;
    $res = $this->masters_model->update_city_status($state_id, $is_deleted);
    echo 'success';
    } 
    function getsubcategory($category)
    {
         $subcatoptiondata  = '<select class="form-control"  id="subcategory" name="subcategory" >
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
 /* function getdomain($subcategory_id)
  {
     $domainoptiondata  = '<select class="form-control"  id="domain" name="domain">
            <option selected="selected" value="">Select</option>';
     if($subcategory_id!='')
      {             
       $getdomain   = $this->common_model->fetchdomainbyid($subcategory_id);
     
        if($getdomain)
        {
          $i=0;
          foreach($getdomain as $domain)
          {
            $domainoptiondata  = $domainoptiondata.'<option value="'.$domain['domain_id'].'">'.$domain['domain_name'].'</option>';
            $i++;
          }
        }
      } 
    else
    {
      $domainoptiondata  = $domainoptiondata.'';
    }

    $domainoptiondata  = $domainoptiondata.'</select>';
    
    echo $domainoptiondata;
    
  }*/
   function getcollege($university)
   {
      $universityoptiondata  = '<select class="form-control form-control-lg"  id="college" name="college" >
                    <option selected="selected" value="">All</option>';
     if($university!='')
      {             
       $getcollege   = $this->common_model->fetchcollegebyid($university);
     
        if($getcollege->num_rows()>0)
        {
          $i=0;
          foreach($getcollege->result_array() as $college)
          {

            $universityoptiondata  = $universityoptiondata.'<option value="'.$college['college_id'].'">'.$college['college_name'].'</option>';
            
            $i++;
          }
        }
      } 
    else
    {
      $universityoptiondata  = $universityoptiondata.'';
    }

    $universityoptiondata  = $universityoptiondata.'</select>';
    
    echo $universityoptiondata;
    
   }
   function getstate($country)
   {
      $stateoptiondata  = '<select class="form-control form-control-lg"  id="state" name="state" onchange="getcity()" >
            <option selected="selected" value="">All</option>';
     if($country!='')
      {             
       $getstate   = $this->common_model->fetchstatebyid($country);
     
        if($getstate->num_rows()>0)
        {
          $i=0;
          foreach($getstate->result_array() as $state)
          {

            $stateoptiondata  = $stateoptiondata.'<option value="'.$state['state_id'].'">'.$state['state_name'].'</option>';
            
            $i++;
          }
        }
      } 
    else
    {
      $stateoptiondata  = $stateoptiondata.'';
    }

    $stateoptiondata  = $stateoptiondata.'</select>';
    
    echo $stateoptiondata;
    
  }   
  function getcity($state_id)
  {
     $cityoptiondata  = '<select class="form-control form-control-lg"  id="city" name="city">
            <option selected="selected" value="">All</option>';
     if($state_id!='')
      {             
       $getcity   = $this->common_model->fetchcitybyid($state_id);
     
        if($getcity->num_rows()>0)
        {
          $i=0;
          foreach($getcity->result_array() as $city)
          {

            $cityoptiondata  = $cityoptiondata.'<option value="'.$city['city_id'].'">'.$city['city_name'].'</option>';
            
            $i++;
          }
        }
      } 
    else
    {
      $cityoptiondata  = $cityoptiondata.'';
    }

    $cityoptiondata  = $cityoptiondata.'</select>';
    
    echo $cityoptiondata;
    
  }

  private function updateProductPriceForCartPayment($data, $id)
  {

    // updating mock price in cart
    $price_data1['subcategory_price'] = $data['m_offer_price'];
    $this->db->where('domain_type', 'mock')
             ->where('status', 1)
             ->where('subcategory_id', $id)
             ->update('cart', $price_data1);

    // updating all price in cart
    $price_data1['subcategory_price'] = $data['offer_price'];
    $this->db->where('domain_type', 'all')
             ->where('status', 1)
             ->where('subcategory_id', $id)
             ->update('cart', $price_data1);

    // updating mock price in payment
    $price_data2['price'] = $data['m_offer_price'];
    $this->db->where('material_type', 'mock')
             ->where('paymentstatus', 1)
             ->where('material_id', $id)
             ->update('payment', $price_data2);

    // updating all price in payment
    $price_data2['price'] = $data['offer_price'];
    $this->db->where('material_type', 'all')
             ->where('paymentstatus', 1)
             ->where('material_id', $id)
             ->update('payment', $price_data2);

    return true;
  }
  
  
}

/* End of file Masters.php */
/* Location: ./application/controllers/admin/login.php */