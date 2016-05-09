<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Required extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('required_model');
		$this->load->library('session');

	}
	
	public function index()
	{
		// $data['result'] = $this->course_model->query_all();
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
			'classify_manage'=>'',
			'all_classify'=>'',
			'course_manage'=>'current',
			'required_course'=>'current',
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
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_required.html');
	}

	public function elective_course()
	{
		$data['result'] = $this->required_model->query_all();
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
			'classify_manage'=>'',
			'all_classify'=>'',
			'course_manage'=>'current',
			'required_course'=>'',
			'elective_course'=>'current',
			'skill_course'=>'',
			'video_manage'=>'',
			'all_video'=>'',
			'upload_video'=>'',
			'order_manage'=>'',
			'all_order'=>'',
			'account_data'=>'',
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
		// $this->load->view('admin/admin_course.html');
	}


	public function skill_course()
	{
		$data['result'] = $this->required_model->query_all();
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
			'classify_manage'=>'',
			'all_classify'=>'',
			'course_manage'=>'current',
			'required_course'=>'',
			'elective_course'=>'',
			'skill_course'=>'current',
			'video_manage'=>'',
			'all_video'=>'',
			'upload_video'=>'',
			'order_manage'=>'',
			'all_order'=>'',
			'account_data'=>'',
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
		// $this->load->view('admin/admin_course.html');
	}


	// public function add_course(){
	// 	$data['current'] = array('data_back'=>'',
	// 		'data_manage'=>'',
	// 		'user_data' =>'' ,
	// 		'teacher_data'=>'',
	// 		'course_data'=>'',
	// 		'data_add'=>'current',
	// 		'course_add'=>'current',
	// 		'video_add'=>'',
	// 		'teacher_add'=>'',
	// 		'data_check'=>'',
	// 		'course_check'=>'',
	// 		'video_check'=>'',
	// 		'teacher_check'=>'',
	// 		 );
	// 	$this->load->view('admin/admin_header.html',$data);
	// 	$this->load->view('admin/admin_add_course.html');
	// }

	public function upload_pic(){
		$typeArr = array("jpg", "png", "gif");//允许上传文件格式 
		$path = "./uploads/course/";//上传路径 
		 
		if (isset($_POST)) { 
		    $name = $_FILES['file']['name']; 
		    $size = $_FILES['file']['size']; 
		    $name_tmp = $_FILES['file']['tmp_name']; 
		    if (empty($name)) { 
		        echo json_encode(array("error"=>"您还未选择图片")); 
		        exit; 
		    } 
		    $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型 
		     
		    if (!in_array($type, $typeArr)) { 
		        echo json_encode(array("error"=>"清上传jpg,png或gif类型的图片！")); 
		        exit; 
		    } 
		    if ($size > (500 * 1024)) { 
		        echo json_encode(array("error"=>"图片大小已超过2000KB！")); 
		        exit; 
		    } 
		     
		    $pic_name = time() . rand(10000, 99999) . "." . $type;//图片名称 
		    $pic_url = $path . $pic_name;//上传后图片路径+名称 
		    if (move_uploaded_file($name_tmp, $pic_url)) { //临时文件转移到目标文件夹 
		        echo json_encode(array("error"=>"0","pic"=>$pic_url,"name"=>$pic_name)); 
		    } else { 
		        echo json_encode(array("error"=>"上传有误，清检查服务器配置！")); 
		    } 
		}
	}


	public function c_course(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		// file_put_contents("/home/tanxu/www/data.txt", print_r($value,true),FILE_APPEND );
		if ($this->course_model->add_course($value)) {
	    		echo '1';
	    	}else{
	    		echo 'error';
	    	}
	}
}

