<?php 

/** * * 后台权限拦截钩子 * @link http://www.php-chongqing.com * @author bing.peng *  */
class CenterAuth {
	private $CI;            
	public function __construct() {
		$this->CI = &get_instance();
	}
	/**     * 权限认证     */    
	public function auth() {        
		$this->CI->load->helper('url');
		if ( preg_match("/center.*/i", uri_string()) ) {
			// 需要进行权限检查的URL            
			$this->CI->load->library('session');
			$this->CI->load->model('user_model');
			$username = $this->CI->session->userdata('username');


			
			if (!$username) {
			 	redirect('http://www.rfgxy.com/login');           	
			}       
			if (!$this->CI->session->userdata('pic')) {
				$row = $this->CI->user_model->check_username_is($username);
				if ($row['pic'] != '') {
					$this->CI->session->set_userdata('pic', '.'.$row['pic']);
					
				}else{
					$this->CI->session->set_userdata('pic', '../index/style/touxiang.gif');
				}	
			}
     
		}            
	}        
}
 ?>

