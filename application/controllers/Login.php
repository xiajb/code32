<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function _construct(){


		paent::_construct();

	}
	public function index()
	{
		// $this->load->helper('url');
		$this->load->view("login.html");
	}
	//登录方法
function  checklogin(){
		//获得表单的用户名和密码
		$user_name=$this->input->post('uName');
		$user_pwd=$this->input->post('uPwd')
		$type=1;





}




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */