<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	function __construct(){


		parent::__construct();
		// $this->load->model('user_model');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view("new.html");
	}

}
