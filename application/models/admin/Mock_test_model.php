<?php 
class Mock_test_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    function fetch_mockdata_count()
    {
        $this->db->select("*");  
        $this->db->from("mock_test");
        $this->db->where("is_deleted",0);    
        $query = $this->db->get();  
        return $query->num_rows();
    }
    function fetch_mockdata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM mock_test WHERE is_deleted = 0   ORDER BY mock_test_id  ASC limit  $start_row, $limit");
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
     function fetch_mockbyid_count($exam_id)
    {
        $this->db->select("*");  
        $this->db->from("mock_test");
        $this->db->where("is_deleted",0);
        $this->db->where("exam_id",$exam_id);    
        $query = $this->db->get();  
        return $query->num_rows();
    }
    function insert_mockdata($data)
    {
        $qry=$this->db->insert("mock_test", $data);
        return true;
    }
    function fetch_single_video($id)  
    {  
        $upqry      =   'SELECT * FROM video WHERE video_id = \''.$id.'\' ';
        $exupqry    =   $this->db->query($upqry);
        return $exupqry->result_array();
    } 
    function update_mock_testdata($data, $id)  
    {  
        $this->db->where("mock_test_id", $id);  
        $this->db->update("mock_test", $data);
        return true;
    } 
    function update_mock_status($mock_test_id, $is_deleted){

        $this->db->where('mock_test_id', $mock_test_id);
        $this->db->update('mock_test', $is_deleted);
        return true;
    }
    // upload through file
    function insert($data)
    {
        $this->db->insert_batch('mock_test', $data);
    }
    function fetch_mockdatabyid($exam_id,$start_row,$limit)  
    { 
        /*print_r($exam_id); print_r($start_row); print_r($limit); exit;*/
      /* $qry     =   $this->db->query('SELECT * FROM mock_test WHERE  exam_id= \''.$exam_id.'\'  And is_deleted = 0   ORDER BY mock_test_id  ASC limit  $start_row, $limit');*/
         $qry     =   $this->db->query("SELECT * FROM mock_test WHERE is_deleted = 0  And  exam_id='$exam_id'  ORDER BY mock_test_id  ASC limit  $start_row, $limit");
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function fetch_mocktestbyid($mock_test_id)  
    { 
       $qry     =   $this->db->query('SELECT * FROM mock_test WHERE mock_test_id  = \''.$mock_test_id.'\' ');
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
}
?>