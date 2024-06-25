<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    date_default_timezone_set('Asia/Kolkata');
		if(!$this->session->userdata('CL_STUDENT_ID') || $this->session->userdata('CL_STUDENT_ID')=='')
		{
		redirect(base_url().'login');
		}
		$this->load->model('video_model');
		$this->load->model('mock_model');
		$this->load->model("student_model", 'student_model');
		$this->load->model('payment_model');
	    $this->load->model('student_model');
	}
	public function index()
	{

	}
	function payment_video()
	{
		
		$video_id 				= $this->uri->segment(3);
		$data["video_data"] 	= $this->video_model->fetch_video($video_id);
		$student_id 	        = $this->session->userdata('CL_STUDENT_ID');
		$check_payment_status   =  $this->payment_model->fetch_payment_status($student_id,$video_id );   
		if($check_payment_status == 0)
		{
			$this->load_payment_video();
		}
		else
		{
			$this->video_detail($video_id);
		}
		
	}
	public function video_detail()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Videos';
		$video_id 				= $this->uri->segment(3);
		//print_r($video_id); exit;
		$data["video_data"] 	= $this->video_model->fetch_video($video_id);
		$data['load_view'] 		= 'video_data';
		$this->load->view('template', $data);
	}
	function load_payment_video()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Videos';
		$video_id 				= $this->uri->segment(3);
		$data["material_data"] 	= $this->video_model->fetch_video($video_id);
		$data['load_view'] 		= 'payment_video';
		$this->load->view('template', $data);
	}
	function proceed_payment()
	{

	   $codedata=array();
	   $get_lastdetails =  $this->payment_model->fetch_lastdetails();
	   if($get_lastdetails->num_rows()>0)
		{
			foreach($get_lastdetails->result_array() as $row)
			{
				$codedata['payment_id'] = $row['payment_id'];
				$alpha =  substr($codedata['payment_id'],0,2);
				$number = (int) substr($codedata['payment_id'],2,strlen($codedata['payment_id'])-1)+1;
		     }
			 $paymentid = $alpha.STR_PAD((string)$number,2,"0",STR_PAD_LEFT);

		}
		else
		{
			$paymentid= 'PA'.date('ymd').'01';
		}
		$postdata['student_id'] 	= $this->session->userdata('CL_STUDENT_ID');
		$postdata['payment_id'] 	= $paymentid;
		$postdata['material_id']    = $_POST['material_id'];
		$postdata['payment_date'] 	= date('Y-m-d H:i:s');
	
		$paymentdetail=$this->payment_model->insert_payment($postdata);
		if($paymentdetail)
		{
      		$payment_status['payment_status']  = 1;
      		$res = $this->student_model->update_paymentstatus($postdata['student_id'], $payment_status);
			$result['resultCode'] = 1;
			$result['material_id']= $postdata['material_id'];
		}else{
			$result['resultCode'] = 0;
		}
		

		echo json_encode($result);
	}
	function payment_exam()
	{
		
		$exam_id 				= $this->uri->segment(3);
		
		$student_id 	        = $this->session->userdata('CL_STUDENT_ID');
		$check_payment_status   =  $this->payment_model->fetch_payment_status($student_id,$exam_id );
		  
		if($check_payment_status == 0)
		{
			$this->load_payment_exam();
		}
		else
		{
			$this->exam_detail($exam_id);
		}
		
	}
	function load_payment_exam()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Exam';
		$exam_id 				= $this->uri->segment(3);
		$data["material_data"] 	= $this->mock_model->fetch_exam($exam_id);
		$data['load_view'] 		= 'payment_mock';
		$this->load->view('template', $data);
	}
	public function exam_detail()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Mock Questions';
		$data['load_js'] 		= 'mock_test';
		$exam_id 				= $this->uri->segment(3);
		$student_id             	= $this->session->userdata('CL_STUDENT_ID');
		$data['exam_id'] = $exam_id ;
		$data['student_id'] = $student_id ;
		$data['exam_data']	    = $this->mock_model->fetch_exam($exam_id);
		$data['question'] 		= $this->mock_model->fetch_question($exam_id);
		$data['answered_question'] 		= $this->mock_model->checkstudentanswer($exam_id,$student_id);	
		$data['load_view'] 		= 'mock_questions';
		$this->load->view('template', $data);
	}
}?>