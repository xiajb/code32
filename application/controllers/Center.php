<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Center extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}
	//个人中心
	public function mydata()
	{	
		$data['active'] = array(
				'mydata'=>'active',
				'mycourse'=>'',
				'myorder'=>'',
				'changepw'=>'',
				'comment'=>'',
				'feedback'=>''
			);
		if ($_GET['label'] == "jiben") {
			$this->load->view("center_header.html",$data);
			$this->load->view("center_mydata_jiben.html");
			$this->load->view("center_footer.html");
		}elseif ($_GET['label'] == "xiangxi") {
			$this->load->view("center_header.html",$data);
			$this->load->view("center_mydata_xiangxi.html");
			$this->load->view("center_footer.html");
		}

	}

	public function mycourse()
	{
		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'active',
				'myorder'=>'',
				'changepw'=>'',
				'comment'=>'',
				'feedback'=>''
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_mycourse.html");
		$this->load->view("center_footer.html");

	}


	public function myorder()
	{

		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'myorder'=>'active',
				'changepw'=>'',
				'comment'=>'',
				'feedback'=>''
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_myorder.html");
		$this->load->view("center_footer.html");

	}

	public function changepw()
	{

		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'myorder'=>'',
				'changepw'=>'active',
				'comment'=>'',
				'feedback'=>''
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_changepw.html");
		$this->load->view("center_footer.html");

	}

	public function comment()
	{

		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'myorder'=>'',
				'changepw'=>'',
				'comment'=>'active',
				'feedback'=>''
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_comment.html");
		$this->load->view("center_footer.html");
	}



	public function feedback()
	{

		$data['active'] = array(
				'mydata'=>'',
				'mycourse'=>'',
				'myorder'=>'',
				'changepw'=>'',
				'comment'=>'',
				'feedback'=>'active'
			);
		$this->load->view("center_header.html",$data);
		$this->load->view("center_feedback.html");
		$this->load->view("center_footer.html");

	}	
	//再试一次
	function test ($course_id){
	$this->session->set_userdata('course_id',$course_id);

	$this->load->view("index.html");

	}
}
