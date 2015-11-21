<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	*
	 */
	public function index()
	{
		$this->load->view('admin_header.html');
		$this->load->view('admin_user.html');
		$this->load->view('admin_footer.html');
	}
	public function teacher()
	{
		$this->load->view('admin_header.html');
		$this->load->view('admin_teacher.html');
		$this->load->view('admin_footer.html');
	}
	public function course()
	{
		$this->load->view('admin_header.html');
		$this->load->view('admin_course.html');
		$this->load->view('admin_footer.html');
	}
	public function video()
	{
		$this->load->view('admin_header.html');
		$this->load->view('admin_upload.html');
		$this->load->view('admin_footer.html');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */