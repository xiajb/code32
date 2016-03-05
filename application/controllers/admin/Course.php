<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('teacher_model');
		$this->load->model('classify_model');
		$this->load->model('course_model');
		$this->load->model('chapter_model');
		$this->load->library('session');

	}

	
	public function required()
	{
		$data['result'] = $this->course_model->get_course_by_classifyid(2,'');
		$data['wait'] = $this->course_model->get_course_by_classifyid(2,'0');
		$data['nopass'] = $this->course_model->get_course_by_classifyid(2,'-1');
		$data['admin'] = $this->course_model->get_course_by_classifyid(2,'2');
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
			'feedback_manage'=>'',
			'all_feedback'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );

// $page_config['perpage']=2;   //每页条数
// $page_config['part']=2;//当前页前后链接数量
// $page_config['url']='/admin/course/required';//url
// $page_config['seg']=4;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
// $page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
// $this->load->library('mypage_class');
// $page_config['total']=$this->required_model->result_acount_status(1);
// $this->mypage_class->initialize($page_config);

// $data['check'] = $this->required_model->get_num_course(1,(int)$page_config['perpage'],(int)$page_config['nowindex']);
// $data['admin'] = $this->required_model->get_num_course(2,(int)$page_config['perpage'],(int)$page_config['nowindex']);
// $data['nopass'] = $this->required_model->get_num_course(-1,(int)$page_config['perpage'],(int)$page_config['nowindex']);


		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_required.html');
	}


	public function elective()
	{
		$data['result'] = $this->course_model->get_course_by_classifyid(1,'');
		$data['wait'] = $this->course_model->get_course_by_classifyid(1,'0');
		$data['nopass'] = $this->course_model->get_course_by_classifyid(1,'-1');
		$data['admin'] = $this->course_model->get_course_by_classifyid(1,'2');

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
			'feedback_manage'=>'',
			'all_feedback'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_elective.html');
	}



	public function skill()
	{
		$data['result'] = $this->course_model->get_course_by_classifyid(3,'');
		$data['wait'] = $this->course_model->get_course_by_classifyid(3,'0');
		$data['nopass'] = $this->course_model->get_course_by_classifyid(3,'-1');
		$data['admin'] = $this->course_model->get_course_by_classifyid(3,'2');

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
			'feedback_manage'=>'',
			'all_feedback'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_skill.html');
	}

	public function add()
	{
		$data['teacher'] = $this->teacher_model->get_by_check(2);
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
			'feedback_manage'=>'',
			'all_feedback'=>'',
			'comment_manage'=>'',
			'all_comment'=>'',
			'link_manage'=>'',
			'all_link'=>'',
			'add_link'=>'',
			 );
		$this->load->view('admin/admin_header.html',$data);
		$this->load->view('admin/admin_add_course.html');
	}


	public function add_course(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		$value['add_time'] = date("Y-m-d H:i:s",time());
		$value['status'] = '2';
		if ($this->course_model->add_course($value)) {
	    		echo '1';
	    	}else{
	    		echo 'error';
	    	}
	}

	public function delete(){
		$id = $_POST['value'];
		echo $this->course_model->delete($id);
	}

	public function get_classify(){
		$value = $_POST['data'];
		$value = $this->security->xss_clean($value);
		$row = $this->classify_model->Show_classify_byid($value);
		// echo json_encode($row);
		$string = '';
		for ($i=0; $i < count($row); $i++) { 
			$string.= '<option value="'.$row[$i]['classify_id'].'">'.$row[$i]['classify_name'].'</option>';
		}
		echo $string;
	}

	public function get_chapter(){
		$value = $_POST['data'];
		$value = $this->security->xss_clean($value);
		$row = $this->chapter_model->get_chapter_by_id($value);
		if(is_array($row)){
			$string = '';
			for ($i=0; $i < count($row); $i++) { 
				$string.= '<option value="'.$row[$i]['chapter_id'].'">'.$row[$i]['chapter_name'].'</option>';
			}
		}
		echo $string;
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


}

