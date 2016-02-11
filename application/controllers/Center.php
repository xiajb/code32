<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Center extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('feedback_model');
		$this->load->library('session');
		$this->load->helper('url');
	}
	//个人中心
	public function mydata()
	{	
		$data['active'] = array(
				'mydata'=>'active',
				'mycourse'=>'',
				'myorder'=>'',
				'changepw'=>'',
				'comment'=>'',
				'feedback'=>''
			);
		switch ($_GET['label']) {
			case 'jiben':
				$this->load->view("center_header.html",$data);
				$this->load->view("center_mydata_jiben.html");
				$this->load->view("center_footer.html");
				break;
			case 'xiangxi':
				$this->load->view("center_header.html",$data);
				$this->load->view("center_mydata_xiangxi.html");
				$this->load->view("center_footer.html");
				break;
			case '':
				$this->load->view("center_header.html",$data);
				$this->load->view("center_mydata_jiben.html");
				$this->load->view("center_footer.html");
				break;
		}


	}

	public function user_detail(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		$this->user_model->user_detail_updata($_SESSION['username'],$value);
		echo '1';
		
			
	}

	public function mycourse()
	{
		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'active',
				'myorder'=>'',
				'changepw'=>'',
				'comment'=>'',
				'feedback'=>''
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_mycourse.html");
		$this->load->view("center_footer.html");

	}


	public function myorder()
	{

		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'myorder'=>'active',
				'changepw'=>'',
				'comment'=>'',
				'feedback'=>''
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_myorder.html");
		$this->load->view("center_footer.html");

	}

	public function changepw()
	{

		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'myorder'=>'',
				'changepw'=>'active',
				'comment'=>'',
				'feedback'=>''
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_changepw.html");
		$this->load->view("center_footer.html");

	}
	//ajax判断原密码是否正确
	public function pwd_is_true(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		$row = $this->user_model->check_username_is($_SESSION['username']);
		if ($row != false) {
			if ($row['password'] == md5($value['password'])) {
				echo '1';
			}else{
				echo '-1';
			}
		}else{
			echo '0';
		}

	}

	public function change_pw(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);

		$row = $this->user_model->check_username_is($_SESSION['username']);
		if ($row != false) {
			if ($row['password'] == md5($value['former_pwd'])) {
				$this->user_model->for_username_change_pwd($_SESSION['username'],$value['password']);
				
				echo '1';
			}else{
				echo '-1';
			}
		}else{
			echo '0';
		}
	}

	public function comment()
	{

		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'myorder'=>'',
				'changepw'=>'',
				'comment'=>'active',
				'feedback'=>''
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_comment.html");
		$this->load->view("center_footer.html");
	}



	public function feedback()
	{
$data['csrf'] = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'myorder'=>'',
				'changepw'=>'',
				'comment'=>'',
				'feedback'=>'active'
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_feedback.html");
		$this->load->view("center_footer.html");

	}	

	public function feed_back(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		$value["username"] = $_SESSION['username'];
		$row = $this->user_model->check_username_is($value["username"]);
		if ($row != false) {
			$value['phone'] = $row['phone'];
			$value['email'] = $row['email'];
			$value['vip'] = $row['vip'];
			$value["feedback_time"] = date("Y-m-d H:i",time());
			if ($this->feedback_model->add_feedback($value)) {
				echo '1';
			}else{
				echo '-1';
			}
		}else{
			echo '0';
		}
	}
	public function upload_pic(){
		$typeArr = array("jpg", "png", "gif");//允许上传文件格式 
		$path = "./uploads/user_pic/";//上传路径 
		 
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
	//再试一次
	function test ($course_id){
	$this->session->set_userdata('course_id',$course_id);

	$this->load->view("index.html");

	}
}
