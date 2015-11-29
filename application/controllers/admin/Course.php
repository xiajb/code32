<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');

	}
	
	public function index()
	{
		$this->load->view('admin/admin_header.html');
		$this->load->view('admin/admin_course.html');
		$this->load->view('admin/admin_footer.html');
	}

	public function add_course(){
		$this->load->view('admin/admin_header.html');
		$this->load->view('admin/admin_add_course.html');
		$this->load->view('admin/admin_footer.html');
	}
}

