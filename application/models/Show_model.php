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
	function getsection_orderbyid($id){
		$this->load->database();
		$this->db->select_max('ci_section.order_no');
		$this->db->join('ci_chapter','ci_chapter.chapter_id=ci_section.chapter_id');
		$this->db->where('ci_chapter.course_id',$id);
		$query=$this->db->get('ci_section');
	
		$row=$query->result_array();
		return $row;
	}
	function showcoursebyclassifyid($direction_id,$classify_id,$is_easy,$offset,$per_page){
			$this->load->database();
			if($classify_id>0){
					$this->db->where('ci_classify.classify_id',$classify_id);
			}
			if($direction_id>0){
					$this->db->where('ci_direction.direction_id',$direction_id);
			}
			if($is_easy>0){
				if($is_easy==1){
				$course_level='初级';
			}else if($is_easy==2){
				$course_level='中级';
			}else{
				$course_level='高级';
			}

					$this->db->where('ci_course.course_level',$course_level);
			}
			$this->db->select('ci_course.*');
			$this->db->join('ci_classify','ci_classify.classify_id=ci_course.classify_id');
			$this->db->join('ci_direction','ci_classify.direction_id=ci_direction.direction_id');
			$this->db->order_by('course_id','desc');
			$this->db->limit($offset,$per_page);
			 $query=$this->db->get('ci_course');
			 $row=$query->result_array();
			// echo $this->db->last_query();
			 	$total=$this->db->count_all('ci_course');
	 		return $arr=array($row,$total);

	}
}



 ?>
