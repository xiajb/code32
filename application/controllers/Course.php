<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	//
	public function index()
	{
		$this->load->helper('url');
		$this->load->view("course_temp.html");

	}
}
