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
		if ($_SESSION['uid'] == '' || !isset($_SESSION['uid'])) {
			redirect("http://www.rfgxy.com/login");
			return;
		}else{
			$row = $this->user_model->get_user_by_uid($_SESSION['uid']);
			if ($row == false) {
				redirect("http://www.rfgxy.com/login");
			}elseif($row['name'] == '' || $row['pic']==""){
				redirect("http://www.rfgxy.com/center/mydata");
			}elseif ($row['level'] == 1) {
				redirect("http://www.rfgxy.com/center/mydata");
			}else{
				$this->load->view("index_header.html");
				$this->load->view("join.html");
				$this->load->view("index_footer.html");
			
			}
		}

	}

	public function apply(){
		if (!isset($_SESSION['uid']) || $_SESSION['uid'] == '') {
			echo "-1";
			// redirect("http://www.rfgxy.com/login");
			// return;
		}else{
			$row = $this->user_model->get_user_by_uid($_SESSION['uid']);
			if ($row == false) {
				echo "-1";
			}elseif($row['name'] == '' || $row['pic']==""){
				echo "-2";
			}elseif ($row['level'] == 1) {
				echo "-3";
			}else{
				echo "1";
			}
		}
	}

	public function add_teacher(){
		$value = $_POST;
		$value = $this->security->xss_clean($value);
		$row = $this->user_model->get_user_by_uid($_SESSION['uid']);
		if ($row == false) {
			echo '-1';
			exit();
		}

		$result = $this->teacher_model->get_teacher($row['uid']);
		if ($result == false) {
			$value['uid'] = $row['uid'];
			$value['pic'] = $row['pic'];
			$value['status'] = 0;
			$value['apply_time'] = date("Y-m-d H:i",time());
			$this->teacher_model->add_teacher($value);
			echo '1';
			exit();
		}elseif($result->status == 0) {
			echo '-2';
			exit();
		}else{
			echo '-1';
			exit();
		}
	}

}
