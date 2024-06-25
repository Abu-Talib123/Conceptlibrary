<?php 
class Video_model extends CI_Model
{
  function __construct()
    {
        parent::__construct();
    }
    // video
    function fetch_videodata_count()
    {
        $this->db->select("*");  
        $this->db->from("video");
        $this->db->where("is_deleted",0);    
        $query = $this->db->get();  
        return $query->num_rows();
    }
    function fetch_videodata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM video WHERE is_deleted = 0   ORDER BY video_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function insert_videodata($data)
    {
        $qry=$this->db->insert("video", $data);
        return $qry;
    }
    function fetch_single_video($id)  
    {  
        $upqry      =   'SELECT * FROM video WHERE video_id = \''.$id.'\' ';
        $exupqry    =   $this->db->query($upqry);
        return $exupqry->row_array();
    } 
    function update_videodata($data, $id)  
    {  
        $this->db->where("video_id", $id);  
        $this->db->update("video", $data);
    } 
    function update_video_status($video_id, $is_deleted){

        $this->db->where('video_id', $video_id);
        $this->db->update('video', $is_deleted);
        return true;
    }
    function fetch_lastdetails()
    {
        $sqry   = 'SELECT * from video order by id desc limit 1';
        $exsqry =   $this->db->query($sqry);
        return $exsqry;
    }
}
?>