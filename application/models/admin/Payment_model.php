<?php 
class Payment_model extends CI_Model
{
  function __construct()
    {
        parent::__construct();
    }
    // psyment
    function fetch_paymentdata_count()
    {
        $this->db->select("*");  
        $this->db->from("payment");
        $this->db->where("paymentstatus",2);    
        $query = $this->db->get();  
        return $query->num_rows();
    }
    function fetch_paymentdata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM payment WHERE paymentstatus = 2   ORDER BY payment_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
}?>