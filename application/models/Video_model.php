<?php 
class Video_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    
	function fetch_freevideodata()  
    {  
        $this->db->select("*");  
        $this->db->from("video");
        $this->db->where("is_deleted",0); 
        $this->db->where("status",0); 
        $this->db->where("is_active",1);   
        $query = $this->db->get();  
        return $query->result_array();
    }
    function fetch_paidvideodata()  
    {  
        $this->db->select("*");  
        $this->db->from("video");
        $this->db->where("is_deleted",0); 
        $this->db->where("status",1);    
        $this->db->where("is_active",1);  
        $query = $this->db->get();  
        return $query->result_array();
    }  
    function fetch_video($id)  
    {  
        $sqry      =   'SELECT * FROM video WHERE video_id = \''.$id.'\' AND is_active = 1 AND is_deleted = 0 ';
        $exqry    =   $this->db->query($sqry);
        return $exqry->result_array();
    } 
    function fetch_videodata()  
    {  
        $this->db->select("*");  
        $this->db->from("video");
        $this->db->where("is_deleted",0);
        $this->db->where("is_active",1);
        $query = $this->db->get();  
        return $query->result_array();
    }
    function fetchvideotype($catid,$subcatid)
    {
        $query  =   'SELECT * FROM video WHERE category_id=\''.$catid.'\' AND  subcategory_id=\''.$subcatid.'\' AND is_deleted=\'0\' AND is_active = 1';
        $exquery=   $this->db->query($query);
   
        return $exquery->result_array();
    }
    function fetch_videobysubcat($subcategory_id)
    {
        $query  =   'SELECT * FROM video WHERE subcategory_id=\''.$subcategory_id.'\' AND is_deleted=\'0\' AND is_active = 1';
        $exquery=   $this->db->query($query);
        return $exquery->result_array();
    }
    function fetch_statusbysubcat($subcategory_id)
    {
        $query  =   'SELECT status  from sub_category WHERE subcategory_id=\''.$subcategory_id.'\' AND is_deleted=\'0\' AND is_active = 1';
        $exquery=   $this->db->query($query);
        $status='';

        if($exquery->num_rows()>0)
        {
           $status = $exquery->row_array();
           return $status['status'];
        }

        
    }
    
    function check_cart($subcatid, $student_id, $type)
    {
       
        $query  =   "SELECT * FROM cart WHERE   subcategory_id='$subcatid' AND student_id = '$student_id' AND domain_type IN ('all', '$type')";
        $exquery=   $this->db->query($query);
        return $exquery->num_rows();
    }
    
    function fetch_paidvideobysubcat($subcatid)
    {
        $query  =   'SELECT * FROM sub_category WHERE   subcategory_id=\''.$subcatid.'\' AND is_deleted=\'0\' AND status =\'1\'';
        $exquery=   $this->db->query($query);
        return $exquery->row_array();
    }
    
    function check_payment($subcatid, $student_id, $type)
    {
       
        $query  =   "SELECT * FROM payment WHERE   material_id='$subcatid' AND student_id = '$student_id' AND material_type IN ('all', '$type') AND  paymentstatus IN(1,2)";
        $exquery=   $this->db->query($query);
        return $exquery->num_rows();
    }
    
    function file_video_data($video_id)
    {
        $query  =   'SELECT video_url FROM video WHERE video_id=\''.$video_id.'\'';
        $exquery=   $this->db->query($query);
        if($exquery->num_rows()>0)
        {
            foreach($exquery->result() as $result)
            {
                $video_url = $result->video_url;
            }
        }

        return $video_url;
    }
    
    function fetch_video_data($id)  
    {  
        $sqry      =   'SELECT * FROM video WHERE video_id = \''.$id.'\' AND is_active = 1 AND is_deleted = 1 ';
        $exqry    =   $this->db->query($sqry);
        return $exqry->row_array();
    } 

}
?>