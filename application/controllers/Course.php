<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('show_model');
		$this->load->model('user_model');
		$this->load->model('teacher_model');
		$this->load->model('course_model');
		$this->load->model('collect_model');
		$this->load->model('comment_model');
		$this->load->library('session');
	}
	//
	public function showcourse($course_id)
	{
		$this->load->helper('url');
		$course=$this->course_model->getcoursebyid($course_id);
		if (empty($course)) {
			$this->load->view("404.html");
		}else{
			//print_r($course);
			//echo '<br>';
			$data['tid'] = $course[0]['course_lectruer_id'];
			$data['teacher'] = $this->teacher_model->get_by_tid($data['tid']);
			$chapter=$this->show_model->showchapterbyid($course_id);
			$section=$this->show_model->showsectionbyid($course_id);
			$course[0]['order_no']=$this->show_model->getsection_orderbyid($course_id)[0]['order_no'];
			//print_r($course);
			$data['arr']=array($chapter,$section,$course);
			// file_put_contents('/home/tanxu/www/data.txt', print_r($data['arr'],true));
			$data['comment'] = $this->comment_model->get_comment_by_course($course_id);
			for ($i=0; $i < count($data['comment']); $i++) { 
				$row = $this->user_model->get_user_by_uid($data['comment'][$i]['uid']);
				$data['comment'][$i]['pic'] = $row['pic'];
				
			}
			$data['total'] = $this->course_model->get_count_by_teacher($data['tid']);
			$this->session->set_userdata('course_id',$course_id);
			// $this->load->view("index_header.html",$data);
			$this->load->view("index/course.html",$data);
			$this->load->view("about_footer.html");
		}

	}
	function update_likes(){
		$value = $_POST;
		// file_put_contents('/home/tanxu/www/data.txt', $value['tid']);
		if (isset($value['tid'])) {
			echo $this->teacher_model->update_likes($value['tid']);
		}else{
			echo '-1';
		}

	}

	function update_course_zan(){
		$value = $_POST;
		if (isset($value['course_id'])) {
			echo $this->course_model->update_zan($value['course_id']);
		}else{
			echo '-1';
		}

	}



	function add_collect(){
		if (!isset($_SESSION['uid'])) {
			echo '-3';
			exit();	
		}
		$value = $_POST;
		if (!isset($value['course_id'])) {
			echo '-1';
			exit();
		}
		$collect = $this->collect_model->query_by_course($value['course_id'],$_SESSION['uid']);
		if ($collect == '') {
			$data['uid'] = $_SESSION['uid'];
			$data['course_id'] = $value['course_id'];
			$this->course_model->update_collects($value['course_id']);
			echo $this->collect_model->add_collect($data);
			exit();
		}else{
			echo '-2';
			exit();
		}
	}

}
