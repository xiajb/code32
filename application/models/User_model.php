<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
	const TBL_USER='ci_user';	
	function __construct(){
		parent::__construct();

	}
	#登陆
	public function get_user($username,$password){
		$password = md5($password);
		$sql='select * from ci_user where username= "'.$username.'"and password= "'.$password.'"'; 
		$query=$this->db->query($sql);
		// $query = $this->db->where($condition)->get(self::TBL_USER);
		return $query->num_rows();
	}
	#注册
	public function add_user($data){
		return $this->db->insert(self::TBL_USER,$data);
	}
	#注册检查手机是否存在
	public function sql_check_phone($phone){
		$sql = 'select * from ci_user where phone= "'.$phone.'"';
		$query=$this->db->query($sql);
		//返回行数
		return $query->num_rows();
	}
	#注册检查用户名是否存在
	public function sql_check_username($username){
		$sql = 'select * from ci_user where username= "'.$username.'"';
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	#注册检查邮箱是否存在
	public function sql_check_email($email){
		$sql = 'select * from ci_user where email= "'.$email.'"';
		$query=$this->db->query($sql);
		return $query->num_rows();

	}
	#后台获取全部用户数据
	public function query_all(){
		$sql = 'select * from ci_user';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	#后台取用户是否是管理员
	public function get_user_admin($username,$password,$level){
		$password = md5($password);
		$sql='select * from ci_user where username="'.$username.'"and password="'.$password.'" and level='.$level; 
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	#后台取有session的用户是否是管理员
	public function get_user_session($username,$level){
		$sql='select * from ci_user where username="'.$username.'"and level='.$level;
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	#后台删除用户
	public function delete_user($id){
		$this->db->delete(self::TBL_USER, array('uid' => $id));
	}
	#改变用户的级别
	public function change_level($uid,$level){
		if ($uid != "" && $level != "") {
			$data = array('level' => $level);
			$this->db->where('uid', $uid);
			$this->db->update(self::TBL_USER, $data);
			echo "1";
		}else{
			echo "-1";
		}

	}

	#找回密码step1 穿进来邮箱是否存在
	public function check_email_is($email){
		$sql = 'select * from ci_user where email= "'.$email.'"';
		$query = $this->db->query($sql);
		$row = $query->row_array();

		if (isset($row))
		{
			return $row;
		}else{
			return false;
		}
	}


	#找回密码step1 穿进来电话是否存在
	public function check_phone_is($phone){
		$sql = 'select * from ci_user where phone= "'.$phone.'"';
		$query = $this->db->query($sql);
		$row = $query->row_array();

		if (isset($row))
		{
			return $row;
		}else{
			return false;
		}
	}

	public function check_username_is($username){
		$sql = 'select * from ci_user where username= "'.$username.'"';
		$query = $this->db->query($sql);
		$row = $query->row_array();

		if (isset($row))
		{
			return $row;
		}else{
			return false;
		}
	}

	//更改密码
	public function change_pwd($uid,$pwd){
		// if ($uid != "" && $pwd != "") {
			$data = array('password' => md5($pwd));
			$this->db->where('uid', $uid);
			$this->db->update(self::TBL_USER, $data);
		// 	echo "1";
		// }else{
		// 	echo "-1";
		// }
	}
	//根据用户名 更改密码
	public function for_username_change_pwd($username,$pwd){
		// if ($uid != "" && $pwd != "") {
			$data = array('password' => md5($pwd));
			$this->db->where('username', $username);
			$this->db->update(self::TBL_USER, $data);
		// 	echo "1";
		// }else{
		// 	echo "-1";
		// }
	}

	public function user_detail($username,$data){
		$this->db->where('username',$username);
		$this->db->update(self::TBL_USER,$data);
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