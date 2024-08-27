<?php 
class Result_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    // Category
    function fetch_resultdata($year)  
    { 
       $qry     =   $this->db->query("SELECT * FROM final_result WHERE year = $year");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }

    function getStudent($id) {
        $qry = $this->db->query("SELECT student_photo, username FROM student WHERE student_id = '$id' AND is_deleted = 0");
        return $qry->row_array();
    }
    function getcategory($id) {
        $qry = $this->db->query("SELECT category_name FROM category WHERE category_id = $id AND is_deleted = 0");
        return $qry->row_array();
    }
}
?>