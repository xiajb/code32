<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');

	}
	
	public function index()
	{
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'current',
			'user_data' =>'current' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
			'course_manage'=>'',
			'required_course'=>'',
			'elective_course'=>'',
			'skill_course'=>'',
			'video_manage'=>'',
			'all_video'=>'',
			'upload_video'=>'',
			'order_manage'=>'',
			'all_order'=>'',
			'account_data'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'current',
			'all_link'=>'current',
			'add_link'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_link.html');
	}

	
	public function add_link()
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
			'video_manage'=>'',
			'all_video'=>'',
			'upload_video'=>'',
			'order_manage'=>'',
			'all_order'=>'',
			'account_data'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'current',
			'all_link'=>'',
			'add_link'=>'current',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_add_link.html');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */