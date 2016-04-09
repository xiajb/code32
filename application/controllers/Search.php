<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('course_model');
	}

	public function index(){
		$value = $_GET;
		// $data['course'] = $this->course_model->get_course_like_limit(1,$words);

		// $page_config['perpage']=2;   //每页条数
		// $page_config['part']=2;//当前页前后链接数量
		// $page_config['url']='/search/index';//url
		// $page_config['seg']=3;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		// $page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		// $this->load->library('mypage_class');
		// $page_config['total']=$this->course_model->get_like_count($words);
		// $this->mypage_class->initialize($page_config);
		// if ($page_config['nowindex'] == 1) {
		// 	$data['result'] = $this->course_model->get_course_like_limit(0,(int)$page_config['perpage'],$words);
		// }else{
		// 	$firstcount = ((int)$page_config['nowindex']-1) * (int)$page_config['perpage'];
		// 	$data['result'] = $this->course_model->get_course_like_limit($firstcount,(int)$page_config['perpage'],$words);
		// }
		$data['total'] = $this->course_model->get_like_count($value['words']);
		$data['value'] = $value;
		if (!isset($value['page']) || $value['page'] == 1) {
			$data['result'] = $this->course_model->get_course_like_limit(0,2,$value['words']);
		}else{
			$firstcount = ((int)$value['page']-1) * (int)$value['page'];
			$data['result'] = $this->course_model->get_course_like_limit($firstcount,2,$value['words']);
		}
		// file_put_contents('/home/tanxu/www/data.txt', print_r($data['course'],true));
		$this->load->view('index_header.html',$data);
		$this->load->view('search.html');
		$this->load->view('index_footer.html');
	}
}
