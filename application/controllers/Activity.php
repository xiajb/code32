<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('link_model');
		$this->load->model('activity_model');
		$this->load->model('join_model');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		$id = $_GET['id'];
		$data['result'] = $this->activity_model->get_activity_by_id($id);
		if ($data['result'] == '' || $data['result'] == null) {
			redirect('http://www.rfgxy.com/error');
		}else{
			$this->load->view("about_activity.html",$data);
			$this->load->view("about_footer.html");
		}
	}

	public function join(){
		$id = $_GET['id'];
		$res = $this->activity_model->get_activity_by_id($id);
		// file_put_contents('/home/tanxu/www/data.txt', $res);
		if ($res == '') {
			echo '-2';
			exit;
		}

		if (!isset($_SESSION['uid'])) {
			echo '-1';
			exit();
		}
		$join = $this->join_model->get_uid_activity($id, $_SESSION['uid']);
		if($join != []){
			echo '0';
			exit();
		}else{
			$join_data = array(
					"uid"=>$_SESSION['uid'],
					"activity_id"=>$id,
				);
			$this->join_model->add($join_data);
			echo '1';
			exit();
		}

	}

}
