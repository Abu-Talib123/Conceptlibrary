<?php 
class Common_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
     // Category
    function fetch_categorydata()
    {
		$this->db->select("*");  
		$this->db->from("category");
		$this->db->where("is_deleted",0);  
		$this->db->where("is_active",1);  
		$query = $this->db->get();  
		return $query->result_array();
    }
   function category_name($id)
	{
		$sequery    ='SELECT category_name  FROM category WHERE category_id=\''.$id.'\'  ';
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
	function fetch_single_category($id)  
	{  
		$upqry		=	'SELECT * FROM category WHERE category_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
	//subcategory

	 function fetch_subcategorydata()
    {
		$this->db->select("*");  
		$this->db->from("sub_category");
		$this->db->where("is_deleted",0);
		$this->db->where("is_active",1);  
		$query = $this->db->get();  
		return $query->result_array();
    }
    function fetch_single_subcategory($id)  
	{  
		$upqry		=	'SELECT * FROM sub_category WHERE subcategory_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
    function subcategory_name($id)
	{
		$sequery    ='SELECT subcategory_name  FROM sub_category WHERE subcategory_id=\''.$id.'\'';
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
	
	function subcategory_price($id, $material_type ='')
	{
		$sequery    ='SELECT *  FROM sub_category WHERE subcategory_id=\''.$id.'\'';
		$exsequery	=	$this->db->query($sequery);
		$price='';

		if($exsequery->num_rows()>0)
		{
			foreach($exsequery->result() as $result)
			{   
			    if($material_type == 'mock'){
			        if($result->m_offer_price > 0){
			            $price =	$result->m_offer_price;
			        }else{
			            $price =	$result->m_price;
			        }
			    }else {
			        if($result->offer_price > 0){
			            $price =	$result->offer_price;
			        }else{
			            $price =	$result->price;
			        }
			    }
				
			}
		}

		return $price;
	}
	function fetchsubcatbyid($category_id)
	{
		$seqry		=	'SELECT * FROM sub_category WHERE category_id = \''.$category_id.'\' AND is_deleted = 0 AND is_active = 1 ';
		$exseqry	=	$this->db->query($seqry);
		return $exseqry->result_array();
	}
	function fetchsubcategoryresult($subcategory_id)
	{
		$seqry		=	'SELECT * FROM sub_category WHERE subcategory_id = \''.$subcategory_id.'\' ';
		$exseqry	=	$this->db->query($seqry);
		return $exseqry->result_array();
	}
	/*function fetchdomainbyid($subcategory_id)
	{
		$seqry		=	'SELECT * FROM domain WHERE subcategory_id = \''.$subcategory_id.'\' ';
		$exseqry	=	$this->db->query($seqry);
		return $exseqry->result_array();
	}*/
	
	// University
	function fetch_universitydata()
    {
		$this->db->select("*");  
		$this->db->from("university");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->result_array();
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
	// college
    function fetch_collegedata()
    {
		$this->db->select("*");  
		$this->db->from("college");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->result_array();
    }
    function fetch_single_college($id)  
	{  
		$upqry		=	'SELECT * FROM college WHERE college_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
	function fetchcollegebyid($university_id)
	{
		$seqry		=	'SELECT * FROM college WHERE university_id = \''.$university_id.'\' ';
		$exseqry	=	$this->db->query($seqry);
		return $exseqry;
	}
	//Country
	function fetch_countrydata()
    {
		$this->db->select("*");  
		$this->db->from("country");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->result_array();
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
	// state
    function fetch_statedata()
    {
		$this->db->select("*");  
		$this->db->from("state");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->result_array();
    }
	function fetch_single_state($id)  
	{  
		$upqry		=	'SELECT * FROM state WHERE state_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
	function fetchstatebyid($country_id)
	{
		$seqry		=	'SELECT * FROM state WHERE country_id = \''.$country_id.'\' ';
		$exseqry	=	$this->db->query($seqry);
		return $exseqry;
	}
	// city
    function fetch_citydata()
    {
		$this->db->select("*");  
		$this->db->from("city");
		$this->db->where("is_deleted",0);    
		$query = $this->db->get();  
		return $query->result_array();
    }
	function fetch_single_city($id)  
	{  
		$upqry		=	'SELECT * FROM city WHERE city_id = \''.$id.'\' ';
		$exupqry	=	$this->db->query($upqry);
		return $exupqry->result_array();
	} 
	function fetchcitybyid($id)
	{
		$sequery = 'SELECT * FROM city where state_id=\''.$id.'\'';
		$exsequery = $this->db->query($sequery );
		return $exsequery;
	}
	function fetchvideocategorybydata()
	{
		$seqry		= 'SELECT DISTINCT category_id FROM video';
		$exupqry	=  $this->db->query($seqry);
		return $exupqry->result_array();
	}
	function fetchsubcategorybydata($id)
	{
		$seqry		=	'SELECT DISTINCT subcategory_id FROM video where category_id=\''.$id.'\'';
		$exupqry	=	$this->db->query($seqry);
		return $exupqry->result_array();
	}
	function fetch_cart($student_id,$subcategory_id)  
    {  
        $sqry      =   'SELECT * FROM cart WHERE student_id = \''.$student_id.'\'  AND subcategory_id =\''.$subcategory_id.'\' and status = \'1\'';
        $exqry     =   $this->db->query($sqry);
        return $exqry->result_array();
    } 
	function fetch_cartdata_count($id)
	{
	$this->db->select("*");  
	$this->db->from("cart");
	$this->db->where("student_id",$id); 
	$this->db->where("status",1);    
	$query = $this->db->get();  
	return $query->num_rows();
	}
	function fetchexambyid($id)
	{
		$sequery = 'SELECT * FROM exam where subcategory_id=\''.$id.'\' AND is_deleted = 0 AND is_active = 1';
		$exsequery = $this->db->query($sequery );
		return $exsequery;
	}
	


}
?>