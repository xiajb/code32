<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('required_model');
		$this->load->model('teacher_model');
		$this->load->model('elective_model');
		$this->load->model('skill_model');
		$this->load->library('session');

	}
	
	public function required()
	{
		$data['result'] = $this->required_model->query_all();
		$data['nopass'] = $this->required_model->query_by_nopass();
		$data['check'] = $this->required_model->query_by_check();
		$data['admin'] = $this->required_model->query_by_admin();

		$data['teacher'] = $this->teacher_model->query_admin_add();
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
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
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_required.html');
	}

	public function required_add(){
		$value = json_decode($this->input->post('data'),true);
		$value['add_time'] = date("Y-m-d H:i:s",time());
		$this->required_model->add_required($value);
		echo '1';
	}

	public function elective()
	{
		$data['result'] = $this->elective_model->query_all();
		$data['nopass'] = $this->elective_model->query_by_nopass();
		$data['check'] = $this->elective_model->query_by_check();
		$data['admin'] = $this->elective_model->query_by_admin();

		$data['teacher'] = $this->teacher_model->query_admin_add();
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
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
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_elective.html');
	}


	public function elective_add(){
		$value = json_decode($this->input->post('data'),true);
		$value['add_time'] = date("Y-m-d H:i:s",time());
		$this->elective_model->add_elective($value);
		echo '1';
	}


	public function skill()
	{
		$data['result'] = $this->skill_model->query_all();
		$data['nopass'] = $this->skill_model->query_by_nopass();
		$data['check'] = $this->skill_model->query_by_check();
		$data['admin'] = $this->skill_model->query_by_admin();

		$data['teacher'] = $this->teacher_model->query_admin_add();
		$data['current'] = array('data_back'=>'',
			'user_manage'=>'',
			'user_data' =>'' ,
			'teacher_data'=>'',
			'add_teacher'=>'',
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
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_skill.html');
	}

	public function skill_add(){
		$value = json_decode($this->input->post('data'),true);
		$value['add_time'] = date("Y-m-d H:i:s",time());
		$this->skill_model->add_skill($value);
		echo '1';
	}




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
		// file_put_contents("/home/tanxu/www/data.txt", print_r($value,true),FILE_APPEND );
		if ($this->course_model->add_course($value)) {
	    		echo '1';
	    	}else{
	    		echo 'error';
	    	}
	}
}

