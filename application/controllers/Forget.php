<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(dirname(__FILE__)) . '/geetest/geetest.class.php';

class Forget extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
		$this->phone = "";
		$this->email = "";
		$this->token = "";

	}	

	public function step1()
	{
		if ($this->session->userdata('username')) {
			redirect('http://www.rfgxy.com');
		}else{
			$this->load->view("findpwd_tmp1.html");
		}
	}

	public function check_user(){
		$value = json_decode($this->input->post('value'),true);
		$value = $this->security->xss_clean($value);
		$GtSdk = new GeetestLib();
		$result = $GtSdk->validate($value['geetest_challenge'], $value['geetest_validate'], $value['geetest_seccode']);
		if ($result == TRUE) {
			$this->session->set_userdata('geetest_seccode',$value['geetest_seccode']);

			if (preg_match("/^1[34578]\d{9}$/", $value['username'])) {
				# 判断是否是电话，若是则按电话号码查询
				$this->phone = $value['username'];
				$row = $this->user_model->check_phone_is($this->phone);
				if ($row != false) {
					# code...
					$this->token = rand(1000,9999);
					$data = array(
						'success'=>1,
						'token'=>$this->token,
						'phone'=>$row['phone'],
						'email'=>$row['email']
						);
					$this->session->set_userdata('token',$this->token);
					$this->session->set_userdata('phone',$row['phone']);
					$this->session->set_userdata('email',$row['email']);
					echo $this->token;
				}else{
					echo "-1";
				}
				// echo json_encode($data);
			}else if (filter_var($value['username'], FILTER_VALIDATE_EMAIL)) {
				#判断是否是邮箱，若是则按邮箱查询
				$this->email = $value['username'];
				$row = $this->user_model->check_email_is($this->email);
				if ($row !=false) {
					# code...
					$this->token = rand(1000,9999);
					$data = array(
						'success'=>1,
						'token'=>$this->token,
						'phone'=>$row['phone'],
						'email'=>$row['email']
						);
					$this->session->set_userdata('uid',$row['uid']);

					$this->session->set_userdata('token',$this->token);
					$this->session->set_userdata('phone',$row['phone']);
					$this->session->set_userdata('email',$row['email']);
					echo $this->token;
				}else{
					echo "-1";
				}
				// echo json_encode($data);
			}else{
				#传过来的既不是邮箱又不是电话，返回错误
				$data = array("success"=>-1);
				// echo json_encode($data);
				echo "-1";
			}
		} else {
			#验证码错误
			$data = array("success"=>-10);
			// echo json_encode($data);
			echo "-10";
		}
		
	}

	// public function phone_findpwd(){
	// 	$token = 
	// }

	public function step2()
	{
		$token = $_GET['token'];
		if ($token == $_SESSION['token']) {
			$data['email'] = $_SESSION['email'];
			$data['phone'] = $_SESSION['phone'];
			$data['token'] = $token;
			$this->load->view("findpwd_tmp2.html",$data);
		}else{
			echo "no token";
		}

	}

	public function step3()
	{
		$token = $_GET['token'];
		if ($token == $_SESSION['token']) {
			$data['token'] = $token;
			$this->load->view("findpwd_tmp3.html",$data);
		}else{
			echo "no token";
		}
	}

	//更改完密码，删除token
	public function modify_pwd(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		if ($value['token'] == $_SESSION['token']) {
			$this->user_model->change_pwd($_SESSION['uid'],$value['pwd']);
			unset($_SESSION['token']);
			echo '1';
		}else{
			echo "no token";
		}
	}

	public function step4()
	{

		$this->load->view("findpwd_tmp4.html");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */