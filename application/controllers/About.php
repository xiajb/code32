<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('link_model');
		$this->load->model('feedback_model');
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
		$this->load->view("about_header.html",$data);
		$this->load->view("about_us.html");
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
		$this->load->view("about_header.html",$data);
		$this->load->view("about_group.html");
		$this->load->view("about_footer.html");
	}
	public function job()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => '',
			'job' => 'selected',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html",$data);
		$this->load->view("about_job.html");
		$this->load->view("about_footer.html");
	}
	public function recruit()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => '',
			'job' => '',
			'recruit' => 'selected',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html",$data);
		$this->load->view("about_recruit.html");
		$this->load->view("about_footer.html");
	}
	public function contact()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => '',
			'job' => '',
			'recruit' => '',
			'contact' => 'selected',
			'faq' => '',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html",$data);
		$this->load->view("about_contact.html");
		$this->load->view("about_footer.html");
	}		

	public function faq()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => '',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => 'selected',
			'feedback' => '',
			'friendly' => ''
		);
		$this->load->view("about_header.html",$data);
		$this->load->view("about_faq.html");
		$this->load->view("about_footer.html");
	}		
	public function feedback()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => '',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => 'selected',
			'friendly' => ''
		);
		$this->load->view("about_header.html",$data);
		$this->load->view("about_feedback.html");
		$this->load->view("about_footer.html");
	}
	public function friendly()
	{
		$data['selected'] = array(
			'us' => '', 
			'group'  => '',
			'job' => '',
			'recruit' => '',
			'contact' => '',
			'faq' => '',
			'feedback' => '',
			'friendly' => 'selected'
		);
		$data['link'] = $this->link_model->query_all();
		$this->load->view("about_header.html",$data);
		$this->load->view("about_friendly.html");
		$this->load->view("about_footer.html");
	}	

	public function feed_back(){
		$value = json_decode($this->input->post('data'),true);
		$value = $this->security->xss_clean($value);
		$value["feedback_time"] = date("Y-m-d H:i",time());
		if ($this->feedback_model->add_feedback($value)) {
			echo '1';
		}else{
			echo '-1';
		}
	}


}
