<?php 
class login_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    function get_admin_detail($email,$password)
	{
		$encryptpassword	=	sha1($password);
		$qry = $this->db->query("SELECT * FROM users WHERE (email = '$email' OR username='$email') AND password = '$encryptpassword' AND status = 1");
		if($qry->num_rows() > 0)
		{
			return $qry->row_array();
		}else{
			return false;
		}
	}
	function updatepassword($data)
	{
		$password	=	sha1($data['password']);
		$upquery	=	'UPDATE users set  password = \''.$password.'\' WHERE email= \''.$data['email'].'\'';
		$exsequery	=	$this->db->query($upquery);		
		return true;
	}
	function forgotPassword($email)
	{
		$this->db->select('email');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query=$this->db->get();
		return $query->row_array();
	}
   

}
?>