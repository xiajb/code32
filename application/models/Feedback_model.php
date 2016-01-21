<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Feedback_model extends CI_Model{
	const TBL_USER='ci_feedback';
	function __construct(){
		parent::__construct();

	}

	public function add_feedback($data){
		return $this->db->insert(self::TBL_USER,$data);
	}
	public function query_all(){
		$sql = 'select * from ci_feedback';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function delete($id){
		$this->db->delete(self::TBL_USER, array('feedback' => $id));
	}
}
