<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('course_model');
		$this->load->model('user_model');
		$this->load->model('chapter_model');
		$this->load->model('classify_model');
		$this->load->model('section_model');
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

	public function all()
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
		$this->load->view('admin/admin_video_all.html');
	}

	public function add()
	{
		$data['course'] = $this->course_model->get_status('2');
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
	public function video_add (){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		if ($value['chapter1'] != '') {
			$chapter = array();
			$chapter['course_id'] = $value['course_id'];
			$chapter['chapter_name'] = $value['chapter1'];
			file_put_contents("/home/tanxu/www/data.txt", print_r($chapter,true));
			$chapter_id = $this->chapter_model->add_chapter($chapter);
			$section['chapter_id'] = $chapter_id;
		}else{

			$section['chapter_id'] = $value['chapter'];
		}
		$section = array();
		$section['section_name'] = $value['section'];
		$section['section_path'] = $value['path'];
		$section['create_time'] = date("Y-m-d H:i:s",time());
		$section['creater'] = 'admin';
		$section_id = $this->section_model->add_section($section);
		if ($section_id >=0) {
			echo '1';
		}else{
			echo '-1';
		}
		
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
