<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('teacher_model');
		$this->load->library('session');

	}
	
	public function index()
	{
		$data['result'] = $this->teacher_model->query_all();
		$data['pass'] = array();
		$data['not_pass'] = array();
		$data['checking'] = array();
		$data['admin_add'] = array();
		for ($i=0; $i <count($data['result']) ; $i++) { 
			if ($data['result'][$i]['check'] == 0) {
				$array = array($i=>$data['result'][$i]);
				$data['checking'] = array_merge($data['checking'],$array);
			}elseif ($data['result'][$i]['check'] == -1) {
				$array = array($i=>$data['result'][$i]);
				$data['not_pass'] = array_merge($data['not_pass'],$array);
			}elseif ($data['result'][$i]['check'] == 2) {
				$array = array($i=>$data['result'][$i]);
				$data['admin_add'] = array_merge($data['admin_add'],$array);
			}elseif ($data['result'][$i]['check'] == 1) {
				$array = array($i=>$data['result'][$i]);
				$data['pass'] = array_merge($data['pass'],$array);
			}
		}

		$data['current'] = array('data_back'=>'',
			'user_manage'=>'current',
			'user_data' =>'' ,
			'teacher_data'=>'current',
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
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_teacher.html');
	}
	
	public function add_teacher()
	{
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'current',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'current',
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
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_add_teacher.html');
	}

	public function upload_pic(){
		$typeArr = array("jpg", "png", "gif");//允许上传文件格式 
		$path = "./uploads/teacher/";//上传路径 
		 
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

	public function delete_teacher(){
		$id = $_POST['value'];
		$value = $this->teacher_model->delete_teacher($id);
		echo $value;
	}

	public function c_teacher(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		// file_put_contents("/home/tanxu/www/data.txt", print_r($value,true),FILE_APPEND );
		if ($this->teacher_model->add_teacher($value)) {
	    		echo '1';
	    	}else{
	    		echo 'error';
	    	}
	}

	public function change_status(){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		if ($this->teacher_model->change_status($value['status'],$value['tid'])) {
	    		echo '1';
	    	}else{
	    		echo 'error';
	    	}
	}
}

