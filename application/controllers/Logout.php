<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function index(){
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect('http://www.rfgxy.com/login');
	}
}
