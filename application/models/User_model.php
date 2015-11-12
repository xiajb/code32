<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
	const TBL_USER='ci_user';
	public function get_user($username,$password){
		$condition['username'] = $username;
		$condition['password'] = md5($password);
		$query = $this->db->where($condition)->get(self::TBL_USER);
		return $query->row_array();
	}
	public function add_user($data){
		return $this->db->insert(self::TBL_USER,$data);
	}
}