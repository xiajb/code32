<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(dirname(dirname(__FILE__))) . '/geetest/upyun.class.php';

class Video extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('course_model');
		$this->load->model('user_model');
		$this->load->model('chapter_model');
		$this->load->model('classify_model');
		$this->load->model('section_model');
		$this->load->model('show_model');
		$this->load->library('session');

	}


	public function index()
	{
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
			'classify_manage'=>'',
			'all_classify'=>'',
			'course_manage'=>'',
			'required_course'=>'',
			'elective_course'=>'',
			'skill_course'=>'',
			'add_course'=>'',
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
			'activity_manage'=>'',
			'add_activity'=>'',
			'all_activity'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_add_video.html');
	}

	public function all()
	{
		$data['result'] = $this->section_model->query_all();
		$data['not_pass'] = $this->section_model->get_by_status('-1');
		$data['pass'] = $this->section_model->get_by_status('1');
		$data['wait'] = $this->section_model->get_by_status('0');
		$data['admin'] = $this->section_model->get_by_status('2');
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
			'classify_manage'=>'',
			'all_classify'=>'',
			'course_manage'=>'',
			'required_course'=>'',
			'elective_course'=>'',
			'skill_course'=>'',
			'add_course'=>'',
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
			'activity_manage'=>'',
			'add_activity'=>'',
			'all_activity'=>'',
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
			'classify_manage'=>'',
			'all_classify'=>'',
			'course_manage'=>'',
			'required_course'=>'',
			'elective_course'=>'',
			'skill_course'=>'',
			'add_course'=>'',
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
			'activity_manage'=>'',
			'add_activity'=>'',
			'all_activity'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_add_video.html');
	}
	public function video_add (){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		$section = array();
		//原有章节，增加
		$section['order_no']=$this->show_model->getsection_orderbyid($value['course_id'])[0]['order_no']+1;
		if ($value['chapter1'] == '') {
			$section['chapter_id'] = $value['chapter'];
		}else{
			//新建章节
			$chapter = array();
			$chapter['order_no']=$this->chapter_model->getchapter_orderbyid($value['course_id'])[0]['order_no']+1;
			$chapter['course_id'] = $value['course_id'];
			$chapter['chapter_name'] = $value['chapter1'];
			// file_put_contents("/home/tanxu/www/data.txt", print_r($chapter,true));
			$chapter_id = $this->chapter_model->add_chapter($chapter);
			$section['chapter_id'] = $chapter_id;
			// $section['order_no'] = $chapter['order_no'];
		}
		
		$section['section_name'] = $value['section'];
		$section['section_path'] = $value['path'];
		$section['create_time'] = date("Y-m-d H:i:s",time());
		$section['status'] = 2;
		$section_id = $this->section_model->add_section($section);
		if ($section_id >=0) {
			echo '1';
		}else{
			echo '-1';
		}
		
	}

	public function change_status(){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		if ($this->section_model->change_status($value['status'],$value['section_id'])) {
	    		echo '1';
	    	}else{
	    		echo 'error';
	    	}
	}

	public function delete(){
		$id = $_POST['value'];
		$section = $this->section_model->get_section_by_id($id);
		if ($section['section_path']) {
			$path =  strstr($section['section_path'], '/video');
			$UpYun = new UpYun('code32','rxs','rxs84217621');
			$result = $UpYun->delete($path);
		}
		$value = $this->section_model->delete($id);
		if ($result==1 && $value==1) {
			echo '1';
		}else{
			echo '-1';
		}
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
