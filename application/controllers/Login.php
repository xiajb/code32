<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){


		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}
	public function index()
	{
		if (isset($_SESSION['username'])) {
			redirect('http://www.rfgxy.com');
		}else{

			$this->load->helper('url');
			$this->load->view("login.html");
		}

	}
	//登录方法

	function  checklogin(){
		//获得表单的用户名和密码
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		if (preg_match("/^1[34578]\d{9}$/", $value['username'])) {
			# 判断是否是电话，若是则按电话号码查询
			$row = $this->user_model->check_phone_is($value['username']);
			if ($row != false) {
				if ($row['password'] == md5($value['password'])) {
					$this->session->set_userdata('username',$row['username']);
					$this->session->set_userdata('level',$row['level']);
					ob_clean();
					echo '1';
				}else{
					ob_clean();
					echo '-1';
				}
			}else{
				ob_clean();
				echo '0';
			}
			// echo json_encode($data);
		}else if (filter_var($value['username'], FILTER_VALIDATE_EMAIL)) {
			#判断是否是邮箱，若是则按邮箱查询
			$row = $this->user_model->check_email_is($value['username']);
			if ($row != false) {
				if ($row['password'] == md5($value['password'])) {
					$this->session->set_userdata('username',$row['username']);
					$this->session->set_userdata('level',$row['level']);
					echo '1';
				}else{
					echo '-1';
				}
			}else{
				echo '0';
			}
		}else{
			#传过来的既不是邮箱又不是电话
			$row = $this->user_model->check_username_is($value['username']);
			if ($row != false) {
				if ($row['password'] == md5($value['password'])) {
					$this->session->set_userdata('username',$row['username']);
					$this->session->set_userdata('level',$row['level']);
					echo '1';
				}else{
					echo '-1';
				}
			}else{
				echo '0';
			}
		}

	}
}
