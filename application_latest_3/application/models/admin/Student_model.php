<?php 
class Student_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    // Exam
    function fetch_studentdata_count()
    {
        $this->db->select("*");  
        $this->db->from("student");    
        $query = $this->db->get();  
        return $query->num_rows();
    }
    function fetch_studentdata($start_row, $limit)
    {
       $qry     =   $this->db->query("SELECT * FROM student WHERE is_deleted = 0   ORDER BY student_id  DESC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
   
    function fetch_student($id)  
    {  
        $upqry      =   'SELECT * FROM student WHERE student_id = \''.$id.'\' ';
        $exupqry    =   $this->db->query($upqry);
        return $exupqry->result_array();
    } 
    function update_student_data($student_id, $is_active)  
    {  
        $upqry      =   'UPDATE  student  SET  is_active = \''.$is_active.'\'  WHERE student_id = \''.$student_id.'\' ';
        $exupqry    =   $this->db->query($upqry);
        return true;
    } 
    function update_student_status($student_id, $is_deleted){

        $this->db->where('student_id', $student_id);
        $this->db->update('student', $is_deleted);
        return true;
    }
    function update_studentdata($data, $id)  
    {  
        $this->db->where("student_id", $id);  
        $this->db->update("student", $data);
        return true;
    } 
    function studentcount()
    {
        $sqry   = 'SELECT 
        SUM(CASE WHEN is_active =1  And is_deleted=0 THEN 1 ELSE 0 END) AS active_users,
        SUM(CASE WHEN is_active =0  And is_deleted=1 THEN 1 ELSE 0 END) AS banned_users,
        SUM(CASE WHEN is_active =0  And is_deleted=0 THEN 1 ELSE 0 END) AS new_users
        FROM student';
        $exsqry =   $this->db->query($sqry);
        return $exsqry->result_array();
    }

    function totalcount()
    {
        $sqry   = 'SELECT count(*) as Total FROM student WHERE is_deleted = 0';
        $exsqry =   $this->db->query($sqry);
        $result = $exsqry->row_array();
        return $result['Total'];
    }
    
    function total_videos() {
        $qry = 'SELECT * FROM video WHERE is_deleted = 0';
        $total_rows =   $this->db->query($qry)->num_rows();
        return $total_rows;
    }
    
    function total_mockpapers() {
        $qry = 'SELECT * FROM exam WHERE is_deleted = 0';
        $total_rows =   $this->db->query($qry)->num_rows();
        return $total_rows;
    }

    function getStudentByLimitJson($limit = 10)
    {
        $query = $this->db->select("*")
                          ->where('is_deleted', 0)
                          ->limit($limit)
                          ->order_by('id', 'desc')
                          ->get("student");
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    function getStudentBySearchJson($searchTerm="")
    {
        $query = $this->db->select("*")
                          ->where('is_deleted', 0)
                          ->where("( student_id LIKE '%".$searchTerm."%' OR username LIKE '%".$searchTerm."%' OR email LIKE '%".$searchTerm."%' )")
                          ->order_by('id', 'desc')
                          ->get("student");
        
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    function get_student_exam_history()
    {
        $query = $this->db->select("exam.exam_id, exam.category_id, exam.subcategory_id, exam.exam_name, category.category_name, sub_category.subcategory_name")
                          ->join("category", "category.category_id = exam.category_id")
                          ->join("sub_category", "sub_category.subcategory_id = exam.subcategory_id")
                          ->where('exam.is_deleted', 0)
                          ->where('exam.is_active', 1)
                          ->order_by('exam.id', 'desc')
                          ->get("exam");
        
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    function deleteStudentExamHistory($student_id = 0, $exam_id = 0)
    {
        if($student_id && $exam_id)
        {
            return $this->db->where("student_id", $student_id)->where("exam_id", $exam_id)->delete("student_history");
        }

        return false;
    }

    function getTotalExamCounts()
    {
        return $this->db->select("IFNULL(COUNT(id), 0) AS total_exam")
                        ->where("is_active", 1)
                        ->where("is_deleted", 0)
                        ->get("exam")
                        ->row()->total_exam;
    }

    function getTotalStudentAttendedExams($student_id)
    {
        return $this->db->select("exam_id")
                        ->where("student_id", $student_id)
                        ->group_by("exam_id")
                        ->get("student_history")->num_rows();

    }

    function checkStudentExamStatusById($student_id, $exam_id)
    {
        $count = $this->db->select("exam_id")
                        ->where("student_id", $student_id)
                        ->where("exam_id", $exam_id)
                        ->get("student_history")->num_rows();
        if($count > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function get_student_exam_details($student_id)
    {
        $total_exams_query = $this->db->select("COUNT(exam_id) as total_exams")
                                      ->where("is_deleted", 0)
                                      ->where("is_active", 1)
                                      ->get("exam");
        $total_exams = $total_exams_query->row()->total_exams;

        $attended_exams_query = $this->db->select("COUNT(DISTINCT exam_id) as attended_exams")
                                         ->where("student_id", $student_id)
                                         ->get("student_history");
        $attended_exams = $attended_exams_query->row()->attended_exams;

        $not_attended_exams = $total_exams - $attended_exams;

        return [
            'total_exams' => $total_exams,
            'attended_exams' => $attended_exams,
            'not_attended_exams' => $not_attended_exams
        ];
    }
   
}
?>