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
		$this->load->model('required_model');
		$this->load->model('elective_model');
		$this->load->model('skill_model');
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
		$data['userdata'] = $this->user_model->check_username_is($_SESSION['username']);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_mydata.html");
		$this->load->view("center_footer.html");
	}

	public function user_detail(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		$this->user_model->user_detail_updata($_SESSION['username'],$value);
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
			$row = $this->user_model->check_username_is($_SESSION['username']);
			$teacher = $this->teacher_model->get_teacher($row['uid']);
			$required = $this->required_model->get_course($teacher->tid);
			$elective = $this->elective_model->get_course($teacher->tid);
			$data['course'] = array_merge($required,$elective);
			$skill = $this->skill_model->get_course($teacher->tid);
			$data['course'] = array_merge($data['course'],$skill);
			$data['checking']= array();
			$data['pass'] = array();
			$data['not_pass'] = array();
			for ($i=0; $i < count($data['course']); $i++) {
				if ($data['course'][$i]['status'] == 0) {
					$data1 = array(
						'img'=>$data['course'][$i]['img'],
						'title'=>$data['course'][$i]['title'],
						'detail'=>$data['course'][$i]['detail'],
					);
					if (array_keys($data['course'][$i])[0] == 'required_id') {
						$data1['type'] = 'required';
						$data1['id'] = $data['course'][$i]['required_id'];
					}elseif (array_keys($data['course'][$i])[0] == 'elective_id') {
						$data1['type'] = 'elective';
						$data1['id'] = $data['course'][$i]['elective_id'];
					}elseif (array_keys($data['course'][$i])[0] == 'skill_id') {
						$data1['type'] = 'skill';
						$data1['id'] = $data['course'][$i]['skill_id'];
					}
					$data['checking'][$i] = $data1;
				}elseif($data['course'][$i]['status'] == -1){
					$data2 = array(
						'img'=>$data['course'][$i]['img'],
						'title'=>$data['course'][$i]['title'],
						'detail'=>$data['course'][$i]['detail'],
					);
					if (array_keys($data['course'][$i])[0] == 'required_id') {
						$data2['type'] = 'required';
						$data2['id'] = $data['course'][$i]['required_id'];
					}elseif (array_keys($data['course'][$i])[0] == 'elective_id') {
						$data2['type'] = 'elective';
						$data2['id'] = $data['course'][$i]['elective_id'];
					}elseif (array_keys($data['course'][$i])[0] == 'skill_id') {
						$data2['type'] = 'skill';
						$data2['id'] = $data['course'][$i]['skill_id'];
					}
					$data['not_pass'][$i] = $data2;
				}elseif ($data['course'][$i]['status'] == 1) {
					$data3 = array(
						'img'=>$data['course'][$i]['img'],
						'title'=>$data['course'][$i]['title'],
						'detail'=>$data['course'][$i]['detail'],
					);
					if (array_keys($data['course'][$i])[0] == 'required_id') {
						$data3['type'] = 'required';
						$data3['id'] = $data['course'][$i]['required_id'];
					}elseif (array_keys($data['course'][$i])[0] == 'elective_id') {
						$data3['type'] = 'elective';
						$data3['id'] = $data['course'][$i]['elective_id'];
					}elseif (array_keys($data['course'][$i])[0] == 'skill_id') {
						$data3['type'] = 'skill';
						$data3['id'] = $data['course'][$i]['skill_id'];
					}
					$data['pass'][$i] = $data3;
				}
			}
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
	public function elective()
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
		$this->load->view("center_teacher_add_elective.html");
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

			//$row = $this->user_model->check_username_is($_SESSION['username']);
			//$teacher = $this->teacher_model->get_teacher($row['uid']);
			//$required = $this->required_model->get_course($teacher->tid);
			//$elective = $this->elective_model->get_course($teacher->tid);
		//	$data['course'] = array_merge($required,$elective);
		//	$skill = $this->skill_model->get_course($teacher->tid);
			//$data['course'] = array_merge($data['course'],$skill);
		//	$data['pass'] = array();
			//for ($i=0; $i < count($data['course']); $i++) {
		//		if ($data['course'][$i]['status'] == 1) {
			//		$data1 = array(
				//		'img'=>$data['course'][$i]['img'],
				//		'title'=>$data['course'][$i]['title'],
				//		'detail'=>$data['course'][$i]['detail'],
				///	);

					// if (array_keys($data['course'][$i])[0] == 'required_id') {
					// 	$data1['type'] = 'required';
					// 	$data1['id'] = $data['course'][$i]['required_id'];
					// }elseif (array_keys($data['course'][$i])[0] == 'elective_id') {
					// 	$data1['type'] = 'elective';
					// 	$data1['id'] = $data['course'][$i]['elective_id'];
					// }elseif (array_keys($data['course'][$i])[0] == 'skill_id') {
					// 	$data1['type'] = 'skill';
					// 	$data1['id'] = $data['course'][$i]['skill_id'];
					// }
				//	$data['pass'][$i] = $data1;
			//	}

		//	}
			$data['courses']=$this->course_model->query_all();
		$this->load->view("center_header.html",$data);
		$this->load->view("center_teacher_add_video.html");
		$this->load->view("center_footer.html");

	}
	public function add_section(){
			$section_arr=$this->input->post('section_arr');
			$now = time();
			$section_arr['create_time']=unix_to_human($now, TRUE, 'eu');
			$section_arr['order_no']=$this->show_model->getsection_orderbyid($section_arr['course_id'])[0]['order_no']+1;
			if ($section_arr['chapter_id2']=='0') {
				$section_arr['chapter_id']=$section_arr['chapter_id1'];
			}else{
		$chapter_arr['order_no']=$this->Chapter_model->getchapter_orderbyid($section_arr['course_id'])[0]['order_no']+1;
			$chapter_arr['chapter_name']=$section_arr['chapter_id2'];
			$chapter_arr['course_id']=$section_arr['course_id'];
			$section_arr['chapter_id']=$this->Chapter_model->add_chapter($chapter_arr);
			};
			unset($section_arr['course_id'],$section_arr['chapter_id1'],$section_arr['chapter_id2']);
			$a=$this->section_model->add_section($section_arr);
			if($a>0){
				echo '添加成功';

			};

	}
	public function ajax_getcharter($course_id){
	$chapter=$this->show_model->showchapterbyid($course_id);
	echo json_encode($chapter);

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

		if ($_SESSION['level'] == 1) {
			$data['active'] = array(
					'mydata'=>'',
					'mycourse'=>'',
					'add_course'=>'',
					'add_video'=>'',
					'comment'=>'active',
					'changepw'=>'',
				);
		}elseif ($_SESSION['level'] == 0) {
			$data['active'] = array(
					'mydata'=>'',
					'mycourse'=>'',
					'myorder'=>'',
					'changepw'=>'',
					'comment'=>'active',
					'feedback'=>''
				);
		}
		$this->load->view("center_header.html",$data);
		$this->load->view("center_comment.html");
		$this->load->view("center_footer.html");
	}



	public function feedback()
	{
// $data['csrf'] = array(
//     'name' => $this->security->get_csrf_token_name(),
//     'hash' => $this->security->get_csrf_hash()
// );
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
	// function test ($course_id){
	// $this->session->set_userdata('course_id',$course_id);

	// $this->load->view("index.html");

	// }
	public function skill_add(){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		$row = $this->user_model->check_username_is($_SESSION['username']);
		$teacher = $this->teacher_model->get_teacher($row['uid']);
		$value['add_time'] = date("Y-m-d H:i:s",time());
		$value['teacher'] = $teacher->tid;
		$this->skill_model->add_skill($value);
		echo '1';
	}

	public function elective_add(){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		$row = $this->user_model->check_username_is($_SESSION['username']);
		$teacher = $this->teacher_model->get_teacher($row['uid']);
		$value['add_time'] = date("Y-m-d H:i:s",time());
		$value['teacher'] = $teacher->tid;
		$this->elective_model->add_elective($value);
		echo '1';
	}
	public function required_add(){
		$value = $_POST;

		$value = $this->security->xss_clean($value);
		$row = $this->user_model->check_username_is($_SESSION['username']);
		$teacher = $this->teacher_model->get_teacher($row['uid']);
		$value['add_time'] = date("Y-m-d H:i:s",time());
		$value['teacher'] = $teacher->tid;
		$this->required_model->add_required($value);
		echo '1';
	}

}
