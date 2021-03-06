<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classify extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('classify_model');
		$this->load->model('direction_model');
		// $this->load->model('teacher_model');
		// $this->load->model('elective_model');
		// $this->load->model('skill_model');
		$this->load->library('session');

	}

	// public function add(){

	// 	$this->load->view('admin/admin_header.html',$data);
	// 	$this->load->view('admin/admin_classify_add.html');
	// }

	public function all(){
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
			'classify_manage'=>'current',
			'all_classify'=>'current',
			'course_manage'=>'',
			'required_course'=>'',
			'elective_course'=>'',
			'skill_course'=>'',
			'add_course'=>'',
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
			'activity_manage'=>'',
			'add_activity'=>'',
			'all_activity'=>'',
			 );
		$data['direction'] = $this->direction_model->Show_direction();
		$data['result'] = $this->classify_model->query_all();
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_classify_add.html');
	}

	public function delete(){
		$id = $_POST['value'];
		$value = $this->classify_model->delete($id);
		echo $value;
	}

	public function add(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		// file_put_contents("/home/tanxu/www/data.txt", print_r($value,true),FILE_APPEND );
		if ($this->classify_model->add_classify($value)) {
	    		echo '1';
	    	}else{
	    		echo 'error';
	    	}
	}

}
?>