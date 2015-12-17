<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
	public function __construct(){
		parent::__construct();
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
			'video_manage'=>'',
			'all_video'=>'',
			'upload_video'=>'',
			'order_manage'=>'',
			'all_order'=>'',
			'account_data'=>'',
			'comment_manage'=>'current',
			'all_comment'=>'current',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_comment.html');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */