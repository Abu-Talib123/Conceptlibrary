<?php 
class login_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    function insert_student($data)
	{
		$qry=$this->db->insert("student", $data);
		return $qry;
	}
	function fetch_lastdetails()
	{
		$sqry 	= 'SELECT * from student order by id desc limit 1';
		$exsqry	=	$this->db->query($sqry);
		return $exsqry;
	}
	function get_student_detail($email,$password)
	{
		$encryptpassword	=	sha1($password);
		$qry = $this->db->query("SELECT * FROM student WHERE email = '$email'  AND password = '$encryptpassword' AND is_active = 1");
		if($qry->num_rows() > 0)
		{
			return $qry->row_array();
		}else{
			return false;
		}
	}
	
	function updateotpstatus($data)
	{

		$upquery	=	'UPDATE student set  otp_verified = \'1 \' WHERE student_id= \''.$data['student_id'].'\'';
		$exsequery	=	$this->db->query($upquery);		
		return true;
	}
	function fetch_otpdata($id)
	{
		$sequery    ='SELECT *  FROM student WHERE student_id=\''.$id.'\'';
		$exsequery	=	$this->db->query($sequery);
		$otp='';

		if($exsequery->num_rows()>0)
		{
		
			return $exsequery->row_array();
		}else {
		    return false;
		}

		
	}
	function forgotPassword($email)
	{
		$this->db->select('email');
		$this->db->from('student');
		$this->db->where('email', $email);
		$query=$this->db->get();
		return $query->row_array();
	}
   

}
?>