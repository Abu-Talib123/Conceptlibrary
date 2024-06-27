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
       $qry     =   $this->db->query("SELECT * FROM blog WHERE is_deleted = 0 ORDER BY blog_id  ASC limit  $start_row, $limit");
      
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
        return $this->db->insert_id();
    }
    // Soft delete a blog post
    function delete_blog($id)
    {
        $this->db->where('blog_id', $id);
        $this->db->update('blog', array('is_deleted' => 1));
        return ($this->db->affected_rows() > 0);
    }
        // Blog Category

    public function get_categories()
    {
        $this->db->select('category_id, name');
        $this->db->from('blog_category'); // Adjust this according to your table name
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_all_categories()
    {
        $query = $this->db->get('blog_category');
        return $query->result_array();
    }
    public function get_all_category()
    {
        $qry     =   $this->db->query("SELECT * FROM blog_category WHERE is_deleted = 0 ORDER BY category_id ");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }

    function fetch_blog_category_data_count()
    {
        $this->db->select("*");  
        $this->db->from("blog_category");
        $this->db->where("is_deleted",0);    
        $query = $this->db->get();  
        return $query->num_rows();
    }
    function fetch_blog_category_data($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM blog_category WHERE is_deleted = 0 ORDER BY category_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    
    function fetch_single_blog_category($id)
    {
        $this->db->select('*');
        $this->db->from('blog_category');
        $this->db->where('category_id', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->row_array();
    }
    function get_blog_category_by_id($id)
    {
        $this->db->where('category_id', $id);
        $query = $this->db->get('blog_category');
        return $query->row_array();
    }
    function update_blog_category_data($data, $id)
    {
        $this->db->where('category_id', $id);
        $this->db->where('is_deleted', 0);
        $this->db->update('blog_category', $data);
        return ($this->db->affected_rows() > 0);
    }
    function insert_blog_category_data($data)
    {
        $this->db->insert('blog_category', $data);
        return $this->db->insert_id();
    }
    function delete_blog_category($id)
    {
        $this->db->where('category_id', $id);
        $this->db->delete('blog_category');
        return ($this->db->affected_rows() > 0);
    }
    
    
}?>