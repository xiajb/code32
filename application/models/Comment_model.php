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

	public function get_limit_by_uid($uid,$first,$num){
		$query = $this->db->select('*')
			        ->where("uid",$uid)
			        ->limit($first, $num)
			        ->get(self::TBL_USER);
		return $query->result_array();
	}

	public function get_count_by_uid($uid){
		$this->db->where('uid',$uid);
		$this->db->from(self::TBL_USER);
		return $this->db->count_all_results();
	}

	public function result_count(){
		return $this->db->count_all(self::TBL_USER);
	}

	public function delete($id){
		return $this->db->delete(self::TBL_USER, array('comment_id' => $id));
	}
	public function get_comment_by_course($course_id){
		$this->db->where("course_id",$course_id);
		$this->db->order_by('comment_id', 'DESC');
		$this->db->limit(6,0);
		$query = $this->db->get(self::TBL_USER);
		return $query->result_array();
	}


}
