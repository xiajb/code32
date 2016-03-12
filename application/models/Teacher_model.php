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

	public function get_by_status($status){
		$this->db->where("status",$status);
		// $sql = 'select * from ci_teacher where check=2';
		// $query = $this->db->query($sql);
		$query = $this->db->get(self::TBL_USER);
		return $query->result_array();
	}

	public function get_teacher($uid){
		$sql = 'select * from ci_teacher where uid='.$uid;
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row;
	}

	public function change_status($status,$id){

		$data = array(
		    'status' => $status
		);
		return $this->db->update(self::TBL_USER, $data, array('tid' => $id));
		
	}

	public function delete_teacher($id){
		return $this->db->delete(self::TBL_USER, array('tid' => $id));
	}

}