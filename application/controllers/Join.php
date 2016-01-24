<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Join extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('teacher_model');
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	public function index()
	{
		if ($_SESSION['username'] == '') {
			redirect("http://www.rfgxy.com/login");
			return;
		}else{
			$row = $this->user_model->check_username_is($_SESSION['username']);
			if ($row == false) {
				redirect("http://www.rfgxy.com/login");
			}elseif($row['name'] == '' || $row['pic']==""){
				redirect("http://www.rfgxy.com/center/mydata?label=xiangxi");
			}else{
				$data['pic'] = $row['pic'];
				$this->load->view("join.html",$data);
			
			}
		}

	}

	public function add_teacher(){
		$value = json_decode($this->input->post('data'),true);
		$row = $this->user_model->check_username_is($_SESSION['username']);
		// print_r($value);
		if ($row != false) {
			$value['uid'] = $row['uid'];
			$value['pic'] = $row['pic'];
			$value['check'] = 2;
			$value['apply_time'] = time();
			$this->teacher_model->add_teacher($value);
			echo '1';
		}else{
			echo '-1';
		}
		
	}

}
