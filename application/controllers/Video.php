<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('video_model');
	    
	}
	public function index()
	{
		$data['page_title'] 		 = 'Concept Library';
		$data['sub_title']			 = 'Videos';
		$data['load_view'] 			 = 'videowithcategory';
		$data['fetch_categorydata']  = $this->Common_model->fetch_categorydata();
		$this->load->view('template', $data);
	}
	function course()
	{
		$data['page_title'] 		 = 'Concept Library';
		$data['title']			     = 'Videos';
		$data['sub_title']			 = 'Courses';
		$data['domain']			     = '';
		$category_id 			 	 = $this->uri->segment(3);
		$data['domain_type'] 		 = 'all';
		$data['fetch_domaindata']    = $this->Common_model->fetchsubcatbyid($category_id);
		$data['load_js']  			 = 'cart';
		$data['load_view'] 			 = 'subcategory_video';

		$this->load->view('template', $data);
	}
	/*function domain()
	{
		$data['page_title'] 		 = 'Concept Library';
		$data['title']			     = 'Videos';
		$data['sub_title']			 = 'Courses';
		$data['domain']			     = 'Domain';
		$data['load_js']  			 = 'cart';
		$subcategory_id 			 = $this->uri->segment(3);
		$data['domain_type'] 		 = 'video';
		$data['fetch_domaindata']    = $this->Common_model->fetchsubcatbyid($subcategory_id);
		$data['load_view'] 			 = 'domain_video';
		$this->load->view('template', $data);
	}*/
	function video_data()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Videos';
		$data['load_js']  		= 'cart';
		$subcategory_id 		= $this->uri->segment(3);
		$data['domain_type'] 	= 'all';
		$data["video_data"] 	= $this->video_model->fetch_videobysubcat($subcategory_id);
		$data['status']         = $this->video_model->fetch_statusbysubcat($subcategory_id);
		
		$data['domain_data']    = $this->Common_model->fetch_single_subcategory($subcategory_id);
		$data['load_view'] 		= 'video';
		$this->load->view('template', $data);
	}
	public function video_detail()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Videos';
		$video_id 				= $this->uri->segment(3);
		$data["video_data"] 	= $this->video_model->fetch_video($video_id);
		$data['load_view'] 		= 'video_single';
		$this->load->view('template', $data);
	}
	public function detail()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Videos';
		$video_id 				= $this->uri->segment(3);
		$data["video_data"] 	= $this->video_model->fetch_video($video_id);
		$data['load_view'] 		= 'video_data';
		$this->load->view('template', $data);
	}
	function file_download()
	{
	    
		$this->load->helper('download');
		$video_id 				= $this->uri->segment(3);
		$file_data              = $this->video_model->fetch_video_data($video_id);
		
		$username = $this->session->userdata('CL_STUDENT_ID').$this->session->userdata('CL_STUDENT_USERNAME').$this->session->userdata('CL_STUDENT_MOBILE');
		$uriSegments = explode("/", parse_url($file_data['video_url'], PHP_URL_PATH));
		
		$lastUriSegment = array_pop($uriSegments);
		/*print "http://conceptlibrary.in:3000/video/watermark?a=$username&video_file_name=$lastUriSegment";exit;*/
		// Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "http://conceptlibrary.in:3000/video/watermark?a=$username&video_file_name=$lastUriSegment",
            CURLOPT_USERAGENT => 'Concept Library URL Request'
        ]);
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        print_r($resp);exit;
		$data                    = file_get_contents($file_data);
		force_download($file_data, $data);

	}
	
	   
	
	
}

/* End of file Video.php */
/* Location: ./application/controllers/Video.php */