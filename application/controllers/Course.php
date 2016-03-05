<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('show_model');
			$this->load->model('course_model');
		$this->load->library('session');
	}
	//
	public function showcourse($course_id)
	{
		$this->load->helper('url');
		$course=$this->course_model->getcoursebyid($course_id);
		$chapter=$this->show_model->showchapterbyid($course_id);
		$section=$this->show_model->showsectionbyid($course_id);
		$data['arr']=array($chapter,$section,$course);
		$this->session->set_userdata('course_id',$course_id);
		$this->load->view("index/course.html",$data);
		$this->load->view("about_footer.html");

	}
	function showinserttocourse(){


	}

}
