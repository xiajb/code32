<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');

	}
	
	// public function index()
	// {
	// 	$data['current'] = array('data_back'=>'',
	// 		'data_manage'=>'current',
	// 		'user_data' =>'' ,
	// 		'teacher_data'=>'',
	// 		'course_data'=>'',
	// 		'data_add'=>'',
	// 		'course_add'=>'',
	// 		'video_add'=>'',
	// 		'teacher_add'=>'',
	// 		'data_check'=>'',
	// 		'course_check'=>'',
	// 		'video_check'=>'',
	// 		'teacher_check'=>'',
	// 		 );
	// 	$this->load->view('admin/admin_header.html',$data);
	// 	$this->load->view('admin/admin_video.html');
	// }
	public function add_video()
	{
		$data['current'] = array('data_back'=>'',
			'data_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'course_data'=>'',
			'data_add'=>'current',
			'course_add'=>'',
			'video_add'=>'current',
			'teacher_add'=>'',
			'data_check'=>'',
			'course_check'=>'',
			'video_check'=>'',
			'teacher_check'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_add_video.html');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */