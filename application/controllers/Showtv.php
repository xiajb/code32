<?php 
/**
* 
*/
class Showtv extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('show_model');
	}
	function show(){
		$chapter=$this->show_model->showtv();
		$section=$this->show_model->showtv2();
		$data['arr']=array($chapter,$section);
		//$lenth=count($chapter);
		//$lenth2=count($section);
		/*for($i=0;$i<$lenth;$i++){
			echo $chapter[$i]['chapter_name'];
			echo '<br>';
			for ($t=0; $t<$lenth2; $t++) { 
				if ($chapter[$i]['chapter_name']==$section[$t]['chapter_name']){
					echo $section[$t]['section_name'];
					echo '<br>';
				}
				*/
			

			//}
			
			
		//}
				$this->load->view('index/show.html',$data);
		
	}
}




 ?>