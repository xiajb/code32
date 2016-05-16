<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Collect_model extends CI_Model{
	const TBL_USER='ci_collect';
	function __construct(){
		parent::__construct();

	}

	public function add_collect($data){
		return $this->db->insert(self::TBL_USER,$data);
	}
	public function query_by_course($course_id,$uid){
		$this->db->where('course_id',$course_id);
		$this->db->where('uid',$uid);
		$query = $this->db->get(self::TBL_USER);
		return $query->row_array();
	}

	// public function get_limit($first,$num){
	// 	$query = $this->db->select('*')
	// 		        ->limit($first, $num)
	// 		        ->get(self::TBL_USER);
	// 	return $query->result_array();
	// }

	public function result_count(){
		// return $this->db->count_all('ci_user');
		// $this->db->from('ci_user');
		// return $this->db->count_all_results();
		return $this->db->count_all(self::TBL_USER);
	}

	public function delete_collect($id){
		return $this->db->delete(self::TBL_USER, array('link' => $id));
	}


}
