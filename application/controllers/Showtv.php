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
	}
	function show(){
		$chapter=$this->show_model->showtv();
		$section=$this->show_model->showtv2();
	//	$data['arr']=array($chapter,$section);
	//	$this->load->view('index/show.html',$data);
		print_r($section);

	}
	function showbyid($id){
		$course=$this->show_model->showcoursebysectionid($id);
		$course_id=$course[0]['course_id'];
		$chapter=$this->show_model->showchapterbyid($course_id);
		$section=$this->show_model->showsectionbyid($course_id);
		$data['arr']=array($chapter,$section,$course);
		$this->session->set_userdata('section_id',$id);
		$this->load->view('index/show.html',$data);

	}
}




 ?>
