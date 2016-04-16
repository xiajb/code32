<?php 

class Join_model extends Ci_Model
{
	
	public function  __construct()
	{
		parent::__construct();
	}

	public function add($data){
  		return $this->db->insert('ci_join',$data);
	}

	public function acount($activity_id){
		$this->db->where('activity_id', $activity_id);
		$this->db->from('ci_join');
		return $this->db->count_all_results(); 
	}

	public function get_all_by_activity_id($activity_id){
		$this->db->where('activity_id',$activity_id);
		$query = $this->db->get('ci_join');
		return $query->result_array();
	}

	public function get_limit($activity_id,$first,$num){
		$query = $this->db->select('*')
			        ->where("activity_id",$activity_id)
			        ->limit($first, $num)
			        ->get('ci_join');
		return $query->result_array();
	}

	public function delete($uid){
		return $this->db->delete('ci_join', array('uid' => $uid));
	}


}




 ?>