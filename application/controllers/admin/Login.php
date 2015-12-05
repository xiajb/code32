<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	*
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('admin/admin_login.html');
	}

	public function check_login(){
		$value = json_decode($this->input->post('value'),true);
		$result=$this->user_model->get_user_admin($value['username'],$value['password'],1);
		if($result){

			echo '登录成功';
			$this->session->set_userdata('username',$value['username']);
			redirect('http://127.0.0.1/code32/index.php/admin/user');
		}
		else{
			echo '-1';

		}		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */