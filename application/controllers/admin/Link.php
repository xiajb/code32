<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
		$this->load->model('link_model');
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
			'feedback_manage'=>'',
			'all_feedback'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'current',
			'all_link'=>'current',
			'add_link'=>'',
			 );
		$data['result'] = $this->link_model->query_all();
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_link.html');
	}

	public function link_insert(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		$value['add_time'] = date("Y-m-d H:i",time());
		$res = $this->link_model->add_link($value);
		if ($res) {
			echo '1';
		}else{
			echo '-1';
		}



	}

	
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
			'video_manage'=>'',
			'all_video'=>'',
			'upload_video'=>'',
			'order_manage'=>'',
			'all_order'=>'',
			'account_data'=>'',
			'feedback_manage'=>'',
			'all_feedback'=>'',
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