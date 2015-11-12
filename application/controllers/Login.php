<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		// $this->load->helper('url');
		$this->load->view("login.html");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */