<?php 
class Blog_model extends CI_Model
{
  function __construct()
    {
        parent::__construct();
    }
    // psyment
    function fetch_blogdata_count()
    {
        $this->db->select("*");  
        $this->db->from("blog");
        $this->db->where("is_deleted",0);    
        $query = $this->db->get();  
        return $query->num_rows();
    }
    function fetch_blogdata($start_row, $limit)  
    { 
       $qry     =  $this->db->query("SELECT * FROM blog WHERE is_deleted = 0 AND is_published = 1 ORDER BY blog_id DESC LIMIT $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function fetch_blogdatas()  
    { 
       $qry     =   $this->db->query("SELECT * FROM blog WHERE is_deleted = 0 ORDER BY blog_id");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function get_blog_by_id($id)
    {
        $this->db->where('blog_id', $id);
        $query = $this->db->get('blog');
        return $query->row_array();
    }
        // Blog Category

     public function get_all_categories()
    {
        $query = $this->db->get('blog_category');
        return $query->result_array();
    }
    
}?>