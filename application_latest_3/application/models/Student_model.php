<?php 
class student_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    
	function fetch_student($id)  
    {  
        $upqry      =   'SELECT * FROM student WHERE student_id = \''.$id.'\' ';
        $exupqry    =   $this->db->query($upqry);
        return $exupqry->result_array();
    } 
    function update_student_data($data, $id)  
    {  
        $this->db->where("student_id", $id);  
        $this->db->update("student", $data);
        return true;
    } 
    function update_paymentstatus($student_id, $payment_status){

        $this->db->where('student_id', $student_id);
        $this->db->update('student', $payment_status);
        return true;
    }
    function updatepassword($data)
    {
        $password   =   sha1($data['password']);
        $upquery    =   'UPDATE student set  password = \''.$password.'\' WHERE student_id= \''.$data['student_id'].'\'';
        $exsequery  =   $this->db->query($upquery);     
        return true;
    }

}
?>