<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->model('course_model');
		$this->load->model('user_model');
		$this->load->library('session');

	}


	public function index()
	{
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
			'course_manage'=>'',
			'required_course'=>'',
			'elective_course'=>'',
			'skill_course'=>'',
			'video_manage'=>'current',
			'all_video'=>'current',
			'upload_video'=>'',
			'order_manage'=>'',
			'all_order'=>'',
			'account_data'=>'',
			'feedback_manage'=>'',
			'all_feedback'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_add_video.html');
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
	public function add()
	{
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
			'course_manage'=>'',
			'required_course'=>'',
			'elective_course'=>'',
			'skill_course'=>'',
			'video_manage'=>'current',
			'all_video'=>'',
			'upload_video'=>'current',
			'order_manage'=>'',
			'all_order'=>'',
			'account_data'=>'',
			'feedback_manage'=>'',
			'all_feedback'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_add_video.html');
	}
	// public function video_add (){
	// 		$data['course']=$this->course_model->query_all();
	// 		//print_r($data['course']);
	// 	//$course_id=$this->input->Post('chapter');
	// ///	print_r($course_id);
	// 	$this->load->view('admin/video_add.html',$data);
	// }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
