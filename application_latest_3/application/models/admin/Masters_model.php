<?php 
class masters_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
    // Category
   function fetch_categorydata_count()
    {
		$this->db->select("*");  
		$this->db->from("category");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->num_rows();
    }
    function fetch_categorydata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM category WHERE is_deleted = 0   ORDER BY category_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
	function fetch_category()
    {
		$this->db->select("*");  
		$this->db->from("category");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->result_array();
    }
	function insert_categorydata($data)  
	{  
	  	$this->db->insert("category", $data);  
	}

	function fetch_single_category($id)  
	{  
		$upqry		=	'SELECT * FROM category WHERE category_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 

	function category_name($id)
	{
		$sequery    ='SELECT category_name  FROM category WHERE category_id=\''.$id.'\' AND is_deleted = 0';
		$exsequery	=	$this->db->query($sequery);
		$category='';

		if($exsequery->num_rows()>0)
		{
			foreach($exsequery->result() as $result)
			{
				$category =	$result->category_name;
			}
		}

		return $category;
	}

	function update_categorydata($data, $id)  
	{  
		$this->db->where("category_id", $id);  
		$this->db->update("category", $data);
	} 

	function update_category_status($category_id, $is_deleted){

		$this->db->where('category_id', $category_id);
		$this->db->update('category', $is_deleted);
		return true;
	}
	function categoryname_exists($category_name)
	{
	$this->db->select('*'); 
	$this->db->from('category');
	$this->db->where('category_name', $category_name);
	$this->db->where('is_deleted', '0');
	$query = $this->db->get();
	$result = $query->result_array();
	return $result;
	}
	// SubCategory
	 function fetch_subcategorydata_count()
    {
		$this->db->select("*");  
		$this->db->from("sub_category");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->num_rows();
    }
    function fetch_subcategorydata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM sub_category WHERE is_deleted = 0   ORDER BY subcategory_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function fetch_subcategory()
    {
		$this->db->select("*");  
		$this->db->from("sub_category");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->result_array();
    }
	function insert_subcategorydata($data)  
	{  
	  	$this->db->insert("sub_category", $data);  
	} 
	function fetch_single_subcategory($id)  
	{  
		$upqry		=	'SELECT * FROM sub_category WHERE subcategory_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
	function update_subcategorydata($data, $id)  
	{  
		$this->db->where("subcategory_id", $id);  
		$this->db->update("sub_category", $data);
	} 
	function update_subcategory_status($subcategory_id, $is_deleted){

		$this->db->where('subcategory_id', $subcategory_id);
		$this->db->update('sub_category', $is_deleted);
		return true;
	}
	function subcategory_name($id)
	{
		$sequery    ='SELECT subcategory_name  FROM sub_category WHERE subcategory_id=\''.$id.'\' AND is_deleted = 0';
		$exsequery	=	$this->db->query($sequery);
		$subcategory='';

		if($exsequery->num_rows()>0)
		{
			foreach($exsequery->result() as $result)
			{
				$subcategory =	$result->subcategory_name;
			}
		}

		return $subcategory;
	}
	// chapter
	function fetch_domaindata_count()
    {
		$this->db->select("*");  
		$this->db->from("domain");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->num_rows();
    }
    function fetch_domaindata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM domain WHERE is_deleted = 0   ORDER BY domain_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function fetch_domain()
    {
		$this->db->select("*");  
		$this->db->from("domain");
		$this->db->where("is_deleted",0);
		//$this->db->where("is_active",1);    
		$query = $this->db->get();  
		return $query->result_array();
    }
	function insert_domaindata($data)  
	{  
	  	$this->db->insert("domain", $data);  
	} 
	function fetch_single_domain($id)  
	{  
		$upqry		=	'SELECT * FROM domain WHERE domain_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
	function update_domaindata($data, $id)  
	{  
		$this->db->where("domain_id", $id);  
		$this->db->update("domain", $data);
	} 
	function update_domain_status($domain_id, $is_deleted){

		$this->db->where('domain_id', $chapter_id);
		$this->db->update('domain', $is_deleted);
		return true;
	}
	function domain_name($id)
	{
		$sequery    ='SELECT domain_name  FROM domain WHERE domain_id=\''.$id.'\'';
		$exsequery	=	$this->db->query($sequery);
		$domain='';

		if($exsequery->num_rows()>0)
		{
			foreach($exsequery->result() as $result)
			{
				$domain =	$result->domain_name;
			}
		}

		return $domain;
	}
	// University
	function fetch_universitydata_count()
    {
		$this->db->select("*");  
		$this->db->from("university");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->num_rows();
    }
    function fetch_universitydata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM university WHERE is_deleted = 0   ORDER BY university_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
	function fetch_university()
    {
		$this->db->select("*");  
		$this->db->from("university");
		$this->db->where("is_deleted",0);
		$this->db->where("is_active",1);    
		$query = $this->db->get();  
		return $query->result_array();
    }

	function insert_universitydata($data)  
	{  
	  	$this->db->insert("university", $data);  
	}

	function fetch_single_university($id)  
	{  
		$upqry		=	'SELECT * FROM university WHERE university_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 

	function university_name($id)
	{
		$sequery    ='SELECT university_name  FROM university WHERE university_id=\''.$id.'\'';
		$exsequery	=	$this->db->query($sequery);
		$university='';

		if($exsequery->num_rows()>0)
		{
			foreach($exsequery->result() as $result)
			{
				$university =	$result->university_name;
			}
		}

		return $university;
	}

	function update_universitydata($data, $id)  
	{  
		$this->db->where("university_id", $id);  
		$this->db->update("university", $data);
	} 

	function update_university_status($university_id, $is_deleted){

		$this->db->where('university_id', $university_id);
		$this->db->update('university', $is_deleted);
		return true;
	}
	// college	
	function fetch_collegedata_count()
    {
		$this->db->select("*");  
		$this->db->from("college");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->num_rows();
    }
    function fetch_collegedata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM college WHERE is_deleted = 0   ORDER BY college_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function fetch_college()
    {
		$this->db->select("*");  
		$this->db->from("college");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->result_array();
    }
	function insert_collegedata($data)  
	{  
	  	$this->db->insert("college", $data);  
	} 
	function fetch_single_college($id)  
	{  
		$upqry		=	'SELECT * FROM college WHERE college_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
	function update_collegedata($data, $id)  
	{  
		$this->db->where("college_id", $id);  
		$this->db->update("college", $data);
	} 
	function update_college_status($college_id, $is_deleted){

		$this->db->where('college_id', $college_id);
		$this->db->update('college', $is_deleted);
		return true;
	}
	function college_name($id)
	{
		$sequery    ='SELECT college_name  FROM college WHERE college_id=\''.$id.'\'';
		$exsequery	=	$this->db->query($sequery);
		$college='';

		if($exsequery->num_rows()>0)
		{
			foreach($exsequery->result() as $result)
			{
				$college =	$result->college_name;
			}
		}

		return $college;
	}
	//Country
	function fetch_countrydata_count()
    {
		$this->db->select("*");  
		$this->db->from("country");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->num_rows();
    }
    function fetch_countrydata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM country WHERE is_deleted = 0   ORDER BY country_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
	function fetch_country()
    {
		$this->db->select("*");  
		$this->db->from("country");
		$this->db->where("is_deleted",0); 
		$this->db->where("is_active",1);     
		$query = $this->db->get();  
		return $query->result_array();
    }

	function insert_countrydata($data)  
	{  
	  	$this->db->insert("country", $data);  
	}

	function fetch_single_country($id)  
	{  
		$upqry		=	'SELECT * FROM country WHERE country_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 

	function country_name($id)
	{
		$sequery    ='SELECT country_name  FROM country WHERE country_id=\''.$id.'\'';
		$exsequery	=	$this->db->query($sequery);
		$country='';

		if($exsequery->num_rows()>0)
		{
			foreach($exsequery->result() as $result)
			{
				$country =	$result->country_name;
			}
		}

		return $country;
	}

	function update_countrydata($data, $id)  
	{  
		$this->db->where("country_id", $id);  
		$this->db->update("country", $data);
	} 

	function update_country_status($country_id, $is_deleted){

		$this->db->where('country_id', $country_id);
		$this->db->update('country', $is_deleted);
		return true;
	}
	// state
	function fetch_statedata_count()
    {
		$this->db->select("*");  
		$this->db->from("state");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->num_rows();
    }
    function fetch_statedata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM state WHERE is_deleted = 0   ORDER BY state_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function fetch_state()
    {
		$this->db->select("*");  
		$this->db->from("state");
		$this->db->where("is_deleted",0); 
		$this->db->where("is_active",1);   
		$query = $this->db->get();  
		return $query->result_array();
    }
	function insert_statedata($data)  
	{  
	  	$this->db->insert("state", $data);  
	} 
	function fetch_single_state($id)  
	{  
		$upqry		=	'SELECT * FROM state WHERE state_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
	function update_statedata($data, $id)  
	{  
		$this->db->where("state_id", $id);  
		$this->db->update("state", $data);
	} 
	function update_state_status($state_id, $is_deleted){

		$this->db->where('state_id', $state_id);
		$this->db->update('state', $is_deleted);
		return true;
	}
	function state_name($id)
	{
		$sequery    ='SELECT state_name  FROM state WHERE state_id=\''.$id.'\'';
		$exsequery	=	$this->db->query($sequery);
		$state='';

		if($exsequery->num_rows()>0)
		{
			foreach($exsequery->result() as $result)
			{
				$state =	$result->state_name;
			}
		}

		return $state;
	}
	// city
	function fetch_citydata_count()
    {
		$this->db->select("*");  
		$this->db->from("city");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->num_rows();
    }
    function fetch_citydata($start_row, $limit)  
    { 
       $qry     =   $this->db->query("SELECT * FROM city WHERE is_deleted = 0   ORDER BY city_id  ASC limit  $start_row, $limit");
      
        if($qry->num_rows() > 0) {
            return $qry->result_array();
        }
        else {
            return false;
        }
    }
    function fetch_city()
    {
		$this->db->select("*");  
		$this->db->from("city");
		$this->db->where("is_deleted",0);
		$this->db->where("is_active",1);    
		$query = $this->db->get();  
		return $query->result_array();
    }
	function insert_citydata($data)  
	{  
	  	$this->db->insert("city", $data);  
	} 
	function fetch_single_city($id)  
	{  
		$upqry		=	'SELECT * FROM city WHERE city_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
	function update_citydata($data, $id)  
	{  
		$this->db->where("city_id", $id);  
		$this->db->update("city", $data);
	} 
	function update_city_status($city_id, $is_deleted){

		$this->db->where('city_id', $city_id);
		$this->db->update('city', $is_deleted);
		return true;
	}
	function city_name($id)
	{
		$sequery    ='SELECT city_name  FROM city WHERE city_id=\''.$id.'\'';
		$exsequery	=	$this->db->query($sequery);
		$city='';

		if($exsequery->num_rows()>0)
		{
			foreach($exsequery->result() as $result)
			{
				$city =	$result->city_name;
			}
		}

		return $city;
	}
	function getstatedetailbyid($id)
	{
		$sequery = 'SELECT * FROM state where country_id=\''.$id.'\' AND is_deleted = \'0\'';
		$exsequery = $this->db->query($sequery );
		return $exsequery;
	}
	function getcitydetailbyid($id)
	{
		$sequery = 'SELECT * FROM city where state_id=\''.$id.'\' AND is_deleted = \'0\'';
		$exsequery = $this->db->query($sequery );
		return $exsequery;
		
	}
	function getsubcategorybyid($id)
	{
		$sequery = 'SELECT * FROM sub_category where category_id=\''.$id.'\' AND is_deleted = \'0\'';
		//print $sequery;exit;
		$exsequery = $this->db->query($sequery );
		return $exsequery;
	}
	
		function fetchsubcatbyid($category_id)
	{
		$seqry		=	'SELECT * FROM sub_category WHERE category_id = \''.$category_id.'\' AND is_deleted = 0  ';
		$exseqry	=	$this->db->query($seqry);
		return $exseqry->result_array();
	}
		function fetchexambyid($id)
	{
		$sequery = 'SELECT * FROM exam where subcategory_id=\''.$id.'\' AND is_deleted = 0 ';
	
		$exsequery = $this->db->query($sequery );
		return $exsequery;
	}
}
?>