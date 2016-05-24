<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');

	}
	
	public function data()
	{
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'current',
			'user_data' =>'current' ,
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
			'activity_manage'=>'',
			'add_activity'=>'',
			'all_activity'=>'',
			 );
		$page_config['perpage']=9;   //每页条数
		$page_config['part']=2;//当前页前后链接数量
		$page_config['url']='/admin/user/data';//url
		$page_config['seg']=4;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		$page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		$this->load->library('mypage_class');
		$page_config['total']=$this->user_model->result_count();
		$this->mypage_class->initialize($page_config);
		if ($page_config['nowindex'] == 1) {
			$data['result'] = $this->user_model->get_limit((int)$page_config['perpage'],0);
		}else{
			$firstcount = ((int)$page_config['nowindex']-1) * (int)$page_config['perpage'];
			$data['result'] = $this->user_model->get_limit((int)$page_config['perpage'],$firstcount);
		}
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