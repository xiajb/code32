<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('show_model');
		$this->load->model('user_model');
		$this->load->model('course_model');
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
			$chapter=$this->show_model->showchapterbyid($course_id);
			$section=$this->show_model->showsectionbyid($course_id);
			$course[0]['order_no']=$this->show_model->getsection_orderbyid($course_id)[0]['order_no'];
			//print_r($course);
			$data['arr']=array($chapter,$section,$course);
			$data['comment'] = $this->comment_model->get_comment_by_course($course_id);
			for ($i=0; $i < count($data['comment']); $i++) { 
				$row = $this->user_model->get_user_by_uid($data['comment'][$i]['uid']);
				// file_put_contents('/home/tanxu/www/data.txt', $data['comment'][$i]['uid']);
				// file_put_contents('/home/tanxu/www/data.txt', print_r($row,true));
				$data['comment'][$i]['pic'] = $row['pic'];
				
			}
			$this->session->set_userdata('course_id',$course_id);
			// $this->load->view("index_header.html",$data);
			$this->load->view("index/course.html",$data);
			$this->load->view("about_footer.html");
		}

	}
	function showinserttocourse(){


	}

}
