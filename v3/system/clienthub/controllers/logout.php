<?php defined('BASEPATH') or exit('No direct script access allowed.'); 

class Logout extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}
	
	function index(){
		$this->data['title'] = "Logout";
		
		$logout = $this->ion_auth->logout();

		redirect('login', 'refresh');
	}
	
}