<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

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
		$this->load->view("about.html");

	}
	public function us()
	{

		$this->load->helper('url');
		$this->load->view("us.html");

	}
	public function group()
	{

		$this->load->helper('url');
		$this->load->view("group.html");

	}
	public function job()
	{

		$this->load->helper('url');
		$this->load->view("job.html");

	}

	public function feedback()
	{

		$this->load->helper('url');
		$this->load->view("feedback.html");

	}
	public function friendly()
	{

		$this->load->helper('url');
		$this->load->view("friendly.html");

	}	
	public function faq()
	{

		$this->load->helper('url');
		$this->load->view("faq.html");

	}	
	public function contact()
	{

		$this->load->helper('url');
		$this->load->view("contact.html");

	}	
	public function recruit()
	{

		$this->load->helper('url');
		$this->load->view("recruit.html");

	}



}
