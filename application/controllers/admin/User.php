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
			'feedback_manage'=>'',
			'all_feedback'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );
		$data['result'] = $this->user_model->query_all();
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_user.html');
	}

	public function delete_user(){
		$id = $_POST['value'];
		$value = $this->user_model->delete_user($id);
		echo $value;
	}

	public function change_level(){
		$value = json_decode($this->input->post('value'),true);
		$value = $this->security->xss_clean($value);
		$this->user_model->change_level($value['uid'],$value['level']);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */