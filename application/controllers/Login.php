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
		// $user_name=$this->input->post('uName');
		// $user_pwd=$this->input->post('uPwd');
		$value = json_decode($this->input->post('data'),true);
		//调用登录方法
		$result=$this->user_model->get_user($value['username'],$value['password']);
		// file_put_contents("/home/tanxu/www/data.txt", $result,FILE_APPEND );
		if($result){

			echo '登录成功';
			$this->session->set_userdata('username',$value['username']);
			redirect('http://127.0.0.1/code32/index.php/index');
			// $this->load->view('index.html');

		}
		else{
			echo '-1';

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