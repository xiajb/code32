<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(dirname(__FILE__)) . '/geetest/upyun.class.php';

class Index extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('classify_model');
		$this->load->model('direction_model');
		$this->load->library('pagination');
		$this->load->model('show_model');
		$this->session->set_userdata('direction_id',0);
		$this->session->set_userdata('classify_id',0);
		$this->session->set_userdata('is_easy',0);
	}


	public function index()
	{
		$cur_page=1;
		$config['use_page_numbers']   = TRUE;
		$config['per_page'] =4;
		$offset=($cur_page-1)*$config['per_page'];
		$direction=$this->direction_model->show_direction();
		$classify=$this->classify_model->show_classify_byid(0);
		$result=$this->show_model->showcoursebyclassifyid(0,0,0,$config['per_page'],$offset,0);
		$result2=$this->show_model->showcoursebyclassifyid(0,0,0,$config['per_page'],$offset,1);
		$course=$result;
		$config['base_url'] ='http://www.qfdlqz.com/index/index2/0/0/0';
		$config['total_rows'] =count($result2);
		$config['prev_link']    = '上一页';
		$config['next_link']    = '下一页';
		$this->pagination->initialize($config);
		$page=$this->pagination->create_links();
		$data['arr']=array(
			$direction,
			$classify,
			$course,
			'total'=>$config['total_rows'] ,
			'cur_page'=>$cur_page,
			'per_page'=>$config['per_page'],
			'page'=>$page
		);
		$this->load->view("index_header.html",$data);
		$this->load->view("index.html");
		$this->load->view("index_footer.html");
	}

	public function index2($direction_id=1,$classify_id=1,$is_easy=1,$cur_page=1){
		if ($cur_page==null){
			$cur_page=1;
		}
		$config['use_page_numbers']   = TRUE;
		$config['per_page'] =4;
		$offset=($cur_page-1)*$config['per_page'];
		$direction=$this->direction_model->show_direction();
		$classify=$this->classify_model->show_classify_byid($direction_id);
		$result=$this->show_model->showcoursebyclassifyid($direction_id,$classify_id,$is_easy,$config['per_page'],$offset,0);
		$result2=$this->show_model->showcoursebyclassifyid($direction_id,$classify_id,$is_easy,$config['per_page'],$offset,1);
		$course=$result;
		$config['base_url'] ='http://www.qfdlqz.com/index/index2/'.$direction_id.'/'.$classify_id.'/'.$is_easy.'/';

		$config['total_rows'] =count($result2);
		$config['prev_link']    = '上一页';
		$config['next_link']    = '下一页';
		$this->pagination->initialize($config);
		$page=$this->pagination->create_links();
		$this->session->set_userdata('direction_id',$direction_id);
		$this->session->set_userdata('classify_id',$classify_id);
		$this->session->set_userdata('is_easy',$is_easy);

		$data['arr']=array(
			$direction,
			$classify,
			$course,
			'total'=>count($result2),
			'cur_page'=>$cur_page,
			'per_page'=>$config['per_page'],
			'page'=>$page
		);
		$this->load->view("index_header.html",$data);
		$this->load->view("index.html");
		$this->load->view("index_footer.html");

	}

	function delete(){
		$UpYun = new UpYun('code32','rxs','rxs84217621');
		echo $UpYun->delete('/video/875cbbbc8ec551845f0ff360df11376f.mp4');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
