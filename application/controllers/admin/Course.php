<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('course_model');
		$this->load->library('session');

	}
	
	public function index()
	{
		// $data['result'] = $this->course_model->query_all();
		$this->load->view('admin/admin_course.html');
	}

	public function add_course(){

		$this->load->view('admin/admin_add_course.html');
	}

	public function upload_pic(){
		$typeArr = array("jpg", "png", "gif");//允许上传文件格式 
		$path = "./uploads/";//上传路径 
		 
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

