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
	public function getcoursebyid($id){
		$this->db->where('course_id',$id);
		$query = $this->db->get('ci_course');
		return $query->result_array();
	}

	public function get_course_by_classifyid($id,$status){
		if ($status == '') {
			$this->db->select('*');
			$this->db->join('ci_classify', 'ci_classify.classify_id = ci_course.classify_id');
			$this->db->where('ci_classify.direction_id',$id);
		}else{
			$this->db->select('*');
			$this->db->join('ci_classify', 'ci_classify.classify_id = ci_course.classify_id');
			$this->db->where('ci_course.status',$status);
			$this->db->where('ci_classify.direction_id',$id);
		}
		$query = $this->db->get('ci_course');
		return $query->result_array();
	}

	public function delete($id){
		return $this->db->delete(self::TBL_USER, array('course_id' => $id));
	}

	public function get_status($status){
		$this->db->where('status', $status);
		$query = $this->db->get(self::TBL_USER);
		return $query->result_array();
	}
  }
