<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	public function notfind()
	{
		$this->load->view("404.html");
	}
}