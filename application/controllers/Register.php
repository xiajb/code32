<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('geetestlib.php');
class Register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->library('session');

	}
	public function index(){
		$this->load->library('form_validation');
		$this->load->view("register.html");
	}
	public function do_register(){
		$this->load->helper(array('form', 'url'));
		//表单验证
		$this->form_validation->set_rules('username','用户名','required');
		$this->form_validation->set_rules('password','密码','required|min_length[6]|max_length[16]|md5');
		// $this->form_validation->set_rules('repassword','重复密码','required|matches[password]');
		$this->form_validation->set_rules('email','电子邮箱','required|valid_email');
		if ($this->form_validation->run() == FALSE){
	            		$this->load->view('register.html');
	        	}
	        	else{
			$data['username']=$this->input->post('username',true);
			$data['password'] = $this->input->post('password',true);
			$data['email'] = $this->input->post('email',true);
			$data['reg_time']=time();
			//geetest验证码判断
			if (!$validate_response = geetest_validate(@$_POST['geetest_challenge'], @$_POST['geetest_validate'], @$_POST['geetest_seccode']) ){
				echo "验证码错误";
			}else{
				//注册插入数据库成功
				if ($this->user_model->add_user($data)) {
					redirect('http://127.0.0.1/code32/index.php/login');
				}else{
					echo 'error';
				}
			}
	        	}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */