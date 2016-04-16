<?php 



/**
* 
*/
class Activity_model extends Ci_Model
{
	
	public function  __construct()
	{
		parent::__construct();
	}

	public function add($data){
  		return $this->db->insert('ci_activity',$data);
	}

	public function query_all(){
		$query = $this->db->get('ci_activity');
		return $query->result_array();
	}

	public function get_activity_by_id($activity_id){
		$this->db->where('activity_id',$activity_id);
		$query = $this->db->get('ci_activity');
		return $query->result_array();
	}

	public function delete($activity_id){
		return $this->db->delete('ci_activity', array('activity_id' => $activity_id));
	}


}




 ?>
