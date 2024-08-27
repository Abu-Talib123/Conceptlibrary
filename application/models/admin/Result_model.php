<?php 
class Result_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    // Category
    function fetch_result_count()
    {
        $this->db->select("*");  
        $this->db->from("final_result");
        $query = $this->db->get();  
        return $query->num_rows();
    }

    function fetch_resultdata_per_year($year)  
    { 
       $qry     =   $this->db->query("SELECT  * FROM final_result WHERE year = $year");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function fetch_resultdata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT DISTINCT * FROM final_result ORDER BY id  DESC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function insert_resultdata($data)
    {
        $this->db->insert('final_result', $data);
        return $this->db->insert_id();
    }

    function getAllStudentname(){
        $query = $this->db->query('SELECT student_id, username FROM student WHERE is_deleted = 0 ORDER BY student_id ASC');
        return $query->result_array();
    }
    function getAllcategories(){
        $query = $this->db->query('SELECT category_id, category_name FROM category WHERE is_deleted = 0 ORDER BY category_id ASC');
        return $query->result_array();
    }
}
?>