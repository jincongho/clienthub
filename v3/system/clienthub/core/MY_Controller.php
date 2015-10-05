<?php

class MY_Controller extends CI_Controller{
	
	protected $only_admin = false; 
	
	public $view = array();
	
	public function __construct(){
		parent::__construct();
		
		if(!$this->ion_auth->logged_in()) redirect("login");
		if(!$this->ion_auth->is_admin() && $this->only_admin === true)
			redirect("");
		
		$this->view["user"]	= $this->ion_auth->user()->row();
		$this->view["message"] = $this->session->flashdata('message');
		$this->view["permits"]	= ($this->ion_auth->is_admin() || is_superadmin($this->ion_auth->user()->row()->id));
	}
	
	protected function __run($view, $data = array()){
		$this->header->output();
		$this->load->view($view, array_merge($this->view, $data));
		$this->load->view("footer");
	} 
	
}