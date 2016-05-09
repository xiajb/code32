<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Center extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
			$this->load->model('section_model');
			$this->load->model('Chapter_model');
		$this->load->helper('date');
		$this->load->model('show_model');
		$this->load->model('course_model');
		$this->load->model('user_model');
		$this->load->model('teacher_model');
		$this->load->model('feedback_model');
		$this->load->model('classify_model');
		$this->load->model('comment_model');
		$this->load->library('session');
		$this->load->helper('url');
	}
	//个人中心
	public function mydata()
	{
		if ($_SESSION['level'] == 1) {
			$data['active'] = array(
					'mydata'=>'active',
					'mycourse'=>'',
					'add_course'=>'',
					'add_video'=>'',
					'comment'=>'',
					'changepw'=>'',
				);
		}elseif ($_SESSION['level'] == 0) {
			$data['active'] = array(
					'mydata'=>'active',
					'mycourse'=>'',
					'myorder'=>'',
					'changepw'=>'',
					'comment'=>'',
					'feedback'=>''
				);
		}
		$data['userdata'] = $this->user_model->get_user_by_uid($_SESSION['uid']);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_mydata.html");
		$this->load->view("center_footer.html");
	}

	public function user_detail(){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		$this->user_model->user_detail_updata($_SESSION['uid'],$value);
		if ($value['pic'] != '') {
			$row = $this->user_model->get_user_by_uid($_SESSION['uid']);
			$this->session->set_userdata('pic',$row['pic']);
		}
		echo '1';


	}

	public function mycourse()
	{
		if ($_SESSION['level'] == 1) {
			$data['active'] = array(
					'mydata'=>'',
					'mycourse'=>'active',
					'add_course'=>'',
					'add_video'=>'',
					'comment'=>'',
					'changepw'=>'',
				);
			$row = $this->user_model->get_user_by_uid($_SESSION['uid']);
			$teacher = $this->teacher_model->get_teacher($row['uid']);
			$data['checking'] = $this->course_model->get_course_by_id($teacher->tid,'0');
			$data['pass'] = $this->course_model->get_course_by_id($teacher->tid,'1');
			$data['not_pass'] = $this->course_model->get_course_by_id($teacher->tid,'-1');

		}elseif ($_SESSION['level'] == 0) {
			$data['active'] = array(
					'mydata'=>'',
					'mycourse'=>'active',
					'myorder'=>'',
					'changepw'=>'',
					'comment'=>'',
					'feedback'=>''
				);
		}
		$this->load->view("center_header.html",$data);
		$this->load->view("center_mycourse.html");
		$this->load->view("center_footer.html");

	}


	//teacher
	public function add()
	{
		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'add_course'=>'active',
				'add_video'=>'',
				'comment'=>'',
				'changepw'=>'',
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_teacher_add_course.html");
		$this->load->view("center_footer.html");

	}
	public function skill()
	{
		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'add_course'=>'active',
				'add_video'=>'',
				'comment'=>'',
				'changepw'=>'',
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_teacher_add_skill.html");
		$this->load->view("center_footer.html");

	}

	public function required()
	{
		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'add_course'=>'active',
				'add_video'=>'',
				'comment'=>'',
				'changepw'=>'',
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_teacher_add_required.html");
		$this->load->view("center_footer.html");

	}



	//teacher
	public function add_video()
	{

		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'add_course'=>'',
				'add_video'=>'active',
				'comment'=>'',
				'changepw'=>'',
			);
		$lectruer = $this->teacher_model->get_teacher($_SESSION['uid']);
		$data['courses']=$this->course_model->get_course_by_lectruer($lectruer->tid);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_teacher_add_video.html");
		$this->load->view("center_footer.html");

	}
	public function add_section(){
			$section_arr = $_POST;
			$section_arr = $this->security->xss_clean($section_arr);
			$now = time();
			$section_arr['create_time']=unix_to_human($now, TRUE, 'eu');
			$section_arr['order_no']=$this->show_model->getsection_orderbyid($section_arr['courses'])[0]['order_no']+1;
			if ($section_arr['chapter2']=='') {
				$section_arr['chapter_id']=$section_arr['chapter1'];
			}else{
				$chapter_arr['order_no']=$this->Chapter_model->getchapter_orderbyid($section_arr['courses'])[0]['order_no']+1;
				$chapter_arr['chapter_name']=$section_arr['chapter2'];
				$chapter_arr['course_id']=$section_arr['courses'];
				$section_arr['chapter_id']=$this->Chapter_model->add_chapter($chapter_arr);
			};
			unset($section_arr['courses'],$section_arr['chapter1'],$section_arr['chapter2'],$section_arr['ci_csrf_token']);
			$a=$this->section_model->add_section($section_arr);
			if($a>0){
				echo '1';
				exit();
				// redirect('http://www.rfgxy.com/center/add');
			}else{
				echo '-1';
				exit();
			};

	}
	// public function ajax_getcharter($course_id){
	// $chapter=$this->show_model->showchapterbyid($course_id);
	// echo json_encode($chapter);

	// }

	public function get_charter(){
		$value = $_POST;
		$value = $this->security->xss_clean($value);

		$row=$this->show_model->showchapterbyid($value['course_id']);	
		$string = '';
		for ($i=0; $i < count($row); $i++) { 
			$string.= '<option value="'.$row[$i]['chapter_id'].'">'.$row[$i]['chapter_name'].'</option>';
		}
		echo $string;
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

		if ($_SESSION['level'] == 1) {
			$data['active'] = array(
					'mydata'=>'',
					'mycourse'=>'',
					'add_course'=>'',
					'add_video'=>'',
					'comment'=>'',
					'changepw'=>'active',
				);
		}elseif ($_SESSION['level'] == 0) {
			$data['active'] = array(
					'mydata'=>'',
					'mycourse'=>'',
					'myorder'=>'',
					'changepw'=>'active',
					'comment'=>'',
					'feedback'=>''
				);
		}
		$this->load->view("center_header.html",$data);
		$this->load->view("center_changepw.html");
		$this->load->view("center_footer.html");

	}
	//ajax判断原密码是否正确
	public function pwd_is_true(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		$row = $this->user_model->get_user_by_uid($_SESSION['uid']);
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
		$value = $_POST;
		$value = $this->security->xss_clean($value);

		$row = $this->user_model->get_user_by_uid($_SESSION['uid']);
		if ($row != false) {
			if ($row['password'] == md5($value['former_pwd'])) {
				$this->user_model->for_username_change_pwd($_SESSION['uid'],$value['password']);

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

		if ($_SESSION['level'] == 1) {
			$value = $_GET;
			$data['active'] = array(
					'mydata'=>'',
					'mycourse'=>'',
					'add_course'=>'',
					'add_video'=>'',
					'comment'=>'active',
					'changepw'=>'',
				);
			$teacher = $this->teacher_model->get_teacher($_SESSION['uid']);
			$course = $this->course_model->get_course_by_lectruer($teacher->tid);
			$data['result'] =array();
			for ($i=0; $i < count($course); $i++) { 
				$data['result']+= $this->comment_model->get_comment_by_course($course[$i]['course_id']);

			}
			if (!isset($value['page']) || $value['page'] == 1) {
				$data['result'] = $this->course_model->get_course_like_limit(0,2,$value['words']);
			}else{
				$firstcount = ((int)$value['page']-1) * (int)$value['page'];
				$data['result'] = $this->course_model->get_course_like_limit($firstcount,2,$value['words']);
			}
			$data['total'] = count($data['result']);


		// $data['total'] = $this->course_model->get_like_count($value['words']);
		// $data['value'] = $value;
		// if (!isset($value['page']) || $value['page'] == 1) {
		// 	$data['result'] = $this->course_model->get_course_like_limit(0,2,$value['words']);
		// }else{
		// 	$firstcount = ((int)$value['page']-1) * (int)$value['page'];
		// 	$data['result'] = $this->course_model->get_course_like_limit($firstcount,2,$value['words']);
		// }
			// file_put_contents('/home/tanxu/www/data.txt', print_r($data['result'],true),FILE_APPEND);

		}elseif ($_SESSION['level'] == 0) {
			$value = $_GET;
			$data['active'] = array(
					'mydata'=>'',
					'mycourse'=>'',
					'myorder'=>'',
					'changepw'=>'',
					'comment'=>'active',
					'feedback'=>''
				);
			$uid = $_SESSION['uid'];
			$data['total']=$this->comment_model->get_count_by_uid($uid);
			if (!isset($value['page']) || $value['page'] == 1) {
				$data['result'] = $this->comment_model->get_limit_by_uid($uid,2,0);
			}else{
				$firstcount = ((int)$value['page']-1) * (int)$value['page'];
				$data['result'] = $this->comment_model->get_limit_by_uid($uid,2,$firstcount);
			}
		}
		$this->load->view("center_header.html",$data);
		$this->load->view("center_comment.html");
		$this->load->view("center_footer.html");
	}



	public function feedback()
	{
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
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		$row = $this->user_model->get_user_by_uid($_SESSION['uid']);
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

	public function add_course(){
		$value = $_POST;

		$value = $this->security->xss_clean($value);
		$teacher = $this->teacher_model->get_teacher($_SESSION['uid']);
		$value['add_time'] = date("Y-m-d H:i:s",time());
		$value['course_lectruer_id'] = $teacher->tid;
		echo $this->course_model->add_course($value);
		// echo '1';
	}

	public function get_classify(){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		$row = $this->classify_model->Show_classify_byid($value['direction']);
		// echo json_encode($row);
		$string = '';
		for ($i=0; $i < count($row); $i++) { 
			$string.= '<option value="'.$row[$i]['classify_id'].'">'.$row[$i]['classify_name'].'</option>';
		}
		echo $string;
	}

}
