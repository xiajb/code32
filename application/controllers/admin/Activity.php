<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('classify_model');
		$this->load->model('direction_model');
		$this->load->model('activity_model');
		// $this->load->model('elective_model');
		// $this->load->model('skill_model');
		$this->load->library('session');

	}

	// public function add(){

	// 	$this->load->view('admin/admin_header.html',$data);
	// 	$this->load->view('admin/admin_classify_add.html');
	// }

	public function index(){
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
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			'activity_manage'=>'current',
			'add_activity'=>'current',
			'all_activity'=>'',
			 );
		// $data['direction'] = $this->direction_model->Show_direction();
		// $data['result'] = $this->classify_model->query_all();
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_add_activity.html');
	}

	public function all(){
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'current',
			'user_data' =>'' ,
			'teacher_data'=>'current',
			'add_teacher'=>'',
			'classify_manage'=>'',
			'all_classify'=>'',
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
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			'activity_manage'=>'current',
			'add_activity'=>'',
			'all_activity'=>'current',
			 );
		// $data['direction'] = $this->direction_model->Show_direction();
		$data['result'] = $this->activity_model->query_all();
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_activity.html');
	}

	public function delete(){
		$id = $_POST['value'];
		$value = $this->activity_model->delete($id);
		echo $value;
	}

	public function add(){
		// $value = json_decode($this->input->post('data'),true);
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		// file_put_contents("/home/tanxu/www/data.txt", print_r($value,true),FILE_APPEND );
		if ($this->activity_model->add($value)) {
	    		echo '1';
	    	}else{
	    		echo 'error';
	    	}
	}

}
?>