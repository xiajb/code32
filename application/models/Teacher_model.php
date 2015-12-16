<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Teacher_model extends CI_Model{
	const TBL_USER='ci_teacher';	
	function __construct(){
		parent::__construct();

	}

	public function add_teacher($data){
		return $this->db->insert(self::TBL_USER,$data);
	}
	public function query_all(){
		$sql = 'select * from ci_teacher';
		$query = $this->db->query($sql);
		return $query->result_array();
	}


}