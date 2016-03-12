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
		if (isset($_SESSION['username'])) {
			redirect('http://www.rfgxy.com');
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
		$GtMsgSdk = new MsgGeetestLib();
		// $GtMsgSdk = $_SESSION['gtmsgsdk'];
		$data = json_decode($this->input->post('value'),true);
		$data = $this->security->xss_clean($data);
		// file_put_contents("/home/tanu/www/data.txt", $this->input->post('value').'---------'.print_r($data,true),FILE_APPEND );
		if ($this->user_model->sql_check_phone($data['phone'])>0) {
			echo "-10";
		}elseif ($data['geetest_validate'] == md5(PRIVATE_KEY . 'geetest' . $data['geetest_challenge']) ){
			$codedata = array(
			            "seccode" => $data['geetest_seccode'],
			            "sdk" => "php_2.15.4.1.1",
			            "phone" =>$data['phone'],
			            "msg_id" => CAPTCHA_ID
			        );
			$action = "send";
			$result = $GtMsgSdk->send_msg_request($action,$codedata);
			if ($result == 1) {
				echo "1";
			}else{
				echo $result;
			}
		}else{
		    echo "-11";
		    
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
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		$GtMsgSdk = new MsgGeetestLib();
		if ($_SESSION['gtserver'] == 1) {
		 
		    $action = "validate";
		    $code = $value['validatecode'];
		    $phone = $value['phone'];
		    $data = array(
		            'phone' => $phone,
		            'msg_id' => CAPTCHA_ID,
		            'code' => $code
		        );
		    $result = $GtMsgSdk->send_msg_request($action,$data);
		    if ($result == 1) {
		    	unset($value["validatecode"]);
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
		    	}else{
		    		echo 'error';
		    	}
		    }else{
		    	echo $result;
		    }
		// }else{
		//     echo "use your own captcha result";
		}
	}
}

