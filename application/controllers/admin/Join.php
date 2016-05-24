<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Join extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('join_model');
		$this->load->model('activity_model');
		$this->load->library('session');
	}
	
	public function index()
	{
		$id = $_GET['id'];
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
			'link_manage'=>'current',
			'all_link'=>'current',
			'add_link'=>'',
			'activity_manage'=>'',
			'add_activity'=>'',
			'all_activity'=>'',
			 );
		// $page_config['perpage']=9;   //每页条数
		// $page_config['part']=2;//当前页前后链接数量
		// $page_config['url']='/admin/join/index';//url
		// $page_config['seg']=4;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		// $page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		// $this->load->library('mypage_class');
		// $page_config['total']=$this->join_model->result_count();
		// $this->mypage_class->initialize($page_config);
		// if ($page_config['nowindex'] == 1) {
		// 	$data['result'] = $this->join_model->get_limit((int)$page_config['perpage'],0);
		// }else{
		// 	$firstcount = ((int)$page_config['nowindex']-1) * (int)$page_config['perpage'];
		// 	$data['result'] = $this->join_model->get_limit((int)$page_config['perpage'],$firstcount);
		// }
		$data['activity'] = $this->activity_model->get_activity_by_id($id);
		$join = $this->join_model->get_all_by_activity_id($id);
		$data['result'] = array();
		for ($i=0; $i < count($join); $i++) { 
			$user = $this->user_model->get_user_by_uid($join[$i]['uid']);
			$data['result'][$i]['name'] = $user['name'];
			$data['result'][$i]['phone'] = $user['phone'];
			$data['result'][$i]['email'] = $user['email'];
			$data['result'][$i]['qq'] = $user['qq'];
			$data['result'][$i]['join_id'] = $join[$i]['join_id'];
		}	
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_join.html');
	}

	// public function link_insert(){
	// 	$value = json_decode($this->input->post('data'),true);
	// 	$value = $this->security->xss_clean($value);
	// 	$value['add_time'] = date("Y-m-d H:i",time());
	// 	$res = $this->link_model->add_link($value);
	// 	if ($res) {
	// 		echo '1';
	// 	}else{
	// 		echo '-1';
	// 	}



	// }

	
	public function add()
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

	function delete(){
		$id = $_POST['value'];
		echo $this->join_model->delete($id);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */