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
	public function query_by_approve(){
		$sql = 'select * from ci_required where phone= "'.$phone.'"';
	}
	// public function getrequiredbyid($id){
	// 	$this->db->where('required_id',$id);
	// 	$query = $this->db->get('ci_required');
	// 	return $query->result_array();
	// }

}
