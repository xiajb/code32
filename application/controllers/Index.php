<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('show_classify');
		$this->load->model('show_direction');

	}	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->session->set_userdata('direction_id',0);
		$this->session->set_userdata('classify_id',0);
		$direction=$this->show_direction->show_direction();
		$classify=$this->show_classify->show_classify_byid(0);
		$data['arr']=array($direction,$classify);
		$this->load->view("index.html",$data);
	}
	public function index2($direction_id,$classify_id){
		$direction=$this->show_direction->show_direction();
		$classify=$this->show_classify->show_classify_byid($direction_id);

		$this->session->set_userdata('direction_id',$direction_id);
		$this->session->set_userdata('classify_id',$classify_id);
		$data['arr']=array($direction,$classify);
		$this->load->view("index.html",$data);

	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
