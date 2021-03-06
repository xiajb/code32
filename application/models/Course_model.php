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
			//$uid=$_SESSION['username'];
		$this->db->select('ci_course.*,ci_teacher.*');
		$this->db->join('ci_teacher','ci_course.course_lectruer_id=ci_teacher.tid','left');
		$this->db->where('course_id',$id);

		$query = $this->db->get('ci_course');
		return $query->result_array();
	}

	public function get_course_by_course_id($course_id){
		$this->db->where('course_id',$course_id);
		$query = $this->db->get(self::TBL_USER);
		return $query->row_array();
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

	public function get_course_by_lectruer($lectruer_id){
		$this->db->where('course_lectruer_id', $lectruer_id);
		$query = $this->db->get(self::TBL_USER);
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

	public function change_status($status,$id){

		$data = array(
		    'status' => $status
		);
		return $this->db->update(self::TBL_USER, $data, array('course_id' => $id));
		
	}

	public function get_course_by_id($tid,$status){
		$this->db->where('course_lectruer_id',$tid);
		$this->db->where('status', $status);
		$query = $this->db->get(self::TBL_USER);
		return $query->result_array();
	}

	public function get_course_like_limit($first,$limit,$words){
		$this->db->like('course_name', $words); $this->db->or_like('course_synopsis', $words);
		$this->db->limit($limit, $first);
		$query = $this->db->get(self::TBL_USER);
		return $query->result_array();
	}


	public function get_like_count($words){
		$this->db->like('course_name', $words); $this->db->or_like('course_synopsis', $words);
		$this->db->from(self::TBL_USER);
		return $this->db->count_all_results();
	}

	public function get_count_by_teacher($course_lectruer_id){
		$this->db->where('course_lectruer_id',$course_lectruer_id);
		$this->db->from(self::TBL_USER);
		return $this->db->count_all_results();
	}
	public function update_zan($course_id){
		$this->db->set('zan', 'zan+1', FALSE);
		$this->db->where('course_id', $course_id);
		return $this->db->update(self::TBL_USER);
	}
	public function update_collects($course_id){
		$this->db->set('collects', 'collects+1', FALSE);
		$this->db->where('course_id', $course_id);
		return $this->db->update(self::TBL_USER);
	}

  }
