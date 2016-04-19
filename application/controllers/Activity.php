<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('link_model');
		$this->load->model('activity_model');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{

		$data['result'] = $this->activity_model->get_activity_by_id(3);
		$this->load->view("about_activity.html",$data);
		$this->load->view("about_footer.html");
	}


}
