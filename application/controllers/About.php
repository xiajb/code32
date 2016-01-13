<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function us()
	{
		$data['selected'] = array(
			'us' => 'selected', 
			'group'  => '',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html");
		$this->load->view("us.html");
		$this->load->view("about_footer.html");
	}
	public function group()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => 'selected',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html");
		$this->load->view("group.html");
		$this->load->view("about_footer.html");
	}
	public function job()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => 'selected',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html");
		$this->load->view("job.html");
		$this->load->view("about_footer.html");
	}
	public function recruit()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => 'selected',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html");
		$this->load->view("recruit.html");
		$this->load->view("about_footer.html");
	}
	public function feedback()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => 'selected',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html");
		$this->load->view("feedback.html");
		$this->load->view("about_footer.html");
	}
	public function friendly()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => 'selected',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html");
		$this->load->view("friendly.html");
		$this->load->view("about_footer.html");
	}	
	public function faq()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => 'selected',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html");
		$this->load->view("faq.html");
		$this->load->view("about_footer.html");
	}	
	public function contact()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => 'selected',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html");
		$this->load->view("contact.html");
		$this->load->view("about_footer.html");
	}	


}
