<?php 
/**
* 
*/
class Show_model extends Ci_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function showtv(){
		$this->load->database();
		$query=$this->db->get('ci_chapter');
		$row=$query->result_array();
		return $row;
	}
	function showtv2(){
		$this->load->database();
		$this->db->select('section_name,section_path,chapter_name');
		$this->db->join('ci_chapter','ci_chapter.chapter_id=ci_section.chapter_id');
		$query=$this->db->get('ci_section');
		$row=$query->result_array();
		return $row;
	}
}



 ?>