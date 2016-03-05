<?php
/**
*
*/
class Showtv extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('show_model');
		$this->load->library('session');
		$this->load->model('course_model');
	}
	function showbyid($section_id,$course_id){
		$course=$this->course_model->getcoursebyid($course_id);
		$chapter=$this->show_model->showchapterbyid($course_id);
		$section=$this->show_model->showsectionbyid($course_id);
		$data['arr']=array($chapter,$section,$course);
		$this->session->set_userdata('section_id',$section_id);
		$this->load->view('index/show.html',$data);
		$this->load->view('about_footer.html');
	}
}




 ?>
