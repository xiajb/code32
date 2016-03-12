<?php

/**
 *
 */
class Section_model extends CI_Model{

	const TBL_USER='ci_section';	
	function __construct(){
		parent::__construct();
	}

	function add_section($in_data){
		$a=$this->db->insert('ci_section',$in_data);
		return $a;
	}

	public function query_all(){
		$query = $this->db->get(self::TBL_USER); 
		return $query->result_array();
	}

	public function get_by_status($status){
		$this->db->where("status",$status);
		$query = $this->db->get(self::TBL_USER);
		return $query->result_array();
	}

	public function change_status($status,$id){

		$data = array(
		    'status' => $status
		);
		return $this->db->update(self::TBL_USER, $data, array('section_id' => $id));
		
	}

	public function delete($id){
		return $this->db->delete(self::TBL_USER, array('section_id' => $id));
	}	

}






?>
