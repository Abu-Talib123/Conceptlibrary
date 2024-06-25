<?php 
class cart_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    function fetch_cart($id)  
    {  
        $sqry      =   'SELECT * FROM cart WHERE student_id = \''.$id.'\' and status = \'1\'';
        $exqry     =   $this->db->query($sqry);
        return $exqry->result_array();
    }
    function insert_cart($data)
    {
        $qry=$this->db->insert("cart", $data);
        return $qry;
    }
    function update_cart($id)
    {
        $qry    =  'UPDATE cart set status =\'0\' where id = \''.$id.'\'';
        $exqry  =   $this->db->query($qry);
        return $exqry;
    }
    function delete_cart($student_id)
    {
       $this->db->where('student_id', $student_id);
       $this->db->delete('cart');
    }
   
   

}
?>