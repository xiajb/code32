<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Course_model extends CI_Model{
	const TBL_USER='ci_course';	
	function __construct(){
		parent::__construct();

	}

	public function add_course($data){
		return $this->db->insert(self::TBL_USER,$data);
	}
	public function query_all(){
		$sql = 'select * from ci_course';
		$query = $this->db->query($sql);
		return $query->result_array();
	}


}