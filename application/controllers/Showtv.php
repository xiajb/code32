<?php 
/**
* 
*/
class Showtv extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	function show(){


		$this->load->view('index/show.html');
	}
}




 ?>