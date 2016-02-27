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
		if ($_SESSION['username'] == '' || !isset($_SESSION['username'])) {
			redirect("http://www.rfgxy.com/login");
			return;
		}else{
			$row = $this->user_model->check_username_is($_SESSION['username']);
			if ($row == false) {
				redirect("http://www.rfgxy.com/login");
			}elseif($row['name'] == '' || $row['pic']==""){
				redirect("http://www.rfgxy.com/center/mydata");
			}elseif ($row['level'] == 1) {
				redirect("http://www.rfgxy.com/center/mydata");
			}else{
				$_SESSION['pic'] = $row['pic'];
				$this->load->view("join.html");
				$this->load->view("center_footer.html");
			
			}
		}

	}

	public function apply(){
		if (!isset($_SESSION['username']) || $_SESSION['username'] == '') {
			echo "-1";
			// redirect("http://www.rfgxy.com/login");
			// return;
		}else{
			$row = $this->user_model->check_username_is($_SESSION['username']);
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
		$row = $this->user_model->check_username_is($_SESSION['username']);
		if ($row == false) {
			echo '-1';
			return;
		}

		$result = $this->teacher_model->get_teacher($row['uid']);
		if ($result == false) {
			$value['uid'] = $row['uid'];
			$value['pic'] = $row['pic'];
			$value['check'] = 0;
			$value['apply_time'] = date("Y-m-d H:i",time());
			$this->teacher_model->add_teacher($value);
			echo '1';
		}elseif($result->check == 0) {
			echo '-2';
		}else{
			echo '-1';
		}
	}

}
