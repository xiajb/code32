<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Required_model extends CI_Model{
	const TBL_USER='ci_required';
	function __construct(){
		parent::__construct();

	}
	#增加课程
	public function add_required($data){
		return $this->db->insert(self::TBL_USER,$data);
	}
	#所有课程
	public function query_all(){
		$sql = 'select * from ci_required';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function query_by_pass(){
		$sql = 'select * from ci_required where status=1';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function query_by_admin(){
		$sql = 'select * from ci_required where status=2';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function query_by_nopass(){
		$sql = 'select * from ci_required where status=-1';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function query_by_check(){
		$sql = 'select * from ci_required where status=0';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_course($tid){
		$sql = 'select * from ci_required where teacher='.$tid;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_num_course($status,$first,$num){
			$query = $this->db->select('*')
			        ->where('status', $status)
			        ->limit($first, $num)
			        ->get(self::TBL_USER);
		// $sql = 'select * from ci_required where status = 1 order by required_id limit '.$first.','.$num;
  //                         $query = $this->db->query($sql);
                          // file_put_contents("/home/tanxu/www/data.txt", print_r($query->result_array(),true));
                          return $query->result_array();
	}

	public function get_num($first,$num){
		return $this->db->limit($first,$num);
                          
	}
	//根据状态值，取当前状态下的记录条数
	public function result_acount_status($status){
		$this->db->where('status', $status);
		$acount = $this->db->count_all_results(self::TBL_USER);
		return $acount;
	}

	//取当前表的总条数
	public function all_count(){
		return $this->db->count_all(self::TBL_USER);
	}



	public function delete_required($id){
		return $this->db->delete(self::TBL_USER, array('required_id' => $id));
	}



			// public function getrequiredbyid($id){
	// 	$this->db->where('required_id',$id);
	// 	$query = $this->db->get('ci_required');
	// 	return $query->result_array();
	// }

}
