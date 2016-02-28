<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Required_model extends CI_Model{
	const TBL_USER='ci_required';
	function __construct(){
		parent::__construct();

	}
	#增加课程
	public function add_required($data){
		return $this->db->insert(self::TBL_USER,$data);
	}
	#所有课程
	public function query_all(){
		$sql = 'select * from ci_required';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function query_by_pass(){
		$sql = 'select * from ci_required where status=1';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function query_by_admin(){
		$sql = 'select * from ci_required where status=2';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function query_by_nopass(){
		$sql = 'select * from ci_required where status=-1';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function query_by_check(){
		$sql = 'select * from ci_required where status=0';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_course($tid){
		$sql = 'select * from ci_required where teacher='.$tid;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function delete_required($id){
		return $this->db->delete(self::TBL_USER, array('required_id' => $id));
	}

			// public function getrequiredbyid($id){
	// 	$this->db->where('required_id',$id);
	// 	$query = $this->db->get('ci_required');
	// 	return $query->result_array();
	// }

}
