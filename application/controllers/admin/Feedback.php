<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('feedback_model');
		$this->load->library('session');

	}
	
	public function index()
	{
		$data['feedback'] = $this->feedback_model->query_all();
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
			'feedback_manage'=>'current',
			'all_feedback'=>'current',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_feedback.html');
	}

	public function delete(){
		$value = $_POST['value'];
		$this->feedback_model->delete($value);
		echo '1';
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */