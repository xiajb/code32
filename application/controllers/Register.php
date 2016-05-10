<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require_once('geetestlib.php');
require_once dirname(dirname(__FILE__)) . '/geetest/geetest.class.php';
require_once dirname(dirname(__FILE__)) . '/geetest/geetestmsg.class.php';
require_once dirname(dirname(__FILE__)) . '/geetest/chuanglan.class.php';
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
		if (isset($_SESSION['username'])) {
			redirect('http://www.qfdlqz.com');
		}else{

			$this->load->library('form_validation');
			$this->load->view("register.html");
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
		$GeetestLib = new GeetestLib();
		// $GtMsgSdk = $_SESSION['gtmsgsdk'];
		$data = json_decode($this->input->post('value'),true);
		$data = $this->security->xss_clean($data);
		// file_put_contents("/home/tanu/www/data.txt", $this->input->post('value').'---------'.print_r($data,true),FILE_APPEND );
		if ($this->user_model->sql_check_phone($data['phone'])>0) {
			echo "-10";
		}elseif ($data['geetest_validate'] == md5(PRIVATE_KEY . 'geetest' . $data['geetest_challenge']) ){
			$_SESSION['phone'] = $data['phone'];
			$result = $GeetestLib->validate($data['geetest_challenge'],$data['geetest_validate'],$data['geetest_seccode']);
			if ($result == 1) {
				$sms=new ChuanglanSMS('N4368059','74fa7a1d');
				$_SESSION['code'] = rand(1000,9999);
				$_SESSION['msg'] = '【创蓝文化】'.$_SESSION['code'];
				$result=$sms->send($data['phone'],$_SESSION['msg']);
				$result = json_decode($result);
				echo $result->success;
				exit();
			}else{
				echo '-1';
				exit();
			}
		}else{
		    echo "-11";
   		    exit();
		}
		
	}

	public function check_email(){
		$data = $this->input->post('value');

		if ($this->user_model->sql_check_email($data) > 0) {
			echo "-10";
			exit;
		}

	}

	public function check_username(){
		$username = $this->input->post('username');
		if ($this->user_model->sql_check_username($username) > 0) {
			echo "-10";
			exit;
		}

	}
	public function do_register(){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		// $GtMsgSdk = new MsgGeetestLib();
		if ($_SESSION['gtserver'] == 1) {

		    if ($value['validatecode'] == $_SESSION['code'] && $value['phone'] == $_SESSION['phone']) {	
		    	unset($_SESSION['code']);	    	
		    	unset($value["validatecode"]);
		    	unset($value["ci_csrf_token"]);
		    	$value["password"] = md5($value["password"]);
		    	$value["reg_time"] = date("Y-m-d H:i",time());
		    	$uid = $this->user_model->add_user($value);
		    	if ($uid) {
				$this->session->set_userdata('username',$value["username"]);
				$this->session->set_userdata('uid',$uid);
				$row = $this->user_model->get_user_by_uid($uid);
				$this->session->set_userdata('pic',$row['pic']);
				$this->session->set_userdata('level',$row['level']);
		    		echo '1';
				exit();
		    	}else{
		    		echo 'error';
				exit();
		    	}
		    }else{
		    	echo $result;
			exit();
		    }
		// }else{
		//     echo "use your own captcha result";
		}
	}
}

