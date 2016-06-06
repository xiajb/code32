<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(dirname(__FILE__)) . '/geetest/geetest.class.php';
require_once dirname(dirname(__FILE__)) . '/geetest/geetestmsg.class.php';
require_once dirname(dirname(__FILE__)) . '/geetest/chuanglan.class.php';

class Helper extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// $this->load->model('user_model');
		$this->load->library('session');
		$this->load->library('email');

	}

	public function send_email(){
		$to_emali = $_POST['email'];
		$token = $_SESSION['token'];

		$config['protocol']='smtp';
		$config['smtp_host'] = 'smtp.qq.com';
		// $config['smtp_host'] = 'smtp.163.com';

		$config['smtp_port']='25';
		$config['smtp_timeout']='30';
		$config['smtp_user']='user@qfdlqz.com';
		// $config['smtp_user']='tanxu1993@163.com';
		$config['smtp_pass']='dl131131';
		// $config['smtp_pass']='qazxcdew';
		$config['charset']='utf-8';
		$config['newline']="\r\n";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$this->email->from('user@qfdlqz.com', '鼎立启智教育网');
		// $this->email->from('tanxu1993@163.com', 'Tanxu');
		$this->email->to($to_emali);
		$title = '验证身份找回密码 - 【qfdlqz.com】';
		$this->email->subject($title);
		$message = '<p>这封信是由 【qfdlqz.com】 发送的。</p>
<p>您收到这封邮件，是由于这个邮箱地址在 【qfdlqz.com】 被登记为用户邮箱，
且该用户请求使用 Email 密码重置功能所致。</p>
<p>
----------------------------------------------------------------------<br />
<strong>重要！</strong><br />
----------------------------------------------------------------------</p>
<p>如果您没有提交密码重置的请求或不是 【qfdlqz.com】 的注册用户，请立即忽略
并删除这封邮件。只有在您确认需要重置密码的情况下，才需要继续阅读下面的
内容。</p>
<p>
----------------------------------------------------------------------<br />
<strong>密码重置说明</strong><br />
----------------------------------------------------------------------</p>
</p>
您只需在提交请求后的三天内，通过点击下面的链接重置您的密码：<br />
<a href="http://www.qfdlqz.com/forget/step3?token='.$token.'" target="_blank">http://www.qfdlqz.com/forget/step3?token='.$token.'</a>
<br />
(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)</p>
<p>在上面的链接所打开的页面中输入新的密码后提交，您即可使用新的密码登录网站了。您可以在用户控制面板中随时修改您的密码。</p>
<p>
此致<br />
</p>
<p>【qfdlqz.com】 管理团队.www.qfdlqz.com</p>';
		$this->email->message($message);
		if ($this->email->send()) {
			echo "1";
			exit();
		}else{
			echo "-1";
			exit();
		}
		// $this->email->send();
// echo $this->email->print_debugger();
	}


	public function send_code(){
		// $value = json_decode($this->input->post('data'),true);
		// $value = $this->security->xss_clean($value);
		// if ($_SESSION['token'] == $value['token']) {
		// 	$GtMsgSdk = new MsgGeetestLib();
		// 	$data = array(
		// 		'phone' => $value['phone'],
		// 		'seccode'=>$_SESSION['geetest_seccode'],
		// 	            	'msg_id' => CAPTCHA_ID
		// 	 );
		// 	$action = "send";
		// 	$result = $GtMsgSdk->send_msg_request($action,$data);
		// 	echo $result;
		// }else{
		// 	echo "notoken";
		// }
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		if (!isset($_SESSION['token']) || $value['token'] != $_SESSION['token']) {
			redirect('http://www.qfdlqz.com/404.html');
		}else{
			$sms=new ChuanglanSMS('N4368059','74fa7a1d');
			$_SESSION['code'] = rand(100000,999999);
			$msg = '【鼎立启智教育网】您的验证码是：'.$_SESSION['code'];
			$result=$sms->send($value['phone'],$msg);
			$result = json_decode($result);
			echo $result->success;
		}
	}




}
 ?>