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
       $qry     =   $this->db->query("SELECT * FROM blog  ORDER BY blog_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }

    function fetch_single_blog($id)
    {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->where('blog_id', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->row_array();
    }
    function get_blog_by_id($id)
    {
        $this->db->where('blog_id', $id);
        $query = $this->db->get('blog');
        return $query->row_array();
    }

    function update_blogdata($data, $id)
    {
        $this->db->where('blog_id', $id);
        $this->db->where('is_deleted', 0);
        $this->db->update('blog', $data);
        return ($this->db->affected_rows() > 0);
    }

    // Insert a new blog post
    function insert_blogdata($data)
    {
        $this->db->insert('blog', $data);
    }

    // Soft delete a blog post
    function delete_blog($id)
    {
        $this->db->where('blog_id', $id);
        $this->db->update('blog', array('is_deleted' => 1));
        return ($this->db->affected_rows() > 0);
    }
}?>