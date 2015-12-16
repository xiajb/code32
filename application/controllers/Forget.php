<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forget extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');

	}	

	public function step1()
	{

		$this->load->view("findpwd_tmp1.html");
	}
	public function step2()
	{

		$this->load->view("findpwd_tmp2.html");
	}

	public function step3()
	{

		$this->load->view("findpwd_tmp3.html");
	}

	public function step4()
	{

		$this->load->view("findpwd_tmp4.html");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */