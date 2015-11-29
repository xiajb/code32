<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');

	}	/**
	*
	 */
	public function index()
	{
		// $this->user_model->query_all();
		// file_put_contents("/home/tanxu/www/data.txt", print_r($this->user_model->query_all(),true),FILE_APPEND );
		$this->load->view('admin/admin_header.html');
		$data['result'] = $this->user_model->query_all();
		$this->load->view('admin/admin_user.html',$data);
		$this->load->view('admin/admin_footer.html');
	}
	public function teacher()
	{
		$this->load->view('admin/admin_header.html');
		$this->load->view('admin/admin_teacher.html');
		$this->load->view('admin/admin_footer.html');
	}
	public function course()
	{
		$this->load->view('admin/admin_header.html');
		$this->load->view('admin/admin_course.html');
		$this->load->view('admin/admin_footer.html');
	}
	public function video()
	{
		$this->load->view('admin/admin_header.html');
		$this->load->view('admin/admin_upload.html');
		$this->load->view('admin/admin_footer.html');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */