<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comment_model extends CI_Model{
	const TBL_USER='ci_comment';
	function __construct(){
		parent::__construct();

	}

	public function add($data){
		return $this->db->insert(self::TBL_USER,$data);
	}
	public function query_all(){
		$sql = 'select * from ci_comment';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_limit($first,$num){
		$query = $this->db->select('*')
			        ->limit($first, $num)
			        ->get(self::TBL_USER);
		return $query->result_array();
	}

	public function result_count(){
		return $this->db->count_all(self::TBL_USER);
	}

	public function delete($id){
		return $this->db->delete(self::TBL_USER, array('comment_id' => $id));
	}
	public function get_comment_by_course($course_id){
		$this->db->where("course_id",$course_id);
		$query = $this->db->get(self::TBL_USER);
		return $query->result_array();
	}


}
