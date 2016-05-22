<?php 



/**
* 
*/
class Chapter_model extends Ci_Model
{
	
	function  __construct()
	{
		parent::__construct();
	}
	function add_chapter($in_data){
  	$this->db->insert('ci_chapter',$in_data);

  	return $this->db->insert_id();
}
function getchapter_orderbyid($id){
		$this->load->database();
		$this->db->select_max('ci_chapter.order_no');
		$this->db->join('ci_course','ci_chapter.course_id=ci_course.course_id');
		$this->db->where('ci_course.course_id',$id);
		$query=$this->db->get('ci_chapter');
		$row=$query->result_array();
		return $row;
	}


public function get_chapter_by_id($course_id){
	$this->db->where('course_id',$course_id);
	$query = $this->db->get('ci_chapter');
	return $query->result_array();
}


}




 ?>