<?php 
class Exam_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    // Exam
    function fetch_examdata_count()
    {
        $this->db->select("*");  
        $this->db->from("exam");
        $this->db->where("is_deleted",0);    
        $query = $this->db->get();  
        return $query->num_rows();
    }
    function fetch_examdetailsdata()
    {
        $this->db->select("*");  
        $this->db->from("exam");
        $this->db->where("is_deleted",0);    
        $query = $this->db->get();  
        return $query->result_array();
    }
    function fetch_examdata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT E.*, SC.subcategory_name, C.category_name FROM exam E 
                                    JOIN category C ON C.category_id = E.category_id
                                    JOIN sub_category SC ON SC.subcategory_id = E.subcategory_id WHERE E.is_deleted = 0   ORDER BY E.exam_id  ASC limit  $start_row, $limit");
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function insert_examdata($data)
    {
        $qry=$this->db->insert("exam", $data);
        return $qry;
    }
    function fetch_single_exam($id)  
    {  
        $upqry      =   'SELECT * FROM exam WHERE exam_id = \''.$id.'\' ';
        $exupqry    =   $this->db->query($upqry);
        return $exupqry->result_array();
    } 
    function update_exam_data($data, $id)  
    {  
        $this->db->where("exam_id", $id);  
        $this->db->update("exam", $data);
    } 
    function update_exam_status($exam_id, $is_deleted){

        $this->db->where('exam_id', $exam_id);
        $this->db->update('exam', $is_deleted);
        return true;
    }
    function exam_name($id)
    {
        $sequery    = 'SELECT exam_name  FROM exam WHERE exam_id=\''.$id.'\'';
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
    function fetch_lastdetails()
    {
        $sqry   = 'SELECT * from exam order by id desc limit 1';
        $exsqry =   $this->db->query($sqry);
        return $exsqry;
    }
}
?>