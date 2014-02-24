<?php
class Authorize extends CI_Controller {
	function __construct() {
		parent::__construct();		
		$this->load->model('User_model');
	}
	
	function login() {
		if ($this->session->userdata('kiotiahraloggedin')) {
			redirect('admin');
		}
		$this->load->view('admin/common/header');
		$this->load->view('admin/system/login');
		$this->load->view('admin/common/footer');
	}
	
	function validate() {
		if ($this->session->userdata('kiotiahraloggedin')) {
			redirect('admin');
		}
		$user = $this->User_model->validate(array('username' => $_POST['username'],'password' => $_POST['password']));
		if ($user && $user['level'] == 9) { $this->session->set_userdata('kiotiahraloggedin',true); 
			redirect('admin');
		} else {
			$this->session->set_flashdata('error',true);
			redirect('admin/login');
		}
	}
	function logout() {
		//$this->session->destroy();
		$this->session->unset_userdata('kiotiahraloggedin');
		redirect('admin');
	}
}
?>