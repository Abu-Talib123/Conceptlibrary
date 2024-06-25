<?php 
class payment_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    function insert_payment($data)
	{
		$qry=$this->db->insert("payment", $data);
		return $qry;
	}
	function fetch_lastdetails()
	{
		$sqry 	= 'SELECT * from payment order by id desc limit 1';
		$exsqry	=	$this->db->query($sqry);
		return $exsqry;
	}
	function fetch_payment_status($student_id , $video_id )
	{
		$sqry 	= 'SELECT * FROM `payment` WHERE student_id=\''.$student_id.'\' and material_id =\''.$video_id.'\'';
		$exsqry	=	$this->db->query($sqry);
		return $exsqry->num_rows();
	}
	function fetch_paymentdetails($id)
	{ 
		$sqry 	= 'SELECT * FROM `payment` WHERE payment_id=\''.$id.'\' ';
		$exquery=   $this->db->query($sqry);
        return $exquery->result_array();
	}
	function  update_paymentdata($razid,$paymentid,$paymentstatus)
	{
		$upqry 	= 'UPDATE payment set razor_payment_id =\''.$razid.'\' ,paymentstatus =  \''.$paymentstatus.'\' WHERE payment_id =\''.$paymentid.'\'';
		$exsqry	=	$this->db->query($upqry);
		return $exsqry;
	}
	
	function check_payment($student_id , $material_id, $material_type='')
	{
	    
		$sqry 	= "SELECT * FROM `payment` WHERE student_id='$student_id' and material_id ='$material_id' AND material_type = '$material_type' ";
		$exsqry	=	$this->db->query($sqry);
		return $exsqry->row_array();
	}
   

}
?>