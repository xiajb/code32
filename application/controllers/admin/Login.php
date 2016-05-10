<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}

	//加载登陆界面
	public function index()
	{
		
		$username = $this->session->userdata('username');
		$res = $this->user_model->get_user_session($username,1);
		if ($res) {
		 	redirect('http://www.qfdlqz.com/admin/user');           	
		}else{
			$this->load->view('admin/admin_login.html');
		}       
	}

	//登陆
	public function check_login(){
		$value = json_decode($this->input->post('value'),true);
		$value = $this->security->xss_clean($value);		
		$result=$this->user_model->get_user_admin($value['username'],$value['password'],1);
		if($result){
			$this->session->set_userdata('username',$value['username']);
			echo '1';
		}
		else{
			echo '-1';
		}		
	}

	//登出
	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect('http://www.qfdlqz.com/admin/login');
	}

}

