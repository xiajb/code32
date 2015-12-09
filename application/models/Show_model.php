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
		$this->db->select('ci_section.*,chapter_name');
		$this->db->join('ci_chapter','ci_chapter.chapter_id=ci_section.chapter_id');
		$query=$this->db->get('ci_section');
		$row=$query->result_array();
		return $row;
	}
	function showchapterbyid($id){
		$this->load->database();
		$this->db->where('course_id',$id);
		$query=$this->db->get('ci_chapter');
		$row=$query->result_array();
		return $row;
	}
	function showsectionbyid($id){
		$this->load->database();
		$this->db->select('ci_section.*,chapter_name');
		$this->db->join('ci_chapter','ci_chapter.chapter_id=ci_section.chapter_id');
		$this->db->where('ci_chapter.course_id',$id);
		$query=$this->db->get('ci_section');
		$row=$query->result_array();
		return $row;
	}
	function showcoursebysectionid($id){
		$this->load->database();
		$this->db->select('ci_course.course_id,course_name');
		$this->db->where('ci_section.section_id',$id);
		$this->db->join('ci_section','ci_chapter.chapter_id=ci_section.chapter_id');
		$this->db->join('ci_course','ci_chapter.course_id=ci_course.course_id','left');
		$query=$this->db->get('ci_chapter');
		$row=$query->result_array();
		return $row;
	}
}



 ?>
