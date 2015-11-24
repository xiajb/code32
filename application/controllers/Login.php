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
		 $this->load->helper('url');
		$this->load->view("login.html");

	}
	//登录方法

	function  checklogin(){
		//获得表单的用户名和密码
		$user_name=$this->input->post('uName');
		$user_pwd=$this->input->post('uPwd');
		//调用登录方法
		$a=$this->user_model->checklogin($user_name,$user_pwd);
		if($a){

			echo '登录成功';
			$this->session->set_userdata('user',$user_name);
			//echo $_SESSION['user'];
			$this->load->view('index.html');

		}
		else{
			echo '失败';

		}
		//switch ($type) {
		///	case '1':
				
			//	break;
			
		//	default:
				
				//break;
		}
		









}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */