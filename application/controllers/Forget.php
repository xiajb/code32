<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forget extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');

	}	

	public function step1()
	{
		if ($this->session->userdata('username')) {
			redirect('http://127.0.0.1/code32/index.php/index');
		}else{
			$this->load->view("findpwd_tmp1.html");
		}
	}
	public function step2()
	{

		$value = json_decode($this->input->post('data'),true);

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