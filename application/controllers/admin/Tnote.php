<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tnote extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');

	}
	
	public function index()
	{
		$data['current'] = array('data_back'=>'',
			'data_manage'=>'current',
			'user_data' =>'current' ,
			'teacher_data'=>'',
			'course_data'=>'',
			'data_add'=>'',
			'course_add'=>'',
			'video_add'=>'',
			'teacher_add'=>'',
			'admin_add'=>'',
			'data_check'=>'',
			'course_check'=>'',
			'video_check'=>'',
			'teacher_check'=>'',
			 );
		$data['result'] = $this->user_model->query_all();
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_teacher_course.html');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */