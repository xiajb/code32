<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Helper extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// $this->load->model('user_model');
		$this->load->library('session');
		$this->load->library('email');

	}

	public function send_email($to_emali){
		$config['protocol']='smtp';
		$config['smtp_host'] = 'smtp.163.com';
		$config['smtp_port']='25';
		$config['smtp_timeout']='30';
		$config['smtp_user']='tanxu1993';
		$config['smtp_pass']='qaz1209084736';
		$config['charset']='utf-8';
		$config['newline']="\r\n";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$this->email->from('tanxu1993@163.com', 'Tanxu');
		$this->email->to($to_emali);

		$this->email->subject('title');
		$this->email->message('message');

		$this->email->send();
// echo $this->email->print_debugger();
	}



}
 ?>