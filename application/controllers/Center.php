<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Center extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	//个人中心
	public function index()
	{

		$this->load->helper('url');
		$this->load->view("center.html");

	}
//再试一次
	function test ($course_id){
	$this->session->set_userdata('course_id',$course_id);

	$this->load->view("index.html");

	}
}
