<?php

class User extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
		if(!$this->ion_auth->logged_in()) redirect("login");
		
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->header->output();
	}
	
	public function index(){
		redirect("user/profile", "refresh");
	}
	
	public function profile(){
		$this->form_validation->set_error_delimiters('', '');
		
		//validate form input
		$this->form_validation->set_rules('first_name', 'First Name', 'require|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone No.', 'xss_clean');
		$this->form_validation->set_rules('company', 'Company Name', 'xss_clean');
		
		$user = $this->ion_auth->user()->row();
		
		if ($this->form_validation->run() == true){
			$data = array(
					'username' => strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name')),
					'email' => $this->input->post('email'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
			);
		}
		
		if ($this->form_validation->run() == true && $this->ion_auth->update($user->id, $data)){ 
			$this->session->set_flashdata('message', "Profile Modified");
			redirect("user/profile", 'refresh');
		}else{ 
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			
			$this->data['first_name'] = array('name' => 'first_name',
					'id' => 'first_name',
					'type' => 'text',
					'value' => $user->first_name,
			);
			$this->data['last_name'] = array('name' => 'last_name',
					'id' => 'last_name',
					'type' => 'text',
					'value' => $user->last_name,
			);
			$this->data['email'] = array('name' => 'email',
					'id' => 'email',
					'type' => 'text',
					'value' => $user->email,
			);
			$this->data['company'] = array('name' => 'company',
					'id' => 'company',
					'type' => 'text',
					'value' => $user->company,
			);
			$this->data['phone'] = array('name' => 'phone',
					'id' => 'phone',
					'type' => 'text',
					'value' => $user->phone,
			);
			$this->load->view("user/profile", $this->data);
		}
		$this->load->view("footer");
	}
	
	public function preference(){
		$this->form_validation->set_error_delimiters('', '');
		$user = $this->ion_auth->user()->row();
		$this->load->model("preference");
		
		//print_r($this->preference->get($user->id, "per_page"));
		
		$this->form_validation->set_rules("per_page", "Per Page", "required|numeric");
		
		if($this->form_validation->run() == true){
			$this->preference->set($user->id, 'per_page', $this->input->post("per_page"));
			$this->session->set_flashdata('message', "Update Preference Successfully!");
			redirect("user/preference", "refresh");
		}else{
			$this->data["message"] =  $this->session->flashdata('message');
			$this->data["per_page"] = array(
					"name" => "per_page",
					"id" => "per_page",
					"type" => "text",
					"value" => $this->preference->get($user->id, "per_page"),
					"class" => "span1"
				);
			$this->load->view("user/preference", $this->data);
		}
		$this->load->view("footer");
	}
	
}