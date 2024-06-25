<?php 
class Mock_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    
     function fetch_examdatabyid($subcatid)
    {
        $today = date("Y-m-d");
        $query  =   'SELECT E.* FROM exam E 
                    JOIN sub_category SC 
                    ON SC.subcategory_id = E.subcategory_id 
                    WHERE E.subcategory_id=\''.$subcatid.'\'   
                    AND E.is_deleted =\'0\' AND E.is_active = 1 AND SC.is_active = 1  ';
        //print_r($query);exit;
        $exquery=   $this->db->query($query);
        return $exquery->result_array();
    }
   
    function fetch_statusbysubcat($subcategory_id)
    {
        $query  =   'SELECT status  from sub_category WHERE subcategory_id=\''.$subcategory_id.'\' AND is_deleted=\'0\'';
        $exquery=   $this->db->query($query);
        $status='';

        if($exquery->num_rows()>0)
        {
            foreach($exquery->result() as $result)
            {
                $status = $result->status;
            }
        }

        return $status;
    }
    function fetch_exam($id)  
    {  
        $sqry      =   'SELECT E.*, SC.status as subcategory_status FROM exam E JOIN sub_category SC ON SC.subcategory_id =  E.subcategory_id WHERE exam_id = \''.$id.'\' ';
        $exqry    =   $this->db->query($sqry);
        return $exqry->row_array();
    } 
    function fetch_examdata()  
    {  
        $this->db->select("*");  
        $this->db->from("exam");
        $this->db->where("is_deleted",0);
        $query = $this->db->get();  
        return $query->result_array();
    }
    function fetch_question($id)  
    {  
        $sqry      =   'SELECT * FROM mock_test WHERE exam_id = \''.$id.'\' AND is_deleted =0 ';
        $exqry    =   $this->db->query($sqry);
        return $exqry->result_array();
    } 
    function getAnswers($mock_test_id)
    { 
        $this->db->select("correct_answer");  
        $this->db->from("mock_test");
        $this->db->where("mock_test_id",$mock_test_id);
        $this->db->where("is_deleted","0");
        $query = $this->db->get();  
        $correct_answer='';

        if($query->num_rows()>0)
        {
        foreach($query->result() as $result)
        {
        $correct_answer = $result->correct_answer;
        }
        }

        return $correct_answer;
    }
    function checkanswer($exam_id,$student_id)
    {
        $this->db->select("*");  
        $this->db->from("student_history");
        $this->db->where("exam_id",$exam_id);
        $this->db->where("student_id",$student_id);
        $query = $this->db->get();  
        return $query->result_array();
    }
    function checkstudentanswer($exam_id,$student_id)
    {
        
        $qry ='SELECT a.mock_test_id,a.exam_id,a.question_type,a.correct_answer,a.question,a.option_1,a.option_2,a.option_3,a.option_4,a.solution_type,a.step,b.student_answered, a.mark, a.negative_mark, a.option_type FROM  mock_test a LEFT JOIN  student_history b ON a.exam_id = b.exam_id and a.mock_test_id =b.mock_test_id AND b.student_id = \''.$student_id .'\'   where a.is_deleted = 0 AND a.exam_id =\''.$exam_id .'\' order by a.mock_test_id asc';

    // print $qry;exit;
        $exqry    =   $this->db->query($qry);
        return $exqry->result_array();
    }
    function exam_name($id)
    {
        $sequery    ='SELECT exam_name  FROM exam WHERE exam_id=\''.$id.'\'';
        $exsequery  =   $this->db->query($sequery);
        $exam='';

        if($exsequery->num_rows()>0)
        {
            foreach($exsequery->result() as $result)
            {
                $exam = $result->exam_name;
            }
        }

        return $exam;
    }
   
     function get_exam_count($exam_id)
    {
        $sqry     =   "SELECT count(*) as total FROM mock_test WHERE exam_id = '$exam_id' AND is_deleted = 0";
        $exqry    =   $this->db->query($sqry);

        if($exqry->num_rows()>0)
        {
            foreach($exqry->result() as $result)
            {
                $totalcount = $result->total;
            }
        }

        return $totalcount;
    }

    function get_answered_question($exam_id, $student_id, $question_id)
    {
        $sqry     =   "SELECT * FROM student_history WHERE exam_id = '$exam_id' AND student_id = '$student_id' AND mock_test_id = '$question_id'  ";
        $exqry    =   $this->db->query($sqry);
        return $exqry->row_array();
    }

     function get_answered_question_counts($exam_id, $student_id)
    {
        $sqry     =   "SELECT * FROM student_history WHERE exam_id = '$exam_id' AND student_id = '$student_id'  ";
        $exqry    =   $this->db->query($sqry);
        return $exqry->result_array();
    }
    function getcorrectanswer_count($exam_id, $student_id)
    {
        $sqry     =   "SELECT count(*) as totalcorrect FROM student_history WHERE  student_answered=correct_answer and exam_id = '$exam_id' and student_id='$student_id'";
             $exqry    =   $this->db->query($sqry);
        if($exqry->num_rows()>0)
        {
            foreach($exqry->result() as $result)
            {
                $totalcorrect = $result->totalcorrect;
            }
        }

        return $totalcorrect;
    }
   
   function getmark($mock_id)
   {
        $this->db->select("*");  
        $this->db->from("mock_test");
        $this->db->where("mock_test_id",$mock_id);
        $this->db->where("is_deleted",0);
        $query = $this->db->get();  
        return $query->result_array();
   }
   function getquestionmark($mock_id)
   {
        $this->db->select("*");  
        $this->db->from("mock_test");
        $this->db->where("mock_test_id",$mock_id);
        $this->db->where("is_deleted",0);
        $query = $this->db->get();  
        return $query->row_array();
   }
function getstudentmark($exam_id,$student_id)
{
    $sqry     =   "SELECT sum(mark)  as total FROM student_ranking WHERE exam_id = '$exam_id' AND student_id = '$student_id'  ";
    $exqry    =   $this->db->query($sqry);
     if($exqry->num_rows()>0)
        {
            foreach($exqry->result() as $total)
            {
                $totalcount = $total->total;
            }
        }

        return $totalcount;
}
function overall_rank($exam_id,$student_id)
{
            $sqry     =   "SELECT rank FROM (
                          SELECT student_id, @rank:=@rank+1 AS rank 
                            FROM (
                                SELECT student_id,  SUM(mark) AS total_sum
                                FROM student_ranking
                                WHERE exam_id='$exam_id'
                                GROUP BY student_id
                                ORDER BY total_sum DESC) AS sq, 
                                (SELECT @rank:=0) AS tr
                                 ) AS q WHERE student_id = '$student_id' ";
            $exqry    =   $this->db->query($sqry);
            if($exqry->num_rows()>0)
            {
               $rank = $exqry->row_array();
               $totalcount = $rank['rank'];
               return $totalcount;
             }else{
                 return 0;
             }

        
}

function total_students($exam_id) {
    
    $sqry     =   "SELECT count(*) as total_student FROM student_history WHERE exam_id = '$exam_id'  ";
    $exqry    =   $this->db->query($sqry);
    if($exqry->num_rows()>0)
    {
       $result = $exqry->row_array();
       $totalstudent = $result['total_student'];
       return $totalstudent;
    }else{
        return 0;
    }
}

function clearQuestionAnswer($collection)
{
    return $this->db->where('student_id', $collection['student_id'])
                    ->where('exam_id', $collection['exam_id'])
                    ->where('mock_test_id', $collection['question_id'])
                    ->delete('student_history');
}

public function get_student_answers_count($exam_id, $student_id)
{
    return $this->db->select('COUNT(id) AS total_answer')
                    ->where('exam_id', $exam_id)
                    ->where('student_id', $student_id)
                    // ->where('status', 1)
                    ->get('student_history')
                    ->row()->total_answer;
}
   
    
    
   

}
?>