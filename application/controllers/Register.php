<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require_once('geetestlib.php');
require_once dirname(dirname(__FILE__)) . '/geetest/geetest.class.php';
require_once dirname(dirname(__FILE__)) . '/geetest/geetestmsg.class.php';
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

	public function check_challenge(){
		$GtSdk = new GeetestLib();
		// session_start();
		$return = $GtSdk->register();
		if ($return) {
			// $this->session
		    $_SESSION['gtserver'] = 1;
		    $result = array(
		            'success' => 1,
		            'gt' => CAPTCHA_ID,
		            'challenge' => $GtSdk->challenge
		        );
		    echo json_encode($result);
		}else{
		    $_SESSION['gtserver'] = 0;
		    $rnd1 = md5(rand(0,100));
		    $rnd2 = md5(rand(0,100));
		    $challenge = $rnd1 . substr($rnd2,0,2);
		    $result = array(
		            'success' => 0,
		            'gt' => CAPTCHA_ID,
		            'challenge' => $challenge
		        );
		    $_SESSION['challenge'] = $result['challenge'];
		    echo json_encode($result);
		}
	}

	public function check_phone(){
		$GtMsgSdk = new MsgGeetestLib();
		// $GtMsgSdk = $_SESSION['gtmsgsdk'];
		$data = json_decode($this->input->post('value'),true);
		// file_put_contents("/home/tanu/www/data.txt", $this->input->post('value').'---------'.print_r($data,true),FILE_APPEND );
		if ($data['geetest_validate'] == md5(PRIVATE_KEY . 'geetest' . $data['geetest_challenge'])) {
		    $codedata = array(
		            "seccode" => $data['geetest_seccode'],
		            "sdk" => "php_2.15.4.1.1",
		            "phone" =>$data['phone'],
		            "msg_id" => CAPTCHA_ID
		        );
		    $action = "send";
		    $result = $GtMsgSdk->send_msg_request($action,$codedata);
		    if ($result == 1) {
			if ($this->user_model->sql_check_phone($data['phone']) >= 1) {
				echo "-10";
			}
		    }else{
			    echo $result;
		    }
		}else{
		    echo "-11";
		    
		}
	}

	public function check_email(){

		// $GtMsgSdk = $_SESSION['gtmsgsdk'];
		$data = json_decode($this->input->post('value'),true);

			if ($this->user_model->sql_check_email($data) >= 1) {
				echo "-10";
			}else{
				echo "1";
			}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */