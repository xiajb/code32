<?php 


/**
* 
*/
class Upload extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}




	function index(){
		$this->load->view('upload_form',array('error' =>''));
	}
	function do_upload(){
			$name=$this->input->post('usefile');
			print_r($name);
			$config=array(
				'upload_path' => './uploads/',
				'allowed_types'=>'gif|jpg|png',
				'max_size'=>'1000',
				'max_width'=>'1024',
				'max_heigh'=>'768');
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('usefile')){

				$error=array('error'=>$this->upload->display_errors());
				$this->load->view('upload_form',$error);

			}
			else{
				$data = array('upload_success' =>$this->upload->data());
				//print_r($data);
				$this->load->view('upload_success',$data);
			}
	}
}



 ?>