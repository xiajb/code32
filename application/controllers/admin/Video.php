<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');

	}
	
	public function index()
	{
		$this->load->view('admin/video.html');
	}
	public function add_video()
	{
		$this->load->view('admin/admin_add_video.html');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */