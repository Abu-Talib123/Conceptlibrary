<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MockPaper extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('mock_model');
	}
	public function index()
	{
		$data['page_title'] 		= 'Concept Library';
		$data['sub_title'] 			= 'Mock Papers';
		$data['fetch_categorydata'] = $this->Common_model->fetch_categorydata();
		$data['load_view'] 			= 'mock_paper';
		$this->load->view('template', $data);
		
	}
	function course()
	{
		$data['page_title'] 	    = 'Concept Library';
		$data['title'] 		        = 'MockPaper';
		$data['sub_title']			= 'Courses';
		$data['load_js']  		    = 'cart';
		$data['domain_type'] 		= 'mock';
		$category_id 			    = $this->uri->segment(3);
		$data["fetch_domaindata"]   = $this->Common_model->fetchsubcatbyid($category_id);
		$data['load_view'] 		    = 'subcategory_mock';
		$this->load->view('template', $data);
	}
	
	function mock_data()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['title']			= 'MockPaper';
		$data['sub_title']	    = 'Courses';
		$data['load_js']  		= 'cart';
		$subcategory_id 	    = $this->uri->segment(3);
		$data['domain_type'] 	= 'mock';
		$data["exam_data"] 	    = $this->mock_model->fetch_examdatabyid($subcategory_id);
		$data['status']         = $this->mock_model->fetch_statusbysubcat($subcategory_id);
		$data['domain_data']    = $this->Common_model->fetch_single_subcategory($subcategory_id);
		
		$data['load_view'] 		= 'mock_data';
		$this->load->view('template', $data);
	}
	public function mock_detail()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'MockPaper';
		$data['domain_type'] 	= 'mock';
		$exam_id 				= $this->uri->segment(3);
		$data["exam_data"] 	    = $this->mock_model->fetch_exam($exam_id);
		$data['load_view'] 		= 'mock_single';
		$this->load->view('template', $data);
	}
	function updatedata()
	{
		$student_id      =  @$this->input->post('student_id');
		$exam_id         =  @$this->input->post('exam_id');
		$question_list   =  @$this->input->post('question_id');
		$dataIns['status'] = '1';
		$dataIns['is_submitted'] = '1';
		
		$this->db->where('student_id', $student_id);
		$this->db->where('exam_id', $exam_id);
	    $exqry = $this->db->update('student_history', $dataIns);
	    
        $questioncount   = count($question_list);
        /*for($i=0;$i<$questioncount;$i++)
        {
		   $question_id 	 =  $_POST['question_id'][$i];				
           $student_answered = @$_POST['option_1'][$question_id];
		  
		   $correct_answer = $this->mock_model->getAnswers($question_id);
		   
		   
		   $dataIns['student_answered'] = $student_answered;
		   $dataIns['correct_answer'] = $correct_answer;
		   
		    
		   $query = $this->db->query("SELECT * FROM student_history WHERE student_id = '$student_id' AND exam_id = '$exam_id' AND mock_test_id ='$question_id' ");
		
			if($query->num_rows() == 0)
			{ 
			    $dataIns['student_id'] = $student_id;
    		    $dataIns['exam_id'] = $exam_id;
    		    $dataIns['mock_test_id'] = $question_id;
			    $dataIns['status'] = '1';
		        $dataIns['is_submitted'] = '1';
			   
			    $this->db->insert('student_history', $dataIns);
			} else
			{
			
				$this->db->where('student_id', $student_id);
				$this->db->where('exam_id', $exam_id);
				$this->db->where('mock_test_id', $question_id);
			    $exqry = $this->db->update('student_history', $dataIns);
			}
		}*/
// 		$checkanswerdata = $this->mock_model->checkanswer($exam_id,$student_id);
// 			if(isset($checkanswerdata))  
// 			{ 
// 				$right_answer  = 0;
// 				$wrong_answer  = 0;
// 				$unanswered    = 0;
// 				$count        =   count($checkanswerdata);
// 				foreach($checkanswerdata as $result1)
// 				{
// 					$get_mark       = $this->mock_model->getquestionmark($question_id);
// 						$data1['student_id']   = $student_id;
// 						$data1['exam_id']      = $exam_id;
// 						$data1['mock_test_id'] = $question_id;
					
// 						$correct_answer   = explode(',',$result1['correct_answer']);
// 						$student_answered = $result1['student_answered'];
// 						if(((isset($correct_answer[0]) && isset($correct_answer[1])) && ($student_answered >= $correct_answer[0] && $student_answered <= $correct_answer[1] )) || ( isset($correct_answer[0]) && $student_answered == $correct_answer[0]))	
// 						{
// 							$right_answer= $right_answer+1;

// 							$query1 = $this->db->get_where('student_ranking', array(//making selection
// 								'student_id' => $student_id,
// 								'exam_id' => $exam_id,
// 								'mock_test_id' =>$question_id));
// 								$count1 = $query->num_rows();
// 								if($count1 == 0) 
// 								{
// 									$data1['mark']         = $get_mark['mark'];
// 						    		$exinqry1 = $this->db->insert('student_ranking', $data1);
// 								}
// 								else
// 								{
// 									 $upquery1 = 'UPDATE  student_ranking set 
// 										student_id     =  \''.$data1['student_id'].'\',
// 										exam_id        =  \''.$data1['exam_id'].'\',
// 										mark           =  \''.$get_mark['mark'].'\'     
// 										where  mock_test_id =   \''.$question_id.'\'';

					
// 					                $exqry1 = $this->db->query($upquery1);
// 								}
// 						}
// 						else if($student_answered == '0')
// 						{
// 							$unanswered = $unanswered+1;
// 						}
// 						else if($correct_answer <> $student_answered)
// 						{
// 							$wrong_answer = $wrong_answer+1;
// 							//making selection
// 							$query1 = $this->db->get_where('student_ranking', array(
// 								'student_id' => $student_id,
// 								'exam_id' => $exam_id,
// 								'mock_test_id' =>$question_id));
// 								$count1 = $query1->num_rows();
// 								if($count1 == 0) 
// 								{
// 									$data1['mark']         = -$get_mark['negative_mark'];
// 						    		$exinqry1 = $this->db->insert('student_ranking', $data1);
// 								}
// 								else
// 								{
// 									 $upquery1 = 'UPDATE  student_ranking set 
// 										student_id     =  \''.$data1['student_id'].'\',
// 										exam_id        =  \''.$data1['exam_id'].'\',
// 										mark           =  \''.-$get_mark['negative_mark'].'\'    
// 										where  mock_test_id =   \''.$question_id.'\'';

					
// 					                $exqry1 = $this->db->query($upquery1);
// 								}
// 						}
					
// 				}
// 			}

				// $data['right_answer']= $right_answer;
				// $data['wrong_answer']= $wrong_answer;
				// $data['unanswered']  = $unanswered;
				// $data['questioncount']  = $count;
				// $data['exam_id']= $exam_id;
				//echo json_encode($data);
        redirect('mockpaper/studenthistorydata/'.$exam_id);
		/*$data['exam_id']= $exam_id;
		echo json_encode($data);*/
	 
	}

function up_studentdata()
	{

		$collection 	= $this->input->post('collection');
		$correct_answer = $this->mock_model->getAnswers($collection['question_id']);
		$get_mark       = $this->mock_model->getmark($collection['question_id']);
            $student_id = $collection['student_id'];
            $exam_id = $collection['exam_id'];
            $question_id = $collection['question_id'];
            
		if(@$collection['remove'] == true){
			$this->db->where('student_id', $collection['student_id']);
			$this->db->where('exam_id', $collection['exam_id']);
			$this->db->where('mock_test_id', $collection['question_id']);
			$this->db->delete('student_history');
			die;
		}
		
			
			$data['student_answered']   = $collection['option'];
			if($collection['option'] == 'CL') {
			    $data['student_answered'] = '';
			}

			if(is_array($collection['option'])) {
			    $data['student_answered'] = implode(',', $collection['option']);
			}
			
			$data['correct_answer'] = $correct_answer;
			$data['status'] = 1;
			$data['is_marked'] = 0;
			if(@$collection['is_marked'] == 1) {
				$data['is_marked'] = $collection['is_marked'];
			}
			
			$query = $this->db->query("SELECT * FROM student_history WHERE student_id = '$student_id' AND exam_id = '$exam_id' AND mock_test_id ='$question_id' ");
			if($query->num_rows() == 0)
			{   $data['student_id']         = $student_id;
			    $data['exam_id']            = $exam_id;
			    $data['mock_test_id']       = $question_id;
			    $exinqry = $this->db->insert('student_history', $data);
			}else
			{
				$condtion = '';
				if($data['is_marked'] == 1 || $data['is_marked'] == '1') {
					$condtion = "is_marked    = 1 , ";
				}
				$this->db->where('student_id', $student_id);
				$this->db->where('exam_id', $exam_id);
				$this->db->where('mock_test_id', $question_id);
				$this->db->update('student_history', $data);
				
			}
			$checkanswerdata = $this->mock_model->checkanswer($collection['exam_id'],$collection['student_id']);
			if(isset($checkanswerdata))  
			{ 
				$right_answer  = 0;
				$wrong_answer  = 0;
				$unanswered    = 0;
				$count        =   count($checkanswerdata);
				foreach($checkanswerdata as $result1)
				{
				 foreach($get_mark as $mark)
				  {
					$data1['student_id']   = $collection['student_id'];
					$data1['exam_id']      = $collection['exam_id'];
					$data1['mock_test_id'] = $collection['question_id'];

					$correct_answer   = explode(',',$result1['correct_answer']);
					$student_answered = $result1['student_answered'];
					

					if(((isset($correct_answer[0]) && isset($correct_answer[1])) && ($student_answered >= $correct_answer[0] && $student_answered <= $correct_answer[1] )) || ( isset($correct_answer[0]) && $student_answered == $correct_answer[0]))					
					{
					    $right_answer          = $right_answer+1;

							$query1 = $this->db->get_where('student_ranking', array(//making selection
							'student_id' => $collection['student_id'],
							'exam_id' => $collection['exam_id'],
							'mock_test_id' =>$collection['question_id']));
							$count1 = $query->num_rows();
							if($count1 == 0) 
							{
								$data1['mark']         = $mark['mark'];
					    		$exinqry1 = $this->db->insert('student_ranking', $data1);
							}
							else
							{
								 $upquery1 = 'UPDATE  student_ranking set 
									student_id     =  \''.$data1['student_id'].'\',
									exam_id        =  \''.$data1['exam_id'].'\',
									mark           =  \''.$mark['mark'].'\'     
									where  mock_test_id =   \''.$collection['question_id'].'\'';

				
				                $exqry1 = $this->db->query($upquery1);
							}


					   
					}else if($student_answered == '')
					{
					$unanswered = $unanswered+1;
					}
					else if($correct_answer <> $student_answered)
					{
						$query1 = $this->db->get_where('student_ranking', array(//making selection
							'student_id' => $collection['student_id'],
							'exam_id' => $collection['exam_id'],
							'mock_test_id' =>$collection['question_id']));
							$count1 = $query1->num_rows();
							if($count1 == 0) 
							{
								$data1['mark']         = -$mark['negative_mark'];
					    		$exinqry1 = $this->db->insert('student_ranking', $data1);
							}
							else
							{
								 $upquery1 = 'UPDATE  student_ranking set 
									student_id     =  \''.$data1['student_id'].'\',
									exam_id        =  \''.$data1['exam_id'].'\',
									mark           =  \''.-$mark['negative_mark'].'\'    
									where  mock_test_id =   \''.$collection['question_id'].'\'';

				
				                $exqry1 = $this->db->query($upquery1);
							}
					    $wrong_answer = $wrong_answer+1;
					}else
					{
					}
						
						$data1['mock_test_id'] = $collection['question_id'];
					  	
					  }
				}
			}

				$data['right_answer']= $right_answer;
				$data['wrong_answer']= $wrong_answer;
				$data['unanswered']  = $unanswered;				
				$data['questioncount']  = $count;
				echo json_encode($data);

	}

	function get_exam_count()
	{

		$exam_id = @$_POST['exam_id'];
		
		$result = $this->mock_model->get_exam_count($exam_id);
		
		echo json_encode($result);
    	
		// echo "<pre>";
		// print_r($result[0]['total']);
		// exit;
	}

	function get_updated_question_count() {
		$exam_id = $_POST['exam_id'];
		$student_id = $this->session->userdata('CL_STUDENT_ID');
		$result = $this->mock_model->get_answered_question_counts($exam_id, $student_id);
		
		$mark_for_review = $unanswered = $answered = 0;
		if($result) {
			foreach ($result as $row) {
				if($row['is_marked'] == 1) {
					$mark_for_review++;
				}else if($row['student_answered'] == 'CL' ) {
					$unanswered++;
				}else  if($row['student_answered'] != 'CL' ) {
					$answered++;
				}
			}

		}

		$result_data['mark_for_review'] = $mark_for_review;
		$result_data['answered'] = $answered;
		$result_data['unanswered'] = $unanswered;
		$result_data['notvisited'] = ($mark_for_review + $answered + $unanswered);
		echo json_encode($result_data);


	}



	function  finish_task()
	{
		$data['page_title'] 		= 'Concept Library';
		$data['sub_title'] 			= 'Mock Papers';
		$exam_id 					= $this->uri->segment(3);
		$student_id                 = $this->session->userdata('CL_STUDENT_ID');
		$data['questioncount']      = $this->mock_model->get_exam_count($exam_id);
		$data['student_answered']   = $this->mock_model->getcorrectanswer_count($exam_id,$student_id);
		$data['score_percentage']   = ($data['student_answered'] / $data['questioncount']) *100 ;
		/*$overallrank                = $this->mock_model->overallcount($exam_id,$student_id);
		$i=0;
		foreach($overallrank as $result)
		{

			$data['totalcorrect']   = $result['totalcorrect'];
			$student_id     = $result['student_id'];
			$data['overallpercentage'] = ($result['totalcorrect']/$data['questioncount']) *100;
			$i++;
		}
		print_r($data);*/
		$data['load_view'] 			= 'success';
		$this->load->view('template', $data);
	

	}

	function studenthistorydata()
	{
		$this->load->library('user_session_check');
	    $this->user_session_check->check_student_user_session();

		$data['page_title'] 		= 'Concept Library';
		$data['sub_title'] 			= 'Mock Questions';
		$data['load_js'] 			= 'mock_test';
		$exam_id 					= $this->uri->segment(3);
		$student_id             	= $this->session->userdata('CL_STUDENT_ID');
		$data['exam_id'] 		    = $exam_id ;
		$data['student_id'] 	    = $student_id ;
		$data['exam_name']          = $this->mock_model->exam_name($exam_id);
		$data['studenthistorydata'] = $this->mock_model->checkstudentanswer($exam_id,$student_id);
		$data['studentmarkdata']    = $this->mock_model->getstudentmark($exam_id,$student_id);
		$data['overallrankdata']    = $this->mock_model->overall_rank($exam_id,$student_id);
		$data['load_view'] 		    = 'student_history';
		$this->load->view('template', $data);
	}

	public function exam_detail()
	{
		$student_id             	= $this->session->userdata('CL_STUDENT_ID');
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Mock Questions';
		$data['load_js'] 		= 'mock_test';
		$exam_id 				= $this->uri->segment(3);
		$data['exam_id'] 		= $exam_id ;
		$data['student_id'] 	= $student_id ;
		$data['exam_data']	    = $this->mock_model->fetch_exam($exam_id);
		$data['question'] 		= $this->mock_model->fetch_question($exam_id);
		$data['answered_question'] 		= $this->mock_model->checkstudentanswer($exam_id,$student_id);		
		$data['load_view'] 		= 'mock_questions';
		$this->load->view('template', $data);
	}

	public function up_cleardata()
	{

		$collection 	= $this->input->post('collection');
        $student_id = $collection['student_id'];
        $exam_id = $collection['exam_id'];
        $question_id = $collection['question_id'];
        if($this->mock_model->clearQuestionAnswer($collection))
        {
        	echo true;
        }
        else
        {
        	echo false;
        }

    }

    public function get_student_answers_count()
    {
    	$exam_id = $this->input->post('exam_id');
    	$student_id = $this->input->post('student_id');

    	echo $this->mock_model->get_student_answers_count($exam_id, $student_id);
    }
	public function free_test()
	{
		$data['page_title'] 	= 'Concept Library';
		$data['sub_title'] 		= 'Free Test';
		$data['question'] 		= $this->mock_model->free_test_questions();
		$question_json 			= json_encode( $data['question']);
		$data['load_js'] 		= 'mock_test';
		$data['json_question'] 	= $question_json;
		$exam_id 				= array_values($data['question'])[0];
		$data['exam_data']		= $this->mock_model->fetch_exam($exam_id['exam_id']);
		$data['exam_id'] 		= $exam_id;
		$data['load_view'] 		= 'free_test';
		
		$this->load->view('template', $data);
		
	}
}
/* End of file MockPaper.php */
/* Location: ./application/controllers/MockPaper.php */
