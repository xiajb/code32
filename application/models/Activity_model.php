<?php 



/**
* 
*/
class Activity_model extends Ci_Model
{
	
	function  __construct()
	{
		parent::__construct();
	}
	function add($data){
  		return $this->db->insert('ci_activity',$data);
	}



	public function get_activity_by_id($course_id){
		// $this->db->where('course_id',$course_id);
		// $query = $this->db->get('ci_chapter');
		// return $query->result_array();
	}


}




 ?>
