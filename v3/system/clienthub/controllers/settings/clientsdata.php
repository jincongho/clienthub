<?php

class Clientsdata extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
		if(!$this->ion_auth->logged_in()) redirect("login");
		if(!$this->ion_auth->is_admin() && !is_superadmin($this->ion_auth->user()->row()->id)) redirect("");
				
		$this->header->css[] = "assets/css/clientsdata.css";
		$this->header->js[] = "assets/js/jquery-ui-1.8.23.custom.min.js";
		$this->header->js[] = "assets/js/jqueryui/jquery.ui.core.min.js";
		$this->header->js[] = "assets/js/jqueryui/jquery.ui.mouse.min.js";
		$this->header->js[] = "assets/js/jqueryui/jquery.ui.widget.min.js";
		$this->header->js[] = "assets/js/jqueryui/jquery.ui.sortable.min.js";
		
		$this->header->output();
		$this->load->model('Clientdbmodel');
		$this->load->library("form_validation");
	}
	
	public function index(){
		
		$this->form_validation->set_rules('fieldslug[]', 'Slug Name', 'required|trim');
		
		if($this->form_validation->run() == true){
			$this->Clientdbmodel->build($this->input->post());
		}
		
		$this->load->view("settings/clientsdata", array(
			"fields" => $this->Clientdbmodel->get_fields(),
			"message" => validation_errors()	
		));		
		$this->load->view("footer");
	}
	
}