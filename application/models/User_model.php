<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
	const TBL_USER='ci_user';	
	function __construct(){
		parent::__construct();

	}
	public function get_user($username,$password){
		$condition['username'] = $username;
		$condition['password'] = md5($password);
		$query = $this->db->where($condition)->get(self::TBL_USER);
		return $query->row_array();
	}
	public function add_user($data){
		return $this->db->insert(self::TBL_USER,$data);
	}

	public function sql_check_phone($phone){
		$this->db->where('phone',$phone);
		$query=$this->db->get('ci_user');
		//返回行数
		return $query->num_rows();
	}

	public function sql_check_email($email){
		// $query = $this->db->where($email)->get(self::TBL_USER);
		// return $query->row_array();
		// $this->db->where('email',$email);
		// $query=$this->db->get('ci_user');
		//返回行数
		$sql = 'select * from ci_user where email= "'.$email.'"';
		$query=$this->db->query($sql);
		return $query->num_rows();

	}

	// function  checklogin($user_name,$user_pwd){
	// 	//返回值
	// 	$a=false;
	// 	$this->load->database();
	// 	//查询数据库
	// 	//$sql='select * from ci_user where user_name= "'.$username.'"and user_pwd= "'.$userpwd.'"'; 
	// 	//$query=$this->db->query($sql);
	// 	$this->db->select('user_name','user_pwd');
	// 	$this->db->where('user_name',$user_name);
	// 	$this->db->where('user_pwd',$user_pwd);
	// 	$query=$this->db->get('ci_user');
	// 	//返回行数
	// 	$row=$query->num_rows();
	// 	//echo $row;
	// 	//返回结果
	// 	if($row>0){
	// 		$a=true;
	// 		return $a;
	// 	}else{

	// 		return $a;
	// 	}

	// }
}