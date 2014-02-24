<?php
class Error extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Customer_model');
	}
	
	function error_404() {
		$data['page_title'] = "Page Not Found";
		$this->load->view('common/header',$data);
		//$this->load->view('common/leftbar',$data);
		$this->load->view('error/404');
		$this->load->view('common/footer');
	}
}
?>